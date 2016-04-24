<?php

namespace App\Repositories;

use App\Models\mahasiswa;
use InfyOm\Generator\Common\BaseRepository;

class mahasiswaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'alamat'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return mahasiswa::class;
    }
}
