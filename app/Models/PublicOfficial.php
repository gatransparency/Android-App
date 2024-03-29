<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PublicOfficial extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    protected $appends = [
        'image',
    ];

    public $table = 'public_officials';

    public const STATUS_SELECT = [
        'Active'   => 'Active',
        'Inactive' => 'Inactive',
    ];

    protected $dates = [
        'hired',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'public_official_number',
        'first_name',
        'badge_employee_number',
        'rank',
        'officer_key_number',
        'hired',
        'email',
        'phone_number',
    ];

    protected $fillable = [
        'agency_id',
        'public_official_number',
        'first_name',
        'middle_name',
        'last_name',
        'badge_employee_number',
        'sex',
        'rank',
        'status',
        'officer_key_number',
        'hired',
        'years_in_profession',
        'email',
        'phone_number',
        'previous_agency',
        'notes',
        'accuracy',
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

    public function officialNumberReports()
    {
        return $this->hasMany(Report::class, 'official_number_id', 'id');
    }

    public function publicOfficialRecords()
    {
        return $this->hasMany(Record::class, 'public_official_id', 'id');
    }

    public function publicOfficialVehicles()
    {
        return $this->hasMany(Vehicle::class, 'public_official_id', 'id');
    }

    public function publicOfficialInternalInvestigations()
    {
        return $this->hasMany(InternalInvestigation::class, 'public_official_id', 'id');
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

    public function agency()
    {
        return $this->belongsTo(AgenciesOffice::class, 'agency_id');
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
