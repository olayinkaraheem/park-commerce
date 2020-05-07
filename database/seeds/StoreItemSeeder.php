<?php

use Illuminate\Database\Seeder;

class StoreItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* 
        $table->string('name');
            $table->text('description');
            $table->integer('price');
            $table->integer('in_stock');
            $table->string('image_url');
            $table->integer('is_deleted')->default(0);
        */

        DB::table('store_items')->insert([
            'name' => 'Main Stone Color',
            'description' => "Ethnic Turkish style Necklaces for Women, Vintage Gold Color ...",
            'price' => 2000,
            'in_stock' => 15,
            'image_url' => '/img/neck-lace-for-women.jpg'
        ]);
        
        DB::table('store_items')->insert([
            'name' => 'White Sneaker For Men',
            'description' => "White Sneaker For Men's/Boy's Sneakers For Men  (White)",
            'price' => 1500,
            'in_stock' => 10,
            'image_url' => '/img/digitrendzz-white-original.jpeg'
        ]);
        
        DB::table('store_items')->insert([
            'name' => 'Turkish style Necklaces for Women',
            'description' => "Yunkingdom Ethnic Turkish style Necklaces for Women Vintage Gold Color Water Drop Resin Pendant Necklace Women 3",
            'price' => 2500,
            'in_stock' => 15,
            'image_url' => '/img/Water-Drop-Resin-Pendant-Necklace-Women-3-600x600.jpg'
        ]);
        
        DB::table('store_items')->insert([
            'name' => 'Tarido',
            'description' => "TD_MAHADEV001 MAHADEV Black dial Black Genuine Leather Strap Analog Wrist Analog Watch - For Men",
            'price' => 500,
            'in_stock' => 7,
            'image_url' => '/img/tarido-braton-original.jpeg',
        ]);
    }
}
