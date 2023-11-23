<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModels extends Model
{
    protected $table = 'cart_book_table';

    protected $primaryKey = 'id_cart';

    protected $allowedFields = ['id_user' , 'id_book' , 'cart_date'];


}
