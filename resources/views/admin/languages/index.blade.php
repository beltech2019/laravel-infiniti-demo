@extends('admin.layout.app')
@section('content')
<div class="card shadow">
    <div class="card-header"><h4>Languages</h4></div>
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
                @foreach($languages as $language)
                <tr>
                    <td>{{ $language->id }}</td>
                    <td>{{ $language->name }}</td>
                    <td>
                        <form action="{{ route('admin.languages.update', $language->id) }}" method="POST">
                            @csrf @method('PUT')
                            <button class="btn btn-sm {{ $language->publish ? 'btn-success' : 'btn-secondary' }}">
                                {{ $language->publish ? 'Published' : 'Unpublished' }}
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
