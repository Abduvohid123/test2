<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoshqaIshchilarMaoshlari extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'boshqa_ishchilar_maoshlaris';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'worker_id',
        'summa',
        'bonus',
        'jarima',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
