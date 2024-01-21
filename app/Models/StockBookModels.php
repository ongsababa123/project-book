<?php

namespace App\Models;

use CodeIgniter\Model;

class StockBookModels extends Model
{
    protected $table = 'stock_book_table';

    protected $primaryKey = 'id_stock';

    protected $allowedFields = ['id_book' , 'id_number_','description', 'status_stock'];

}
