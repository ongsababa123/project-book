<?php

namespace App\Models;

use CodeIgniter\Model;

class PromotionModels extends Model
{
    protected $table = 'promotion_table';

    protected $primaryKey = 'id_promotion';

    protected $allowedFields = ['details' ,'type_promotion', 'id_book_cat', 'number_cal', 'type_sale', 'date_end', 'status', 'image_promotion'];

}
