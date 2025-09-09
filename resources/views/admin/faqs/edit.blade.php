@extends('admin.layout.app')
@section('content')
<div class="card shadow">
    <div class="card-header"><h4>Edit FAQ</h4></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.faqs.update', $faq->id) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Question</label>
                <input type="text" name="question" class="form-control" value="{{ $faq->question }}" required>
            </div>
            <div class="mb-3">
                <label>Answer</label>
                <textarea name="answer" class="form-control" required>{{ $faq->answer }}</textarea>
            </div>
            <button class="btn btn-primary">Update FAQ</button>
        </form>
    </div>
</div>
@endsection
