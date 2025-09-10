@extends('admin.layout.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.privacyPolicyupdate') }}" method="POST">
            @csrf
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Privacy Policy</h5>
                </div>
                <div class="card-body">
                    <textarea class="form-control tinytextarea" name="data" rows="10">{!! $data->data ?? '' !!}</textarea>
                </div>
            </div>
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary">Save Privacy Policy</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script rel="preload" src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const warning = document.getElementById('tinymce-warning');

    try {
        if (typeof tinymce !== "undefined") {

            // Remove previous instance if any
            tinymce.remove('textarea.tinytextarea');

            tinymce.init({
                selector: 'textarea.tinytextarea',
                height: 400,
                menubar: false,
                plugins: 'lists link image preview code',
                toolbar: 'undo redo | bold italic underline | bullist numlist | link image | preview code',
                branding: false,
                setup: function(editor) {
                    editor.on('init', function() {
                        if (!editor.getContainer()) {
                            warning.classList.remove('d-none');
                            console.error("TinyMCE failed to load.");
                        }
                    });
                }
            });

        } else {
            warning.classList.remove('d-none');
            console.error("TinyMCE not found.");
        }
    } catch (e) {
        warning.classList.remove('d-none');
        console.error("TinyMCE initialization error:", e);
    }
});
</script>
@endpush
