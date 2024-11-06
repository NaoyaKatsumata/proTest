<?php

namespace App\Imports;

use App\Models\Shop;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientDataImport implements ToModel
{
    public function model(array $row)
    {
        // CSVの列に合わせてパスの位置を指定
        $shopName = $row[0];
        $detail = $row[1];
        $categoryId = $row[2];
        $areaId = $row[3];
        $fileName=null;

        switch($categoryId){
            case 1:
                $fileName = 'img/sushi.jpg';
                break;
            case 2:
                $fileName = 'img/yakiniku.jpg';
                break;
            case 3:
                $fileName = 'img/izakaya.jpg';
                break;
            case 4:
                $fileName = 'img/italian.jpg';
                break;
            case 5:
                $fileName = 'img/ramen.jpg';
                break;
            default:
                $fileName = "";
                break;
        }

        // 必要に応じて、他のカラムも保存
        return new Shop([
            'shop_name' => $shopName,
            'detail' => $detail,
            'category_id' => $categoryId,
            'img_path' => $fileName,
            'area_id' => $areaId,
        ]);
    }
}
