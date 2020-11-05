<?php

namespace Database\Factories\Anomaly\AddonsModule\Addon;

use Anomaly\AddonsModule\Addon\AddonModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddonModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AddonModel::class;

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
