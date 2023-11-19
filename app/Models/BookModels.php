<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModels extends Model
{
    protected $table = 'book_table';

    protected $primaryKey = 'id_book';

    protected $allowedFields = ['name_book' , 'book_author' , 'details' , 'pic_book' , 'status_book' , 'price' , 'category_id'];

}
