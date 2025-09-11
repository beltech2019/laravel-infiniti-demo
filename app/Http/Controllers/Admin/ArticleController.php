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
        $dataen = responsibleGamingConfigdata('en');
        $dataes = responsibleGamingConfigdata('es');
        $datafr = responsibleGamingConfigdata('fr');
        $datath = responsibleGamingConfigdata('th');
        return view('admin.articles.responsibleGaming', compact('dataen','dataes','datafr','datath'));
    }

    public function privacyPolicyConfig(Request $request)
    {
        $dataen = privacyPolicyConfigdata('en');
        $dataes = privacyPolicyConfigdata('es');
        $datafr = privacyPolicyConfigdata('fr');
        $datath = privacyPolicyConfigdata('th');
        return view('admin.articles.privacyPolicy', compact('dataen','dataes','datafr','datath'));
    }

    public function termsandconditionConfig(Request $request)
    {
        $dataen = termsandconditionConfigdata('en');
        $dataes = termsandconditionConfigdata('es');
        $datafr = termsandconditionConfigdata('fr');
        $datath = termsandconditionConfigdata('th');
        return view('admin.articles.termsandcondition', compact('dataen','dataes','datafr','datath'));
    }

    public function responsibleGamingupdate(Request $request)
    {
        $request->validate([
            'dataen' => 'required|string',
            'datath' => 'required|string',
            'dataes' => 'required|string',
            'datafr' => 'required|string',
        ]);

        LinksContent::where('key', 'RESPONSIBLE_GAMING')
            ->where('lang','en')
            ->update(['data' => $request->dataen]);

        LinksContent::where('key', 'RESPONSIBLE_GAMING')
            ->where('lang','es')
            ->update(['data' => $request->dataes]);

        LinksContent::where('key', 'RESPONSIBLE_GAMING')
            ->where('lang','fr')
            ->update(['data' => $request->datafr]);

        LinksContent::where('key', 'RESPONSIBLE_GAMING')
            ->where('lang','th')
            ->update(['data' => $request->datath]);

        return back()->with('success', 'Updated.');
    }

    public function privacyPolicyupdate(Request $request)
    {
        $request->validate([
            'dataen' => 'required|string',
            'datath' => 'required|string',
            'dataes' => 'required|string',
            'datafr' => 'required|string',
        ]);

        LinksContent::where('key', 'PRIVACY_POLICY')
            ->where('lang','en')
            ->update(['data' => $request->dataen]);

        LinksContent::where('key', 'PRIVACY_POLICY')
            ->where('lang','es')
            ->update(['data' => $request->dataes]);

        LinksContent::where('key', 'PRIVACY_POLICY')
            ->where('lang','fr')
            ->update(['data' => $request->datafr]);

        LinksContent::where('key', 'PRIVACY_POLICY')
            ->where('lang','th')
            ->update(['data' => $request->datath]);    

        return back()->with('success', 'Updated.');  
    }

    public function termsandconditionupdate(Request $request)
    {
        $request->validate([
            'dataen' => 'required|string',
            'datath' => 'required|string',
            'dataes' => 'required|string',
            'datafr' => 'required|string',
        ]);

        LinksContent::where('key', 'TERMS_CONDITIONS')
            ->where('lang','en')
            ->update(['data' => $request->dataen]);

        LinksContent::where('key', 'TERMS_CONDITIONS')
            ->where('lang','es')
            ->update(['data' => $request->dataes]);

        LinksContent::where('key', 'TERMS_CONDITIONS')
            ->where('lang','fr')
            ->update(['data' => $request->datafr]);

        LinksContent::where('key', 'TERMS_CONDITIONS')
            ->where('lang','th')
            ->update(['data' => $request->datath]);    

        return back()->with('success', 'Updated.');      
    }
}
