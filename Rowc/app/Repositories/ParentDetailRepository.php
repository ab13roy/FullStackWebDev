<?php

namespace App\Repositories;

use App\Models\ParentDetail;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ParentDetailRepository
 * @package App\Repositories
 * @version July 2, 2018, 5:04 pm IST
 *
 * @method ParentDetail findWithoutFail($id, $columns = ['*'])
 * @method ParentDetail find($id, $columns = ['*'])
 * @method ParentDetail first($columns = ['*'])
*/
class ParentDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'first_name',
        'last_name',
        'student_identity',
        'phone',
        'gender'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ParentDetail::class;
    }
}
