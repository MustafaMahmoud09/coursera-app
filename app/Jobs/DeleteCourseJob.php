<?php

namespace App\Jobs;

use App\Traits\Controllers\File\DeleteFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteCourseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, DeleteFile;

    /**
     * Create a new job instance.
     */
    public function __construct(public $playlist)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $coverPath = $this->playlist->cover_path;
        $contents = $this->playlist->contents;

        $this->playlist->delete();

        //delete course files from server
        $this->deleteFile($coverPath);
        foreach ($contents as $content) {
            $this->deleteFile($content->cover_path);
            $this->deleteFile($content->video_path);
        } //end foreach
    }//end handle

}//end DeleteCourseJob
