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
        $imageNum = $row[3]; // 例として、2列目に画像パスがあると仮定
        $areaId = $row[4];
        $fileName=null;

        switch($imageNum){
            case 1:
                $fileName = 'img/italian.jpg';
                break;
            case 2:
                $fileName = 'img/izakaya.jpg';
                break;
            case 3:
                $fileName = 'img/ramen.jpg';
                break;
            case 4:
                $fileName = 'img/sushi.jpg';
                break;
            case 5:
                $fileName = 'img/yakiniku.jpg';
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
