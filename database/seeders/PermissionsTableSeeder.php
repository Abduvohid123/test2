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
                'title' => 'fan_create',
            ],
            [
                'id'    => 18,
                'title' => 'fan_edit',
            ],
            [
                'id'    => 19,
                'title' => 'fan_show',
            ],
            [
                'id'    => 20,
                'title' => 'fan_delete',
            ],
            [
                'id'    => 21,
                'title' => 'fan_access',
            ],
            [
                'id'    => 22,
                'title' => 'group_create',
            ],
            [
                'id'    => 23,
                'title' => 'group_edit',
            ],
            [
                'id'    => 24,
                'title' => 'group_show',
            ],
            [
                'id'    => 25,
                'title' => 'group_delete',
            ],
            [
                'id'    => 26,
                'title' => 'group_access',
            ],
            [
                'id'    => 27,
                'title' => 'room_create',
            ],
            [
                'id'    => 28,
                'title' => 'room_edit',
            ],
            [
                'id'    => 29,
                'title' => 'room_show',
            ],
            [
                'id'    => 30,
                'title' => 'room_delete',
            ],
            [
                'id'    => 31,
                'title' => 'room_access',
            ],
            [
                'id'    => 32,
                'title' => 'position_create',
            ],
            [
                'id'    => 33,
                'title' => 'position_edit',
            ],
            [
                'id'    => 34,
                'title' => 'position_show',
            ],
            [
                'id'    => 35,
                'title' => 'position_delete',
            ],
            [
                'id'    => 36,
                'title' => 'position_access',
            ],
            [
                'id'    => 37,
                'title' => 'worker_create',
            ],
            [
                'id'    => 38,
                'title' => 'worker_edit',
            ],
            [
                'id'    => 39,
                'title' => 'worker_show',
            ],
            [
                'id'    => 40,
                'title' => 'worker_delete',
            ],
            [
                'id'    => 41,
                'title' => 'worker_access',
            ],
            [
                'id'    => 42,
                'title' => 'week_create',
            ],
            [
                'id'    => 43,
                'title' => 'week_edit',
            ],
            [
                'id'    => 44,
                'title' => 'week_show',
            ],
            [
                'id'    => 45,
                'title' => 'week_delete',
            ],
            [
                'id'    => 46,
                'title' => 'week_access',
            ],
            [
                'id'    => 47,
                'title' => 'student_create',
            ],
            [
                'id'    => 48,
                'title' => 'student_edit',
            ],
            [
                'id'    => 49,
                'title' => 'student_show',
            ],
            [
                'id'    => 50,
                'title' => 'student_delete',
            ],
            [
                'id'    => 51,
                'title' => 'student_access',
            ],
            [
                'id'    => 52,
                'title' => 'month_create',
            ],
            [
                'id'    => 53,
                'title' => 'month_edit',
            ],
            [
                'id'    => 54,
                'title' => 'month_show',
            ],
            [
                'id'    => 55,
                'title' => 'month_delete',
            ],
            [
                'id'    => 56,
                'title' => 'month_access',
            ],
            [
                'id'    => 57,
                'title' => 'buxgalteriya_access',
            ],
            [
                'id'    => 58,
                'title' => 'chiqimlar_access',
            ],
            [
                'id'    => 59,
                'title' => 'tolovlar_create',
            ],
            [
                'id'    => 60,
                'title' => 'tolovlar_edit',
            ],
            [
                'id'    => 61,
                'title' => 'tolovlar_show',
            ],
            [
                'id'    => 62,
                'title' => 'tolovlar_delete',
            ],
            [
                'id'    => 63,
                'title' => 'tolovlar_access',
            ],
            [
                'id'    => 64,
                'title' => 'qoshima_chiqimlar_create',
            ],
            [
                'id'    => 65,
                'title' => 'qoshima_chiqimlar_edit',
            ],
            [
                'id'    => 66,
                'title' => 'qoshima_chiqimlar_show',
            ],
            [
                'id'    => 67,
                'title' => 'qoshima_chiqimlar_delete',
            ],
            [
                'id'    => 68,
                'title' => 'qoshima_chiqimlar_access',
            ],
            [
                'id'    => 69,
                'title' => 'boshqa_ishchilar_maoshlari_create',
            ],
            [
                'id'    => 70,
                'title' => 'boshqa_ishchilar_maoshlari_edit',
            ],
            [
                'id'    => 71,
                'title' => 'boshqa_ishchilar_maoshlari_show',
            ],
            [
                'id'    => 72,
                'title' => 'boshqa_ishchilar_maoshlari_delete',
            ],
            [
                'id'    => 73,
                'title' => 'boshqa_ishchilar_maoshlari_access',
            ],
            [
                'id'    => 74,
                'title' => 'add_teache_to_group_create',
            ],
            [
                'id'    => 75,
                'title' => 'add_teache_to_group_edit',
            ],
            [
                'id'    => 76,
                'title' => 'add_teache_to_group_show',
            ],
            [
                'id'    => 77,
                'title' => 'add_teache_to_group_delete',
            ],
            [
                'id'    => 78,
                'title' => 'add_teache_to_group_access',
            ],
            [
                'id'    => 79,
                'title' => 'progol_system_create',
            ],
            [
                'id'    => 80,
                'title' => 'progol_system_edit',
            ],
            [
                'id'    => 81,
                'title' => 'progol_system_show',
            ],
            [
                'id'    => 82,
                'title' => 'progol_system_delete',
            ],
            [
                'id'    => 83,
                'title' => 'progol_system_access',
            ],
            [
                'id'    => 84,
                'title' => 'kashalok_create',
            ],
            [
                'id'    => 85,
                'title' => 'kashalok_edit',
            ],
            [
                'id'    => 86,
                'title' => 'kashalok_show',
            ],
            [
                'id'    => 87,
                'title' => 'kashalok_delete',
            ],
            [
                'id'    => 88,
                'title' => 'kashalok_access',
            ],
            [
                'id'    => 89,
                'title' => 'reklama_create',
            ],
            [
                'id'    => 90,
                'title' => 'reklama_edit',
            ],
            [
                'id'    => 91,
                'title' => 'reklama_show',
            ],
            [
                'id'    => 92,
                'title' => 'reklama_delete',
            ],
            [
                'id'    => 93,
                'title' => 'reklama_access',
            ],
            [
                'id'    => 94,
                'title' => 'ota_ona_create',
            ],
            [
                'id'    => 95,
                'title' => 'ota_ona_edit',
            ],
            [
                'id'    => 96,
                'title' => 'ota_ona_show',
            ],
            [
                'id'    => 97,
                'title' => 'ota_ona_delete',
            ],
            [
                'id'    => 98,
                'title' => 'ota_ona_access',
            ],
            [
                'id'    => 99,
                'title' => 'viloyatlar_create',
            ],
            [
                'id'    => 100,
                'title' => 'viloyatlar_edit',
            ],
            [
                'id'    => 101,
                'title' => 'viloyatlar_show',
            ],
            [
                'id'    => 102,
                'title' => 'viloyatlar_delete',
            ],
            [
                'id'    => 103,
                'title' => 'viloyatlar_access',
            ],
            [
                'id'    => 104,
                'title' => 'tumanlar_create',
            ],
            [
                'id'    => 105,
                'title' => 'tumanlar_edit',
            ],
            [
                'id'    => 106,
                'title' => 'tumanlar_show',
            ],
            [
                'id'    => 107,
                'title' => 'tumanlar_delete',
            ],
            [
                'id'    => 108,
                'title' => 'tumanlar_access',
            ],
            [
                'id'    => 109,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 110,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 111,
                'title' => 'sorovnoma_create',
            ],
            [
                'id'    => 112,
                'title' => 'sorovnoma_edit',
            ],
            [
                'id'    => 113,
                'title' => 'sorovnoma_show',
            ],
            [
                'id'    => 114,
                'title' => 'sorovnoma_delete',
            ],
            [
                'id'    => 115,
                'title' => 'sorovnoma_access',
            ],
            [
                'id'    => 116,
                'title' => 'savol_type_create',
            ],
            [
                'id'    => 117,
                'title' => 'savol_type_edit',
            ],
            [
                'id'    => 118,
                'title' => 'savol_type_show',
            ],
            [
                'id'    => 119,
                'title' => 'savol_type_delete',
            ],
            [
                'id'    => 120,
                'title' => 'savol_type_access',
            ],
            [
                'id'    => 121,
                'title' => 'javoblar_create',
            ],
            [
                'id'    => 122,
                'title' => 'javoblar_edit',
            ],
            [
                'id'    => 123,
                'title' => 'javoblar_show',
            ],
            [
                'id'    => 124,
                'title' => 'javoblar_delete',
            ],
            [
                'id'    => 125,
                'title' => 'javoblar_access',
            ],
            [
                'id'    => 126,
                'title' => 'sorovnoma_otkazish_access',
            ],
            [
                'id'    => 127,
                'title' => 'savollar_create',
            ],
            [
                'id'    => 128,
                'title' => 'savollar_edit',
            ],
            [
                'id'    => 129,
                'title' => 'savollar_show',
            ],
            [
                'id'    => 130,
                'title' => 'savollar_delete',
            ],
            [
                'id'    => 131,
                'title' => 'savollar_access',
            ],
            [
                'id'    => 132,
                'title' => 'filial_create',
            ],
            [
                'id'    => 133,
                'title' => 'filial_edit',
            ],
            [
                'id'    => 134,
                'title' => 'filial_show',
            ],
            [
                'id'    => 135,
                'title' => 'filial_delete',
            ],
            [
                'id'    => 136,
                'title' => 'filial_access',
            ],
            [
                'id'    => 137,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
