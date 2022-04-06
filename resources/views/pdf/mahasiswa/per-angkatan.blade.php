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
        <b><u>LAPORAN MAHASISWA PER ANGKATAN</u></b>
    </p>

    <table cellpadding=0 border="0" cellspacing="0" align="left">
        <tr>
            <td width="90" class="column thead" align="center"><strong>NIM</strong></td>
            <td width="150" class="column thead" align="center"><strong>NAMA LENGKAP</strong></td>
            <td width="100" class="column thead" align="center"><strong>ANGKATAN</strong></td>
            <td width="130" class="column thead" align="center"><strong>EMAIL</strong></td>
            <td width="130" class="column thead" align="center"><strong>NOMOR PONSEL</strong></td>
        </tr>

        @foreach ($mahasiswa as $item)
        <tr>
            <td class="column">{{ $item->nim }}</td>
            <td class="column">{{ $item->nama }}</td>
            <td class="column">{{ $item->angkatan }}</td>
            <td class="column">{{ $item->akun->email }}</td>
            <td class="column">{{ $item->nomor_ponsel }}</td>
        </tr>
        @endforeach
    </table>
</page>