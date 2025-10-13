<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class FileUploadController extends Controller
{
    /**
     * Handle chunked file uploads.
     * Expects an extra parameter "file_type" (e.g. local_video, pdf, voice)
     */
    public function uploadChunk(Request $request)
    {
        // Get the file type from the request (it should be one of: local_video, pdf, voice)
        $fileType = $request->input('file_type', 'other');

        // Create a receiver instance for the incoming file chunk.
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            return response()->json(['error' => 'File not uploaded.'], 400);
        }

        // Receive the file chunk(s)
        $fileReceived = $receiver->receive();

        if ($fileReceived->isFinished()) {  // All chunks received – merge them!
            $file = $fileReceived->getFile();
            $extension = $file->getClientOriginalExtension();
            $nameWithoutExt = str_replace('.' . $extension, '', $file->getClientOriginalName());
            $fileName = $nameWithoutExt . '_' . md5(time()) . '.' . $extension;

            // Determine storage directory based on file type
            switch ($fileType) {
                case 'local_video':
                    $directory = 'topics/videos';
                    break;
                case 'pdf':
                    $directory = 'topics/pdfs';
                    break;
                case 'voice':
                    $directory = 'topics/audios';
                    break;
                default:
                    $directory = 'topics/others';
                    break;
            }

            // Save file using the public disk
            $disk = Storage::disk('public');
            $path = $disk->putFileAs($directory, $file, $fileName);

            // Remove the temporary merged file
            unlink($file->getPathname());

            return response()->json([
                'path'     => asset('storage/' . $path),
                'filename' => $fileName,
            ]);
        }

        // File is still uploading – return current percentage progress.
        $handler = $fileReceived->handler();
        return response()->json([
            'done'   => $handler->getPercentageDone(),
            'status' => true,
        ]);
    }
}
