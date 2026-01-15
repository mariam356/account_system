<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\Store;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class InventoryController extends Controller
{


    public function index()
    {

        return view('managements.stores.inventory.index');

    }

    public function show(Request $request)
    {
        $table_length = $request->get('table_length', 10);

        $products = Product::with('unit')
            // جلب مجموع الداخل
            ->withSum('inventory as total_in', 'quantity_in')
            // جلب مجموع الخارج
            ->withSum('inventory as total_out', 'quantity_out')
            ->orderBy('id', 'desc')
            ->paginate($table_length);

        $products->getCollection()->transform(function ($product) {
            // حساب الصافي (الداخل - الخارج) مع معالجة القيم الفارغة
            $systemQuantity = ($product->total_in ?? 0) - ($product->total_out ?? 0);

            return [
                'product_id'       => $product->id,
                'name'             => $product->name,
                'unit_name'        => $product->unit->name ?? '',
                'system_quantity'  => $systemQuantity,
                'actual_quantity'  => $systemQuantity,
            ];
        });

        return response()->json($products);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $products = \App\Models\Product::with('unit') // جلب الوحدة
        ->withSum('inventory as total_in', 'quantity_in') // حساب الداخل
        ->withSum('inventory as total_out', 'quantity_out') // حساب الخارج
        ->when($query, function($q) use ($query) {
            $q->whereTranslationLike('name', "%{$query}%")
                ->orWhereHas('unit', function ($q1) use ($query) {
                    $q1->whereTranslationLike('name', "%{$query}%");
                });
        })
            ->orderBy('id', 'desc')
            ->get();

        // تحويل البيانات لتشمل الحقول التي يتوقعها كود الـ Vue
        $formattedData = $products->map(function ($product) {
            $systemQuantity = ($product->total_in ?? 0) - ($product->total_out ?? 0);
            return [
                'product_id'       => $product->id,
                'name'             => $product->name,
                'unit_name'        => $product->unit->name ?? '',
                'system_quantity'  => $systemQuantity,
                'actual_quantity'  => $systemQuantity,
            ];
        });

        return response()->json($formattedData);
    }


    public function store(Request $request)
    {
        // 1. التحقق من البيانات (Validation)
        // نتحقق أن المصفوفة موجودة وأن كل كمية فعلية هي رقم صحيح لا يقل عن 0
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.actual_quantity' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->products as $product) {
                $productId = $product['product_id'];

                // 2. حساب الكمية الحالية في السيرفر
                $systemQty = Inventory::where('product_id', $productId)
                    ->selectRaw('SUM(quantity_in) - SUM(quantity_out) as total')
                    ->value('total') ?? 0;

                $actualQty = $product['actual_quantity'];
                $difference = $actualQty - $systemQty;

                if ($difference != 0) {
                    // 3. جلب متوسط التكلفة أو آخر سعر شراء
                    // سنبحث عن آخر حركة دخول (quantity_in > 0) لهذا الصنف لها سعر
                    $lastPrice = Inventory::where('product_id', $productId)
                        ->where('quantity_in', '>', 0)
                        ->where('price', '>', 0)
                        ->latest()
                        ->value('price') ?? 0;

                    // ملاحظة: إذا لم يوجد سعر سابق (صنف جديد تماماً)، سيظل 0 أو يمكنك وضع سعر افتراضي

                    Inventory::create([
                        'product_id'       => $productId,
                        'quantity_in'      => $difference > 0 ? $difference : 0,
                        'quantity_out'     => $difference < 0 ? abs($difference) : 0,
                        'price'            => $lastPrice, // تخزين السعر لضمان دقة التكلفة
                        'movement_type_id' => 6, // نوع الحركة: تسوية جردية
                        'created_at'       => now(),
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'تم حفظ التسوية وتحديث التكاليف بنجاح']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => 'حدث خطأ: ' . $e->getMessage()], 500);
        }
    }



}
