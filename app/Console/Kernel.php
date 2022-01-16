<?php

namespace App\Console;

use App\Models\Category;
use App\Models\User;
use App\Models\UserTask;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            Log::info('Schedule called! Tasks for users created!');

            $users = User::all();
            foreach ($users as $user) {
                $existsTasksIds = UserTask::where('user_id', $user->id)->pluck('task_id');

                $categories = Category::whereHas('tasks', function ($query) use ($existsTasksIds) {
                    $query->whereNotIn('id', $existsTasksIds);
                })->with(['tasks' => function($query) use ($existsTasksIds) {
                    $query->whereNotIn('id', $existsTasksIds)->orderByRaw('RAND()');
                }])->get();

                $optionalItemsQuantity = count($categories) < 5 ? count($categories) : 5;
                $categories = $categories->random($optionalItemsQuantity)
                    ->transform(function ($value, $key) {
                        $value->setRelation('tasks', $value->tasks->take(1));
                        return $value;
                    });

                $query = [];
                foreach ($categories as $category) {
                    $query[] = [
                        'user_id' => $user->id,
                        'task_id' => $category->tasks[0]->id,
                        'status' => 'processed',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                }
                UserTask::insert($query);
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
