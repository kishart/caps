<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Post;


class PostController extends Controller
{
    public function post_photo(){
        return view('admin.post_photo');
    }

    public function add_photo(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'image1' => 'image|mimes:jpeg,png,jpg|max:2048',
            'image2' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();

        $post = new Post;
        $post->title = $request->title;
        $post->post_status = 'active';

        if ($request->hasFile('image1')) {
            $imagename1 = time().'_1.'.$request->image1->getClientOriginalExtension();
            $request->image1->move(public_path('postimage1'), $imagename1);
            $post->image1 = $imagename1;
        }

        if ($request->hasFile('image2')) {
            $imagename2 = time().'_2.'.$request->image2->getClientOriginalExtension();
            $request->image2->move(public_path('postimage2'), $imagename2);
            $post->image2 = $imagename2;
        }

        $post->save();

        return redirect()->back()->with('success', 'Your post was added successfully!');
    }

 

    public function showPosts()
    {
        $posts = Post::latest()->get(); // Retrieves posts ordered by the most recent first
        return view('your_view_name', compact('posts'));
    }


    public function delete_post($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->back()->with('message', 'Post deleted successfully');
    }

    public function edit_post($id){
        $post = Post::findOrFail($id);
        return view('admin.edit_post', compact('post'));
    }

    public function update_post(Request $request, $id){
        $data = Post::findOrFail($id);

        $data->title = $request->title;
        $data->description = $request->description;

        if ($request->hasFile('image1')) {
            $imagename1 = time().'_1.'.$request->image1->getClientOriginalExtension();
            $request->image1->move(public_path('postimage1'), $imagename1);
            $data->image1 = $imagename1;
        }

        if ($request->hasFile('image2')) {
            $imagename2 = time().'_2.'.$request->image2->getClientOriginalExtension();
            $request->image2->move(public_path('postimage2'), $imagename2);
            $data->image2 = $imagename2;
        }

        $data->save();

        return redirect()->back()->with('message', 'Post updated successfully');
    }
    public function photos() {
        $posts = Post::all();
        return view('user.photos', compact('posts'));
    }
   
    


    

}
