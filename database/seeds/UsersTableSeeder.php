<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Vu Hoang Linh',
            'email' => 'vlinh12300@gmail.com',
            'address' => 'Ho Chi Minh City',
            'phone' => '0902411129',
            'password' => bcrypt('123123123'),
            'created_at' => now(),
            'group_id' => 1
        ]);
    }
}
