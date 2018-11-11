<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class SubAdmin
 * @package App\Models
 * @version February 9, 2018, 4:17 am UTC
 *
 * @property string name
 * @property string email
 * @property string password
 * @property string role_id
 * @property integer status
 * @property string profile
 */
class SubAdmin extends Model
{

    public $table = 'admins';
    


    public $fillable = [
        'name',
        'last_name',
        'phone',
        'email',
        'password',
        'phone',
        'gender',
        'profile'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'last_name' => 'string',
        'phone' => 'string',
        'email' => 'string',
        'password' => 'string',
        'gender' => 'string',
        'language' => 'string',
        'profile' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'name' => 'required',
//        'email' => 'required',
//        'password' => 'required',
//        'role_id' => 'required',
//        'status' => 'required'
    ];
//    public function getRoleDetail()
//    {
//        return $this->hasOne('App\Models\RoleManagement','role_id','id');
//    }

    
}
