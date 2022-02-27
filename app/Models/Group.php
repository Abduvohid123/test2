<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'active'     => 'active',
        'zaxira'     => 'zaxira',
        'tugatilgan' => 'tugatilgan',
    ];

    public $table = 'groups';

    protected $dates = [
        'start_cource',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'room_id',
        'fan_id',
        'cost',
        'description',
        'status',
        'start',
        'finish',
        'start_cource',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function fan()
    {
        return $this->belongsTo(Fan::class, 'fan_id');
    }

    public function days()
    {
        return $this->belongsToMany(Week::class);
    }

    public function getStartCourceAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartCourceAttribute($value)
    {
        $this->attributes['start_cource'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
