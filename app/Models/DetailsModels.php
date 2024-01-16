<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailsModels extends Model
{
    protected $table = 'details_table';

    protected $primaryKey = 'id_details';

    protected $allowedFields = ['text_details'];

}
