<?php

namespace App\Components;

class Recursive 
{
    private $html;

    public function __construct()
    {
        $this->html = '';
    }


    //parent_id = 0 la cha
    // submark la dau --
    // idSelected la id cua danh muc cha 
    public function makeRecursive($nameRecursive, $idSelected, $parentId = 0, $subMark = '')
    {
        $data = $nameRecursive::where([
            'parent_id' => $parentId,
            'deleted_at' => null
        ])->get();
        foreach ($data as $dataItem) {
            if(!empty($idSelected && $idSelected == $dataItem['id'])) {
                $this->html .= '<option selected value="' .$dataItem['id'].'">'. $subMark. ' '. $dataItem['name']. ' </option>';
            }
            else {
                $this->html .= '<option value="' .$dataItem['id'].'">'. $subMark. ' '. $dataItem['name']. ' </option>';
            }
            $this->makeRecursive($nameRecursive, $idSelected, $dataItem->id, $subMark. '-'); //goi de quy
        }
        return $this->html;
    }

}