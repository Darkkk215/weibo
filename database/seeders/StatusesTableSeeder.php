<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::factory(50)->create();
    }
}
