<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attendence';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['track_id','student_id','hour','date','attendece_type'];

    public function getTrackDetail()
    {
        return $this->hasOne('App\Models\Track','id','track_id');
    }

}
