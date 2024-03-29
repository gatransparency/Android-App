<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'getting_started_create',
            ],
            [
                'id'    => 22,
                'title' => 'getting_started_edit',
            ],
            [
                'id'    => 23,
                'title' => 'getting_started_show',
            ],
            [
                'id'    => 24,
                'title' => 'getting_started_delete',
            ],
            [
                'id'    => 25,
                'title' => 'getting_started_access',
            ],
            [
                'id'    => 26,
                'title' => 'member_access',
            ],
            [
                'id'    => 27,
                'title' => 'investigating_government_create',
            ],
            [
                'id'    => 28,
                'title' => 'investigating_government_edit',
            ],
            [
                'id'    => 29,
                'title' => 'investigating_government_show',
            ],
            [
                'id'    => 30,
                'title' => 'investigating_government_delete',
            ],
            [
                'id'    => 31,
                'title' => 'investigating_government_access',
            ],
            [
                'id'    => 32,
                'title' => 'open_records_info_create',
            ],
            [
                'id'    => 33,
                'title' => 'open_records_info_edit',
            ],
            [
                'id'    => 34,
                'title' => 'open_records_info_show',
            ],
            [
                'id'    => 35,
                'title' => 'open_records_info_delete',
            ],
            [
                'id'    => 36,
                'title' => 'open_records_info_access',
            ],
            [
                'id'    => 37,
                'title' => 'form_create',
            ],
            [
                'id'    => 38,
                'title' => 'form_edit',
            ],
            [
                'id'    => 39,
                'title' => 'form_show',
            ],
            [
                'id'    => 40,
                'title' => 'form_delete',
            ],
            [
                'id'    => 41,
                'title' => 'form_access',
            ],
            [
                'id'    => 42,
                'title' => 'case_law_create',
            ],
            [
                'id'    => 43,
                'title' => 'case_law_edit',
            ],
            [
                'id'    => 44,
                'title' => 'case_law_show',
            ],
            [
                'id'    => 45,
                'title' => 'case_law_delete',
            ],
            [
                'id'    => 46,
                'title' => 'case_law_access',
            ],
            [
                'id'    => 47,
                'title' => 'donation_create',
            ],
            [
                'id'    => 48,
                'title' => 'donation_edit',
            ],
            [
                'id'    => 49,
                'title' => 'donation_show',
            ],
            [
                'id'    => 50,
                'title' => 'donation_delete',
            ],
            [
                'id'    => 51,
                'title' => 'donation_access',
            ],
            [
                'id'    => 52,
                'title' => 'public_information_access',
            ],
            [
                'id'    => 53,
                'title' => 'public_record_create',
            ],
            [
                'id'    => 54,
                'title' => 'public_record_edit',
            ],
            [
                'id'    => 55,
                'title' => 'public_record_show',
            ],
            [
                'id'    => 56,
                'title' => 'public_record_delete',
            ],
            [
                'id'    => 57,
                'title' => 'public_record_access',
            ],
            [
                'id'    => 58,
                'title' => 'submit_record_create',
            ],
            [
                'id'    => 59,
                'title' => 'submit_record_edit',
            ],
            [
                'id'    => 60,
                'title' => 'submit_record_show',
            ],
            [
                'id'    => 61,
                'title' => 'submit_record_delete',
            ],
            [
                'id'    => 62,
                'title' => 'submit_record_access',
            ],
            [
                'id'    => 63,
                'title' => 'setting_access',
            ],
            [
                'id'    => 64,
                'title' => 'report_create',
            ],
            [
                'id'    => 65,
                'title' => 'report_edit',
            ],
            [
                'id'    => 66,
                'title' => 'report_show',
            ],
            [
                'id'    => 67,
                'title' => 'report_delete',
            ],
            [
                'id'    => 68,
                'title' => 'report_access',
            ],
            [
                'id'    => 69,
                'title' => 'vehicle_create',
            ],
            [
                'id'    => 70,
                'title' => 'vehicle_edit',
            ],
            [
                'id'    => 71,
                'title' => 'vehicle_show',
            ],
            [
                'id'    => 72,
                'title' => 'vehicle_delete',
            ],
            [
                'id'    => 73,
                'title' => 'vehicle_access',
            ],
            [
                'id'    => 74,
                'title' => 'public_official_create',
            ],
            [
                'id'    => 75,
                'title' => 'public_official_edit',
            ],
            [
                'id'    => 76,
                'title' => 'public_official_show',
            ],
            [
                'id'    => 77,
                'title' => 'public_official_delete',
            ],
            [
                'id'    => 78,
                'title' => 'public_official_access',
            ],
            [
                'id'    => 79,
                'title' => 'internal_investigation_create',
            ],
            [
                'id'    => 80,
                'title' => 'internal_investigation_edit',
            ],
            [
                'id'    => 81,
                'title' => 'internal_investigation_show',
            ],
            [
                'id'    => 82,
                'title' => 'internal_investigation_delete',
            ],
            [
                'id'    => 83,
                'title' => 'internal_investigation_access',
            ],
            [
                'id'    => 84,
                'title' => 'record_create',
            ],
            [
                'id'    => 85,
                'title' => 'record_edit',
            ],
            [
                'id'    => 86,
                'title' => 'record_show',
            ],
            [
                'id'    => 87,
                'title' => 'record_delete',
            ],
            [
                'id'    => 88,
                'title' => 'record_access',
            ],
            [
                'id'    => 89,
                'title' => 'agencies_office_create',
            ],
            [
                'id'    => 90,
                'title' => 'agencies_office_edit',
            ],
            [
                'id'    => 91,
                'title' => 'agencies_office_show',
            ],
            [
                'id'    => 92,
                'title' => 'agencies_office_delete',
            ],
            [
                'id'    => 93,
                'title' => 'agencies_office_access',
            ],
            [
                'id'    => 94,
                'title' => 'portal_version_create',
            ],
            [
                'id'    => 95,
                'title' => 'portal_version_edit',
            ],
            [
                'id'    => 96,
                'title' => 'portal_version_show',
            ],
            [
                'id'    => 97,
                'title' => 'portal_version_delete',
            ],
            [
                'id'    => 98,
                'title' => 'portal_version_access',
            ],
            [
                'id'    => 99,
                'title' => 'bug_create',
            ],
            [
                'id'    => 100,
                'title' => 'bug_edit',
            ],
            [
                'id'    => 101,
                'title' => 'bug_show',
            ],
            [
                'id'    => 102,
                'title' => 'bug_delete',
            ],
            [
                'id'    => 103,
                'title' => 'bug_access',
            ],
            [
                'id'    => 104,
                'title' => 'reportbug_create',
            ],
            [
                'id'    => 105,
                'title' => 'reportbug_edit',
            ],
            [
                'id'    => 106,
                'title' => 'reportbug_show',
            ],
            [
                'id'    => 107,
                'title' => 'reportbug_delete',
            ],
            [
                'id'    => 108,
                'title' => 'reportbug_access',
            ],
            [
                'id'    => 109,
                'title' => 'portal_request_create',
            ],
            [
                'id'    => 110,
                'title' => 'portal_request_edit',
            ],
            [
                'id'    => 111,
                'title' => 'portal_request_show',
            ],
            [
                'id'    => 112,
                'title' => 'portal_request_delete',
            ],
            [
                'id'    => 113,
                'title' => 'portal_request_access',
            ],
            [
                'id'    => 114,
                'title' => 'change_log_create',
            ],
            [
                'id'    => 115,
                'title' => 'change_log_edit',
            ],
            [
                'id'    => 116,
                'title' => 'change_log_show',
            ],
            [
                'id'    => 117,
                'title' => 'change_log_delete',
            ],
            [
                'id'    => 118,
                'title' => 'change_log_access',
            ],
            [
                'id'    => 119,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 120,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 121,
                'title' => 'public_official_data_create',
            ],
            [
                'id'    => 122,
                'title' => 'public_official_data_edit',
            ],
            [
                'id'    => 123,
                'title' => 'public_official_data_show',
            ],
            [
                'id'    => 124,
                'title' => 'public_official_data_delete',
            ],
            [
                'id'    => 125,
                'title' => 'public_official_data_access',
            ],
            [
                'id'    => 126,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
