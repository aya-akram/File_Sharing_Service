<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\FileDownloaded;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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
            'email_to' => 'email',
            'email_from' => 'email',
            'title' => 'required|string',

        ]);
        $name = $request->file->getClientOriginalName();
        $path = $request->file('file')->store('files', 'public');
        $url = Storage::url($path);
        $uuid = Str::uuid();

        $file = File::create([
            'uuid' => $uuid,
            'name' => $name,
            'path' => $path,
            'url' => $url,
            'title' => $request->title,
        ]);

        // $data = [
        //     'title' => $request->title,
        //     'file_id' => $file->id, // Pass the file's ID to the view
        //     'email_from' => $request->email_from
        // ];
        // Mail::send('emails.file', $data, function ($message) use ($data, $request) {
        //     $message->to($request->email_to)
        //         ->from($data['email_from'])
        //         ->subject($data['title']);
        // });


        return redirect('/upload')->with([
            'success' => 'File uploaded successfully!',
            // 'download_link' => $url,
            'download_link' => URL::signedRoute('file.download', ['uuid' => $uuid]),

        ]);
    }

    public function share($id)
    {
        $files = File::findOrFail($id);
        return response()->file(public_path('storage/' . $files->path));
    }

    // public function download($uuid)
    // {
    //     $file = File::where('uuid', $uuid)->firstOrFail();
    //     return response()->download(public_path('storage/' . $file->path));
    // }
    public function download($uuid)
{
    $file = File::where('uuid', $uuid)->firstOrFail();

    // Trigger the event
    event(new FileDownloaded($file));

    return response()->download(public_path('storage/' . $file->path));
}

    public function showAllFiles()  {
        $files = File::all();


        return view('download', [
            'files' => $files,
        ]);
    }


}
