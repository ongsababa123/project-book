<?php

namespace App\Controllers;

use App\Models\UserModels;
use App\Models\ActivityModels;

// use App\Models\CategoryModels;

class ActivityController extends BaseController
{
    public function activity_index()
    {
        echo view('dashboard/layout/header');
        echo view('dashboard/activity_log');
    }

    public function get_data_table()
    {
        $UserModels = new UserModels();
        $ActivityModels = new ActivityModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        $type_activity = $this->request->getVar('type');
        $type_user = $this->request->getVar('user_type');
        $date_activity = $this->request->getVar('date_activity');

        $totalRecords = $ActivityModels;

        if ($type_user != 0) {
            $totalRecords = $totalRecords->where('type_user', $type_user);
        }

        if ($type_activity != 0) {
            $totalRecords = $totalRecords->where('type', $type_activity);
        }

        if ($date_activity != "") {
            $totalRecords = $totalRecords->where('date_activity', $date_activity);
        }

        if (!empty($searchValue)) {
            $ActivityModels->join('user_table', 'user_table.id_user = activity_log_table.id_user');
            $ActivityModels->groupStart();
            $ActivityModels->like('user_table.name', $searchValue);
            $ActivityModels->orLike('user_table.lastname', $searchValue);
            $ActivityModels->groupEnd();
        }

        $totalRecords = $totalRecords->countAllResults();

        $data = $ActivityModels;

        if ($type_user != 0) {
            $data = $data->where('type_user', $type_user);
        }

        if ($type_activity != 0) {
            $data = $data->where('type', $type_activity);
        }

        if ($date_activity != "") {
            $data = $data->where('date_activity', $date_activity);
        }
        if (!empty($searchValue)) {
            $ActivityModels->join('user_table', 'user_table.id_user = activity_log_table.id_user');
            $ActivityModels->groupStart();
            $ActivityModels->like('user_table.name', $searchValue);
            $ActivityModels->orLike('user_table.lastname', $searchValue);
            $ActivityModels->groupEnd();
        }
        $data = $data->orderBy('date_activity', 'DESC')
            ->orderBy('time_activites', 'DESC')
            ->findAll($limit, $start);

        $recordsFiltered = $totalRecords;
        foreach ($data as $key => $value) {
            $data_user = $UserModels->where('id_user', $value['id_user'])->find();
            $data[$key]['data_user'] = $data_user[0];
        }
        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'searchValue' => $searchValue,
        ];

        return $this->response->setJSON($response);
    }
}
