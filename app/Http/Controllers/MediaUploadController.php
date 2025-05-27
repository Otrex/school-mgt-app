<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MediaUploadController extends Controller
{
    public function storeImage(Request $request)
    {
        if ($request->has('upload')) {

            $file = $request->upload;
            $newName = substr(md5(uniqid()), 0, 12).".".$file->getClientOriginalExtension();

            $url = Cloudinary::upload($request->file('upload')->getRealPath())->getSecurePath();

            return response()->json(['filename' => $newName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
