<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_ids_admin =  4;
        $role_ids_employee =  5;
        $permission_url_admin = ['users.store','users.index','users.create','users.force_delete',
            'users.restore','users.show','users.update','users.destroy','users.edit','suppliers.store',
            'suppliers.index','suppliers.create','suppliers.force_delete','suppliers.restore',
            'suppliers.destroy','suppliers.update','suppliers.edit','roles.store',
            'roles.index','roles.create','roles.force_delete','roles.restore',
            'roles.destroy','roles.update','roles.edit','customers.store',
            'customers.index','customers.create','customers.force_delete','customers.restore',
            'customers.destroy','customers.update','customers.edit','categories.store','categories.index','categories.create',
            'categories.force_delete', 'categories.restore','categories.show','categories.update','categories.destroy','categories.edit'
            ,'subcategories.store','subcategories.index','subcategories.create','subcategories.force_delete','subcategories.restore',
            'subcategories.destroy','subcategories.update','subcategories.edit','units.store','units.index','units.create',
            'units.force_delete','units.restore','units.show','units.update','units.destroy','units.edit', 'products.store',
            'products.index','products.create','products.force_delete','products.restore','products.destroy','products.update',
            'products.edit','products.get_unit_ajax','expense_record.create','expense_record.destroy','expense_record.edit','expense_record.force_delete',
            'expense_record.index','expense_record.restore','expense_record.store','expense_record.update','expenses.store','expenses.index','expenses.create',
            'expenses.force_delete','expenses.restore','expenses.destroy','expenses.update','expenses.edit','expenses.show','voucher.voucher_index',
            'voucher.add_customer_voucher',' voucher.all_voucher_customer_ajax','voucher.all_voucher_product_price_ajax','voucher.create_voucher',
            'voucher.destroy','voucher.print_voucher','voucher.voucher_selected_customer','voucher.voucher_store','voucher.restore','voucher.force_delete','purchase.index','purchase.add_new_unit',
            'purchase.add_new_supplier','purchase.create','purchase.destroy','purchase.edit','purchase.ajax_all_supplier','purchase.get_units_all_ajax','purchase.store',
            'purchase.supplier_details','purchase.update','sales.index','sales.store','sales.add_new_customer','sales.available_stock_price_ajax','sales.create',
            'sales.customer_details','sales.ajax_all_customer','sales.print_sale_invoice','sales.destroy','sales.update','pos_sales.update','sales.show','sales.edit','dashboard','logout',
            'purchase.print_purchase_invoice','suppliers.due_supplier_list_index','suppliers.due_supplier_billing_list','suppliers.due_supplier_payment_create',
            'suppliers.due_supplier_payment_store','suppliers.due_supplier_payment_edit_list','suppliers.due_supplier_payment_edit_page','suppliers.due_supplier_payment_update',
            'customers.customer_payment_index','customers.customer_payment_create','customers.customer_payment_store','customers.due_customer_billing_list','customers.customer_payment_edit_list',
            'customers.customer_payment_edit_payment','customers.customer_payment_update','report_index','stock_report_index','sales_voucher_report_index','sales_voucher_details_list','sales_voucher_weekly_report',
            'sales_voucher_daily_report','sales_voucher_weekly_report','sales_voucher_monthly_report','sales_voucher_yearly_report','expense_record_daily_report','expense_record_weekly_report','expense_record_monthly_report',
            'expense_record_yearly_report','gross_profit_index','gross_profit_daily','gross_profit_weekly','gross_profit_monthly','gross_profit_yearly','net_profit_index','net_profit_daily','net_profit_weekly','net_profit_monthly',
            'net_profit_yearly','all_product_stock_reports'];

        $permission_url_employee = ['suppliers.store',
            'suppliers.index','suppliers.create','suppliers.update','suppliers.edit','customers.store',
            'customers.index','customers.create','customers.update','customers.edit', 'units.store','units.index','units.create',
            'units.update','units.edit', 'products.store','products.index','products.create','products.update',
            'products.edit','products.get_unit_ajax','expense_record.create','expense_record.edit','expense_record.index','expense_record.store','expense_record.update',
            'expenses.store','expenses.index','expenses.create','expenses.update','expenses.edit','expenses.show','voucher.voucher_index',
            'voucher.add_customer_voucher',' voucher.all_voucher_customer_ajax','voucher.all_voucher_product_price_ajax','voucher.create_voucher',
            'voucher.destroy','voucher.print_voucher','voucher.voucher_selected_customer','voucher.voucher_store','voucher.restore','voucher.force_delete','purchase.index','purchase.add_new_unit',
            'purchase.add_new_supplier','purchase.create','purchase.edit','purchase.ajax_all_supplier','purchase.get_units_all_ajax','purchase.store',
            'purchase.supplier_details','purchase.update','sales.index','sales.store','sales.add_new_customer','sales.available_stock_price_ajax','sales.create',
            'sales.customer_details','sales.ajax_all_customer','sales.print_sale_invoice','sales.update','pos_sales.update','sales.show','sales.edit','dashboard','logout',
            'purchase.print_purchase_invoice','suppliers.due_supplier_list_index','suppliers.due_supplier_billing_list','suppliers.due_supplier_payment_create',
            'suppliers.due_supplier_payment_store','suppliers.due_supplier_payment_edit_list','suppliers.due_supplier_payment_edit_page','suppliers.due_supplier_payment_update',
            'customers.customer_payment_index','customers.customer_payment_create','customers.customer_payment_store','customers.due_customer_billing_list','customers.customer_payment_edit_list',
            'customers.customer_payment_edit_payment','customers.customer_payment_update','sales_voucher_report_index','sales_voucher_details_list','sales_voucher_weekly_report',
            'sales_voucher_daily_report','sales_voucher_weekly_report','sales_voucher_monthly_report','sales_voucher_yearly_report','all_product_stock_reports'];

                foreach ($permission_url_admin as $permission){
                    \App\Models\RolePermission::create([
                        'permission_url' => $permission,
                        'role_id' => $role_ids_admin,
                    ]);
                }

                foreach ($permission_url_employee as $permission_employee){
                    \App\Models\RolePermission::create([
                        'permission_url' => $permission_employee,
                        'role_id' => $role_ids_employee,
                    ]);
                }



    }
}
