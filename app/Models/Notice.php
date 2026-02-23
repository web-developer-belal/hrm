<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'department_id',
        'title',
        'description',
        'attachments',
        'status',
    ];

    protected $casts = [
        'attachments' => 'array',
    ];

    // Relationships

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function readers()
    {
        return $this->belongsToMany(Employee::class, 'notice_reads')
                    ->withPivot('read_at')
                    ->withTimestamps();
    }
}