<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();
        return view('admin.languages.index', compact('languages'));
    }

    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        $language->publish = $language->publish === 1 ? 0 : 1;
        $language->save();

        return back()->with('success', 'Language publish status updated.');
    }
}
