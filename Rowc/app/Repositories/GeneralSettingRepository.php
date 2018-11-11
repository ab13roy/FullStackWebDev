<?php

namespace App\Repositories;

use App\Models\GeneralSetting;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class GeneralSettingRepository
 * @package App\Repositories
 * @version February 9, 2018, 11:48 am UTC
 *
 * @method GeneralSetting findWithoutFail($id, $columns = ['*'])
 * @method GeneralSetting find($id, $columns = ['*'])
 * @method GeneralSetting first($columns = ['*'])
*/
class GeneralSettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'search_radius',
        'homepage_url',
        'homepage_url_type'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return GeneralSetting::class;
    }
}
