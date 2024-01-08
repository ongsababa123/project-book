<?php

namespace App\Controllers;

use App\Models\CategoryModels;
use App\Models\BookModels;

class BookController extends BaseController
{
    protected $helpers = ['form'];
    public function index()
    {
        $CategoryModels = new CategoryModels();
        $BookModels = new BookModels();
        $data['bookData'] = $BookModels->findAll();
        $data['categoryData'] = $CategoryModels->findAll();

        echo view('dashboard/layout/header');
        echo view('dashboard/book', $data);
    }

    public function create_book()
    {
        $BookModels = new BookModels();
        $profile_picture = $this->request->getFile('uploadImage');
        $data = [
            'name_book' => $this->request->getVar('name_book'),
            'book_author' => $this->request->getVar('name_book_author'),
            'details' => $this->request->getVar('detail_category'),
            'status_book' => 0,
            'price' => $this->request->getVar('price_book'),
            'price_book' => $this->request->getVar('price_book_book'),
            'category_id' => $this->request->getVar('categorySelect'),
        ];
        if ($profile_picture->isValid() && !$profile_picture->hasMoved()) {
            $validationRules = [
                'uploadImage' => 'max_size[uploadImage,10240]', // 10MB in kilobytes
            ];
            // Validate the input
            if (!$this->validate($validationRules)) {
                $response = [
                    'success' => false,
                    'message' => 'ผิดพลาด',
                    'reload' => false,
                    'image_error' => 'ไฟล์จะต้องมีขนาดต่ำกว่า 10MB'
                ];
                return $this->response->setJSON($response);
            }
            $minFileSize = 1024; // 1MB in kilobytes
            if ($profile_picture->getSize() >= $minFileSize) {
                if ($profile_picture->isValid() && !$profile_picture->hasMoved()) {
                    $imageData = file_get_contents($profile_picture->getTempName()); // Read image file data
                    $base64ImageData = base64_encode($imageData);
                    $data['pic_book'] = $base64ImageData;
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'ผิดพลาด',
                    'reload' => false,
                    'image_error' => 'ไฟล์จะต้องมีขนาดอย่างน้อย 1MB'
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $BookModels->save($data);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'สร้างข้อมูลสำเร็จ',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'error',
                'reload' => false,
            ];
        }


        return $this->response->setJSON($response);
    }

    public function edit_book($id_book = null)
    {
        $BookModels = new BookModels();
        $profile_picture = $this->request->getFile('uploadImage');
        $status = $this->request->getVar('customSwitch3') === 'on' ? 1 : 0;
        $data = [
            'name_book' => $this->request->getVar('name_book'),
            'book_author' => $this->request->getVar('name_book_author'),
            'details' => $this->request->getVar('detail_category'),
            'status_book' => $status,
            'price' => $this->request->getVar('price_book'),
            'price_book' => $this->request->getVar('price_book_book'),
            'category_id' => $this->request->getVar('categorySelect'),
        ];
        if ($profile_picture->isValid() && !$profile_picture->hasMoved()) {
            $validationRules = [
                'uploadImage' => 'max_size[uploadImage,10240]', // 10MB in kilobytes
            ];
            // Validate the input
            if (!$this->validate($validationRules)) {
                $response = [
                    'success' => false,
                    'message' => 'ผิดพลาด',
                    'reload' => false,
                    'image_error' => 'ไฟล์จะต้องมีขนาดต่ำกว่า 10MB'
                ];
                return $this->response->setJSON($response);
            }
            $minFileSize = 1024; // 1MB in kilobytes
            if ($profile_picture->getSize() >= $minFileSize) {
                if ($profile_picture->isValid() && !$profile_picture->hasMoved()) {
                    $imageData = file_get_contents($profile_picture->getTempName()); // Read image file data
                    $base64ImageData = base64_encode($imageData);
                    $data['pic_book'] = $base64ImageData;
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'ผิดพลาด',
                    'reload' => false,
                    'image_error' => 'ไฟล์จะต้องมีขนาดอย่างน้อย 1MB'
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $BookModels->update($id_book, $data);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'อัปเดตข้อมูลสำเร็จ',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'error',
                'reload' => false,
            ];
        }


        return $this->response->setJSON($response);
    }

    public function delete_book($id_book = null)
    {
        helper(['form']);
        $BookModels = new BookModels();

        $check = $BookModels->where('id_book', $id_book)->delete($id_book);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'ลบข้อมูลสำเร็จ!',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'error!',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }
}
