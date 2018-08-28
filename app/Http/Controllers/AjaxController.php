<?php

namespace App\Http\Controllers;

use App\Loaitin;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //
    public function getLoaiTin($idTheLoai)
    {
        $loaitin = Loaitin::where('idTheLoai', $idTheLoai)->get();
        return $loaitin;
    }
}
