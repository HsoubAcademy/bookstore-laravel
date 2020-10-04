<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call(CategorySeeder::class);
        $this->call(PublisherSeeder::class);
        $this->call(AuthorSeeder::class);
        $this->call(BookSeeder::class);
    }
}
