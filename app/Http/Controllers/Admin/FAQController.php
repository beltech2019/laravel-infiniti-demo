<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = FAQ::orderBy('lang')->get()->groupBy('lang');

        $languages = [
            'en' => 'English',
            'fr' => 'French',
            'es' => 'Spanish',
            'th' => 'Thai',
        ];

        return view('admin.faqs.index', compact('faqs', 'languages'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'questionen' => 'required|string|max:255',
            'answeren' => 'required|string',
            'questiones' => 'required|string|max:255',
            'answeres' => 'required|string',
            'questionfr' => 'required|string|max:255',
            'answerfr' => 'required|string',
            'questionth' => 'required|string|max:255',
            'answerth' => 'required|string',
        ]);

        FAQ::create([
            'lang' => 'en',
            'question' => $request->questionen,
            'answer' => $request->answeren
        ]);
        FAQ::create([
            'lang' => 'es',
            'question' => $request->questiones,
            'answer' => $request->answeres
        ]);
        FAQ::create([
            'lang' => 'th',
            'question' => $request->questionth,
            'answer' => $request->answerth
        ]);
        FAQ::create([
            'lang' => 'fr',
            'question' => $request->questionfr,
            'answer' => $request->answerfr
        ]);
        return back()->with('success', 'FAQ added successfully.');
    }

    public function edit(FAQ $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, FAQ $faq)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq->update($request->only('question', 'answer'));
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(FAQ $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ deleted successfully.');
    }
}
