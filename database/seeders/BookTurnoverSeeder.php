<?php

namespace Database\Seeders;

use App\Models\BookTurnover;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookTurnoverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookTurnover::factory(15)->create();
    }
}
