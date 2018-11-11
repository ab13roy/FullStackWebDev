<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTrack extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'student_track';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['track_id','student_id'];

    public function getStudentDetail()
    {
        return $this->hasOne('App\Models\Student','id','student_id');
    }
    public function getTrackDetail()
    {
        return $this->hasOne('App\Models\Track','id','track_id');
    }
}
