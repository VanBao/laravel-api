<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends WebDriverController
{
    public function upload(Request $request) {
        $request->validate([
            'image' => 'required|image|max:5120'
        ]);
        if($request->ajax() && $request->hasFile('image')) {
            $file = $request->image;

            $avatar = str_replace(" ","",time() . '_' . $file->getClientOriginalName());

            $file->move('uploads', $avatar);

            return asset('uploads/' . $avatar);
        }
    }
}
