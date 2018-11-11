<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Coach
 * @package App\Models
 * @version June 17, 2018, 11:18 am IST
 *
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string password
 * @property string retype_password
 * @property string phone
 * @property string gender
 * @property string language
 */
class Coach extends Model
{

    public $table = 'admins';
    


    public $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'phone',
        'gender',
        'language',
        'is_admin'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'last_name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'phone' => 'string',
        'gender' => 'string',
        'language' => 'string',
        'is_admin' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'first_name' => 'required',
//        'last_name' => 'required',
//        'email' => 'required',
//        'password' => 'required',
//        'retype_password' => 'required',
//        'phone' => 'required',
//        'gender' => 'required',
//        'language' => 'required'
    ];

    
}
