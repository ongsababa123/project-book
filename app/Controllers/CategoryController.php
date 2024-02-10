<?php

namespace App\Controllers;

use App\Models\CategoryModels;

class CategoryController extends BaseController
{
    public function index()
    {
        echo view('dashboard/layout/header');
        echo view('dashboard/category');
    }

    public function create_category()
    {
        helper(['form']);

        $CategoryModels = new CategoryModels();

        // Validation rules
        $rules = [
            'name_category' => 'is_unique[category_table.name_category]',
        ];

        if (!$this->validate($rules)) {
            $response = [
                'success' => false,
                'message' => 'ผิดพลาด',
                'validator' => $this->validator->getErrors(), // Get validation errors
                'reload' => false,
            ];
        } else {
            // Validated successfully, proceed to save
            $data = [
                'name_category' => $this->request->getVar('name_category'),
                'details' => $this->request->getVar('detail_category'),
                'status' => 1,
            ];

            $check = $CategoryModels->save($data);
            if ($check) {
                $response = [
                    'success' => true,
                    'message' => 'สร้างข้อมูลสำเร็จ',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Error saving data to the database',
                    'reload' => false,
                ];
            }
        }

        return $this->response->setJSON($response);
    }


    public function edit_category($id_category = null)
    {
        helper(['form']);
        $CategoryModels = new CategoryModels();
        $rules = [
            'name_category' => 'is_unique[category_table.name_category,id_category,' . $id_category . ']',
            'detail_category' => 'is_unique[category_table.details,id_category,' . $id_category . ']',
        ];
        if (!$this->validate($rules)) {
            $response = [
                'success' => false,
                'message' => 'ผิดพลาด',
                'validator' => $this->validator->getErrors(), // Get validation errors
                'reload' => false,
            ];
        } else {
            $status = $this->request->getVar('customSwitch3');
            if ($status === 'on') {
                $status = 1;
            } else {
                $status = 0;
            }
            $data = [
                'name_category' => $this->request->getVar('name_category'),
                'details' => $this->request->getVar('detail_category'),
                'status' => $status
            ];

            $check = $CategoryModels->update($id_category, $data);
            if ($check) {
                $response = [
                    'success' => true,
                    'message' => 'อัพเดทข้อมูลสำเร็จ',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'error',
                    'reload' => false,
                ];
            }
        }

        return $this->response->setJSON($response);
    }

    public function delete_category($id_category = null)
    {
        helper(['form']);
        $CategoryModels = new CategoryModels();

        $check = $CategoryModels->where('id_category', $id_category)->delete($id_category);
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
    public function get_data_table()
    {
        $CategoryModels = new CategoryModels();
        $totalRecords = $CategoryModels->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $recordsFiltered = $totalRecords;
        $recordsFiltered = $totalRecords;

        $data = $CategoryModels->findAll($limit, $start);

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }
}
