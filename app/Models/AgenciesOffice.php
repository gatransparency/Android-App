<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AgenciesOffice extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    protected $appends = [
        'image',
    ];

    public $table = 'agencies_offices';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'agency_name',
        'street_address',
        'street_address_additional',
        'city',
        'state',
        'zip',
        'website_url',
        'phone_number',
        'agency_email',
        'fax',
        'agency_rating',
        'notes',
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

    public function agencyReports()
    {
        return $this->hasMany(Report::class, 'agency_id', 'id');
    }

    public function agencyRecords()
    {
        return $this->hasMany(Record::class, 'agency_id', 'id');
    }

    public function agencyVehicles()
    {
        return $this->hasMany(Vehicle::class, 'agency_id', 'id');
    }

    public function agencyPublicOfficials()
    {
        return $this->hasMany(PublicOfficial::class, 'agency_id', 'id');
    }

    public function agencyInternalInvestigations()
    {
        return $this->hasMany(InternalInvestigation::class, 'agency_id', 'id');
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
}
