<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;

class UserTask extends Pivot
{
    protected $table = 'users_tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'task_id',
        'status',
    ];

    /**
     * User relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Task relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function scopeUserTasks($query)
    {
        return $query->where('user_id', Auth::user()->id)
            ->whereDate('created_at', Carbon::today())
            ->where('status', '!=', 'missed')
            ->with(['user', 'task.category']);
    }
}
