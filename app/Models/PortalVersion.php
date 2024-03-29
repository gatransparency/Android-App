<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PortalVersion extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'portal_versions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'portal_version',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function versionBugs()
    {
        return $this->hasMany(Bug::class, 'version_id', 'id');
    }

    public function portalVersionChangeLogs()
    {
        return $this->hasMany(ChangeLog::class, 'portal_version_id', 'id');
    }
}
