<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dinas Pertanahan</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        body {
            font-family: "Times New Roman", TimesNewRoman, serif;
        }
    </style>
</head>
<body>
@php
    $day = date('d');
    $year = date('Y')
@endphp
<div class="mt-3 mb-5 row text-black">
    <div class="row" style="padding-left: 15pt">

        <div class="col-2" style="">
            <img width="150px" src="{{ asset('storage/logobpn.png') }}" alt="Image">
        </div>

        <div class="col-9 text-center align-middle">
            <div><h4><strong>KEMENTERIAN AGRARIA DAN TATA RUANG/</strong></h4></div>
            <div style="margin-top: -6pt"><h4><strong>BADAN PERTANAHAN NASIONAL</strong></h4></div>
            <h5 style="margin-top: -6pt"><strong>KANTOR PERTANAHAN KABUPATEN PESISIR SELATAN PROVINSI SUMATERA BARAT</strong></h5>
            <div style="margin-top: -1%"> Jln. Makam Pahlawan Sago, Telp. (0756) 7464402 PAINAN </div>
            <div>Email: kantahpessel@yahoo.com</div>
        </div>
    </div>

    <br> <br> <br> <br>

    <div style="font-size: 12pt" class="row mt-5">
        <h5 class="text-center"><strong><u>SURAT TUGAS</u></strong></h5>
        <div style="margin-top: -7pt" class="text-center">NOMOR: {{ $perjalanan->no_surat_tugas }}</div>
        <dl class="row mb-3">
            <dd class="col-3 row">
                <div class="col-10">Menimbang</div>
                <div class="col-2">:</div>
            </dd>
            <dd class="col-9">
                <ol style="margin-left: -16pt; " type="a">
                    <li style="text-align: justify">Bahwa dalam rangka {{ $perjalanan->deskripsi }}</li>
                    <br>
                    <li style="text-align: justify">Bahwa sehubungan dengan hal tersebut pada butir a, perlu menugaskan pegawai untuk mengikuti acara tersebut</li>
                </ol>
            </dd>

            <dd class="col-3 row">
                <div class="col-10">Dasar</div>
                <div class="col-2">:</div>
            </dd>
            <dd style="text-align: justify" class="col-9">Daftar Isian Pelaksana Anggaran Kantor Pertanahan Kabupaten Pesisir Selatan Tahun Anggaran {{ $year }}</dd>

            <dd class="col-3"></dd>
            <dd class="col-7 text-center"><strong>MEMBERI TUGAS :</strong> </dd>

            <dd class="col-3 row">
                <div class="col-10">Kepada</div>
                <div class="col-2">:</div>
            </dd>
            <dd class="col-9">
                @if($perjalanan->anggotas->count() > 1)
                    <ol style="text-align: justify; margin-left: -16pt" type="1">
                        @foreach($perjalanan->anggotas as $anggota)
                            <li>{{ strtoupper($anggota->user->name) }} NIP {{ $anggota->user->nip }} {{ $anggota->user->jabatan->nama_jabatan }} Kantor Pertanahan Kabupaten Pesisir Selatan.</li>
                            <br>
                        @endforeach
                    </ol>
                @else
                    @foreach($perjalanan->anggotas as $anggota)
                        {{ strtoupper($anggota->user->name) }} NIP {{ $anggota->user->nip }} {{ $anggota->user->jabatan->nama_jabatan }} Kantor Pertanahan Kabupaten Pesisir Selatan.
                    @endforeach
                @endif
            </dd>

            <dd class="col-3 row">
                <div class="col-10">Untuk</div>
                <div class="col-2">:</div>
            </dd>
            <dd style="text-align: justify" class="col-9">Melaksanakan Perjalananan Dinas dalam rangka Mengikuti {{ $perjalanan->deskripsi }}, selama {{ $dayInterval }} hari pada tanggal {{ $daySurat." ".$monthSurat." ".$yearSurat }} @if($dayInterval>1) sampai pada tanggal {{ $daySuratsampai." ".$monthSuratsampai." ".$yearSuratsampai }} @endif  bertempat di {{ $perjalanan->tempat }}.</dd>
        </dl>

        <div class="col-6"></div>
        <div class="row col-6 text-center">
            <div>Painan, {{ $day." ".$monthName." ".$year }}</div>
            <div><strong>KEPALA KANTOR PERTANAHAN</strong></div>
            <div class="mb-5"><strong>KABUPATEN PESISIR SELATAN</strong></div>
            <div class="mb-3"></div>
            <div><strong><u>{{ $kakan[0]->name }}</u></strong></div>
            <div><strong>NIP {{ $kakan[0]->nip }}</strong></div>
        </div>
    </div>
</div>
<script>
    window.print();
</script>
</body>
</html>
