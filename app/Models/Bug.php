<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bug extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'bugs';

    protected $dates = [
        'fixed',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'version_id',
        'title',
        'status',
        'synopsis',
        'fixed',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function version()
    {
        return $this->belongsTo(PortalVersion::class, 'version_id');
    }

    public function getFixedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFixedAttribute($value)
    {
        $this->attributes['fixed'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
