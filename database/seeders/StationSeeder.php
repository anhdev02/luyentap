<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('stations')->delete();
        DB::table('stations')->insert([
            ['route_id'=>1, 'station_name'=>'Bến Thành', 'order'=>1],
            ['route_id'=>1, 'station_name'=>'Nhà hát TP', 'order'=>2],
            ['route_id'=>1, 'station_name'=>'Ba Son', 'order'=>3],
            ['route_id'=>1, 'station_name'=>'Văn Thánh', 'order'=>4],
            ['route_id'=>1, 'station_name'=>'Tân Cảng', 'order'=>5],
            ['route_id'=>1, 'station_name'=>'Thảo Điền', 'order'=>6],
            ['route_id'=>1, 'station_name'=>'An Phú', 'order'=>7],
            ['route_id'=>1, 'station_name'=>'Rạch Chiếc', 'order'=>8],
            ['route_id'=>1, 'station_name'=>'Phước Long', 'order'=>9],
            ['route_id'=>1, 'station_name'=>'Bình Thái', 'order'=>10],
            ['route_id'=>1, 'station_name'=>'Thủ Đức', 'order'=>11],
            ['route_id'=>1, 'station_name'=>'Khu Công nghệ cao', 'order'=>12],
            ['route_id'=>1, 'station_name'=>'Suối Tiên', 'order'=>13],
            ['route_id'=>1, 'station_name'=>'BXMĐ mới', 'order'=>14],
            ['route_id'=>2, 'station_name'=>'Bến Thành', 'order'=>1],
            ['route_id'=>2, 'station_name'=>'Tao Đàn', 'order'=>2],
            ['route_id'=>2, 'station_name'=>'Dân Chủ', 'order'=>3],
            ['route_id'=>2, 'station_name'=>'Hòa Hưng', 'order'=>4],
            ['route_id'=>2, 'station_name'=>'Lê Thị Riêng', 'order'=>5],
            ['route_id'=>2, 'station_name'=>'Phạm Văn Hai', 'order'=>6],
            ['route_id'=>2, 'station_name'=>'Bảy Hiền', 'order'=>7],
            ['route_id'=>2, 'station_name'=>'Đồng Đen', 'order'=>8],
            ['route_id'=>2, 'station_name'=>'Nguyễn Hồng Đào', 'order'=>9],
            ['route_id'=>2, 'station_name'=>'Bà Quẹo', 'order'=>10],
            ['route_id'=>2, 'station_name'=>'Phạm Văn Bạch', 'order'=>11],
            ['route_id'=>2, 'station_name'=>'Tham Lương', 'order'=>12],
            ['route_id'=>2, 'station_name'=>'Tân Thới Nhất', 'order'=>13],
            ['route_id'=>2, 'station_name'=>'BX An Sương', 'order'=>14],
            ['route_id'=>5, 'station_name'=>'Chợ Tân Bình', 'order'=>1],
            ['route_id'=>5, 'station_name'=>'Bảy Hiền', 'order'=>2],
            ['route_id'=>5, 'station_name'=>'Lăng Cha Cả', 'order'=>3],
            ['route_id'=>5, 'station_name'=>'Hoàng Văn Thụ', 'order'=>4],
            ['route_id'=>5, 'station_name'=>'Phú Nhuận', 'order'=>5],
            ['route_id'=>5, 'station_name'=>'Nguyễn Văn Đậu', 'order'=>6],
            ['route_id'=>5, 'station_name'=>'Bà Chiểu', 'order'=>7],
            ['route_id'=>5, 'station_name'=>'Hàng Xanh', 'order'=>8],
            ['route_id'=>5, 'station_name'=>'Tân Cảng', 'order'=>9]
        ]);
    }
}
