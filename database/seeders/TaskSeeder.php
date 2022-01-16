<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Task::count()) {
            return;
        }

        DB::table('tasks')->insert([
            [
                'id' => 1,
                'category_id' => 1,
                'name' => 'FundamentalsTask1',
                'description' => 'FundamentalsTaskDescription1',
            ], [
                'id' => 2,
                'category_id' => 1,
                'name' => 'FundamentalsTask2',
                'description' => 'FundamentalsTaskDescription2',
            ], [
                'id' => 3,
                'category_id' => 2,
                'name' => 'StringTask1',
                'description' => 'StringTaskDescription1',
            ], [
                'id' => 4,
                'category_id' => 2,
                'name' => 'StringTask2',
                'description' => 'StringTaskDescription2',
            ], [
                'id' => 5,
                'category_id' => 3,
                'name' => 'AlgorithmsTask1',
                'description' => 'AlgorithmsTaskDescription1',
            ], [
                'id' => 6,
                'category_id' => 3,
                'name' => 'AlgorithmsTask2',
                'description' => 'AlgorithmsTaskDescription2',
            ], [
                'id' => 7,
                'category_id' => 4,
                'name' => 'MathematicTask1',
                'description' => 'MathematicTaskDescription1',
            ], [
                'id' => 8,
                'category_id' => 4,
                'name' => 'MathematicTask2',
                'description' => 'MathematicTaskDescription2',
            ], [
                'id' => 9,
                'category_id' => 5,
                'name' => 'PerfomanceTask1',
                'description' => 'PerfomanceTaskDescription1',
            ], [
                'id' => 10,
                'category_id' => 5,
                'name' => 'PerfomanceTask2',
                'description' => 'PerfomanceTaskDescription2',
            ], [
                'id' => 11,
                'category_id' => 6,
                'name' => 'Booleans1',
                'description' => 'BooleansTaskDescription1',
            ], [
                'id' => 12,
                'category_id' => 6,
                'name' => 'Booleans2',
                'description' => 'BooleansTaskDescription2',
            ], [
                'id' => 13,
                'category_id' => 7,
                'name' => 'Functions1',
                'description' => 'FunctionsTaskDescription1',
            ], [
                'id' => 14,
                'category_id' => 7,
                'name' => 'Functions2',
                'description' => 'FunctionsTaskDescription2',
            ],
        ]);
    }
}
