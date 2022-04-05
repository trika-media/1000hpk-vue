<table>
    <thead>
        <tr>
            <th><b>KODE</b></th>
            <th><b>NAMA</b></th>
            <th><b>KELOMPOK</b></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($penyakit as $item)
        <tr>
            <td>{{ $item['kode'] }}</td>
            <td>{{ $item['nama'] }}</td>
            <td>{{ $item['kelompok'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>