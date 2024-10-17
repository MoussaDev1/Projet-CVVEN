<?php

namespace App\Models;
use CodeIgniter\Model;


class auth_model extends Model{
    protected $table = 'client';
    protected $allowedFields = ['nom_utilisateur', 'password', 'nom', 'prenom', 'telephone_client', 'adresse_client', 'adressemail_client', 'date_client'];

   
}
