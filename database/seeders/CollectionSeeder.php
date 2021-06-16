<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Collection;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::all();
        foreach ($categories as $cat){
            Collection::create([
                'category_id' => $cat->id,
                'name' => 'Master Collection'
            ]);
        }
    }
}
