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

            $templates = factory(App\Template::class, 5)->create(['site_id' => $site->id]);

            factory(App\Media::class, 10)->create(['site_id' => $site->id]);
            factory(App\Page::class, 12)->create(['site_id' => $site->id, 'template_id' => $templates->random()->id]);
            factory(App\Bucket::class, 4)->create(['site_id' => $site->id, 'template_id' => $templates->random()->id]);
            factory(App\Component::class, 2)->create(['site_id' => $site->id]);
        });
    }
}
