<?php

use Illuminate\Database\Seeder;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        $roles = ['owner', 'administator', 'content-editor'];

        foreach ($roles as $role) {
            \App\Role::updateOrCreate(['name' => $role]);
        }

        // Language
        $languages = [
            'en' => 'English',
            'da' => 'Danish',
            'se' => 'Swedish',
            'no' => 'Norwegian',
            'de' => 'German',
        ];

        foreach ($languages as $code => $name) {
            \App\Language::updateOrCreate(['code' => $code], ['name' => $name]);
        }
    }
}
