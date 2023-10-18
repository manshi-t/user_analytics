<?php

namespace Mansi\Analytics\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    public function getConnectionName()
    {
        return config('analysis.analysis');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [	
        'session_id',	
        'ip_address',	
        'device_name',	
        'brand',	
        'model',	
        'os',	
        'browser',	
        'country',	
        'state',	
        'city'
    ];
}
