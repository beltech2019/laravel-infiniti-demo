@extends('layouts.app') {{-- or your frontend layout --}}

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Frequently Asked Questions</h2>
    <div class="accordion" id="faqAccordion">
        @foreach($faqs as $faq)
            <div class="accordion-item mb-2">
                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                        {{ $faq->question }}
                    </button>
                </h2>
                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        {!! nl2br(e($faq->answer)) !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
