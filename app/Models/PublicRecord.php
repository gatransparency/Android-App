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

class PublicRecord extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'public_records';

    protected $appends = [
        'file',
    ];

    protected $dates = [
        'response_due',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'request_number',
        'agency',
        'response_due',
        'county',
        'state',
        'records_requested',
        'status',
        'estimated_amount',
        'amount_paid',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        'Draft'                 => 'Draft',
        'Submitted'             => 'Submitted',
        'Response'              => 'Response',
        'No Responsive Records' => 'No Responsive Records',
        'Completed'             => 'Completed',
        'Denied'                => 'Denied',
        'No Response'           => 'No Response',
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

    public function getResponseDueAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setResponseDueAttribute($value)
    {
        $this->attributes['response_due'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFileAttribute()
    {
        return $this->getMedia('file');
    }
}
