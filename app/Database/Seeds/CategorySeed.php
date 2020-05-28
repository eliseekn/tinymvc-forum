<?php

namespace App\Database\Seeds;

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
        $this->insert('categories', [
            'name' => 'Microéconomie et Macroéconomie',
            'slug' => slugify('Microéconomie et Macroéconomie')
        ]);

        $this->insert('categories', [
            'name' => 'Déchets toxiques',
            'slug' => slugify('Déchets toxiques')
        ]);

        $this->insert('categories', [
            'name' => 'Droits de l\'homme',
            'slug' => slugify('Droits de l\'homme')
        ]);

        $this->insert('categories', [
            'name' => 'Covid-19',
            'slug' => slugify('Covid-19')
        ]);
    }
}