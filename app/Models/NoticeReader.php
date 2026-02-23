<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeReader extends Model
{
    /** @use HasFactory<\Database\Factories\NoticeReaderFactory> */
    use HasFactory;

   protected $fillable = [
        'branch_id',
    ];
}
