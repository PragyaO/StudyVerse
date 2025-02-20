<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Program;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\PostFile;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FrontendController extends Controller
{
    public function index()
    {
        $setting = Setting::find(1);
        $all_programs = Program::where('hideStatus', '0')
            ->where('is_deleted', '0')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        $all_posts = Post::where('hideStatus', '0')
            ->where('is_deleted', '0')
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        return view('frontend.index', compact('all_programs', 'all_posts', 'setting'));
    }

    public function ViewProgramPost($slug)
{
    $program = Program::where('slug', $slug)->firstOrFail();

    // Use paginate() instead of get()
    $posts = Post::where('program_id', $program->id)
                ->where('hideStatus', 0)
                ->where('is_deleted', 0)
                ->paginate(10);

    return view('frontend.post.index', compact('program', 'posts'));
}


public function viewallpost()
{
    // Fetch all posts that are not hidden, including pagination
    $posts = Post::where('hideStatus', 0)->orderBy('created_at', 'desc')->paginate(10);

    // Fetch the settings (meta data)
    $setting = Setting::Find(1);

    // Return the view with posts and settings
    return view('frontend.post.viewallpost', compact('posts', 'setting'));
}

    public function viewProgram(){
        $programs = Program::where('hideStatus',0)->orderBy('created_at', 'desc')->paginate(10);;
        $setting = Setting::Find(1);
        return view('frontend.post.viewallprogram',compact('programs', 'setting'));
    }

    public function viewPost(string $program_slug, string $post_slug)
    {
        // Find the program
        $program = Program::where('slug', $program_slug)
            ->where('hideStatus', '0')
            ->where('is_deleted', '0')
            ->first();

        if ($program) {
            // Find the specific post under the program
            $post = Post::where('program_id', $program->id)
                ->where('hideStatus', '0')
                ->where('slug', $post_slug)
                ->first();

            // Get latest post in the program
            $latest_posts = Post::where('program_id', $program->id)
                ->where('hideStatus', '0')
                ->orderBy('created_at', 'DESC')
                ->take(1)
                ->get();


            if ($post) {
                $files = PostFile::where('post_id', $post->id)->get();
                return view('frontend.post.view', compact('post', 'latest_posts', 'program', 'files'));
            } else {
                return redirect('/')->with('hideStatus', 'Post not found.');
            }
        } else {
            return redirect('/')->with('hideStatus', 'Program not found.');
        }
    }
}
