<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

class GroupProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $groups = [
                [
                    'model' => 'Nike air max 1',
                    'quantity' => 7,
                    'product' => ['name' => 'Nike air max 1','image' => 'images/nike1.png', 'price' => 200, 'description' => 'The first shoe to reveal Nike Air to the world gets elevated with Parisian-inspired details. Add this to the tried-and-true cushioning and classic wavy mudguard—its no wonder its reigned supreme for so long.']
                ],
                [
                    'model' => 'Nike air max 90',
                    'quantity' => 6,
                    'product' => ['name' => 'Nike air max 90','image' => 'images/nike90.png', 'price' => 140, 'description' => 'Nothing as fly, nothing as comfortable, nothing as proven. The Nike Air Max 90 stays true to its OG running roots with the iconic Waffle sole, stitched overlays and classic TPU details. Classic colors celebrate your fresh look while Max Air cushioning adds comfort to the journey.']
                ],
                [
                    'model' => 'Nike air force',
                    'quantity' => 4,
                    'product' => ['name' => 'Nike air force','image' => 'images/airforce1.png', 'price' => 120, 'description' => 'The radiance lives on in the Nike Air Force 1 ’07, the b-ball OG that puts a fresh spin on what you know best: durably stitched overlays, clean finishes and the perfect amount of flash to make you shine.']
                ],
                [
                    'model' => 'Jordan 4',
                    'quantity' => 3,
                    'product' => ['name' => 'Jordan 4','image' => 'images/jordan4.jpg', 'price' => 320,'description' => 'The Air Jordan 4 Retro Oxidized Green is the latest must-have sneaker, combining a classic silhouette with a fresh summer-ready colorway. The shoe features a predominantly white upper, highlighted with oxidized green and neutral grey accents that create a sleek and contemporary look.']
                ],
            ];

            foreach ($groups as $g){
                $group = Group::create([
                    'model' => $g['model'],
                    'quantity' => $g['quantity'],
                ]);

                for($i = 0; $i < $group->quantity; $i++){
                    Product::create([
                        'name' => $g['product']['name'] ,
                        'description' => $g['product']['description'],
                        'barcode' => Str::random(9), 
                        'group_id' => $group->id,
                        'image' =>  $g['product']['image'],
                        'price' =>  $g['product']['price'],
                    ]);
                }
            }

           
    }
}
