<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photos;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

class TestPhotoController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the photos input
        $request->validate([
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id', // Validate the selected user ID
        ]);
    
        $filePaths = [];
    
        // Check if photos were uploaded
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // Store each photo in the 'photos' directory in the public disk
                $filePath = $photo->store('photos', 'public');
                $filePaths[] = $filePath; // Collect all file paths
            }
        }
    
        // Save file paths and the selected user to the database
        Photos::create([
            'user_id' => $request->user_id, // Save the selected user ID
            'photo_paths' => json_encode($filePaths),
            'description' => $request->description,
        ]);
    
        // Redirect back with success message
        return back()->with('success', 'Photos uploaded successfully!');
    }
    
    


public function showUploadedPhotos()
{
    // Fetch the uploaded photos for the logged-in user
    $photoUploads = Photos::with('user') // Assuming 'user' is the relationship in the Photo model
        ->orderBy('created_at', 'desc')
        ->get();

    // Pass the photoUploads variable to the view
    return view('user.show-photos', compact('photoUploads'));
}

public function showForm()
    {
        // Fetch users from the database
        $users = User::all();

        // Pass the $users variable to the view
        return view('admin.upload-photos', compact('users'));
    }


    public function postComment(Request $request, $photoId)
{
    // Validate the comment input
    $request->validate([
        'comment' => 'required|string',
    ]);

    // Fetch the photo by ID and check if it exists
    $photo = Photos::findOrFail($photoId);

    // Allow comments for any authenticated user, not just the photo uploader
    if (Auth::check()) {
        // Create a new comment and save it to the database
        $comment = new Comment();
        $comment->user_id = Auth::id(); // The authenticated user's ID
        $comment->photo_id = $photoId; // The ID of the photo being commented on
        $comment->comment = $request->comment;
        $comment->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Comment posted successfully');
    }

    // If user is not authenticated, redirect with an error
    return redirect()->back()->withErrors(['error' => 'You must be logged in to comment.']);
}


 

    public function list()
    {
        // Fetch all photo uploads from the database
        $photoUploads = Photos::with('comments.user')->get(); // Include related comments and users for display

        // Return the view with the photo uploads
        return view('photo_list', compact('photoUploads'));
    }
    public function edit($id) {
        $photo = Photos::findOrFail($id);
        return view('admin.photo_edit', compact('photo'));
    }
    
    public function update(Request $request, $id) {
        $photo = Photos::findOrFail($id);
        $photo->description = $request->input('description');
        $photo->save();
    
        return redirect()->route('photo.list')->with('success', 'Photo updated successfully!');
    }
    
    public function destroy($id) {
        $photo = Photos::findOrFail($id);
        $photo->delete();
    
        return redirect()->route('photo.list')->with('success', 'Photo deleted successfully!');
    }
    public function viewPhotos()
    {
        $photoUploads = Photos::with('comments.user')->get();
        return view('admin/view-photos', compact('photoUploads'));
    }


    
    public function listPhotos($photosId)
    {
        $photos = Photo::with('user') // Load related user data
            ->where('photos_id', $photosId)
            ->latest()
            ->get();
    
        return view('admin.upload-photos', compact('photos'));
    }
    

}