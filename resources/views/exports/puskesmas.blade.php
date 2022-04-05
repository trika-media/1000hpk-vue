<table>
    <thead>
        <tr>
            <th><b>NAMA</b></th>
            <th><b>ALAMAT</b></th>
            <th><b>KELURAHAN</b></th>
            <th><b>KECAMATAN</b></th>
            <th><b>KAB/KOTA</b></th>
            <th><b>PROVINSI</b></th>
            <th><b>LAT</b></th>
            <th><b>LNG</b></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($puskesmas as $item)
        <tr>
            <td>{{ $item['nama'] }}</td>
            <td>{{ $item['alamat'] }}</td>
            <td>{{ $item['kelurahan']['name'] }}</td>
            <td>{{ $item['kecamatan']['name'] }}</td>
            <td>{{ $item['kabupaten']['name'] }}</td>
            <td>{{ $item['provinsi']['name'] }}</td>
            <td>{{ $item['lat'] }}</td>
            <td>{{ $item['lng'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>