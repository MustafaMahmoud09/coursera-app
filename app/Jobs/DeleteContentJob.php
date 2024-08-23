<?php

namespace App\Jobs;

use App\Traits\Controllers\File\DeleteFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteContentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, DeleteFile;

    /**
     * Create a new job instance.
     */
    public function __construct(public $content)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //get paths
        $videoPath = $this->content->video_path;
        $coverPath = $this->content->cover_path;

        //delete video content from db
        $this->content->delete();

        //delete files from this server
        $this->deleteFile($videoPath);
        $this->deleteFile($coverPath);
    } //end handle

}//end DeleteContentJob
