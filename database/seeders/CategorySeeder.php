<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Category::count()) {
            return;
        }

        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Fundamentals',
            ], [
                'id' => 2,
                'name' => 'String',
            ], [
                'id' => 3,
                'name' => 'Algorithms',
            ], [
                'id' => 4,
                'name' => 'Mathematic',
            ], [
                'id' => 5,
                'name' => 'Perfomance',
            ], [
                'id' => 6,
                'name' => 'Booleans',
            ], [
                'id' => 7,
                'name' => 'Functions',
            ],
        ]);
    }
}
