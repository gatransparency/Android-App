<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Record extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'records';

    protected $appends = [
        'record',
    ];

    protected $dates = [
        'date_added',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'date_added',
        'full_name',
        'record_type',
        'entered_by',
        'gtnn_number_id',
        'agency_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getDateAddedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAddedAttribute($value)
    {
        $this->attributes['date_added'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getRecordAttribute()
    {
        return $this->getMedia('record');
    }

    public function gtnn_number()
    {
        return $this->belongsTo(PublicOfficial::class, 'gtnn_number_id');
    }

    public function agency()
    {
        return $this->belongsTo(AgenciesOffice::class, 'agency_id');
    }
}
