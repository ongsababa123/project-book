<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModels extends Model
{
    protected $table = 'category_table';

    protected $primaryKey = 'id_category';

    protected $allowedFields = ['name_category' , 'details' , 'status'];

}
