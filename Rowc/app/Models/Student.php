<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Student
 * @package App\Models
 * @version June 17, 2018, 11:29 am IST
 *
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string phone
 * @property string gender
 * @property string school_id
 */
class Student extends Model
{

    public $table = 'students';
    


    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'gender',
        'unique_identity',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'gender' => 'string',
        'unique_identity' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'gender' => 'required'
    ];

    
}
