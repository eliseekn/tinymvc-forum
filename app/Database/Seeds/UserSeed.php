<?php

namespace App\Database\Seeds;

use Framework\ORM\Seeder;

/**
 * UserSeed
 * 
 * Insert new row
 */
class UserSeed extends Seeder
{
    /**
     * insert row
     *
     * @return void
     */
    public function sow(): void
    {
        $this->insert('users', [
            'name' => 'N\'Guessan Kouadio Elisée',
            'email' => 'eliseekn@gmail.com',
            'password' => hash_string('moderator'),
            'role' => 'moderator',
            'gender' => 'male',
            'department' => 'Webmaster',
            'grade' => 'Développeur d\'applications'
        ]);

        $this->insert('users', [
            'name' => 'Beyllah Koffi Fortuné',
            'email' => 'bkfort@gmail.com',
            'password' => hash_string('user'),
            'role' => 'user',
            'gender' => 'male',
            'department' => 'Sciences Economiques et de Gestion',
            'grade' => 'Licence 3'
        ]);

        $this->insert('users', [
            'name' => 'Iri Aya Blanche',
            'email' => 'iri@gmail.com',
            'password' => hash_string('user'),
            'role' => 'user',
            'gender' => 'female',
            'department' => 'Protection de l\'Environnement et Gestion des Risques',
            'grade' => 'Master 1'
        ]);

        $this->insert('users', [
            'name' => 'Kouakou Laurelle',
            'email' => 'laurelle@gmail.com',
            'password' => hash_string('user'),
            'role' => 'user',
            'gender' => 'female',
            'department' => 'Tronc Commun Agroforesterie/Environnement',
            'grade' => 'Licence 1'
        ]);

        $this->insert('users', [
            'name' => 'N\'Guessan Amian Arsène',
            'email' => 'arsene@gmail.com',
            'password' => hash_string('user'),
            'role' => 'user',
            'gender' => 'male',
            'department' => 'Master 2',
            'grade' => 'Biodiversité et Gestion Durable des Ecosystèmes'
        ]);
    }
}