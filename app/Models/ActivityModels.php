<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModels extends Model
{
    protected $table = 'activity_log_table';

    protected $primaryKey = 'id_activity';

    protected $allowedFields = ['id_user' , 'type_user' , 'type' , 'date_activity', 'time_activites'];

}
