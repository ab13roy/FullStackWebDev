<?php

namespace App\Repositories;

use App\Models\CoachDocument;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CoachDocumentRepository
 * @package App\Repositories
 * @version July 21, 2018, 7:42 pm IST
 *
 * @method CoachDocument findWithoutFail($id, $columns = ['*'])
 * @method CoachDocument find($id, $columns = ['*'])
 * @method CoachDocument first($columns = ['*'])
*/
class CoachDocumentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'coach_id',
        'document_type',
        'document_file'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CoachDocument::class;
    }
}
