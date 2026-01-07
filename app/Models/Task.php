<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskStatus;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status_id',
    ];

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }
}
