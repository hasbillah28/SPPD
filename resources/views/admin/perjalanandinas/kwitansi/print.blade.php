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
            font-size: 12pt;
        }
    </style>
</head>
<body>
@php
    $day = date('d');
    $year = date('Y')
@endphp
<div class=" mb-5 row text-black">
    <div class="row col-12">
        <div class="col-6">
        </div>

        <div class="col-6 row">
            <div>Peraturan Menteri Keuangan Republik Indonesia</div>
            <div>Nomor 190/PMK.05/2021</div>
            <div>Tanggal 29 November 2012</div>
        </div>
    </div>

    <div class="row">
        <div class="col-2">
            <img src="{{ asset('storage/logobpn.png') }}" style="width: 100px" class="avatar-img" alt="Logo BPN">
        </div>

        <div class="col-9 ms-0 align-middle">
            <br>
            <strong>Kantor Pertanahan Kabupaten Pesisir Selatan</strong><br>
            <strong>                Jl. Makam Pahlawan Sago - Painan
            </strong>
        </div>

    </div>

    <div class="">
        <table class="table table-bordered p-2">
            <tbody>
            <tr>
                <td>
                    <div class="row ms-1 me-1 mb-1">
                        <div class="row col-12">
                            <div class="col-7"></div>
                            <div class="col-5">
                                <div class="row col-12">

                                    <div class="col-6">TA</div>
                                    <div class="col-6">: 2021</div>


                                    <div class="col-6">Nomor Bukti</div>
                                    <div class="col-6">: {{ $kwitansi->nomor_bukti }}</div>

                                    <div class="col-6">Mata Anggaran</div>
                                    <div class="col-6">: {{ $kwitansi->mata_anggaran_1 }}</div>

                                    <div class="col-6"></div>
                                    <div class="col-6">{{" "."           ".$kwitansi->mata_anggaran_2 }}</div>

                                </div>
                            </div>
                        </div>

                        <div class="row col-12 text-center">
                            <strong>KWITANSI/BUKTI PEMBAYARAN</strong>
                        </div>

                        <br><br>

                        <div class="col-12">
                            <dl class="row col-12">
                                <dd class="col-3">Sudah terima dari</dd>
                                <dd class="row col-9">
                                    <div class="col-1">:</div>
                                    <div class="col-auto" style="margin-left: -4%">
                                        <div>Pejabat Pembuat Komitmen</div>
                                        <div>Kantor Pertanahan Kabupaten Pesisir Selatan</div>
                                    </div>
                                </dd>


                                <dd class="col-3">Jumlah Uang</dd>
                                <dd class="row col-9">
                                    <div class="col-1">:</div>
                                    <div class="col-auto" style="margin-left: -4%"><strong>Rp.{{ $jumlahUang }},-</strong></div>
                                </dd>

                                <dd class="col-3">Terbilang</dd>
                                <dd class="row col-9">
                                    <div class="col-1">:</div>
                                    <div class="col-auto" style="margin-left: -4%; text-transform: capitalize"><em>{{ $terbilang.' rupiah' }}</em></div>
                                </dd>

                                <dd class="col-3">Untuk Pembayaran</dd>
                                <dd class="row col-9">
                                    <div class="col-1">:</div>
                                    <div class="col-11 text-justify" style="margin-left: -4%">Biaya perjalanan dinas dalam rangka {{ $kwitansi->sppd->perjalanan->deskripsi }}, selama {{ $dayInterval }} hari pada tanggal {{ $daySurat.' '.$monthSurat.' '.$yearSurat }} @if($dayInterval>1) sampai pada tanggal {{ $daySuratsampai." ".$monthSuratsampai." ".$yearSuratsampai }} @endif bertempat di {{ $kwitansi->sppd->perjalanan->tempat }}.</div>
                                </dd>

                                <dd class="col-3"></dd>
                                <dd class="row col-9">
                                    <div class="col-1"></div>
                                    <div class="col-auto" style="margin-left: -4%">Uang Harian = Rp.{{ $uangHarian }}</div>
                                </dd>
                            </dl>
                        </div>
                        <br>
                        <div class="row ms-1 me-1 mb-1">
                            <div class="col-8"></div>
                            <div class="col-4">
                                <div>Painan, {{ $day.' '.$monthName.' '.$year }}</div>
                                <div>Yang Menerima,</div>
                                <br>
                                <br>
                                <br>
                                <div>{{ strtoupper($kwitansi->sppd->user->name) }}</div>
                                <div>NIP {{ $kwitansi->sppd->user->nip }}</div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="row ms-1 me-1">
                        <div class="col-8">
                            <div>Setuju dibebankan pada mata anggaran berkenaan,</div>
                            <div>a.n. Kuasa Pengguna Anggaran</div>
                            <div>Pejabat Pembuat Komitmen</div>
                            <br><br><br>
                            <div>{{ strtoupper($pejabat[0]->name) }}</div>
                            <div>NIP {{ $pejabat[0]->nip }}</div>
                        </div>

                        <div class="col-4">
                            <div>lunas dibayar Tgl. </div>
                            <div>Bendahara Pengeluaran</div>
                            <br><br><br><br>
                            <div>{{ strtoupper($bendahara[0]->name) }}</div>
                            <div>NIP {{ $bendahara[0]->nip }}</div>
                        </div>
                    </div>
                </td>
            </tr>

            </tbody>

        </table>
    </div>

</div>
<script>
    window.print();

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script>
</body>
</html>
