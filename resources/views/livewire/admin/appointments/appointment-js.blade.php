@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#note'));
        $('form').submit(function () {
        @this.set('state.note', $('#note').val());
        })
    </script>
@endpush
