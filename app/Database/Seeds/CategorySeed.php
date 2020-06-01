<?php

namespace App\Database\Seeds;

use Faker\Factory;
use Framework\ORM\Seeder;

/**
 * CategorySeed
 * 
 * Insert new row
 */
class CategorySeed extends Seeder
{
    /**
     * insert row
     *
     * @return void
     */
    public function sow(): void
    {
        $faker = Factory::create('en_US');

        $this->insert('categories', [
            'name' => 'Technologies de l\'information et de la communication',
            'slug' => slugify('Technologies de l\'information et de la communication'),
            'description' => $faker->sentence(random_int(10, 20))
        ]);

        $this->insert('categories', [
            'name' => 'Environnement et biodiversité',
            'slug' => slugify('Environnement et biodiversité'),
            'description' => $faker->sentence(random_int(10, 20))
        ]);

        $this->insert('categories', [
            'name' => 'Droits de l\'homme et droit international',
            'slug' => slugify('Droits de l\'homme et international'),
            'description' => $faker->sentence(random_int(10, 20))
        ]);

        $this->insert('categories', [
            'name' => 'Droits des affaires',
            'slug' => slugify('Droits des affaires'),
            'description' => $faker->sentence(random_int(10, 20))
        ]);

        $this->insert('categories', [
            'name' => 'Micro et macroéconomie',
            'slug' => slugify('Micro et macroéconomie'),
            'description' => $faker->sentence(random_int(10, 20))
        ]);

        $this->insert('categories', [
            'name' => 'Comptabilité générale',
            'slug' => slugify('Comptabilité générale'),
            'description' => $faker->sentence(random_int(10, 20))
        ]);

        $this->insert('categories', [
            'name' => 'Nutrition et alimentation',
            'slug' => slugify('Nutrition et alimentation'),
            'description' => $faker->sentence(random_int(10, 20))
        ]);
    }
}