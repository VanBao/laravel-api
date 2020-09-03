<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            [
                'code' => 'expires_token',
                'type' => 'system',
                'value' => '7'
            ],
            [
                'code' => 'need_login',
                'type' => 'system',
                'value' => 'off'
            ],
            [
                'code' => 'is_maintenance',
                'type' => 'system',
                'value' => 'off'
            ],
            [
                'code' => 'onesignal_user_id',
                'type' => 'user',
                'value' => null
            ],
            [
                'code' => 'fcm_token',
                'type' => 'user',
                'value' => null
            ],
            [
                'code' => 'language',
                'type' => 'user',
                'value' => null
            ]
        ]);
    }
}
