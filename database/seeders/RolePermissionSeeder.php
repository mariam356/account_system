<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // create Permissions for interface

        //permission dashboard
        Permission::create(['name' => 'show dashboard', 'guard_name' => 'user']);

        //permission user
        Permission::create(['name' => 'show user', 'guard_name' => 'user']);
        Permission::create(['name' => 'update user', 'guard_name' => 'user']);
        Permission::create(['name' => 'create user', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete user', 'guard_name' => 'user']);


        //permission backup
        Permission::create(['name' => 'show backup', 'guard_name' => 'user']);
        Permission::create(['name' => 'update backup', 'guard_name' => 'user']);
        Permission::create(['name' => 'create backup', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete backup', 'guard_name' => 'user']);



        //permission permission
        Permission::create(['name' => 'show permission', 'guard_name' => 'user']);
        Permission::create(['name' => 'update permission', 'guard_name' => 'user']);
        Permission::create(['name' => 'create permission', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete permission', 'guard_name' => 'user']);

        //permission branch
        Permission::create(['name' => 'show branch', 'guard_name' => 'user']);
        Permission::create(['name' => 'update branch', 'guard_name' => 'user']);
        Permission::create(['name' => 'create branch', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete branch', 'guard_name' => 'user']);

        //permission fund
        Permission::create(['name' => 'show fund', 'guard_name' => 'user']);
        Permission::create(['name' => 'update fund', 'guard_name' => 'user']);
        Permission::create(['name' => 'create fund', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete fund', 'guard_name' => 'user']);

        //permission bank
        Permission::create(['name' => 'show bank', 'guard_name' => 'user']);
        Permission::create(['name' => 'update bank', 'guard_name' => 'user']);
        Permission::create(['name' => 'create bank', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete bank', 'guard_name' => 'user']);


        //permission currency
        Permission::create(['name' => 'show currency', 'guard_name' => 'user']);
        Permission::create(['name' => 'update currency', 'guard_name' => 'user']);
        Permission::create(['name' => 'create currency', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete currency', 'guard_name' => 'user']);


        //permission account
        Permission::create(['name' => 'show account', 'guard_name' => 'user']);
        Permission::create(['name' => 'update account', 'guard_name' => 'user']);
        Permission::create(['name' => 'create account', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete account', 'guard_name' => 'user']);
        Permission::create(['name' => 'report account', 'guard_name' => 'user']);

        //permission journal
        Permission::create(['name' => 'show journal', 'guard_name' => 'user']);
        Permission::create(['name' => 'update journal', 'guard_name' => 'user']);
        Permission::create(['name' => 'create journal', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete journal', 'guard_name' => 'user']);
        Permission::create(['name' => 'report journal', 'guard_name' => 'user']);

        //permission exchange_bond
        Permission::create(['name' => 'show exchange_bond', 'guard_name' => 'user']);
        Permission::create(['name' => 'update exchange_bond', 'guard_name' => 'user']);
        Permission::create(['name' => 'create exchange_bond', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete exchange_bond', 'guard_name' => 'user']);
        Permission::create(['name' => 'report exchange_bond', 'guard_name' => 'user']);

        //permission receive_bond
        Permission::create(['name' => 'show receive_bond', 'guard_name' => 'user']);
        Permission::create(['name' => 'update receive_bond', 'guard_name' => 'user']);
        Permission::create(['name' => 'create receive_bond', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete receive_bond', 'guard_name' => 'user']);
        Permission::create(['name' => 'report receive_bond', 'guard_name' => 'user']);

        //permission account_statement
        Permission::create(['name' => 'show account_statement', 'guard_name' => 'user']);
        Permission::create(['name' => 'report account_statement', 'guard_name' => 'user']);

        //permission trial_balance
        Permission::create(['name' => 'show trial_balance', 'guard_name' => 'user']);
        Permission::create(['name' => 'report trial_balance', 'guard_name' => 'user']);

        //permission balance_sheet
        Permission::create(['name' => 'show balance_sheet', 'guard_name' => 'user']);
        Permission::create(['name' => 'report balance_sheet', 'guard_name' => 'user']);


        //permission profit_loss
        Permission::create(['name' => 'show profit_loss', 'guard_name' => 'user']);
        Permission::create(['name' => 'report profit_loss', 'guard_name' => 'user']);

        //permission stores
        Permission::create(['name' => 'show stores', 'guard_name' => 'user']);
        Permission::create(['name' => 'update stores', 'guard_name' => 'user']);
        Permission::create(['name' => 'create stores', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete stores', 'guard_name' => 'user']);

        //permission categories
        Permission::create(['name' => 'show categories', 'guard_name' => 'user']);
        Permission::create(['name' => 'update categories', 'guard_name' => 'user']);
        Permission::create(['name' => 'create categories', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete categories', 'guard_name' => 'user']);

        //permission units
        Permission::create(['name' => 'show units', 'guard_name' => 'user']);
        Permission::create(['name' => 'update units', 'guard_name' => 'user']);
        Permission::create(['name' => 'create units', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete units', 'guard_name' => 'user']);


        //permission product
        Permission::create(['name' => 'show product', 'guard_name' => 'user']);
        Permission::create(['name' => 'update product', 'guard_name' => 'user']);
        Permission::create(['name' => 'create product', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete product', 'guard_name' => 'user']);

        //permission inventory_management
        Permission::create(['name' => 'show inventory_management', 'guard_name' => 'user']);
        Permission::create(['name' => 'update inventory_management', 'guard_name' => 'user']);


        //permission category_movement
        Permission::create(['name' => 'show category_movement', 'guard_name' => 'user']);

        //permission suppliers
        Permission::create(['name' => 'show suppliers', 'guard_name' => 'user']);
        Permission::create(['name' => 'update suppliers', 'guard_name' => 'user']);
        Permission::create(['name' => 'create suppliers', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete suppliers', 'guard_name' => 'user']);

        //permission purchases_invoice
        Permission::create(['name' => 'show purchases_invoice', 'guard_name' => 'user']);
        Permission::create(['name' => 'update purchases_invoice', 'guard_name' => 'user']);
        Permission::create(['name' => 'create purchases_invoice', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete purchases_invoice', 'guard_name' => 'user']);

        //permission customer
        Permission::create(['name' => 'show customer', 'guard_name' => 'user']);
        Permission::create(['name' => 'update customer', 'guard_name' => 'user']);
        Permission::create(['name' => 'create customer', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete customer', 'guard_name' => 'user']);

        //permission sale_representative
        Permission::create(['name' => 'show sale_representative', 'guard_name' => 'user']);
        Permission::create(['name' => 'update sale_representative', 'guard_name' => 'user']);
        Permission::create(['name' => 'create sale_representative', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete sale_representative', 'guard_name' => 'user']);

        //permission sales_invoice
        Permission::create(['name' => 'show sales_invoice', 'guard_name' => 'user']);
        Permission::create(['name' => 'update sales_invoice', 'guard_name' => 'user']);
        Permission::create(['name' => 'create sales_invoice', 'guard_name' => 'user']);
        Permission::create(['name' => 'delete sales_invoice', 'guard_name' => 'user']);

        //permission audit
        Permission::create(['name' => 'show audit', 'guard_name' => 'user']);

        $role = Role::create(['name' => 'user_administrator', 'guard_name' => 'user']);
        $role->givePermissionTo(Permission::where('guard_name', 'user')->get());

        User::where('email','admin@admin.com')->first()->assignRole('user_administrator');


    }
}
