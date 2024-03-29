<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class InternalInvestigation extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    protected $appends = [
        'file',
    ];

    public $table = 'internal_investigations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        'open'       => 'Open',
        'closed'     => 'Closed',
        'pendingrel' => 'Pending Release',
    ];

    protected $fillable = [
        'agency_id',
        'public_official_id',
        'narrative',
        'status',
        'entered_by_id',
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

    public function agency()
    {
        return $this->belongsTo(AgenciesOffice::class, 'agency_id');
    }

    public function public_official()
    {
        return $this->belongsTo(PublicOfficial::class, 'public_official_id');
    }

    public function getFileAttribute()
    {
        return $this->getMedia('file');
    }

    public function entered_by()
    {
        return $this->belongsTo(User::class, 'entered_by_id');
    }
}
