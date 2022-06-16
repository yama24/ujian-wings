<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Login;
use \App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Login::create([
            'User' => 'Smit',
            'Password' => password_hash('_sm1t_OK', PASSWORD_DEFAULT),
        ]);

        Product::create([
            'Product_Code' => 'SKUSKILNP',
            'Product_Name' => 'So klin Pewangi',
            'Price' => '15000',
            'Currency' => 'IDR',
            'Discount' => '10',
            'Dimension' => '13 cm x 10 cm',
            'Unit' => 'PCS',
        ]);

        Product::create([
            'Product_Code' => 'GVBR',
            'Product_Name' => 'Giv Biru',
            'Price' => '11000',
            'Currency' => 'IDR',
            'Discount' => '0',
            'Dimension' => '12 cm x 12 cm',
            'Unit' => 'PCS',
        ]);

        Product::create([
            'Product_Code' => 'SKLNLQD',
            'Product_Name' => 'SO Klin Liquid',
            'Price' => '18000',
            'Currency' => 'IDR',
            'Discount' => '0',
            'Dimension' => '19 cm x 20 cm',
            'Unit' => 'PCS',
        ]);
    }
}
