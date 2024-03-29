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
                'title' => 'submit_record_create',
            ],
            [
                'id'    => 54,
                'title' => 'submit_record_edit',
            ],
            [
                'id'    => 55,
                'title' => 'submit_record_show',
            ],
            [
                'id'    => 56,
                'title' => 'submit_record_delete',
            ],
            [
                'id'    => 57,
                'title' => 'submit_record_access',
            ],
            [
                'id'    => 58,
                'title' => 'setting_access',
            ],
            [
                'id'    => 59,
                'title' => 'agencies_office_create',
            ],
            [
                'id'    => 60,
                'title' => 'agencies_office_edit',
            ],
            [
                'id'    => 61,
                'title' => 'agencies_office_show',
            ],
            [
                'id'    => 62,
                'title' => 'agencies_office_delete',
            ],
            [
                'id'    => 63,
                'title' => 'agencies_office_access',
            ],
            [
                'id'    => 64,
                'title' => 'portal_version_create',
            ],
            [
                'id'    => 65,
                'title' => 'portal_version_edit',
            ],
            [
                'id'    => 66,
                'title' => 'portal_version_show',
            ],
            [
                'id'    => 67,
                'title' => 'portal_version_delete',
            ],
            [
                'id'    => 68,
                'title' => 'portal_version_access',
            ],
            [
                'id'    => 69,
                'title' => 'bug_create',
            ],
            [
                'id'    => 70,
                'title' => 'bug_edit',
            ],
            [
                'id'    => 71,
                'title' => 'bug_show',
            ],
            [
                'id'    => 72,
                'title' => 'bug_delete',
            ],
            [
                'id'    => 73,
                'title' => 'bug_access',
            ],
            [
                'id'    => 74,
                'title' => 'reportbug_create',
            ],
            [
                'id'    => 75,
                'title' => 'reportbug_edit',
            ],
            [
                'id'    => 76,
                'title' => 'reportbug_show',
            ],
            [
                'id'    => 77,
                'title' => 'reportbug_delete',
            ],
            [
                'id'    => 78,
                'title' => 'reportbug_access',
            ],
            [
                'id'    => 79,
                'title' => 'portal_request_create',
            ],
            [
                'id'    => 80,
                'title' => 'portal_request_edit',
            ],
            [
                'id'    => 81,
                'title' => 'portal_request_show',
            ],
            [
                'id'    => 82,
                'title' => 'portal_request_delete',
            ],
            [
                'id'    => 83,
                'title' => 'portal_request_access',
            ],
            [
                'id'    => 84,
                'title' => 'change_log_create',
            ],
            [
                'id'    => 85,
                'title' => 'change_log_edit',
            ],
            [
                'id'    => 86,
                'title' => 'change_log_show',
            ],
            [
                'id'    => 87,
                'title' => 'change_log_delete',
            ],
            [
                'id'    => 88,
                'title' => 'change_log_access',
            ],
            [
                'id'    => 89,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 90,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 91,
                'title' => 'public_official_create',
            ],
            [
                'id'    => 92,
                'title' => 'public_official_edit',
            ],
            [
                'id'    => 93,
                'title' => 'public_official_show',
            ],
            [
                'id'    => 94,
                'title' => 'public_official_delete',
            ],
            [
                'id'    => 95,
                'title' => 'public_official_access',
            ],
            [
                'id'    => 96,
                'title' => 'report_create',
            ],
            [
                'id'    => 97,
                'title' => 'report_edit',
            ],
            [
                'id'    => 98,
                'title' => 'report_show',
            ],
            [
                'id'    => 99,
                'title' => 'report_delete',
            ],
            [
                'id'    => 100,
                'title' => 'report_access',
            ],
            [
                'id'    => 101,
                'title' => 'record_create',
            ],
            [
                'id'    => 102,
                'title' => 'record_edit',
            ],
            [
                'id'    => 103,
                'title' => 'record_show',
            ],
            [
                'id'    => 104,
                'title' => 'record_delete',
            ],
            [
                'id'    => 105,
                'title' => 'record_access',
            ],
            [
                'id'    => 106,
                'title' => 'vehicle_create',
            ],
            [
                'id'    => 107,
                'title' => 'vehicle_edit',
            ],
            [
                'id'    => 108,
                'title' => 'vehicle_show',
            ],
            [
                'id'    => 109,
                'title' => 'vehicle_delete',
            ],
            [
                'id'    => 110,
                'title' => 'vehicle_access',
            ],
            [
                'id'    => 111,
                'title' => 'internal_investigation_create',
            ],
            [
                'id'    => 112,
                'title' => 'internal_investigation_edit',
            ],
            [
                'id'    => 113,
                'title' => 'internal_investigation_show',
            ],
            [
                'id'    => 114,
                'title' => 'internal_investigation_delete',
            ],
            [
                'id'    => 115,
                'title' => 'internal_investigation_access',
            ],
            [
                'id'    => 116,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
