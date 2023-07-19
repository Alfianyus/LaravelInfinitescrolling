<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::latest()->paginate(10);
        if ($request->ajax()) {
            $view = view('posts.load', compact('posts'))->render();
            return Response::json(['view' => $view, 'nextPageUrl' => $posts->nextPageUrl()]);
        }
        return view('posts.index', compact('posts'));
    }
}
