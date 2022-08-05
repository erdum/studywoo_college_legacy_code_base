<?php

namespace App\Traits;

trait ControllerTrait{


    public function jsonResponse($message,$statusCode,$action=null){
        switch($statusCode){
            case 200:
                if($action=='delete')
                    $message="$message deleted successfully";

                else
                $message="$message updated successfully";

                break;

            case 201:
                $message="$message created successfully";
                break;

            case 304:
                $message="Nothing to change";
                break;

            default:
                $message="Something went wrong";
                break;

        }
        return response()->json([
            'message'=>$message
        ],$statusCode);
    }
}
