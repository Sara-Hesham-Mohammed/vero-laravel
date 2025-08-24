<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'editor', //organization members that can edit content but not high level stuff like an admin can
            'educator', //teacher or other wise
            'student',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);//addning the roles to db
        }


    }
}
