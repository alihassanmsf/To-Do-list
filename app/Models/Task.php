<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'due_date',
        'priority',
        'status',
        'created_by',
        'assigned_for',
        'completed_by',
        ];


    // Relationship to the User who created the task
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relationship to the user the task is assigned for.
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_for');
    }
}
