<page backtop="30mm" backbottom="10mm" backleft="2mm" backright="2mm">
    <style>
        .column {
            border: 1px solid #000;
            padding: 10px;
        }

        .thead {
            background-color: #d6d6d6;
        }
    </style>

    <p align="left">
        <b><u>DETAIL IBU HAMIL</u></b>
    </p>

    <table cellpadding=0 border="0" cellspacing="0" align="left">
        <tr>
            <td class="column thead">Identitas</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->identitas }}</td>
        </tr>
        <tr>
            <td class="column thead">Nama</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->nama }}</td>
        </tr>
        <tr>
            <td class="column thead">Alamat</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->alamat }}</td>
        </tr>
        <tr>
            <td class="column thead">Nomor Ponsel</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->nomor_ponsel }}</td>
        </tr>
        <tr>
            <td class="column thead">Tanggal Lahir</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->tanggal_lahir->format('d/m/Y') }}</td>
        </tr>
    </table>

    <p align="left">
        <b><u>PUSKESMAS DAN KELUHAN</u></b>
    </p>

    <table cellpadding=0 border="0" cellspacing="0" align="left">
        <tr>
            <td class="column thead">Puskesmas</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->puskesmas->nama }}</td>
        </tr>
        <tr>
            <td class="column thead">Keluhan</td>
            <td class="column">:</td>
            <td class="column">
                @foreach ($ibuhamil->keluhan as $keluhan)
                - {{ $keluhan->penyakit->nama ?? $keluhan->nama_penyakit }} <br>
                @endforeach
            </td>
        </tr>
    </table>

    <p align="left">
        <b><u>DETAIL ALAMAT</u></b>
    </p>

    <table cellpadding=0 border="0" cellspacing="0" align="left">
        <tr>
            <td class="column thead">Kelurahan</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->kelurahan->name }}</td>
        </tr>
        <tr>
            <td class="column thead">Kecamatan</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->kecamatan->name }}</td>
        </tr>
        <tr>
            <td class="column thead">Kab/Kota</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->kabupaten->name }}</td>
        </tr>
        <tr>
            <td class="column thead">Provinsi</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->provinsi->name }}</td>
        </tr>
        <tr>
            <td colspan="3" class="column thead"></td>
        </tr>
        <tr>
            <td class="column thead">Lat</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->lat }}</td>
        </tr>
        <tr>
            <td class="column thead">Lng</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->lng }}</td>
        </tr>
    </table>

    <p align="left">
        <b><u>DIINPUT OLEH MAHASISWA</u></b>
    </p>

    <table cellpadding=0 border="0" cellspacing="0" align="left">
        <tr>
            <td class="column thead">NIM</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->mahasiswa->nim }}</td>
        </tr>
        <tr>
            <td class="column thead">Nama</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->mahasiswa->nama }}</td>
        </tr>
        <tr>
            <td class="column thead">Angkatan</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->mahasiswa->angkatan }}</td>
        </tr>
        <tr>
            <td class="column thead">Nomor Ponsel</td>
            <td class="column">:</td>
            <td class="column">{{ $ibuhamil->mahasiswa->nomor_ponsel }}</td>
        </tr>
    </table>
</page>