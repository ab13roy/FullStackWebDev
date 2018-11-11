<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class EmailTemplate
 * @package App\Models
 * @version February 7, 2018, 12:14 pm UTC
 *
 * @property string keyword
 * @property string subject
 * @property string content
 * @property integer is_deleted
 */
class EmailTemplate extends Model
{

    public $table = 'email_templates';
    


    public $fillable = [
        'keyword',
        'subject',
        'content',
        'is_deleted'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'keyword' => 'string',
        'subject' => 'string',
        'content' => 'string',
        'is_deleted' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    
}
