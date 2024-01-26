<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\PromotionModels;
use CodeIgniter\I18n\Time;
use App\Models\UserModels;


class PromotionCheck implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        $PromotionModels = new PromotionModels();
        $data['data_promotion'] = $PromotionModels->where('status', 1)->findAll();
        foreach ($data['data_promotion'] as $key => $value) {
            $to_day_pro = date('Y-m-d'); // Format: Year-Month-Day (e.g., 2024-01-26)
            if ($to_day_pro > $value['date_end']) {
                log_message('debug', 'Promotion has ended. Updating status.');
                $PromotionModels->update($value['id_promotion'], ['status' => 0]);
            }
        }
        
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // ไม่ต้องการทำอะไรเพิ่มเติมหลังจากการประมวลผลก่อน
    }

}
