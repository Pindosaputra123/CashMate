<?php

namespace App\MyClass;

class Template
{

    public static function required()
    {
        return "<span class='text-danger'> * </span>";
    }


    public static function requiredBanner()
    {
        return "<div class='col-lg-12 mb-2'>
                    <button class='btn btn-primary' style='width: 100%'>
                        Kolom Bertanda". self::required() ." Wajib Di isi 
                    </button>
                </div>";
    }
}
