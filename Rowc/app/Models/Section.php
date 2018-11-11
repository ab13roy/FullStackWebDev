<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Section
 * @package App\Models
 * @version June 17, 2018, 10:50 am IST
 *
 * @property string name
 * @property date start_date
 * @property date end_date
 * @property string location
 */
class Section extends Model
{

    public $table = 'sections';
    


    public $fillable = [
        'name',
        'start_date',
        'end_date',
        'location'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
        'location' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'location' => 'required'
    ];

    
}
