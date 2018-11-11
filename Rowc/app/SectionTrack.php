<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionTrack extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'section_track';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['section_id','track_id'];

    public function getTrackDetail()
    {
        return $this->hasOne('App\Models\Track','id','track_id');
    }
    public function getTrackCoachDetail()
    {
        return $this->hasOne('App\CoachTrack','track_id','track_id');
    }


}
