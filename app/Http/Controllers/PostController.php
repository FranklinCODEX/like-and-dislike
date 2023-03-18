<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function welcome()
    {
        $collections = Post::all(); 
        return view('welcome', compact('collections'));
    }

    public function like($id)
    {
        $post = Post::findOrFail($id);
        $user_id = auth()->user()->id;
        
        //reagir c'est like ou dislike
        // il faut etre connecter avant de pouvoir reagir
        if (!$user_id)
        {
            return redirect()->route('register');
        }

        $like = Like::where('user_id', $user_id)
                    ->where('post_id', $post->id)
                    ->first();

        //si l'utilisateur connecte n'a pas encore reagir on enregisre 
        if (!$like) {
            $like = new Like;
            $like->user_id = $user_id;
            $like->post_id = $post->id;
            $like->like = 1;
            $like->save();

            $post->like += 1;
            $post->save();
        } elseif ($like->like == 1) {
            //sinon si la reaction existe deja on supprime la reaction et on decremente la reaction
            $like->delete();
            $post->like -= 1;
            $post->save();
        } elseif ($like->dislike == 1) {
            //cette partie c'est juste pour s'assurer qu'il fait une seule reaction
            $like->like = 1;
            $like->dislike = 0;
            $like->save();

            $post->like += 1;
            $post->dislike -= 1;
            $post->save();
        }

        return redirect()->back();
    }

    public function dislike($id)
    {
        $post = Post::findOrFail($id);
        $user_id = auth()->user()->id;
        if (!$user_id)
        {
            return redirect()->route('register');
        }
        $like = Like::where('user_id', $user_id)
                    ->where('post_id', $post->id)
                    ->first();

        if (!$like) {
            $like = new Like;
            $like->user_id = $user_id;
            $like->post_id = $post->id;
            $like->dislike = 1;
            $like->save();

            $post->dislike += 1;
            $post->save();
        } elseif ($like->dislike == 1) {
            $like->delete();
            $post->dislike -= 1;
            $post->save();
        } elseif ($like->like == 1) {
            $like->like = 0;
            $like->dislike = 1;
            $like->save();

            $post->like -= 1;
            $post->dislike += 1;
            $post->save();
        }

        return redirect()->back();
    }
}
