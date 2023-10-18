<?php

namespace Mansi\Analytics\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageActivity extends Model
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
        'clicked_element',		
        'timestamp',		
        'visited_page_id'
    ];
}
