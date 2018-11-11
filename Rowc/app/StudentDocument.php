<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDocument extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_document';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id','document_type','document_file'];


}
