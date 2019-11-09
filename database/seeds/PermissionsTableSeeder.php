<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '18',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '19',
                'title' => 'asset_management_access',
            ],
            [
                'id'    => '20',
                'title' => 'asset_category_create',
            ],
            [
                'id'    => '21',
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => '22',
                'title' => 'asset_category_show',
            ],
            [
                'id'    => '23',
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => '24',
                'title' => 'asset_category_access',
            ],
            [
                'id'    => '25',
                'title' => 'asset_location_create',
            ],
            [
                'id'    => '26',
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => '27',
                'title' => 'asset_location_show',
            ],
            [
                'id'    => '28',
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => '29',
                'title' => 'asset_location_access',
            ],
            [
                'id'    => '30',
                'title' => 'asset_status_create',
            ],
            [
                'id'    => '31',
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => '32',
                'title' => 'asset_status_show',
            ],
            [
                'id'    => '33',
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => '34',
                'title' => 'asset_status_access',
            ],
            [
                'id'    => '35',
                'title' => 'asset_create',
            ],
            [
                'id'    => '36',
                'title' => 'asset_edit',
            ],
            [
                'id'    => '37',
                'title' => 'asset_show',
            ],
            [
                'id'    => '38',
                'title' => 'asset_delete',
            ],
            [
                'id'    => '39',
                'title' => 'asset_access',
            ],
            [
                'id'    => '40',
                'title' => 'assets_history_access',
            ],
            [
                'id'    => '41',
                'title' => 'expense_management_access',
            ],
            [
                'id'    => '42',
                'title' => 'expense_category_create',
            ],
            [
                'id'    => '43',
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => '44',
                'title' => 'expense_category_show',
            ],
            [
                'id'    => '45',
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => '46',
                'title' => 'expense_category_access',
            ],
            [
                'id'    => '47',
                'title' => 'income_category_create',
            ],
            [
                'id'    => '48',
                'title' => 'income_category_edit',
            ],
            [
                'id'    => '49',
                'title' => 'income_category_show',
            ],
            [
                'id'    => '50',
                'title' => 'income_category_delete',
            ],
            [
                'id'    => '51',
                'title' => 'income_category_access',
            ],
            [
                'id'    => '52',
                'title' => 'expense_create',
            ],
            [
                'id'    => '53',
                'title' => 'expense_edit',
            ],
            [
                'id'    => '54',
                'title' => 'expense_show',
            ],
            [
                'id'    => '55',
                'title' => 'expense_delete',
            ],
            [
                'id'    => '56',
                'title' => 'expense_access',
            ],
            [
                'id'    => '57',
                'title' => 'income_create',
            ],
            [
                'id'    => '58',
                'title' => 'income_edit',
            ],
            [
                'id'    => '59',
                'title' => 'income_show',
            ],
            [
                'id'    => '60',
                'title' => 'income_delete',
            ],
            [
                'id'    => '61',
                'title' => 'income_access',
            ],
            [
                'id'    => '62',
                'title' => 'expense_report_create',
            ],
            [
                'id'    => '63',
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => '64',
                'title' => 'expense_report_show',
            ],
            [
                'id'    => '65',
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => '66',
                'title' => 'expense_report_access',
            ],
            [
                'id'    => '67',
                'title' => 'contact_management_access',
            ],
            [
                'id'    => '68',
                'title' => 'contact_company_create',
            ],
            [
                'id'    => '69',
                'title' => 'contact_company_edit',
            ],
            [
                'id'    => '70',
                'title' => 'contact_company_show',
            ],
            [
                'id'    => '71',
                'title' => 'contact_company_delete',
            ],
            [
                'id'    => '72',
                'title' => 'contact_company_access',
            ],
            [
                'id'    => '73',
                'title' => 'contact_contact_create',
            ],
            [
                'id'    => '74',
                'title' => 'contact_contact_edit',
            ],
            [
                'id'    => '75',
                'title' => 'contact_contact_show',
            ],
            [
                'id'    => '76',
                'title' => 'contact_contact_delete',
            ],
            [
                'id'    => '77',
                'title' => 'contact_contact_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
