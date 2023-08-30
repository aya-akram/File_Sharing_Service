<?php

namespace App\Listeners;

use App\Models\File;
use App\Models\FileDownload;
use App\Events\FileDownloaded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFileDownload
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FileDownloaded $event): void
    {
         $downloadedFile = $event->file;
         File::where('id', $downloadedFile->id)->increment('download_count');
         FileDownload::create([
             'ip_address' => request()->ip(),
             'user_agent' => request()->userAgent(),
             'file_id' => $downloadedFile->id,
         ]);
     }



    }

