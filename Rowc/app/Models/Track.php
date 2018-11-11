<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Track
 * @package App\Models
 * @version June 17, 2018, 11:09 am IST
 *
 * @property string title
 * @property string short_title
 * @property string description
 */
class Track extends Model
{

    public $table = 'tracks';
    


    public $fillable = [
        'title',
        'short_title',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'short_title' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'description' => 'required'
    ];

    
}
