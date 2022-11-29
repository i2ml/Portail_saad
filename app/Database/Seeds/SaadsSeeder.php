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
            'id' => 2,
            'nom' => 'Nîmes centre',
        ];
        $this->db->table('secteur')->insert($secteur);
        $secteur = [
            'id' => 0,
            'nom' => 'Le Vigan',
        ];
        $this->db->table('secteur')->insert($secteur);
        $secteur = [
            'id' => 1,
            'nom' => 'Banane sur mer',
        ];
        $this->db->table('secteur')->insert($secteur);
        $secteur = [
            'id' => 3,
            'nom' => 'Ailleurs',
        ];
        $this->db->table('secteur')->insert($secteur);
        $saad = [
            'id' => 2,
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
        $saad = [
            'id' => 0,
            'nom' => 'Saad 2',
            'tel' => '69696dzdez96969',
            'mail' => 'saad1dzdze@saad1.fr',
            'site' => 'saaddzedze1.fr',
            'adresse' => 'pas la',
            'siret_siren' => 333893894893,
            'finess' => 3290903,
            'image' => 'img.png',
            'idCategorie' => 1,
        ];
        $this->db->table('saads')->insert($saad);
        $saad = [
            'id' => 1,
            'nom' => 'Saad 1',
            'tel' => '0555313822',
            'mail' => 'banane@saad1.fr',
            'site' => 'draftbot.com',
            'adresse' => 'au bord de la mer',
            'siret_siren' => 333893894893,
            'finess' => 3290903,
            'image' => 'img.png',
            'idCategorie' => 2,
        ];
        $this->db->table('saads')->insert($saad);
        $personne = [
            'nom' => 'gregoire',
            'prenom' => 'admin de test',
            'mail' => 'bonjour@mail.com',
            'motdepasse' => '$2y$10$769wC8oc5oKksX4kjOV9aOqArpNip0AI6cKmS9IQY3CUQoyOYyTZG', // 'test'
            'accountType' => 2,
        ];
        $this->db->table('personne')->insert($personne);
        $agir = [
            'idSaad' => 1,
            'idSecteur' => 1,
        ];
        $this->db->table('agir')->insert($agir);
        $agir = [
            'idSaad' => 0,
            'idSecteur' => 2,
        ];
        $this->db->table('agir')->insert($agir);
        $agir = [
            'idSaad' => 2,
            'idSecteur' => 3,
        ];
        $this->db->table('agir')->insert($agir);
        $codepostal = [
            'id' => '30000',
            'nom' => 'Nîmes',
            'idSecteur' => 1,
        ];
        $this->db->table('code_postal')->insert($codepostal);
        $listesaad = [
            'idSaad' => 1,
            'idPersonne' => 1,
            ];
        $this->db->table('saad_list')->insert($listesaad);
        $public = [
            'id' => 1,
            'nom' => 'PA',
        ];
        $this->db->table('public')->insert($public);
        $public = [
            'id' => 2,
            'nom' => 'PH',
        ];
        $this->db->table('public')->insert($public);
        $public = [
            'id' => 3,
            'nom' => 'Aidant',
        ];
        $this->db->table('public')->insert($public);
        $pathologie = [
            'id' => 1,
            'nom' => 'Cancer',
        ];
        $this->db->table('pathologie')->insert($pathologie);
        $pathologie = [
            'id' => 2,
            'nom' => 'Alzheimer',
        ];
        $this->db->table('pathologie')->insert($pathologie);
        $pathologie = [
            'id' => 3,
            'nom' => 'Troubles du comportement ',
        ];
        $this->db->table('pathologie')->insert($pathologie);
        $pathologie = [
            'id' => 4,
            'nom' => 'Parkinson',
        ];
        $this->db->table('pathologie')->insert($pathologie);
        $pathologie = [
            'id' => 5,
            'nom' => 'Accompagnement fin de vie ',
        ];
        $this->db->table('pathologie')->insert($pathologie);
        $pathologie = [
            'id' => 6,
            'nom' => 'Addictologie',
        ];
        $this->db->table('pathologie')->insert($pathologie);
        $pathologie = [
            'id' => 7,
            'nom' => 'Handicap psychique',
        ];
        $this->db->table('pathologie')->insert($pathologie);
        $cibler = [
            'idSaad' => 1,
            'idPublic' => 1,
        ];
        $this->db->table('cibler')->insert($cibler);
        $specialiser = [
            'idSaad' => 1,
            'idPathologie' => 1,
        ];
        $this->db->table('specialiser')->insert($specialiser);
    }
}
