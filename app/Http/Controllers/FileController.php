<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Uphotos;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FileController extends Controller
{
    
   public function create()
    {
        $users = User::all();
        return view('admin.uphotostest', compact('users'));
    }
    public function showPhotos()
    {
        // Fetch files with associated users and posts
        $files = \App\Models\File::with(['user', 'post'])->get();
        
        // Return the view with the files data
        return view('user.viewp', compact('files'));
    }
    


    public function index()
    {
        $users = User::all();
        return view('user.viewp', compact('users'));
    }


    public function cphotos()
    {
    $users = User::all();
    $files = File::with('user', 'comments')->get(); // Eager load users and comments
    return view('admin.uphotos', compact('users', 'files'));
}
public function pcreate()
{
    $users = User::all();
    return view('admin.uphotos', compact('users'));
}

public function photos()
{
$users = User::all();
$files = File::with('user', 'comments')->get(); // Eager load users and comments
return view('admin.uphotos', compact('users', 'files'));
}


public function savePhotos(Request $request)
{
    // Validate the request
    $request->validate([
        'filename.*' => 'required|mimes:jpg,jpeg,png,bmp|max:2048', // Adjust as necessary
        'description' => 'required|string',
        'post_id' => 'required|exists:posts,id', // Ensure that post exists
    ]);

    // Check if files are present
    if ($request->hasFile('filename')) {
        foreach ($request->file('filename') as $file) {
            // Create a new File instance for each uploaded file
            $photo = new File(); // Assuming File is your model for photos

            // Set the description and user ID automatically from the authenticated user
            $photo->description = $request->description;
            $photo->user_id = auth()->id(); // Automatically assign the logged-in user
            $photo->post_id = $request->post_id; // Associate the photo with the post

            // Create a unique filename
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads/photos'), $filename);

            // Set the filename in the database
            $photo->filename = $filename;

            // Save the photo
            $photo->save();
        }
    } else {
        return redirect()->back()->withErrors(['error' => 'No files were uploaded.']);
    }

    // Redirect with a success message
    return redirect()->back()->with('success', 'Photos uploaded successfully');
}


    public function postComment(Request $request, $fileId)
    {
        // Validate the comment
        $request->validate([
            'comment' => 'required|string',
        ]);
    
        // Check if the authenticated user is allowed to comment on this file
        $file = File::findOrFail($fileId);
        if (Auth::id() !== $file->user_id) {
            return redirect()->back()->withErrors(['error' => 'You are not allowed to comment on this file.']);
        }
    
        // Save the comment (assuming you have a Comment model and table)
        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->file_id = $fileId;
        $comment->comment = $request->comment;
        $comment->save();
    
        return redirect()->back()->with('success', 'Comment posted successfully');
    }
      





    public function destroy($id)
{
    $file = File::findOrFail($id);
    $file->delete();

    return redirect()->back()->with('success', 'File deleted successfully');
}
}