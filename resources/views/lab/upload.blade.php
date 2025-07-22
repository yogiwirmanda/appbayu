@extends('master.main')
@section('content')
<h2>Upload PDF Lab Result</h2>

<form id="uploadForm" enctype="multipart/form-data">
    @csrf
    <input type="file" name="pdf_file" accept="application/pdf" required>
    <button type="submit">Upload</button>
</form>

<div id="results" style="margin-top: 20px;"></div>
@endsection
@section('page-scripts')
<script>
    $('#uploadForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('lab.extract') }}",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                let html = '<h3>Results:</h3><ul>';
                response.results.forEach(item => {
                    html += `<li><strong>${item.pemeriksaan}:</strong> ${item.hasil}</li>`;
                });
                html += '</ul>';
                $('#results').html(html);
            },
            error: function(xhr) {
                alert('Upload failed: ' + xhr.responseJSON.message);
            }
        });
    });
</script>
@endsection