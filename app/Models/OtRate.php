<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtRate extends Model
{
    protected $fillable = [
        'designation_id',
        'ot_id',
        'rate',
    ];

    protected $casts = [
        'rate' => 'decimal:2',
    ];

    public function ot()
    {
        return $this->belongsTo(Ot::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }


}
