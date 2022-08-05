<?php

namespace App\CustomClasses;

class CheckDocument
{
    
    static public function exist($model, $label, $value)
    {
        if (is_array($value) && $value['id'] && $value['label']) {
            return $model::where('id', $value['id'])->where($label, $value['label'])->first();
        }
        
        return $model::where($label, $value)->first();
    }
}