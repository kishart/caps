<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photos;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class TestPhotoController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the photos input
        $request->validate([
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            
        ]);

        $filePaths = [];

        // Check if photos were uploaded
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // Store each photo in the 'photos' directory in the public disk
                $filePath = $photo->store('photos', 'public');
                $filePaths[] = $filePath; // Collect all file paths
                $photo->description = $request->description;
            $photo->user_id = auth()->id(); // Automatically assign the logged-in user
            $photo->post_id = $request->post_id; 
            }
        }

        // Save file paths to the database
        Photos::create([
            'user_id' => auth()->id(),
            'photo_paths' => json_encode($filePaths),
            'description' => $request->description,
            'post_id' => 'required|exists:posts,id',
        ]);

        // Redirect back with success message
        return back()->with('success', 'Photos uploaded successfully!');
    }


public function showUploadedPhotos()
{
    // Fetch the uploaded photos for the logged-in user
    $photoUploads = TestPhoto::where('user_id', auth()->id())
        ->orderBy('created_at', 'desc')
        ->get();

    // Pass the photoUploads variable to the view
    return view('show-photos', compact('photoUploads'));
}

public function showForm()
    {
        // Fetch users from the database
        $users = User::all();

        // Pass the $users variable to the view
        return view('admin.upload-photos', compact('users'));
    }
    
}