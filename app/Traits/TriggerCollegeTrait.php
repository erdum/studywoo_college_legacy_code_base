<?php

namespace App\Traits;

trait TriggerCollegeTrait{
    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
           //update cache table
        });

        self::updated(function ($model) {
            //update cache table
        });


    }
}
