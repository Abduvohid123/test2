<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Student extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public const JINSI_SELECT = [
        '0' => 'O\'g\'il bola',
        '1' => 'Qiz bola',
    ];

    public const STATUS_SELECT = [
        '0' => 'Kutish',
        '1' => 'Sinov Darsida',
        '2' => 'Kelmay Qo\'ygan',
        '3' => 'Aktiv',
        '4' => 'Tugatgan',
    ];

    public $table = 'students';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'birth_day',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'birth_day',
        'phone_number',
        'status',
        'jinsi',
        'start_time',
        'end_time',
        'tuman_id',
        'address',
        'reklama_id',
        'user_id',
        'filial_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getBirthDayAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setBirthDayAttribute($value)
    {
        $this->attributes['birth_day'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function getImageAttribute()
    {
        $file = $this->getMedia('image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function weeks()
    {
        return $this->belongsToMany(Week::class);
    }

    public function tuman()
    {
        return $this->belongsTo(Tumanlar::class, 'tuman_id');
    }

    public function reklama()
    {
        return $this->belongsTo(Reklama::class, 'reklama_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
