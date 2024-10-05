<?php

namespace App\Http\Controllers;

use App\Models\File;
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
    $files = \App\Models\File::with('user')->get();
    return view('user.viewp', compact('files'));
}
    public function index()
    {
        $users = User::all();
        return view('user.viewp', compact('users'));
    }


    public function uphotos()
    {
    $users = User::all();
    $files = File::with('user', 'comments')->get(); // Eager load users and comments
    return view('admin.uphotos', compact('users', 'files'));
}

    
    public function saveUphotos(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'required',
            'filename' => 'required',  // Ensure at least one file is uploaded
            'filename.*' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $file) {
                $data = new File;
                $data->user_id = $request->user_id;  // Store the user allowed to comment
                $data->description = $request->description;
                $data->category = $request->category ?? null;
    
                $fileName = time() . '_' . $file->getClientOriginalName();
                $uploadPath = public_path('uploads');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }
                $file->move($uploadPath, $fileName);
                $data->filename = $fileName;
                $data->save();
            }
        }
    
        return redirect()->back()->with('success', 'Files uploaded successfully');
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