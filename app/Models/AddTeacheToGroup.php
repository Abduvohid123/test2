<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddTeacheToGroup extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const SALLARY_TYPE_RADIO = [
        'percent' => 'Foiz',
        'summa'   => 'Summa',
    ];

    public $table = 'add_teache_to_groups';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'group_id',
        'sallary_type',
        'oylik',
        'filial_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Worker::class);
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
