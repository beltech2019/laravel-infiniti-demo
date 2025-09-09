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
        $request->validate([
            'path' => 'required|string|regex:/\.(jpg|jpeg|png)$/i',
        ], [
            'path.regex' => 'Only JPG and PNG files are allowed.',
        ]);

        $banner = Banners::findOrFail($id);
        $banner->path = $request->path;
        $banner->save();

        return back()->with('success', 'Banner path updated.');
    }
}
