<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageFileDownloader extends Controller
{
    public function download($filePath)
    {
      
        $fullPath = storage_path('app/public/' . $filePath);
        // dd($fullPath);
        // Check if the file exists
        if (!file_exists($fullPath)) {
            abort(404);
        }

        // Return the file as a download response
        return response()->download($fullPath);
    }

    
}
