<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryMovementController extends Controller
{
    public function index(Request $request)
    {
        $table_length = $request->get('table_length', 10);
        $productId = $request->get('product_id'); // استقبال رقم المنتج من الفلتر

        $movements = Inventory::with('product')

            ->when($productId, function ($query) use ($productId) {
                // إذا اختار المستخدم منتجاً، اجلب حركاته فقط
                return $query->where('product_id', $productId);
            })
            ->orderBy('created_at', 'asc')
            ->paginate($table_length)
            ->appends($request->all()); // مهم جداً للحفاظ على الفلتر عند التنقل بين الصفحات

        // تأكد من تمرير قائمة المنتجات لعرضها في الـ Select
        $product = \App\Models\Product::all();
        $movement_type = \App\Models\MovementType::all();
        return view('managements.stores.category_movement.index', compact('movements','movement_type', 'product'));
    }

    public function search(Request $request)
    {
        // 1. استلام القيم
        $MovementTypeId = $request->get('movement_type_id');
        $productId = $request->get('product_id');
        $fromDate = $request->get('from_date');
        $toDate = $request->get('to_date');
        $queryStr = $request->get('query');

        // 2. بناء الاستعلام الأساسي
        $query = Inventory::with('product', 'movement_type');

        // 3. إضافة الشروط (فقط إذا كانت القيمة مرسلة فعلاً)
        if ($request->filled('product_id')) {
            $query->where('product_id', $productId);
        }

        if ($request->filled('movement_type_id')) {
            $query->where('movement_type_id', $MovementTypeId);
        }
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $fromDate);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $toDate);
        }

        if ($request->filled('query')) {
            $query->whereHas('product', function($q) use ($queryStr) {
                $q->whereTranslationLike('name', "%{$queryStr}%");
            });
        }

        // 4. نقطة الحماية: إذا لم يتم إرسال أي فلتر على الإطلاق، ارجع مصفوفة فارغة
        // هذا يمنع ظهور كل البيانات عند فتح الصفحة أو المسح
        if (!$request->anyFilled(['product_id', 'from_date', 'to_date', 'query','movement_type_id'])) {
            return response()->json([]);
        }

        $movements = $query->orderBy('created_at', 'desc')->get();

        return response()->json($movements);
    }

    // حفظ حركة أو عدة حركات
    public function store(Request $request)
    {
        foreach ($request->products as $product) {
            $systemQty = Inventory::where('product_id', $product['product_id'])->sum('quantity_in')
                - Inventory::where('product_id', $product['product_id'])->sum('quantity_out');

            $quantityDiff = $product['actual_quantity'] - $systemQty;

            if ($quantityDiff == 0) continue;

            // تحديد كمية الداخل والخارج حسب الفرق
            Inventory::create([
                'product_id'    => $product['product_id'],
                'quantity_in'   => $quantityDiff > 0 ? $quantityDiff : 0,
                'quantity_out'  => $quantityDiff < 0 ? abs($quantityDiff) : 0,
                'price'         => $product['price'] ?? 0,
                'operation_type_id'=> $product['operation_type_id'],
                'note'          => $product['note'] ?? ''
            ]);
        }

        return response()->json(['success' => true]);
    }
}
