<?php

namespace App\Models;

use CodeIgniter\Model;

class DayrentModels extends Model
{
    protected $table = 'day_rent_table';

    protected $primaryKey = 'id_day_rent';

    protected $allowedFields = ['day_rent'];

}
