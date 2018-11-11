<?php

namespace App\Repositories;

use App\Models\Section;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SectionRepository
 * @package App\Repositories
 * @version June 17, 2018, 10:50 am IST
 *
 * @method Section findWithoutFail($id, $columns = ['*'])
 * @method Section find($id, $columns = ['*'])
 * @method Section first($columns = ['*'])
*/
class SectionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'start_date',
        'end_date',
        'location'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Section::class;
    }
}
