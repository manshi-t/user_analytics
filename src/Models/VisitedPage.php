<?php

namespace Mansi\Analytics\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitedPage extends Model
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
        'page_url',
        'time_spent',
        'session_id'
    ];
}
