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

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);

        $title = $faker->sentence(random_int(10, 15));

        $this->insert('topics', [
            'title' => $title,
            'slug' => slugify($title),
            'content' => $faker->paragraph(random_int(5, 10)),
            'user_id' => random_int(2, 5),
            'cat_id' => random_int(1, 7),
            'attachments' => ''
        ]);
    }
}