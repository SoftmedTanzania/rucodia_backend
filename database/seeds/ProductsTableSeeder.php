<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Product;
use App\Unit;
use App\Subcategory;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kg_unit = Unit::where('name', 'Kg')->first();
        $lt_unit = Unit::where('name', 'Lt')->first();
        $can_unit = Unit::where('name', 'Can')->first();
        $bag_unit = Unit::where('name', 'Bag')->first();
        $ton_unit = Unit::where('name', 'Ton')->first();
        $cutling_unit = Unit::where('name', 'Cutling')->first();
        $piece_unit = Unit::where('name', 'Piece')->first();

        $mahindi_subcategory = Subcategory::where('name', 'Mahindi')->first();
        $maharage_subcategory = Subcategory::where('name', 'Maharage')->first();
        $vifaa_subcategory = Subcategory::where('name', 'Pampu')->first();
        $dawa_subcategory = Subcategory::where('name', 'Thiodan')->first();

            $product = new Product();
            $product->uuid = (string) Str::uuid();
            $product->name = 'Katumani 2018H';
            $product->price = 15000;
            $product->description = 'Mahindi yanayokua kwa wiki 9.';
            $product->created_by = 'System';
            $product->created_at = date('Y-m-d H:i:s');
            $product->save();
            $product->units()->attach($kg_unit, array('uuid' => (string) Str::uuid()));
            $product->subcategories()->attach($mahindi_subcategory, array('uuid' => (string) Str::uuid()));

            $product = new Product();
            $product->uuid = (string) Str::uuid();
            $product->name = 'Mlingano 2018H';
            $product->price = 13500;
            $product->description = 'Mahindi yanayokua kwa wiki 7.';
            $product->created_by = 'System';
            $product->created_at = date('Y-m-d H:i:s');
            $product->save();
            $product->units()->attach($kg_unit, array('uuid' => (string) Str::uuid()));
            $product->subcategories()->attach($mahindi_subcategory, array('uuid' => (string) Str::uuid()));

            $product = new Product();
            $product->uuid = (string) Str::uuid();
            $product->name = 'Ilonga RH1';
            $product->price = 25000;
            $product->description = 'Maharage mekundu ya Mpwapwa yanastahmili ukame.';
            $product->created_by = 'System';
            $product->created_at = date('Y-m-d H:i:s');
            $product->save();
            $product->units()->attach($kg_unit, array('uuid' => (string) Str::uuid()));
            $product->subcategories()->attach($maharage_subcategory, array('uuid' => (string) Str::uuid()));

            $product = new Product();
            $product->uuid = (string) Str::uuid();
            $product->name = 'Solo Viper';
            $product->price = 92000;
            $product->description = 'Mashine ya kupulizia na kunyunyizia dawa shambani.';
            $product->created_by = 'System';
            $product->created_at = date('Y-m-d H:i:s');
            $product->save();
            $product->units()->attach($piece_unit, array('uuid' => (string) Str::uuid()));
            $product->subcategories()->attach($vifaa_subcategory, array('uuid' => (string) Str::uuid()));

            $product = new Product();
            $product->uuid = (string) Str::uuid();
            $product->name = 'Thiorolox';
            $product->price = 7800;
            $product->description = 'Sumu ya Thiodan ya AgroCull.';
            $product->created_by = 'System';
            $product->created_at = date('Y-m-d H:i:s');
            $product->save();
            $product->units()->attach($lt_unit, array('uuid' => (string) Str::uuid()));
            $product->subcategories()->attach($dawa_subcategory, array('uuid' => (string) Str::uuid()));
    }
}
