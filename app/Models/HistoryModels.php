<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModels extends Model
{
    protected $table = 'history_book_table';

    protected $primaryKey = 'id_history';

    protected $allowedFields = ['id_user' , 'id_book' , 'id_stock_book', 'rental_date', 'return_date', 'submit_date', 'sum_rental_price', 'sum_deposit_price', 'sum_late_price', 'sum_price_promotion', 'id_promotion', 'status_his' ];

}
