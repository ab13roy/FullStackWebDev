<?php

namespace App\Repositories;

use App\Models\EmailTemplate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EmailTemplateRepository
 * @package App\Repositories
 * @version February 7, 2018, 12:14 pm UTC
 *
 * @method EmailTemplate findWithoutFail($id, $columns = ['*'])
 * @method EmailTemplate find($id, $columns = ['*'])
 * @method EmailTemplate first($columns = ['*'])
*/
class EmailTemplateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'keyword',
        'subject',
        'content',
        'is_deleted'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EmailTemplate::class;
    }
}
