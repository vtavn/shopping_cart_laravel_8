<?php
namespace App\Components;

use App\Models\Menu;

class MenuRecursive {
    private $html;

    public function __construct()
    {
        $this->html = '';
    }

    public function menuRecursive($parenIdMenuEdit, $parentId = 0, $subMark = '')
    {
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $dataItem)
        {
            if (!empty($parenIdMenuEdit) && $parenIdMenuEdit == $dataItem->id){
                $this->html .= "<option selected value='".$dataItem->id."'>". $subMark . $dataItem->name . "</option>";
            } else {
                $this->html .= "<option value='".$dataItem->id."'>". $subMark . $dataItem->name . "</option>";
            }
            $this->menuRecursive($parenIdMenuEdit, $dataItem->id, $subMark.'--');
        }
        return $this->html;
    }
}
