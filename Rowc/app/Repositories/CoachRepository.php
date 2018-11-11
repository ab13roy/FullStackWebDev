<?php

namespace App\Repositories;

use App\Models\Coach;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CoachRepository
 * @package App\Repositories
 * @version June 17, 2018, 11:18 am IST
 *
 * @method Coach findWithoutFail($id, $columns = ['*'])
 * @method Coach find($id, $columns = ['*'])
 * @method Coach first($columns = ['*'])
*/
class CoachRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'retype_password',
        'phone',
        'gender',
        'language'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Coach::class;
    }
}
