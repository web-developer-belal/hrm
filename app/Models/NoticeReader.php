<?php
namespace App\Models;

use App\Models\Notice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeReader extends Model
{
    /** @use HasFactory<\Database\Factories\NoticeReaderFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'notice_id',
        'read_at',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }
}
