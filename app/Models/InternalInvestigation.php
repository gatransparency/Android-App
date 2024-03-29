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

class InternalInvestigation extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    protected $appends = [
        'files',
    ];

    public $table = 'internal_investigations';

    protected $dates = [
        'ia_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ia_date',
        'gtnn_number_id',
        'agency_office_id',
        'name',
        'investigator',
        'narrative',
        'entered_by',
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

    public function getIaDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setIaDateAttribute($value)
    {
        $this->attributes['ia_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function gtnn_number()
    {
        return $this->belongsTo(PublicOfficial::class, 'gtnn_number_id');
    }

    public function agency_office()
    {
        return $this->belongsTo(AgenciesOffice::class, 'agency_office_id');
    }

    public function getFilesAttribute()
    {
        return $this->getMedia('files');
    }
}
