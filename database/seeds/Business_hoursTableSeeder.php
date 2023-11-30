<?php

use Illuminate\Database\Seeder;

class Business_hoursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
       // 外部キー制約無視
        App\Business_hour::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');


        // テーブルの初期化
        DB::table('business_hours')->truncate();

        $business_hours = [
            [
            'facility_code' => 'A001',
            'open' => '09:00:00',
            'close' => '19:00:00',
        	],
        	[
            'facility_code' => 'A002',
            'open' => '09:00:00',
            'close' => '19:00:00',
        	],
        	[
            'facility_code' => 'A003',
            'open' => '09:00:00',
            'close' => '19:00:00',
        	],
        	[
            'facility_code' => 'A004',
            'open' => '09:00:00',
            'close' => '19:00:00',
        	],
        ];

        foreach ($business_hours as $key => $business_hour) {
            App\Business_hour::create($business_hour);
        }

        // 外部キー制約を有効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        App\Business_hour::reguard();

    }
}
