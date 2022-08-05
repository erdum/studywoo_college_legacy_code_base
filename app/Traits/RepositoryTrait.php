<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;


trait RepositoryTrait{

    private function createOrUpdate(Model $model , array $data ){
        $model = $model->where('id',$data['id'] ?? null)->first()  ?? $model;
        $fillable=$model->getFillable();

        foreach($data as $key=>$value){
            if($key!='id')
            if(in_array($key,$fillable))
            $model->$key=$value ?? null;
        }
        if($model->isDirty()){
            if($model->save()){
                // if id 200 updated else 201 created
            $status_code= isset($data['id']) ? 200 :201 ;
        }
        else{
            // 400 error saving
            $status_code= 400;
        }
    }
    else{
    // 304 noting to change
    $status_code= 304;
    }

    return ['model'=>$model ,'status_code'=>$status_code];
    }
}
