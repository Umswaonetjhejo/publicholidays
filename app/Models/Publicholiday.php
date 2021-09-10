<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicholiday extends Model
{
    use HasFactory;

    protected $fillable=[
        'id','day','month','year','dayOfWeek','text'
    ];

    /**
     * Get the route key for the model.
     *
     * @return integer
     */
    public function getRouteKeyName()
    {
        return 'id';
    }
}
