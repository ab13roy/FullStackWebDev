<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoachTrack extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coach_track';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['coach_id','track_id'];

    public function getTrackDetail()
    {
        return $this->hasOne('App\Models\Track','id','track_id');
    }
}
