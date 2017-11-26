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
        $this->call(DefaultSeeder::class);

        $this->admin = factory(App\User::class)->create(['email' => 'admin@whalecore.net']);
        factory(App\User::class)->create(['email' => 'editor@whalecore.net']);
        factory(App\User::class)->create(['email' => 'developer@whalecore.net']);

        factory(App\Project::class, 1)->create()->each(function ($site) {
            $site->members()->create(['user_id' => $this->admin->id, 'role_id' => 1]);

            // Pages
            $pageTem = factory(App\Template::class)->states('page')->create(['project_id' => $site->id]);
            factory(App\Item::class, 5)->create(['project_id' => $site->id, 'template_id' => $pageTem->id]);

            // Posts
            $postTem = factory(App\Template::class)->states('post')->create(['project_id' => $site->id]);
            factory(App\Item::class, 2)->create(['project_id' => $site->id, 'template_id' => $postTem->id]);

            // Bucket
            $bucketTem = factory(App\Template::class)->states('bucket')->create(['project_id' => $site->id]);
            factory(App\Item::class, 1)->create(['project_id' => $site->id, 'template_id' => $bucketTem->id]);
        });
    }
}
