<?php

namespace App\Repositories;

use App\Models\peneliti;
use InfyOm\Generator\Common\BaseRepository;

class penelitiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return peneliti::class;
    }
}
