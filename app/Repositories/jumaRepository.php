<?php

namespace App\Repositories;

use App\Models\juma;
use InfyOm\Generator\Common\BaseRepository;

class jumaRepository extends BaseRepository
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
        return juma::class;
    }
}
