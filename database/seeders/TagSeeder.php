<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
           'id' => '1',
           'name' => 'master',
           'color' => 'red'
        ]);
        
        DB::table('tags')->insert([
           'id' => '2',
           'name' => 'host',
           'color' => 'green'
        ]);
        
        DB::table('tags')->insert([
           'id' => '3',
           'name' => 'client',
           'color' => 'blue'
        ]);
    }
}
