<?php


use Illuminate\Database\Seeder;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // 外部キー制約無視
        App\Facility::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');


        // テーブルの初期化
        DB::table('facilities')->truncate();

        $facilities = [

            ['facility_code' => 'A001',
            'facility_name' => '多目的ホールA'],
            ['facility_code' => 'A002',
            'facility_name' => '多目的ホールB'],
            ['facility_code' => 'A003',
            'facility_name' => '道場'],
            ['facility_code' => 'A004',
            'facility_name' => 'レクリエーションルーム']
        ];

        foreach ($facilities as $key => $facility) {
            App\Facility::create($facility);
        }

        // 外部キー制約を有効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        App\Facility::reguard();

    }
}
