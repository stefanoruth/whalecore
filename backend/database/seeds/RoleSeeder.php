<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['owner', 'administator', 'content-editor'];

        foreach ($roles as $role) {
            \App\Role::updateOrCreate(['name' => $role]);
        }
    }
}
