<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class GeneralSetting
 * @package App\Models
 * @version February 9, 2018, 11:48 am UTC
 *
 * @property string search_radius
 * @property string homepage_url
 * @property integer homepage_url_type
 */
class GeneralSetting extends Model
{

    public $table = 'general_settings';
    


    public $fillable = [
        'search_radius',
        'homepage_url',
        'homepage_url_type',
        'setting_key',
        'value',
        'comments',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'search_radius' => 'string',
        'homepage_url' => 'string',
        'homepage_url_type' => 'integer',
        'facebook_link' => 'string',
        'twitter_link' => 'string',
        'instagram_link' => 'string',
        'instagram_link' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    
}
