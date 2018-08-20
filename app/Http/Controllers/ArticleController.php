<?php

namespace App\Http\Controllers;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    //

    public function create(Request $request){
        $this->validate($request, [
            'content' => 'required|string|max:200|min:5',
            'uris' => 'nullable|string',
            'user_id'=>'nullable|integer',
            'user_name'=>'required|string'
        ]);

        Article::create(request(['content', 'uris','user_id', 'user_name']));
        return response()->json(request(['content', 'uris','user_id', 'user_name']));

    }

    public function getAll(){
        return response(Article::all(), 200);
    }
}
