<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtaOna extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '0' => 'Ota',
        '1' => 'Ona',
    ];

    public $table = 'ota_onas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'student_id',
        'status',
        'phone_number',
        'filial_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
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
