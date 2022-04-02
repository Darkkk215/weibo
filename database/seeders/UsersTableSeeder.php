<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(50)->create();
        $user = User::find(1);
        $user->name = 'Dark';
        $user->email = '228243453@qq.com';
        $user->save();
        //User::factory()->count(50)->create();
    }
}
