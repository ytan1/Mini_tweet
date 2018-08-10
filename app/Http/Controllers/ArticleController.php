<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
class ArticleController extends Controller
{
    //

    public function create(Request $request){
        $vali = Validator::make($request->any(), [
            'content' => 'required|string|max:200|min:5',
            'uris' => 'nullable|string'
        ]);
        $vali->validate();

        Article::create(\request(['content', 'uris']));
        return response(array("msg"=>"create success!"), 200);
    }
}
