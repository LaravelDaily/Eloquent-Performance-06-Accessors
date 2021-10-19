<?php

namespace Database\Seeders;

use App\Models\Ghost;
use Illuminate\Database\Seeder;

class GhostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ghost::factory(1000)->create();
    }
}
