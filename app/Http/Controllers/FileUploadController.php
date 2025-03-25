<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048', // Allow Excel and CSV files
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->getPathname();
            $fileName = $file->getClientOriginalName();
            $fileMime = $file->getClientMimeType();

            // Send file to external API
            $response = Http::attach(
                'file',           // Form field name
                file_get_contents($filePath),
                $fileName
            )->post('http://ehealthprc.com:5000/api/v1/pasien/import-excel');

            // Check response
            if ($response->successful()) {
                return back()->with('success', 'File uploaded and sent successfully!');
            } else {
                return back()->with('error', 'Failed to send file: ' . $response->body());
            }
        }

        return back()->with('error', 'No file was uploaded.');
    }
}
