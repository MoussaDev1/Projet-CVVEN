<?php

namespace App\Models;
use CodeIgniter\Model;

class LogementModel extends Model{
    protected $table = 'logement';
    protected $allowedFields = ['id', 'lieu', 'prix_logement', 'taille_logement', 'type_logement'];
}

?>