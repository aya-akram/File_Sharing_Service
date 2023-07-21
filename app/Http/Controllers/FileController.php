<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function create()
    {
        $file = File::first();
        $success =  session('success');
        session()->get('success');


        // or use any other logic to get the specific file you want
        return view('upload', [
            'file' => $file,
            'success' => $success
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'email_to' => 'required|email',
            'email_from' => 'required|email',
            'title' => 'required|string'
        ]);
        $name = $request->file->getClientOriginalName();
        $path = $request->file('file')->store('files', 'public');
        $url = Storage::url($path);

        $file = File::create([
            'name' => $name,
            'path' => $path,
            'url' => $url,
        ]);

        $data = [
            'title' => $request->title,
            'file_id' => $file->id, // Pass the file's ID to the view
            'email_from' => $request->email_from
        ];
        Mail::send('emails.file', $data, function ($message) use ($data, $request) {
            $message->to($request->email_to)
                ->from($data['email_from'])
                ->subject($data['title']);
        });


        return redirect('/upload')->with([
            'success' => 'File uploaded successfully!',
            'download_link' => $url,
        ]);
    }

    public function share($id)
    {
        $files = File::findOrFail($id);
        // return response()->file(storage_path('public/' . $files->path));
        return response()->file(public_path('storage/' . $files->path));
    }

    // public function downloadPage($id)
    // {

    //     $file = File::findOrFail($id);
    //     $download_link = asset('storage/' . $file->path);


    //     return view('downloade', ['file_id' => $file->id,'download_link' => $download_link]);

    //     return response()->file(public_path('storage/' . $file->path));

    // }


}
