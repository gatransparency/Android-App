<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'reports';

    protected $dates = [
        'report_date',
        'date_of_occurance',
        'date_approved',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const REPORT_STATUS_SELECT = [
        'New'      => 'New',
        'Pending'  => 'Pending',
        'Approved' => 'Approved',
        'Denied'   => 'Denied',
        'Hold'     => 'Hold',
    ];

    public const RELEASE_SELECT = [
        'Public'         => 'Public',
        'Do Not Release' => 'Do Not Release',
        'Pending'        => 'Pending',
        'Review'         => 'Review',
        'Hold'           => 'Hold',
    ];

    protected $fillable = [
        'gtnn_number_id',
        'agency_id',
        'report_date',
        'report_number',
        'date_of_occurance',
        'full_name',
        'time',
        'location',
        'narrative',
        'report_status',
        'release',
        'admin_signature',
        'date_approved',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function gtnn_number()
    {
        return $this->belongsTo(PublicOfficial::class, 'gtnn_number_id');
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

    public function getDateApprovedAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateApprovedAttribute($value)
    {
        $this->attributes['date_approved'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
