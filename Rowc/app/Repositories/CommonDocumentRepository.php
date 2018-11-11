<?php

namespace App\Repositories;

use App\Models\CommonDocument;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CommonDocumentRepository
 * @package App\Repositories
 * @version July 9, 2018, 10:40 pm IST
 *
 * @method CommonDocument findWithoutFail($id, $columns = ['*'])
 * @method CommonDocument find($id, $columns = ['*'])
 * @method CommonDocument first($columns = ['*'])
*/
class CommonDocumentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'common_file'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CommonDocument::class;
    }
}
