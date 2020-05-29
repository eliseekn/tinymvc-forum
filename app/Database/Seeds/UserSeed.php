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
            'password' => hash_string('Modérateur'),
            'role' => 'Modérateur',
            'gender' => 'Masculin',
            'department' => 'Webmaster',
            'grade' => 'Développeur d\'applications'
        ]);

        $this->insert('users', [
            'name' => 'Beyllah Koffi Fortuné',
            'email' => 'bkfort@gmail.com',
            'password' => hash_string('Utilisateur'),
            'gender' => 'Masculin',
            'department' => 'Sciences Economiques et de Gestion',
            'grade' => '3e année'
        ]);

        $this->insert('users', [
            'name' => 'Iri Aya Blanche',
            'email' => 'iri@gmail.com',
            'password' => hash_string('Utilisateur'),
            'gender' => 'Féminin',
            'department' => 'Protection de l\'Environnement et Gestion des Risques',
            'grade' => '1ère année'
        ]);

        $this->insert('users', [
            'name' => 'Kouakou Laurelle',
            'email' => 'laurelle@gmail.com',
            'password' => hash_string('Utilisateur'),
            'gender' => 'Féminin',
            'department' => 'Tronc Commun Agroforesterie/Environnement',
            'grade' => '1ère année'
        ]);

        $this->insert('users', [
            'name' => 'N\'Guessan Amian Arsène',
            'email' => 'arsene@gmail.com',
            'password' => hash_string('Utilisateur'),
            'gender' => 'Masculin',
            'department' => 'Biodiversité et Gestion Durable des Ecosystèmes',
            'grade' => '5e année'
        ]);
    }
}