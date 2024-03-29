<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Vehicle extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'vehicles';

    protected $appends = [
        'image',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const MARKED_SELECT = [
        'Marked'    => 'Marked',
        'Un-Marked' => 'Un-Marked',
    ];

    public const CONDITION_SELECT = [
        'Good' => 'Good',
        'Fair' => 'Fair',
        'Poor' => 'Poor',
    ];

    public const STYLE_SELECT = [
        'Sedan'      => 'Sedan',
        'SUV'        => 'SUV',
        'Bicycle'    => 'Bicycle',
        'Motorcycle' => 'Motorcycle',
        'Van'        => 'Van',
        'Truck'      => 'Truck',
        'Other'      => 'Other',
    ];

    protected $fillable = [
        'gtnn_number_id',
        'agency_vehicle_id',
        'year',
        'make',
        'model',
        'marked',
        'style',
        'condition',
        'plate_number',
        'vehicle_number',
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

    public function getImageAttribute()
    {
        $files = $this->getMedia('image');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function gtnn_number()
    {
        return $this->belongsTo(PublicOfficial::class, 'gtnn_number_id');
    }

    public function agency_vehicle()
    {
        return $this->belongsTo(AgenciesOffice::class, 'agency_vehicle_id');
    }
}
