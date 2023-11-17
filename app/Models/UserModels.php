<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModels extends Model
{
    protected $table = 'user_table';

    protected $primaryKey = 'id_user';

    protected $allowedFields = ['email_user' , 'name' , 'lastname' , 'phone' , 'password' , 'key_pass' , 'status_user' , 'type_user'];

}
