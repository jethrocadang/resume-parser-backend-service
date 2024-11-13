<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    public function Upload(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,docx,doc'
        ]);

        $file = $request->file('resume');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('resumes', $fileName, 'public');


        $fileUrl = Storage::url($filePath);

        $resume = new Resume();
        $resume->file_name = $fileName;
        $resume->file_url = $fileUrl;
        $resume->uploaded_at = now();
        $resume->save();

        return response()->json([
            'message' => 'Resume uploaded successfully!',
            'file_url' => $fileUrl,
            'file_name' => $fileName,
        ], 201);

    }
}
