<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
