<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'deadline',
        'user_id'
    ];
    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id'); // Ensure 'user_id' matches the foreign key in the tasks table
    }
}
