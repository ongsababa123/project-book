<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\HistoryModels;
use App\Models\BookModels;
use CodeIgniter\I18n\Time;

class HistoryCheck implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        $HistoryModels = new HistoryModels();
        $BookModels = new BookModels();
        $session = session();
        $data['data_History'] = $HistoryModels->findAll();
        $ses_data = [
            'check_his' => 0,
        ];
        $session->set($ses_data);
        foreach ($data['data_History'] as $key => $value) {
            $rental_date = Time::createFromFormat('Y-m-d', $value['rental_date'], 'Asia/Bangkok');
            $now = Time::now('Asia/Bangkok');

            if ($value['status_his'] === '1') {
                if ($now->equals($rental_date)) {
                    if (session()->get('id') === $value['id_user']) {
                        $ses_data = [
                            'message_his' => 'รายการสินค้าในประวัติการเช่ากำลังจะเกินกำหนด!!',
                            'check_his' => 1,
                        ];
                        $session->set($ses_data);
                    } else {
                        $ses_data = [
                            'check_his' => 0,
                        ];
                        $session->set($ses_data);
                    }
                } else if ($now > $rental_date) {
                    $HistoryModels->update($value['id_history'], ['status_his' => 0]);
                    $idUserArray = explode(',', $value['id_book']);
                    foreach ($idUserArray as $id) {
                        $BookModels->update($id, ['status_book' => 1]);
                    }
                    if (session()->get('id') === $value['id_user']) {
                        $ses_data = [
                            'message_his' => 'รายการสินค้าในประวัติการเช่าเกินกำหนด!!',
                            'check_his' => 1,
                        ];
                        $session->set($ses_data);
                    } else {
                        $ses_data = [
                            'check_his' => 0,
                        ];
                        $session->set($ses_data);
                    }
                }
            } else if ($value['status_his'] === '0') {
                if (session()->get('id') === $value['id_user']) {
                    $HistoryModels->delete($value['id_history']);
                    $ses_data = [
                        'message_his' => 'รายการสินค้าในประวัติการเช่าเกินกำหนด!!',
                        'check_his' => 1,
                    ];
                    $session->set($ses_data);
                } else {
                    $ses_data = [
                        'check_his' => 0,
                    ];
                    $session->set($ses_data);
                }
            } else {
                $ses_data = [
                    'check_his' => 0,
                ];
                $session->set($ses_data);
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // ไม่ต้องการทำอะไรเพิ่มเติมหลังจากการประมวลผลก่อน
    }

}
