<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('companies')->insert([
            'company_name' => 'coca-cola',
            'street_sddress' => '東京都渋谷区０丁目',
            'representative_name' => '0001234000',
        ]);
        DB::table('companies')->insert([
            'company_name' => 'サントリー',
            'street_sddress' => '大阪府大阪市０区',
            'representative_name' => '0005678000',
        ]);
        DB::table('companies')->insert([
            'company_name' => 'キリン',
            'street_sddress' => '東京都中野区０丁目',
            'representative_name' => '0009123000',
        ]);
    }
}
