<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class ParentDetail
 * @package App\Models
 * @version July 2, 2018, 5:04 pm IST
 *
 * @property string email
 * @property string first_name
 * @property string last_name
 * @property string student_identity
 * @property string phone
 * @property string gender
 */
class ParentDetail extends Model
{

    public $table = 'users';
    


    public $fillable = [
        'email',
        'first_name',
        'last_name',
        'student_identity',
        'phone',
        'gender'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'email' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'student_identity' => 'string',
        'phone' => 'string',
        'gender' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
