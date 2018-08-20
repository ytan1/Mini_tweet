<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    //
    public function __construct()
    {
        //if anonymous upload is not allowed, uncomment this line
       //$this->middleware('auth:api', ['except' => []]);
    }
    public function upload(Request $request)
    {
        $path = $request->file('file')->storePublicly(md5(time()));

        return response(array('uri' => $path), 200);
//            dd($request->file('file'));
    }

    public function delete(Request $request){
        Storage::delete( $request->input('path'));
        return response(array('msg' => 'delete success!'), 200);
    }
}
