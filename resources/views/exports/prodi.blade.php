<table>
    <thead>
        <tr>
            <th><b>KODE FAKULTAS</b></th>
            <th><b>FAKULTAS</b></th>
            <th><b>NAMA PRODI</b></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($prodi as $item)
        <tr>
            <td>{{ $item['fakultas']['kode'] }}</td>
            <td>{{ $item['fakultas']['nama'] }}</td>
            <td>{{ $item['nama'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>