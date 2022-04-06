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
        <b><u>LAPORAN JUMLAH PENYAKIT TERBANYAK</u></b>
    </p>

    <table cellpadding=0 border="0" cellspacing="0" align="center">
        <tr>
            <td width="250" class="column thead" align="center"><strong>NAMA PENYAKIT</strong></td>
            <td width="250" class="column thead" align="center"><strong>JUMLAH</strong></td>
        </tr>

        @foreach ($keluhan as $item)
        <tr>
            <td class="column">{{ $item->nama }}</td>
            <td class="column">{{ $item->jumlah }}</td>
        </tr>
        @endforeach
    </table>
</page>