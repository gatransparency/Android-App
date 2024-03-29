<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PublicOfficial extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    protected $appends = [
        'image',
    ];

    public $table = 'public_officials';

    protected $dates = [
        'hired',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        'Active'   => 'Active',
        'Inactive' => 'Inactive',
    ];

    protected $fillable = [
        'gtnn_number',
        'name',
        'email',
        'current_agency_id',
        'hired',
        'badge_number',
        'rank_position',
        'hourly_rate',
        'annual_salary',
        'status',
        'okey_number',
        'years',
        'phone_number',
        'previous_employment',
        'professionalism',
        'appearance',
        'uniform',
        'attitude',
        'law_knowledge',
        'rights_violations',
        'if_yes',
        'notes',
        'signature',
        'initials',
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

    public function gtnnNumberReports()
    {
        return $this->hasMany(Report::class, 'gtnn_number_id', 'id');
    }

    public function gtnnNumberVehicles()
    {
        return $this->hasMany(Vehicle::class, 'gtnn_number_id', 'id');
    }

    public function gtnnNumberInternalInvestigations()
    {
        return $this->hasMany(InternalInvestigation::class, 'gtnn_number_id', 'id');
    }

    public function gtnnNumberRecords()
    {
        return $this->hasMany(Record::class, 'gtnn_number_id', 'id');
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

    public function current_agency()
    {
        return $this->belongsTo(AgenciesOffice::class, 'current_agency_id');
    }

    public function getHiredAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setHiredAttribute($value)
    {
        $this->attributes['hired'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
