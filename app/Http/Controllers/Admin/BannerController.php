<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banners::all();
        return view('admin.banners.index', compact('banners'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banners::findOrFail($id);
        $type = strtolower($banner->type); // e.g. jpg, jpeg, png

        if ($request->hasFile('file')) {
            // Validate according to banner type
            $request->validate([
                'file' => "file|mimes:$type|max:4096",
            ], [
                'file.mimes' => "Only .$type files are allowed.",
            ]);

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $banner->path = 'images/' . $filename;
        } else {
            // If no file uploaded, validate path string
            $request->validate([
                'path' => "required|string|regex:/\.($type)$/i",
            ], [
                'path.regex' => "Only .$type file paths are allowed.",
            ]);

            $banner->path = $request->path;
        }

        $banner->save();

        return back()->with('success', 'Banner updated successfully.');
    }

}
