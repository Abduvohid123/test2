<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SavolType extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'savol_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'sorovnoma_id',
        'filial_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function sorovnoma()
    {
        return $this->belongsTo(Sorovnoma::class, 'sorovnoma_id');
    }

    public function filial()
    {
        return $this->belongsTo(Filial::class, 'filial_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
