<?php

namespace App\Controllers;

use App\Models\HistoryModels;
use App\Models\BookModels;

class DashboardController extends BaseController
{
    public function index()
    {
        $BookModels = new BookModels();
        $HistoryModels = new HistoryModels();

        // ดึงข้อมูล id_book จากฐานข้อมูล
        $results = $HistoryModels->findAll(); // ปรับตามโครงสร้าง Model ของคุณ

        // รวบรวมทุกไอดีเข้ามาในอาร์เรย์
        $allIds = [];
        foreach ($results as $row) {
            $ids = explode(',', $row['id_book']);
            $allIds = array_merge($allIds, $ids);
        }

        // นับจำนวนครั้งที่แต่ละไอดีปรากฏซ้ำกัน
        $idCounts = array_count_values($allIds);

        // เรียงลำดับตามจำนวนครั้งที่ปรากฏ
        arsort($idCounts);

        // ดึง 3 อันดับแรก
        $top3Ids = array_slice($idCounts, 0, 3, true);

        // ดึงข้อมูลของไอดีที่มีจำนวนครั้งซ้ำมากที่สุด 3 อันดับ
        $top3Ids = array_keys($top3Ids);


        // ตรวจสอบว่ามีไอดีที่ซ้ำกันหรือไม่
        if (!empty($top3Ids)) {
            // ใช้คำสั่ง WHERE IN เพื่อดึงข้อมูลจากฐานข้อมูล
            $data['bookData'] = $BookModels->whereIn('id_book', $top3Ids)->findAll();
        } else {
            // กรณีไม่มีไอดีที่ซ้ำกัน
            $data['bookData'] = $BookModels->orderBy('RAND()')->limit(3)->get()->getResultArray();
        }

        echo view('dashboard/layout/header');
        echo view('dashboard/home', $data);
    }
}
