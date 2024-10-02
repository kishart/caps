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

    public function saveUphotos(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'description' => 'required',
            'filename' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = new File;
        $data->user_id = $request->user_id;

        if ($request->hasFile('filename')) {
            $file = $request->file('filename');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Check if uploads directory exists, if not create it
            $uploadPath = public_path('uploads');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $fileName);
            $data->filename = $fileName;
        }

        $data->description = $request->description;
        $data->category = $request->category ?? null;

        $data->save();

        return redirect()->back()->with('success', 'Upload successful');
    }

}
