<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteTempUploadedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-temp-uploaded-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete temp uploaded files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Storage::directories('tmp') as $directory) {
            $directoryLastModified = Carbon::createFromTimestamp(Storage::lastModified($directory));
 
            if (now()->diffInHours($directoryLastModified) > 24) {
                Storage::deleteDirectory($directory);
            }
        }
    }
}
