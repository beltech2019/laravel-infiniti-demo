@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header"><h4>Add FAQ</h4></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.faqs.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Question English</label>
                        <input type="text" name="questionen" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Answer English</label>
                        <textarea name="answeren" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Question Spanish</label>
                        <input type="text" name="questiones" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Answer Spanish</label>
                        <textarea name="answeres" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Question French</label>
                        <input type="text" name="questionfr" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Answer French</label>
                        <textarea name="answerfr" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Question Thai</label>
                        <input type="text" name="questionth" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Answer Thai</label>
                        <textarea name="answerth" class="form-control" required></textarea>
                    </div>
                    <button class="btn btn-primary">Add FAQ</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header"><h4>FAQs</h4></div>
            <div class="card-body">
                @foreach($faqs as $lang => $langFaqs)
                    <h5 class="mt-3 text-primary">
                        {{ $languages[$lang] ?? strtoupper($lang) }} FAQs
                    </h5>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($langFaqs as $faq)
                            <tr>
                                <td>{{ $faq->id }}</td>
                                <td>{{ $faq->question }}</td>
                                <td>{{ $faq->answer }}</td>
                                <td>
                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" 
                                    class="btn btn-sm p-0 border-0 bg-transparent text-warning" 
                                    title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" 
                                        method="POST" 
                                        style="display:inline;">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm p-0 border-0 bg-transparent text-danger" 
                                                title="Delete"
                                                onclick="return confirm('Delete this FAQ?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
