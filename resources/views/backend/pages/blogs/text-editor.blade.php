<div class="mb-4">
    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
        Add Your Content
    </label>
    <textarea id="editor" name="content">{{ old('content', $blog?->content ?? '') }}</textarea>
</div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#editor').summernote({
                height: 400,
                placeholder: 'Write your content...'
            });
        });
    </script>
@endpush
