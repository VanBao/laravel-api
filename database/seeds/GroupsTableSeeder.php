<?php

use Illuminate\Database\Seeder;
use App\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::insert([
            [
                'name' => 'Super Admin',
                'type' => 'super_admin',
                'description' => 'Super Admin',
                'created_at' => now()
            ],
            [
                'name' => 'Admin',
                'type' => 'admin',
                'description' => 'Admin',
                'created_at' => now()
            ],
            [
                'name' => 'Staff',
                'type' => 'staff',
                'description' => 'Staff',
                'created_at' => now()
            ],
            [
                'name' => 'User',
                'type' => 'user',
                'description' => 'User',
                'created_at' => now()
            ]
        ]);
    }
}
