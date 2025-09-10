@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.responsibleGamingupdate') }}" method="POST">
            @csrf
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Responsible Gaming</h5>
                </div>
                <div class="card-body" style="min-height: 420px;">
                    <textarea id="tinyeditor" class="form-control tinytextarea" name="data" rows="15">{!! $data->data ?? '' !!}</textarea>
                </div>
            </div>
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary">Save Responsible Gaming</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script rel="preload" src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    function alertInvalidAPI() {
        alert("TinyMCE cannot load: please check your API key.");
        console.error("TinyMCE API key is missing or invalid.");
    }

    try {
        if (typeof tinymce !== "undefined") {

            if (tinymce.get('tinyeditor')) tinymce.get('tinyeditor').remove();

            tinymce.init({
                selector: '#tinyeditor',
                height: 400,
                menubar: false,
                plugins: 'lists link image preview code',
                toolbar: 'undo redo | bold italic underline | bullist numlist | link image | preview code',
                branding: false,
                entity_encoding: 'raw',
                setup: function(editor) {
                    editor.on('init', function() {
                        // Check if the editor loaded correctly
                        if (!editor.getContainer()) {
                            alertInvalidAPI();
                        }
                    });
                }
            });

        } else {
            alertInvalidAPI();
        }
    } catch (e) {
        alertInvalidAPI();
    }

});
</script>
@endpush
