<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'category_name'=>'寿司'
        ];
        DB::table('categories')->insert($param);

        $param = [
            'category_name'=>'焼肉'
        ];
        DB::table('categories')->insert($param);

        $param = [
            'category_name'=>'居酒屋'
        ];
        DB::table('categories')->insert($param);

        $param = [
            'category_name'=>'イタリアン'
        ];
        DB::table('categories')->insert($param);

        $param = [
            'category_name'=>'ラーメン'
        ];
        DB::table('categories')->insert($param);
    }
}
