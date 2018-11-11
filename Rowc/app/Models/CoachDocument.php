<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class CoachDocument
 * @package App\Models
 * @version July 21, 2018, 7:42 pm IST
 *
 * @property integer coach_id
 * @property string document_type
 * @property string document_file
 */
class CoachDocument extends Model
{

    public $table = 'coach_documents';
    


    public $fillable = [
        'coach_id',
        'document_type',
        'document_file'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'coach_id' => 'integer',
        'document_type' => 'string',
        'document_file' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'document_type' => 'required'
    ];

    
}
