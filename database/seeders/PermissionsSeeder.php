<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //roles permissions
            'create role',
            'edit role',
            'delete role',
            'view role',
            'assign role',
            'revoke role',

            //schools
            'create school',
            'edit school',
            'delete school',
            'view school',

            //tournament
            'create tournament',
            'edit tournament',
            'delete tournament',
            'view tournament',
            
            //matches
            'create match',
            'edit match',
            'delete match',
            'view match',

            //debate teams
            'create team',
            'edit team',
            'delete team',
            'view team',
        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate(['name'=>$permission]);
        }
    }
}
