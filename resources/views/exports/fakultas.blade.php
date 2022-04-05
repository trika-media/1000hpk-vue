<table>
    <thead>
        <tr>
            <th><b>KODE</b></th>
            <th><b>NAMA</b></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($fakultas as $item)
        <tr>
            <td>{{ $item['kode'] }}</td>
            <td>{{ $item['nama'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>