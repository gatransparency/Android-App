<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChangeLog extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'change_logs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'portal_version_id',
        'change',
        'log',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CHANGE_SELECT = [
        'Update'   => 'Update',
        'Bug Fix'  => 'Bug Fix',
        'Addition' => 'Addition',
        'Removal'  => 'Removal',
        'Multiple' => 'Multiple',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function portal_version()
    {
        return $this->belongsTo(PortalVersion::class, 'portal_version_id');
    }
}
