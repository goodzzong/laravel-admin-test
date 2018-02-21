<?php

use Illuminate\Database\Seeder;

class NoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Notice::truncate();
        factory(App\Notice::class, 50)->create();
    }
}