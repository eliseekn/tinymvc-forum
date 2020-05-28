<?php

namespace App\Database\Seeds;

use Faker\Factory;
use Framework\ORM\Seeder;

/**
 * CommentSeed
 * 
 * Insert new row
 */
class CommentSeed extends Seeder
{
    /**
     * insert row
     *
     * @return void
     */
    public function sow(): void
    {
        $faker = Factory::create('en_US');

        $this->insert('comments', [
            'content' => $faker->paragraph(1),
            'user_id' => random_int(1, 4),
            'topic_id' => random_int(1, 4),
            'votes' => random_int(1, 10),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(1),
            'user_id' => random_int(1, 4),
            'topic_id' => random_int(1, 4),
            'votes' => random_int(1, 10),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(1),
            'user_id' => random_int(1, 4),
            'topic_id' => random_int(1, 4),
            'votes' => random_int(1, 10),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(1),
            'user_id' => random_int(1, 4),
            'topic_id' => random_int(1, 4),
            'votes' => random_int(1, 10),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(1),
            'user_id' => random_int(1, 4),
            'topic_id' => random_int(1, 4),
            'votes' => random_int(1, 10),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(1),
            'user_id' => random_int(1, 4),
            'topic_id' => random_int(1, 4),
            'votes' => random_int(1, 10),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(1),
            'user_id' => random_int(1, 4),
            'topic_id' => random_int(1, 4),
            'votes' => random_int(1, 10),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(1),
            'user_id' => random_int(1, 4),
            'topic_id' => random_int(1, 4),
            'votes' => random_int(1, 10),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(1),
            'user_id' => random_int(1, 4),
            'topic_id' => random_int(1, 4),
            'votes' => random_int(1, 10),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(1),
            'user_id' => random_int(1, 4),
            'topic_id' => random_int(1, 4),
            'votes' => random_int(1, 10),
            'attachments' => ''
        ]);
    }
}