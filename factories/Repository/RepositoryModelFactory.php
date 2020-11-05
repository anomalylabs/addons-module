<?php

namespace Database\Factories\Anomaly\AddonsModule\Addon;

use Anomaly\AddonsModule\Repository\RepositoryModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepositoryModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RepositoryModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [];
    }
}
