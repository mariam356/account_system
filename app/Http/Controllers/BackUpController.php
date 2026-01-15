<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BackUpController extends Controller
{
    private array $backupMap = [
        'user' => ['users'],
        'permission' => ['permissions', 'role_has_permissions', 'model_has_roles'],
        'branch' => ['branches','branch_translations'],
        'fund' => ['funds','fund_translations'],
        'bank' => ['banks','bank_translations'],
        'currency' => ['currencies','currency_translations'],

        'accounting_guide' => ['accounts','account_translations','acc_report_types','acc_report_type_translations', 'acc_types','acc_type_translations'],
        'journal' => ['journals', 'journal_details','journal_types','journal_type_translations'],

        'stores' => ['stores','store_translations'],
        'inventory_groups' => ['inventories'],
        'units' => ['units','unit_translations'],
        'products' => ['products','product_translations'],
        'inventory_management' => ['inventories'],
        'category_movement' => ['inventories'],

        'suppliers' => ['suppliers','supplier_translations'],
        'customer' => ['customers','customer_translations'],
        'sale_representative' => ['sale_representatives','sale_representative_translations'],
    ];

    private string $backupDir;

    public function __construct()
    {
        $this->backupDir = storage_path('app/backups');
        if (!is_dir($this->backupDir)) {
            mkdir($this->backupDir, 0777, true);
        }
    }

    public function index(Request $request)
    {
        return view('managements.file.backup.index');
    }

    public function backup(Request $request)
    {
        $request->validate([
            'name' => 'required|array'
        ]);

        $dbHost = env('DB_HOST','127.0.0.1');
        $dbPort = env('DB_PORT','3306');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');

        $selected = $request->name;
        $files = [];

        foreach ($selected as $item) {

            switch($item) {
                // Exchange Bond
                case 'exchange_bond':
                    $bonds = DB::table('bonds')->where('bond_type_id',2)->pluck('id');
                    if($bonds->isEmpty()) break;

                    $files[] = $this->dumpTable('bonds', "--where=\"bond_type_id=2\"");
                    $files[] = $this->dumpTable('bond_details', "--where=\"bond_id IN (".implode(',', $bonds->toArray()).")\"");
                    break;

                // Receive Bond
                case 'receive_bond':
                    $bonds = DB::table('bonds')->where('bond_type_id',1)->pluck('id');
                    if($bonds->isEmpty()) break;

                    $files[] = $this->dumpTable('bonds', "--where=\"bond_type_id=1\"");
                    $files[] = $this->dumpTable('bond_details', "--where=\"bond_id IN (".implode(',', $bonds->toArray()).")\"");
                    break;

                // Purchases Invoice
                case 'purchases_invoice':
                    $bills = DB::table('bills')->whereIn('bill_type_id',[2,3])->pluck('id');
                    if($bills->isEmpty()) break;

                    $files[] = $this->dumpTable('bills', "--where=\"bill_type_id IN (2,3)\"");
                    $files[] = $this->dumpTable('bill_details', "--where=\"bill_id IN (".implode(',', $bills->toArray()).")\"");
                    break;

                // Sales Invoice
                case 'sales_invoice':
                    $bills = DB::table('bills')->whereIn('bill_type_id',[1,4])->pluck('id');
                    if($bills->isEmpty()) break;

                    $files[] = $this->dumpTable('bills', "--where=\"bill_type_id IN (1,4)\"");
                    $files[] = $this->dumpTable('bill_details', "--where=\"bill_id IN (".implode(',', $bills->toArray()).")\"");
                    break;

                // Balance Sheet
                case 'balance_sheet':
                    $accounts = DB::table('accounts')->where('acc_report_type_id',1)->pluck('id');
                    if($accounts->isEmpty()) break;

                    $files[] = $this->dumpTable('accounts', "--where=\"acc_report_type_id=1\"");
                    $files[] = $this->dumpTable('account_translations', "--where=\"account_id IN (".implode(',', $accounts->toArray()).")\"");
                    break;

                // Profit & Loss
                case 'profit_loss':
                    $accounts = DB::table('accounts')->where('acc_report_type_id',2)->pluck('id');
                    if($accounts->isEmpty()) break;

                    $files[] = $this->dumpTable('accounts', "--where=\"acc_report_type_id=2\"");
                    $files[] = $this->dumpTable('account_translations', "--where=\"account_id IN (".implode(',', $accounts->toArray()).")\"");
                    break;

                // Tables without special conditions
                default:
                    if(isset($this->backupMap[$item])){
                        foreach($this->backupMap[$item] as $table){
                            $files[] = $this->dumpTable($table);
                        }
                    }
                    break;
            }
        }

        // دمج الملفات كلها في ملف واحد
        $filePath = $this->backupDir . DIRECTORY_SEPARATOR .
            $table . '_' . uniqid() . '.sql';

        file_put_contents($filePath, '');
        foreach ($files as $f) {
            if (!file_exists($f)) {
                throw new \Exception("Backup file not found: $f");
            }

            file_put_contents($filePath, file_get_contents($f), FILE_APPEND);
            unlink($f);
        }


        return response()->download($filePath);
    }

    private function dumpTable(string $table, string $where = ''): string
    {
        $dbHost = config('database.connections.mysql.host');
        $dbPort = config('database.connections.mysql.port');
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        $filePath = $this->backupDir . DIRECTORY_SEPARATOR .
            $table . '_' . uniqid() . '.sql';

        $mysqldump = '"C:\xampp\mysql\bin\mysqldump.exe"';

        $command = $mysqldump
            . " --host={$dbHost}"
            . " --port={$dbPort}"
            . " --user={$dbUser}"
            . " --password=\"{$dbPass}\""
            . " {$dbName} {$table} {$where}"
            . " > \"{$filePath}\" 2>&1";

        exec($command, $output, $status);

        if ($status !== 0 || !file_exists($filePath)) {
            throw new \Exception(
                "mysqldump FAILED\n\n".
                "TABLE: {$table}\n".
                "COMMAND:\n{$command}\n\n".
                "OUTPUT:\n".implode("\n", $output)
            );
        }

        return $filePath;
    }


}
