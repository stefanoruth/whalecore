<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguageSeeder::class);
        $this->call(RoleSeeder::class);

        $this->admin = factory(App\User::class)->create(['email' => 'admin@whalecore.net']);

        factory(App\Site::class, 3)->create()->each(function($site){
            $site->members()->create(['user_id' => $this->admin->id, 'role_id' => 1]);
        });
    }
}
