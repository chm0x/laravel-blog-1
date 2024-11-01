<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/data/categories.json');

        # Let decode and converted to Associative Arrays.
        $categories = collect(json_decode($json, true));

        $categories->each(function($category){
            Category::create([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description']
            ]);
        });
    }
}
