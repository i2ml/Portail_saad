<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SaadsSeeder extends Seeder
{
    public function run()
    {
        $categorie = [
            'id' => 1,
            'nom' => 'CPOM1',
            'tarif' => 8,
        ];
        $this->db->table('categorie')->insert($categorie);
        $categorie = [
            'id' => 2,
            'nom' => 'CPOM2',
            'tarif' => 4,
        ];
        $this->db->table('categorie')->insert($categorie);
        $categorie = [
            'id' => 3,
            'nom' => 'Hors CPOM',
            'tarif' => 2,
        ];
        $this->db->table('categorie')->insert($categorie);
        $secteur = [
            'nom' => 'Nîmes centre',
        ];
        $this->db->table('secteur')->insert($secteur);
        $saad = [
            'nom' => 'Saad 1',
            'tel' => '6969696969',
            'mail' => 'saad1@saad1.fr',
            'site' => 'saad1.fr',
            'adresse' => '21B rue robert 30000 Nîmes',
            'siret_siren' => 333893894893,
            'finess' => 3290903,
            'image' => 'img.png',
            'idCategorie' => 1,
        ];
        $this->db->table('saads')->insert($saad);
        $personne = [
            'nom' => 'gregoire',
            'prenom' => 'ballade dure',
            'mail' => 'bonjour@mail.com',
            'motdepasse' => '123456789',
            'idSaad' => 1,
        ];
        $this->db->table('personne')->insert($personne);
        $agir = [
            'idSaad' => 1,
            'idSecteur' => 1,
        ];
        $this->db->table('agir')->insert($agir);
        $codepostal = [
            'id' => '30000',
            'nom' => 'Nîmes',
            'idSecteur' => 1,
        ];
        $this->db->table('code_postal')->insert($codepostal);
    }
}
