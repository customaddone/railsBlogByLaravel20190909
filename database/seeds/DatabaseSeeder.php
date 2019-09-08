<?php

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
        /* これを付けないとシーディングできない */
        $this->call(UsersTableSeeder::class);
    }
}
