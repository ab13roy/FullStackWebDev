<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class CommonDocument
 * @package App\Models
 * @version July 9, 2018, 10:40 pm IST
 *
 * @property string title
 * @property string common_file
 */
class CommonDocument extends Model
{

    public $table = 'common_documents';
    


    public $fillable = [
        'title',
        'document_type',
        'common_file'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'document_type' => 'string',
        'common_file' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'document_type' => 'required'
    ];

    
}
