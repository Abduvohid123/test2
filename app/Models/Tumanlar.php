<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tumanlar extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'tumanlars';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'viloyat_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function viloyat()
    {
        return $this->belongsTo(Viloyatlar::class, 'viloyat_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
