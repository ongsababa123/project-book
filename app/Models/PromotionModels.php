<?php

namespace App\Models;

use CodeIgniter\Model;

class PromotionModels extends Model
{
    protected $table = 'promotion_table';

    protected $primaryKey = 'id_promotion';

    protected $allowedFields = ['details' , 'status', 'image_promotion'];

}
