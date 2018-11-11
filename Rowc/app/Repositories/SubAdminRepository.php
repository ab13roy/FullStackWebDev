<?php

namespace App\Repositories;

use App\Models\SubAdmin;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SubAdminRepository
 * @package App\Repositories
 * @version February 9, 2018, 4:17 am UTC
 *
 * @method SubAdmin findWithoutFail($id, $columns = ['*'])
 * @method SubAdmin find($id, $columns = ['*'])
 * @method SubAdmin first($columns = ['*'])
*/
class SubAdminRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'role_id',
        'status',
        'profile'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SubAdmin::class;
    }
}
