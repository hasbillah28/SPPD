@php
$i = 0
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Perjalanan Dinas</title>

    <style media="print">
        @page  {
            size: landscape;
            font-size: xx-small;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="containers">
    <div class="row mb-3">

        <div class="text-center align-middle">
            <div><h4><strong>KEMENTERIAN AGRARIA DAN TATA RUANG/</strong></h4></div>
            <div style="margin-top: -6pt"><h4><strong>BADAN PERTANAHAN NASIONAL</strong></h4></div>
            <h5 style="margin-top: -6pt"><strong>KANTOR PERTANAHAN KABUPATEN PESISIR SELATAN PROVINSI SUMATERA BARAT</strong></h5>
            <div style="margin-top: -1%"> Jln. Makam Pahlawan Sago, Telp. (0756) 7464402 PAINAN </div>
            <div>Email: kantahpessel@yahoo.com</div>
        </div>
    </div>

    <table id="table" class="table table-sm table-bordered">
        <thead>
        <tr class="align-middle">
            <th>No</th>
            <th>Tanggal</th>
            <th>Nomor SPPD</th>
            <th>Nama Pegawai</th>
            <th>Jabatan</th>
            <th>Maksud Tujuan</th>
            <th>Tempat Tujuan</th>
            <th>Lamanya</th>
        </tr>
        </thead>
        <tbody style="font-size: small">
        @forelse ($sppd as $surat)
            @if($surat->perjalanan->no_surat_tugas != null)
                <tr class="align-middle text-sm-start">
                    <td class="mt-5">{{ ++$i }}</td>
                    <td>{{ $surat->perjalanan->tanggal_berangkat }}</td>
                    <td>{{ $surat->no_sppd }}</td>
                    <td>{{ $surat->user->name }}</td>
                    <td>{{ $surat->user->jabatan->nama_jabatan }}</td>
                    <td>{{ $surat->perjalanan->deskripsi }}</td>
                    <td>{{ $surat->perjalanan->tempat }}</td>
                    <td>{{ (date_diff(date_create($surat->perjalanan->tanggal_berangkat), date_create($surat->perjalanan->tanggal_kembali))->days + 1).' hari' }}</td>
                </tr>
            @endif
        @empty
            <tr class="text-center">
                <td colspan="8">Tidak ada pada rentang tanggal yang ditentukan</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
<script>
    window.print();
</script>
</body>
</html>

