@extends('admin.layout.app')
@section('content')
<div class="card shadow">
    <div class="card-header"><h4>Games</h4></div>
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
                @foreach($games as $game)
                <tr>
                    <td>{{ $game->id }}</td>
                    <td>{{ $game->name }}</td>
                    <td>
                        <form action="{{ route('admin.games.update', $game->id) }}" method="POST">
                            @csrf @method('PUT')
                            <button class="btn btn-sm {{ $game->publish ? 'btn-success' : 'btn-secondary' }}">
                                {{ $game->publish ? 'Published' : 'Unpublished' }}
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
