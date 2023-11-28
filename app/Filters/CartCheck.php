<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\CartModels;
use App\Models\BookModels;
use CodeIgniter\I18n\Time;

class CartCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $CartModels = new CartModels();
        $BookModels = new BookModels();
        date_default_timezone_set('Asia/Bangkok');
        $session = session();

        $data['data_Cart'] = $CartModels->findAll();
        $ses_data = [
            'check' => 0,
        ];
        $session->set($ses_data);
        foreach ($data['data_Cart'] as $key => $value) {
            $cartDateTime = Time::createFromFormat('Y-m-d H:i:s', $value['cart_date'], 'Asia/Bangkok');
            $now = Time::now('Asia/Bangkok');

            $diffInHours = ($now->getTimestamp() - $cartDateTime->getTimestamp()) / 3600; // หาความต่างเป็นชั่วโมง
            if ($value['status_cart'] === '1') {
                if ($diffInHours >= 23 && $diffInHours < 24) {
                    if (session()->get('id') === $value['id_user']) {
                        $ses_data = [
                            'message_cart' => 'รายการสินค้าในตระกร้าของคุณกำลังหมดอายุ!!',
                            'check' => 1,
                        ];
                        $session->set($ses_data);
                    }
                } else {
                    $ses_data = [
                        'check' => 0,
                    ];
                    $session->set($ses_data);
                }

                if ($diffInHours >= 24) {
                    $CartModels->update($value['id_cart'], ['status_cart' => 0]);
                    $BookModels->update($value['id_book'], ['status_book' => 1]);
                    if (session()->get('id') === $value['id_user']) {
                        $ses_data = [
                            'message_cart' => 'รายการสินค้าในตระกร้าของคุณหมดอายุ!!',
                            'check' => 1,
                        ];
                        $session->set($ses_data);
                    }
                }
            } else {
                if (session()->get('id') === $value['id_user']) {
                    $ses_data = [
                        'message_cart' => 'รายการสินค้าในตระกร้าของคุณหมดอายุ!!',
                        'check' => 1,
                    ];
                    $session->set($ses_data);
                    $CartModels->delete($value['id_cart']);
                } else {
                    $ses_data = [
                        'check' => 0,
                    ];
                    $session->set($ses_data);
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // ไม่ต้องการทำอะไรเพิ่มเติมหลังจากการประมวลผลก่อน
    }
}
