@extends('master.main')

@section('content')
<h2>Input Pemeriksaan Manual</h2>

<div id="results" style="margin-top: 20px;"></div>
@endsection

@section('page-scripts')
<script>
    function addRow() {
        const row = document.createElement('div');
        row.classList.add('row');
        row.innerHTML = `
            <input type="text" name="pemeriksaan[]" placeholder="Pemeriksaan" required>
            <input type="text" name="hasil[]" placeholder="Hasil" required>
            <input type="text" name="nilai[]" placeholder="Nilai Rujukan / Keterangan">
            <button type="button" onclick="removeRow(this)">❌</button>
        `;
        document.getElementById('form-rows').appendChild(row);
    }

    function removeRow(button) {
        button.parentElement.remove();
    }

    $('#labForm').on('submit', function(e) {
        e.preventDefault();

        const form = new FormData(this);
        const rows = [];

        const pemeriksaan = form.getAll('pemeriksaan[]');
        const hasil = form.getAll('hasil[]');
        const nilai = form.getAll('nilai[]');

        for (let i = 0; i < pemeriksaan.length; i++) {
            if (pemeriksaan[i].trim() && hasil[i].trim()) {
                rows.push({
                    pemeriksaan: pemeriksaan[i],
                    hasil: hasil[i],
                    nilai: nilai[i]
                });
            }
        }

        $.ajax({
            url: "{{ route('lab.extract') }}",
            type: "POST",
            data: JSON.stringify({ rows }),
            contentType: "application/json",
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                let html = '<h3>Results:</h3><ul>';
                response.received_rows.forEach(item => {
                    html += `<li><strong>${item.pemeriksaan}</strong>: ${item.hasil} (${item.nilai})</li>`;
                });
                html += '</ul>';
                $('#results').html(html);
            },
            error: function(xhr) {
                alert('Submit failed!');
                console.error(xhr.responseText);
            }
        });
    });
</script>
@endsection
