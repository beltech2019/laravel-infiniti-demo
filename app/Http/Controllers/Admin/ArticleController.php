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


    public function cookiePolicy(Request $request)
    {
        $data = cookiePolicydata();
        return view('articals.cookiePolicy', compact('data'));
    }

    public function howtoplay(Request $request)
    {
        $data = howtoplaydata();
        return view('articals.howtoplay', compact('data'));
    }

    public function news(Request $request)
    {
        $data = newsdata();
        return view('articals.news', compact('data'));
    }

    public function cookiePolicyConfig(Request $request)
    {
        $dataen = cookiePolicyConfigdata('en');
        $dataes = cookiePolicyConfigdata('es');
        $datafr = cookiePolicyConfigdata('fr');
        $datath = cookiePolicyConfigdata('th');
        return view('admin.articles.cookiePolicy', compact('dataen','dataes','datafr','datath'));
    }

    public function howtoplayConfig(Request $request)
    {
        $dataen = howtoplayConfigdata('en');
        $dataes = howtoplayConfigdata('es');
        $datafr = howtoplayConfigdata('fr');
        $datath = howtoplayConfigdata('th');
        return view('admin.articles.howtoplay', compact('dataen','dataes','datafr','datath'));
    }

    public function newsConfig(Request $request)
    {
        $dataen = newsConfigdata('en');
        $dataes = newsConfigdata('es');
        $datafr = newsConfigdata('fr');
        $datath = newsConfigdata('th');
        return view('admin.articles.news', compact('dataen','dataes','datafr','datath'));
    }

    public function cookiePolicyupdate(Request $request)
    {
        $request->validate([
            'dataen' => 'required|string',
            'datath' => 'required|string',
            'dataes' => 'required|string',
            'datafr' => 'required|string',
        ]);

        LinksContent::where('key', 'COOKIE_POLICY')
            ->where('lang','en')
            ->update(['data' => $request->dataen]);

        LinksContent::where('key', 'COOKIE_POLICY')
            ->where('lang','es')
            ->update(['data' => $request->dataes]);

        LinksContent::where('key', 'COOKIE_POLICY')
            ->where('lang','fr')
            ->update(['data' => $request->datafr]);

        LinksContent::where('key', 'COOKIE_POLICY')
            ->where('lang','th')
            ->update(['data' => $request->datath]);

        return back()->with('success', 'Updated.');
    }

    public function howtoplayupdate(Request $request)
    {
        $request->validate([
            'dataen' => 'required|string',
            'datath' => 'required|string',
            'dataes' => 'required|string',
            'datafr' => 'required|string',
        ]);

        LinksContent::where('key', 'HOW_TO_PLAY')
            ->where('lang','en')
            ->update(['data' => $request->dataen]);

        LinksContent::where('key', 'HOW_TO_PLAY')
            ->where('lang','es')
            ->update(['data' => $request->dataes]);

        LinksContent::where('key', 'HOW_TO_PLAY')
            ->where('lang','fr')
            ->update(['data' => $request->datafr]);

        LinksContent::where('key', 'HOW_TO_PLAY')
            ->where('lang','th')
            ->update(['data' => $request->datath]);    

        return back()->with('success', 'Updated.');  
    }

    public function newsupdate(Request $request)
    {
        $request->validate([
            'dataen' => 'required|string',
            'datath' => 'required|string',
            'dataes' => 'required|string',
            'datafr' => 'required|string',
        ]);

        LinksContent::where('key', 'NEWS')
            ->where('lang','en')
            ->update(['data' => $request->dataen]);

        LinksContent::where('key', 'NEWS')
            ->where('lang','es')
            ->update(['data' => $request->dataes]);

        LinksContent::where('key', 'NEWS')
            ->where('lang','fr')
            ->update(['data' => $request->datafr]);

        LinksContent::where('key', 'NEWS')
            ->where('lang','th')
            ->update(['data' => $request->datath]);    

        return back()->with('success', 'Updated.');      
    }

    public function ourRetailers(Request $request)
    {
        $data = ourRetailersdata();
        return view('articals.ourRetailers', compact('data'));
    }

    public function promotions(Request $request)
    {
        $data = promotionsdata();
        return view('articals.promotions', compact('data'));
    }

    public function results(Request $request)
    {
        $data = resultsdata();
        return view('articals.results', compact('data'));
    }

    public function ourRetailersConfig(Request $request)
    {
        $dataen = ourRetailersConfigdata('en');
        $dataes = ourRetailersConfigdata('es');
        $datafr = ourRetailersConfigdata('fr');
        $datath = ourRetailersConfigdata('th');
        return view('admin.articles.ourRetailers', compact('dataen','dataes','datafr','datath'));
    }

    public function promotionsConfig(Request $request)
    {
        $dataen = promotionsConfigdata('en');
        $dataes = promotionsConfigdata('es');
        $datafr = promotionsConfigdata('fr');
        $datath = promotionsConfigdata('th');
        return view('admin.articles.promotions', compact('dataen','dataes','datafr','datath'));
    }

    public function resultsConfig(Request $request)
    {
        $dataen = resultsConfigdata('en');
        $dataes = resultsConfigdata('es');
        $datafr = resultsConfigdata('fr');
        $datath = resultsConfigdata('th');
        return view('admin.articles.results', compact('dataen','dataes','datafr','datath'));
    }

    public function ourRetailersupdate(Request $request)
    {
        $request->validate([
            'dataen' => 'required|string',
            'datath' => 'required|string',
            'dataes' => 'required|string',
            'datafr' => 'required|string',
        ]);

        LinksContent::where('key', 'OUR_RETAILERS')
            ->where('lang','en')
            ->update(['data' => $request->dataen]);

        LinksContent::where('key', 'OUR_RETAILERS')
            ->where('lang','es')
            ->update(['data' => $request->dataes]);

        LinksContent::where('key', 'OUR_RETAILERS')
            ->where('lang','fr')
            ->update(['data' => $request->datafr]);

        LinksContent::where('key', 'OUR_RETAILERS')
            ->where('lang','th')
            ->update(['data' => $request->datath]);

        return back()->with('success', 'Updated.');
    }

    public function promotionsupdate(Request $request)
    {
        $request->validate([
            'dataen' => 'required|string',
            'datath' => 'required|string',
            'dataes' => 'required|string',
            'datafr' => 'required|string',
        ]);

        LinksContent::where('key', 'PROMOTIONS')
            ->where('lang','en')
            ->update(['data' => $request->dataen]);

        LinksContent::where('key', 'PROMOTIONS')
            ->where('lang','es')
            ->update(['data' => $request->dataes]);

        LinksContent::where('key', 'PROMOTIONS')
            ->where('lang','fr')
            ->update(['data' => $request->datafr]);

        LinksContent::where('key', 'PROMOTIONS')
            ->where('lang','th')
            ->update(['data' => $request->datath]);    

        return back()->with('success', 'Updated.');  
    }

    public function resultsupdate(Request $request)
    {
        $request->validate([
            'dataen' => 'required|string',
            'datath' => 'required|string',
            'dataes' => 'required|string',
            'datafr' => 'required|string',
        ]);

        LinksContent::where('key', 'RESULTS')
            ->where('lang','en')
            ->update(['data' => $request->dataen]);

        LinksContent::where('key', 'RESULTS')
            ->where('lang','es')
            ->update(['data' => $request->dataes]);

        LinksContent::where('key', 'RESULTS')
            ->where('lang','fr')
            ->update(['data' => $request->datafr]);

        LinksContent::where('key', 'RESULTS')
            ->where('lang','th')
            ->update(['data' => $request->datath]);    

        return back()->with('success', 'Updated.');      
    }
}
