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
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);

        $this->insert('comments', [
            'content' => $faker->paragraph(random_int(1, 5)),
            'user_id' => random_int(2, 6),
            'topic_id' => random_int(1, 16),
            'votes' => random_int(1, 7),
            'attachments' => ''
        ]);
    }
}