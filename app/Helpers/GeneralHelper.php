<?php


namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GeneralHelper
{

    public static function customMessage()
    {
        return [
            'required' => 'The :attribute field is required.',
            'unique' => "The :attribute is already in use."
        ];
    }
}