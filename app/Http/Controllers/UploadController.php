<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Session;
use Storage;

use App\Http\Requests\UploadRequest;

class UploadController extends Controller
{
    public function store(Request $request) {
        $nameSlug = 'hello-world';
        $file = $request->file('file');
        $extension = $request->file('file')->getClientOriginalExtension();
        $originalName = $request->file('file')->getClientOriginalName();
        $filename = $nameSlug.'-'.date('YmdHis').'-valid-id.'.$extension;

        session(['valid_id_file' => $filename]);

        $file->storeAs('public', $filename, 'local');

        $path = Storage::url($filename);

        return response()->json(['file' => session('valid_id_file'), 'path' => $path]);
    }
}
