<?php

use Faker\Factory as Faker;
use App\Models\juma;
use App\Repositories\jumaRepository;

trait MakejumaTrait
{
    /**
     * Create fake instance of juma and save it in database
     *
     * @param array $jumaFields
     * @return juma
     */
    public function makejuma($jumaFields = [])
    {
        /** @var jumaRepository $jumaRepo */
        $jumaRepo = App::make(jumaRepository::class);
        $theme = $this->fakejumaData($jumaFields);
        return $jumaRepo->create($theme);
    }

    /**
     * Get fake instance of juma
     *
     * @param array $jumaFields
     * @return juma
     */
    public function fakejuma($jumaFields = [])
    {
        return new juma($this->fakejumaData($jumaFields));
    }

    /**
     * Get fake data of juma
     *
     * @param array $postFields
     * @return array
     */
    public function fakejumaData($jumaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $jumaFields);
    }
}
