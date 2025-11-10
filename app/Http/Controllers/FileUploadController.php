<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->getPathname();
            $fileName = $file->getClientOriginalName();
            $fileMime = $file->getClientMimeType();

            $response = Http::attach(
                'file',
                file_get_contents($filePath),
                $fileName
            )->post('https://ehealthprc.com:5000/api/v1/pasien/import-excel');

            if ($response->successful()) {
                return back()->with('success', 'File uploaded and sent successfully!');
            } else {
                return back()->with('error', 'Failed to send file: ' . $response->body());
            }
        }

        return back()->with('error', 'No file was uploaded.');
    }
}
