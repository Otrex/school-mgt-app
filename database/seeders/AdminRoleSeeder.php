<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin1 = Admin::find(1);

        $role1 = Role::find(1);

        // $admin2 = Admin::find(2);

        // $role2 = Role::find(2);

        $admin1->roles()->attach($role1->id);

        // $admin2->roles()->attach($role2->id);
    }
}
