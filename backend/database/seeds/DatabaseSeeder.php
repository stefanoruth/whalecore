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

        factory(App\Project::class, 3)->create()->each(function($site){
            $site->members()->create(['user_id' => $this->admin->id, 'role_id' => 1]);

            $templates = factory(App\Template::class, 10)->create(['project_id' => $site->id]);

            // factory(App\Media::class, 10)->create(['project_id' => $site->id]);
            factory(App\Item::class, 50)->make(['project_id' => $site->id])->each(function($item) use ($templates){
                $item->template_id = $templates->random()->id;

                $item->save();
            });
        });
    }
}
