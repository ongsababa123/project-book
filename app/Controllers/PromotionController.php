<?php

namespace App\Controllers;

use App\Models\PromotionModels;
use App\Models\HistoryModels;
use App\Models\BookModels;
use App\Models\CategoryModels;

class PromotionController extends BaseController
{
    public function index()
    {
        $BookModels = new BookModels();
        $CategoryModels = new CategoryModels();
        $data['book'] = $BookModels->findAll();
        $data['category'] = $CategoryModels->findAll();

        echo view('dashboard/layout/header');
        echo view('dashboard/promotion', $data);
    }

    public function edit_promotion($id_promotion = null)
    {
        $PromotionModels = new PromotionModels();
        $profile_picture = $this->request->getFile('uploadImage');
        $data = [
            'details' => $this->request->getVar('detail_promotion'),
            'type_promotion' => $this->request->getVar('type_promotion'),
            'id_book_cat' => $this->request->getVar('id_book_cat'),
            'number_cal' => $this->request->getVar('number_cal'),
            'type_sale' => $this->request->getVar('type_sale'),
            'date_end' => $this->request->getVar('end_date_promotion'),
            'status' => $this->request->getVar('status_promotion'),
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
                    $data['image_promotion'] = $base64ImageData;
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
        $check = $PromotionModels->update($id_promotion, $data);
        if ($check) {
            $response = [
                'success' => true,
                'message' => 'แก้ไขข้อมูลสำเร็จ',
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

    public function get_data_table()
    {
        $PromotionModels = new PromotionModels();
        $totalRecords = $PromotionModels->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $recordsFiltered = $totalRecords;
        $recordsFiltered = $totalRecords;

        $data = $PromotionModels->findAll($limit, $start);

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }

    public function cal_promotion()
    {
        $promotionModels = new PromotionModels();
        $data['promotion'] = $promotionModels->findAll();
    
        $historyModels = new HistoryModels();
        $id_user = $this->request->getVar('id_user');
        $sum_id_book = $this->request->getVar('sum_id_book');
        $sum_price = $this->request->getVar('sum_price');
        $sum_id_book_array = explode(',', $sum_id_book);
        $text = null;
        $sumid_promotion = null;
        $price_promotion = 0;
    
        $countHis = $historyModels->where('id_user', $id_user)->countAllResults();
    
        if (count($sum_id_book_array) >= 3) {
            if ($data['promotion'][0]['status'] == '1') {
                // $sum_price -= 10;
                $text .= $data['promotion'][0]['details'] . '<br>';
                $sumid_promotion .= $data['promotion'][0]['id_promotion']. ',';
                $price_promotion += 10;
            }
        }
    
        if ($countHis >= 3) {
            if ($data['promotion'][1]['status'] == '1') {
                // $sum_price -= 20;
                $text .= $data['promotion'][1]['details'] . '<br>';
                $sumid_promotion .= $data['promotion'][1]['id_promotion'];
                $price_promotion += 20;
            }
        }

        $response = [
            'price_result' => $sum_price,
            'price_promotion' => $price_promotion,
            'sumid_promotion' => $sumid_promotion,
            'text' => $text,
        ];
    
        return $this->response->setJSON($response);
    }

    public function create_promotion()
    {
        $PromotionModels = new PromotionModels();
        $profile_picture = $this->request->getFile('uploadImage');
        $data = [
            'details' => $this->request->getVar('detail_promotion'),
            'type_promotion' => $this->request->getVar('type_promotion'),
            'id_book_cat' => $this->request->getVar('id_book_cat'),
            'number_cal' => $this->request->getVar('number_cal'),
            'type_sale' => $this->request->getVar('type_sale'),
            'date_end' => $this->request->getVar('end_date_promotion'),
            'status' => 1,
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
                    $data['image_promotion'] = $base64ImageData;
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
        $check = $PromotionModels->save($data);
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
    
}
