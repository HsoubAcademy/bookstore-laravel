<?php

use App\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create(['name' => 'فاطمة حيشية']);
        Author::create(['name' => 'محمد عرابي']);
        Author::create(['name' => 'محمد الزاير']);
        Author::create(['name' => 'عمر النواوي']);
        Author::create(['name' => 'ماجد عطوي']);
        Author::create(['name' => 'رياض سامر']);
    }
}
