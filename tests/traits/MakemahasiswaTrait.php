<?php

use Faker\Factory as Faker;
use App\Models\mahasiswa;
use App\Repositories\mahasiswaRepository;

trait MakemahasiswaTrait
{
    /**
     * Create fake instance of mahasiswa and save it in database
     *
     * @param array $mahasiswaFields
     * @return mahasiswa
     */
    public function makemahasiswa($mahasiswaFields = [])
    {
        /** @var mahasiswaRepository $mahasiswaRepo */
        $mahasiswaRepo = App::make(mahasiswaRepository::class);
        $theme = $this->fakemahasiswaData($mahasiswaFields);
        return $mahasiswaRepo->create($theme);
    }

    /**
     * Get fake instance of mahasiswa
     *
     * @param array $mahasiswaFields
     * @return mahasiswa
     */
    public function fakemahasiswa($mahasiswaFields = [])
    {
        return new mahasiswa($this->fakemahasiswaData($mahasiswaFields));
    }

    /**
     * Get fake data of mahasiswa
     *
     * @param array $postFields
     * @return array
     */
    public function fakemahasiswaData($mahasiswaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'alamat' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $mahasiswaFields);
    }
}
