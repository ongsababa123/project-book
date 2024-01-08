<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModels extends Model
{
    protected $table = 'book_table';

    protected $primaryKey = 'id_book';

    protected $allowedFields = ['name_book' , 'book_author' , 'details' , 'pic_book' , 'status_book' , 'price' , 'price_book' , 'category_id'];

    public function searchProducts($search, $perPage, $offset)
    {
        if ($search) {
            return $this->like('name_book', $search)->findAll($perPage, $offset);
        } else {
            return $this->findAll($perPage, $offset);
        }
    }

    public function countSearchResults($search)
    {
        if ($search) {
            return $this->like('name_book', $search)->countAllResults();
        } else {
            return $this->countAllResults();
        }
    }
}
