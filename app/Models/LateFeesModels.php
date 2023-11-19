<?php

namespace App\Models;

use CodeIgniter\Model;

class LateFeesModels extends Model
{
    protected $table = 'late_fees_table';

    protected $primaryKey = 'id_late_fees';

    protected $allowedFields = ['price_fees'];

}
