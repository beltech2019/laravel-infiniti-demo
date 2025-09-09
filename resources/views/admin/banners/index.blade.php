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
                    <th>Current Image</th>
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
                        @if($banner->path)
                            <img src="{{ asset($banner->path) }}" alt="banner" width="100">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                    </td>

                    <td>
                        <form method="POST" action="{{ route('admin.banners.update', $banner->id) }}" enctype="multipart/form-data">
                            @csrf @method('PUT')

                            <div class="input-group">
                                {{-- Path textbox --}}
                                <input type="text" 
                                       name="path" 
                                       value="{{ $banner->path }}" 
                                       class="form-control" 
                                       id="pathInput{{ $banner->id }}" 
                                       readonly>

                                {{-- File chooser restricted by type --}}
                                <input type="file" 
                                       name="file" 
                                       class="d-none" 
                                       id="fileInput{{ $banner->id }}" 
                                       accept=".{{ strtolower($banner->type) }}">

                                <button type="button" 
                                        class="btn btn-secondary" 
                                        onclick="document.getElementById('fileInput{{ $banner->id }}').click()">
                                    Choose
                                </button>
                            </div>

                            <script>
                                document.getElementById('fileInput{{ $banner->id }}').addEventListener('change', function(e) {
                                    if (e.target.files.length > 0) {
                                        document.getElementById('pathInput{{ $banner->id }}').value = 'images/' + e.target.files[0].name;
                                    }
                                });
                            </script>
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
