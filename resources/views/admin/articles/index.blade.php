@extends('admin.layout.app')
@section('content')
<div class="card shadow">
    <div class="card-header"><h4>Articles</h4></div>
    <div class="card-body">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Publish</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->name }}</td>
                    <td>
                        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST">
                            @csrf @method('PUT')
                            <button class="btn btn-sm {{ $article->publish ? 'btn-success' : 'btn-secondary' }}">
                                {{ $article->publish ? 'Published' : 'Unpublished' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
