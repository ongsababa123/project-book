<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModels extends Model
{
    protected $table = 'history_book_table';

    protected $primaryKey = 'id_history';

    protected $allowedFields = ['id_user' , 'id_book' , 'rental_date' , 'return_date' , 'submit_date' , 'sum_price'];

}
