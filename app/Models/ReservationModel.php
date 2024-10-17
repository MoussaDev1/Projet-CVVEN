<?php

namespace App\Models;
use CodeIgniter\Model;

class ReservationModel extends Model{
    protected $table = 'reservation';
    protected $allowedFields = ['id', 'date_debut', 'date_fin', 'Prix_Reservation', 'id_client', 'id_logement', 'validation_reservation'];
}

?>