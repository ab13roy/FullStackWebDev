<?php

namespace App\Repositories;

use App\Models\Track;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TrackRepository
 * @package App\Repositories
 * @version June 17, 2018, 11:09 am IST
 *
 * @method Track findWithoutFail($id, $columns = ['*'])
 * @method Track find($id, $columns = ['*'])
 * @method Track first($columns = ['*'])
*/
class TrackRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'short_title',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Track::class;
    }
}
