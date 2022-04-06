<page backtop="30mm" backbottom="10mm" backleft="2mm" backright="2mm">
    <style>
        .column {
            border: 1px solid #000;
            padding: 4px;
        }

        .thead {
            background-color: #d6d6d6;
        }
    </style>

    <p align="center">
        <b><u>LAPORAN PROFIL IBU HAMIL</u></b>
    </p>

    <table cellpadding=0 border="0" cellspacing="0" align="left">
        <tr>
            <td width="170" class="column thead" align="center"><strong>NAMA LENGKAP</strong></td>
            <td width="170" class="column thead" align="center"><strong>ALAMAT</strong></td>
            <td width="130" class="column thead" align="center"><strong>KAB/KOTA</strong></td>
            <td width="130" class="column thead" align="center"><strong>PROVINSI</strong></td>
            <td width="130" class="column thead" align="center"><strong>NOMOR PONSEL</strong></td>
            <td width="130" class="column thead" align="center"><strong>TANGGAL LAHIR</strong></td>
        </tr>

        @foreach ($ibuhamil as $item)
        <tr>
            <td class="column">{{ $item->nama }}</td>
            <td class="column">{{ $item->alamat }}</td>
            <td class="column">{{ $item->kabupaten->name }}</td>
            <td class="column">{{ $item->provinsi->name }}</td>
            <td class="column">{{ $item->nomor_ponsel }}</td>
            <td class="column">{{ $item->tanggal_lahir }}</td>
        </tr>
        @endforeach
    </table>
</page>