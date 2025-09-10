<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LinksContent;
use App\Models\Articles;
use Illuminate\Http\Request;
use Log;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Articles::all();
        return view('admin.articles.index', compact('articles'));
    }

    public function update(Request $request, $id)
    {
        $article = Articles::findOrFail($id);
        $article->publish = $article->publish === 1 ? 0 : 1;
        $article->save();

        return back()->with('success', 'Article publish status updated.');
    }

    public function faqs(Request $request)
    {
        $faqs = getFaqs(); 
        return view('articals.faqs', compact('faqs'));
    }

    public function responsibleGaming(Request $request)
    {
        $data = responsibleGamingdata();
        return view('articals.responsibleGaming', compact('data'));
    }

    public function privacyPolicy(Request $request)
    {
        $data = privacyPolicydata();
        return view('articals.privacyPolicy', compact('data'));
    }

    public function termsandcondition(Request $request)
    {
        $data = termsandconditiondata();
        return view('articals.termsandcondition', compact('data'));
    }

    public function responsibleGamingConfig(Request $request)
    {
        $data = responsibleGamingConfigdata();
        return view('admin.articles.responsibleGaming', compact('data'));
    }

    public function privacyPolicyConfig(Request $request)
    {
        $data = privacyPolicydata();
        return view('admin.articles.privacyPolicy', compact('data'));
    }

    public function termsandconditionConfig(Request $request)
    {
        $data = termsandconditiondata();
        return view('admin.articles.termsandcondition', compact('data'));
    }

    public function responsibleGamingupdate(Request $request)
    {
        $request->validate([
            'data' => 'required|string',
        ]);

        LinksContent::where('key', 'RESPONSIBLE_GAMING')
            ->update(['data' => $request->data]);

        return back()->with('success', 'Updated.');
    }

    public function privacyPolicyupdate(Request $request)
    {
        $request->validate([
            'data' => 'required|string',
        ]);

        LinksContent::where('key', 'PRIVACY_POLICY')
            ->update(['data' => $request->data]);

        return back()->with('success', 'Updated.');  
    }

    public function termsandconditionupdate(Request $request)
    {
        $request->validate([
            'data' => 'required|string',
        ]);

        LinksContent::where('key', 'TERMS_CONDITIONS')
            ->update(['data' => $request->data]);

        return back()->with('success', 'Updated.');      
    }
}
