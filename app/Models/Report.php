<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'reports';

    protected $dates = [
        'report_date',
        'date_of_occurance',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'agency_id',
        'report_date',
        'report_number',
        'full_name',
        'date_of_occurance',
        'time',
        'location',
        'narrative',
        'official_number_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function agency()
    {
        return $this->belongsTo(AgenciesOffice::class, 'agency_id');
    }

    public function getReportDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setReportDateAttribute($value)
    {
        $this->attributes['report_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDateOfOccuranceAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfOccuranceAttribute($value)
    {
        $this->attributes['date_of_occurance'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function official_number()
    {
        return $this->belongsTo(PublicOfficial::class, 'official_number_id');
    }
}
