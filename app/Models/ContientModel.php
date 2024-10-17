<?php

namespace App\Models;
use CodeIgniter\Model;

class ContientModel extends Model{
    protected $table = 'contient';
    protected $allowedFields = ['id_reservation', 'id_prestation'];
}

?>