@extends('admin.layout.app')
@section('content')
<div class="card shadow">
    <div class="card-header"><h4>Banners</h4></div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Path</th>
                    <th>Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td>{{ $banner->name }}</td>
                    <td>{{ strtoupper($banner->type) }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.banners.update', $banner->id) }}">
                            @csrf @method('PUT')
                            <input type="text" name="path" value="{{ $banner->path }}" class="form-control">
                    </td>
                    <td>
                            <button class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
