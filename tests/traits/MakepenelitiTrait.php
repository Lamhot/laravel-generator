<?php

use Faker\Factory as Faker;
use App\Models\peneliti;
use App\Repositories\penelitiRepository;

trait MakepenelitiTrait
{
    /**
     * Create fake instance of peneliti and save it in database
     *
     * @param array $penelitiFields
     * @return peneliti
     */
    public function makepeneliti($penelitiFields = [])
    {
        /** @var penelitiRepository $penelitiRepo */
        $penelitiRepo = App::make(penelitiRepository::class);
        $theme = $this->fakepenelitiData($penelitiFields);
        return $penelitiRepo->create($theme);
    }

    /**
     * Get fake instance of peneliti
     *
     * @param array $penelitiFields
     * @return peneliti
     */
    public function fakepeneliti($penelitiFields = [])
    {
        return new peneliti($this->fakepenelitiData($penelitiFields));
    }

    /**
     * Get fake data of peneliti
     *
     * @param array $postFields
     * @return array
     */
    public function fakepenelitiData($penelitiFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $penelitiFields);
    }
}
