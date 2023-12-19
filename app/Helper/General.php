<?php

use Carbon\Carbon;
use App\Models\Seo;
use App\Models\Setting;
use Illuminate\Support\Facades\App;

function userDefaultImage()
{
    return asset('backend/assets/images/blank.png');
}
function emptyImage()
{
    return asset('backend/assets/images/empty.jpg');
}

function order_number($model)
{
    $get_order_number=$model::select('order')->orderBy('id','DESC')->first();
    if(!empty($get_order_number)){
        $data=$get_order_number['order'] + 1;
    }else{
        $data=1;
    }
    // dd($data);
    return $data;
}

