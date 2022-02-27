<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QoshimaChiqimlar extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'qoshima_chiqimlars';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'chiqim_sababi',
        'summa',
        'kim_tarafidan_olindi_id',
        'who_is_deleted',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function kim_tarafidan_olindi()
    {
        return $this->belongsTo(Worker::class, 'kim_tarafidan_olindi_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
