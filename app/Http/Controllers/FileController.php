<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;

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
        return view('admin.uphotos', compact('users'));
    }
    public function saveUphotos(Request $request)
{
    // Validate input for multiple files
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'description' => 'required',
        'filename' => 'required',  // Validate that at least one file is selected
        'filename.*' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',  // Ensure each file meets the validation rules
    ]);

    // Handle multiple file uploads
    if ($request->hasFile('filename')) {
        foreach ($request->file('filename') as $file) {
            // Create a new File instance for each uploaded file
            $data = new File;
            $data->user_id = $request->user_id;
            $data->description = $request->description;
            $data->category = $request->category ?? null;

            // Generate a unique name for the file
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Check if the uploads directory exists, create it if not
            $uploadPath = public_path('uploads');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Move the file to the uploads directory
            $file->move($uploadPath, $fileName);
            $data->filename = $fileName;

            // Save the file data to the database
            $data->save();
        }
    }

    return redirect()->back()->with('success', 'Files uploaded successfully');
}
    public function destroy($id)
{
    $file = File::findOrFail($id);
    $file->delete();

    return redirect()->back()->with('success', 'File deleted successfully');
}
}