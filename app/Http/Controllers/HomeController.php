<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return redirect('about');
    }

    public function about()
    {
        return view('welcome', ['component' => '<about-component></about-component>']);
    }

    public function table(Request $request)
    {
        $request->validate(['perPage' => 'min:2']);

        if ($request->isMethod('GET')) {
            return view('welcome', ['component' => '<table-component></table-component>']);
        }

        $posts = Post::with('user')->paginate();

        return response()->json(['posts' => $posts]);
    }

    public function reddit()
    {
        $data = RedditController::reddit();
        
        foreach ($data as $d) {
            $user = [];
            $post = new Post();
            $user['username'] = $d['data']['name'];
            $user = User::create($user);
            $post->user_id = $user->id;
            $post->headline = $d['data']['title'];
            $post->content = $d['data']['public_description'] ?? $d['data']['description'];
            $post->save();
        }

        return redirect('/table');
    }

    public function tableDelete(Request $request)
    {
        Post::find($request->id)->delete();

        return response()->json(['message' => 'Delete Successful']);
    }
}
