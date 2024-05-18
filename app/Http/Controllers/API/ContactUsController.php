<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\contactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index()
    {
        $courses = contactUs::all();
        $data = [
            "msg" => "Return All Data",
            "status" => 200,
            "data" => $courses,
        ];
        return response()->json($data);
    }
}
