<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewBookModels extends Model
{
    protected $table = 'review_book_table';

    protected $primaryKey = 'id_review_book';

    protected $allowedFields = ['id_book' , 'id_history' , 'id_user' , 'rating_value', 'comment' , 'date_time'];

}
