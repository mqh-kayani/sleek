<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => Str::slug('new design','-')
        ]);
        Tag::create([
            'name' => Str::slug('stylish pillowcase','-')
        ]);
        Tag::create([
            'name' => Str::slug('stylish headbands','-')
        ]);
        Tag::create([
            'name' => Str::slug('stylish face mask','-')
        ]);
        Tag::create([
            'name' => Str::slug('stylish bonnets','-')
        ]);
    }
}
