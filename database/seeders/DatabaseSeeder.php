<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // app(Role::class)->findOrCreate(RolesEnum::ADMIN->value, 'web');
        // app(Role::class)->findOrCreate(RolesEnum::STUDENT->value, 'web');
        // app(Role::class)->findOrCreate(RolesEnum::TEACHER->value, 'web');
        // app(Role::class)->findOrCreate(RolesEnum::PARENT->value, 'web');
        // $user = User::find('1');
        // $user->assignRole(RolesEnum::ADMIN);
    }
}
