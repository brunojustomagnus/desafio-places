<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = [
            [
                'name' => 'Morro do Farol',
                'slug' => 'morro-do-farol-torres-rs',
                'city' => 'Torres',
                'state' => 'Rio Grande do Sul',
            ],
        ];
        DB::table('places')->insert($places);
    }
}
