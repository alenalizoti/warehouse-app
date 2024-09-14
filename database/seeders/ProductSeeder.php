<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'Nike air max 1',
            'description' => 'The first shoe to reveal Nike Air to the world gets elevated with Parisian-inspired details. Add this to the tried-and-true cushioning and classic wavy mudguard—its no wonder its reigned supreme for so long.',
            'barcode' =>  rand(100000000, 999999999),
            'price' => 150,
            'image' => 'images/nike1.png',
            'group_id' => 1
        ]);
        DB::table('products')->insert([
            'name' => 'Nike air max 90',
            'description' => 'Nothing as fly, nothing as comfortable, nothing as proven. The Nike Air Max 90 stays true to its OG running roots with the iconic Waffle sole, stitched overlays and classic TPU details. Classic colors celebrate your fresh look while Max Air cushioning adds comfort to the journey.',
            'barcode' =>  rand(100000000, 999999999),
            'price' => 120,
            'image' => 'images/nike90.png',
            'group_id' => 2
        ]);
        DB::table('products')->insert([
            'name' => 'Nike air force',
            'description' => 'The radiance lives on in the Nike Air Force 1 ’07, the b-ball OG that puts a fresh spin on what you know best: durably stitched overlays, clean finishes and the perfect amount of flash to make you shine.',
            'barcode' =>  rand(100000000, 999999999),
            'price' => 110,
            'image' => 'images/airforce1.png',
            'group_id' => 3
        ]);
        DB::table('products')->insert([
            'name' => 'Jordan 4',
            'description' => 'The Air Jordan 4 Retro Oxidized Green is the latest must-have sneaker, combining a classic silhouette with a fresh summer-ready colorway. The shoe features a predominantly white upper, highlighted with oxidized green and neutral grey accents that create a sleek and contemporary look. ',
            'barcode' =>  rand(100000000, 999999999),
            'price' => 250,
            'image' => 'images/jordan4.jpg',
            'group_id' => 4
        ]);
    }

 
}
