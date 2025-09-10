@extends('layouts.app') {{-- or your frontend layout --}}
@section('content')
<div class="w-100" style="color: #000; margin: 0; padding: 15px;">
    {!! $data !!}
</div>
@endsection
