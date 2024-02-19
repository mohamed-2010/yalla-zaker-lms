<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
        public function run(): void
        {
            // ...

            $teacher_role = Role::where('name', 'teacher')->first();
            $admin_role = Role::where('name', 'admin')->first();

            $permissions = [
                'recorded-lesson-list',
                'recorded-lesson-edit',
                'recorded-lesson-delete',
                'exam-create',
                'exam-edit',
                'exam-delete',
            ];

            foreach ($permissions as $permissionName) {
                $teacher_permission = Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'teacher']);
                $admin_permission = Permission::firstOrCreate(['name' => $permissionName, 'guard_name' => 'admin']);
                $teacher_role->givePermissionTo($teacher_permission);
                $admin_role->givePermissionTo($admin_permission);
            }
        }
}
