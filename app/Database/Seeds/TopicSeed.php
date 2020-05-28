<?php

namespace App\Database\Seeds;

use Faker\Factory;
use Framework\ORM\Seeder;

/**
 * TopicSeed
 * 
 * Insert new row
 */
class TopicSeed extends Seeder
{
    /**
     * insert row
     *
     * @return void
     */
    public function sow(): void
    {
        $faker = Factory::create('en_US');

        $title = $faker->sentence(random_int(6, 10));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(),
            'user_id' => random_int(1, 4),
            'cat_id' => random_int(1, 4),
            'state' => 'open',
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(6, 10));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(),
            'user_id' => random_int(1, 4),
            'cat_id' => random_int(1, 4),
            'state' => 'open',
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(6, 10));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(),
            'user_id' => random_int(1, 4),
            'cat_id' => random_int(1, 4),
            'state' => 'open',
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(6, 10));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(),
            'user_id' => random_int(1, 4),
            'cat_id' => random_int(1, 4),
            'state' => 'open',
            'attachments' => ''
        ]);
    }
}