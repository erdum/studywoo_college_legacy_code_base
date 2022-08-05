<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait ModalTrait
{
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $username = Str::slug($model->name);
            if (self::where('username', $username)->first()) {
                $loop = true;
                $number = 1;
                $new_username = "";
                while ($loop) {
                    $new_username = $number . "-" . $username;
                    if (self::where('username', $new_username)->first()) {
                        $number++;
                    } else {
                        $loop = false;
                    }
                }
                $model->username = $new_username;
            } else {
                $model->username = $username;
            }
        });
    }
}


