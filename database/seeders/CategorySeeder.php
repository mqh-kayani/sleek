<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Pillowcase'
        ]);
        Category::create([
            'name' => 'Headbands'
        ]);
        Category::create([
            'name' => 'Scrunchise'
        ]);
        Category::create([
            'name' => 'Face Mask'
        ]);
        Category::create([
            'name' => 'Bonnets'
        ]);
        Category::create([
            'name' => 'Durages'
        ]);
    }
}
