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
        // DB::table('products')->insert([
        //     'name' => 'Product 1',
        //     'created_at' => now(),
        //     'slug' => 'Loui',
        // ]);

        for ($i=16; $i <= 19 ; $i++) { 
            DB::table('products')->insert([
                'name' => 'Products' .$i,
                'created_at' => now(),
                'slug' => 'User' . $i,
                'status' => 'active',
            ]);
        }
    }
}
