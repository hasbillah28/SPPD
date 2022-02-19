<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Surat Perjalanan Dinas</title>
    <style>
        body {
            font-size: 9pt;
            font-family: "Times New Roman", serif;
        }

        div.chapter {
            page-break-after: always;
        }
    </style>
</head>
<body>
@foreach($perjalananUser as $perjalanan)
    <div class="container">
        <div class="row">
            <div class="col-6 row">
                <div class="text-center"><strong>KEMENTRIAN AGRARIA DAN TATA RUANG/</strong></div>
                <div class="text-center"><strong>BADAN PERTANAHAN NASIONAL</strong></div>
                <div class="text-center"><strong>KANTOR PERTANAHAN KAB.PESISIR SELATAN</strong></div>
            </div>

            <div class="col-2"></div>

            <div class="col-4 row">
                <div class=""><strong>Lembar Ke    : I/II/III/1V/V/VI</strong></div>
                <div class=""><strong>Kode No.      :</strong></div>
                <div class=""><strong>Nomor          : {{ $noSppd }}</strong></div>
            </div>
        </div>

        <div class="text-center row mt-4 mb-2">
            <strong>SURAT PERJALANAN DINAS</strong>
        </div>

        <div class="row">
            <table class="table table-bordered border-dark">
                <tbody>
                <tr>
                    <td>1</td>
                    <td style="width: 40%">Pejabat Pembuat Komitmen</td>
                    <td class="text-center"> <strong> KANTOR PERTANAHAN <br> KABUPATEN PESISIR SELATAN</strong></td>
                </tr>

                <tr>
                    <td class="align-middle">2</td>
                    <td class="align-middle">
                        Nama/NIP Pegawai yang <br> melaksanakan
                        perjalanan dinas </td>
                    <td>
                        <strong>
                            {{ strtoupper($perjalanan->user->name) }}
                            <br>
                            NIP {{ $perjalanan->user->nip }}
                        </strong>
                    </td>
                </tr>

                <tr>
                    <td rowspan="3">3</td>
                    <td>a. Pangkat/Golongan</td>

                    <td style="text-align: justify">a. {{ $perjalanan->user->pangkat->nama_pangkat }} ({{ $perjalanan->user->golongan->nama_golongan }})</td>
                </tr>
                <tr>
                    <td>b. Jabatan/Instansi</td>
                    <td style="text-align: justify">b. {{ $perjalanan->user->jabatan->nama_jabatan }} / Kantor Pertanahan Kab. Pesisir Selatan</td>
                </tr>
                <tr>
                    <td>c. Tingkat Biaya Perjalanan Dinas</td>
                    <td>c. -</td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>Maksud Perjalanan Dinas</td>
                    <td style="text-align: justify">Dalam rangka {{ $perjalanan->perjalanan->deskripsi }}, bertempat di {{ $perjalanan->perjalanan->tempat }}</td>
                </tr>

                <tr>
                    <td>5</td>
                    <td>Alat angkutan yang digunakan</td>
                    <td style="text-align: justify">{{ $perjalanan->perjalanan->angkutan->nama_angkutan }}</td>
                </tr>

                <tr>
                   <td>6</td>
                    <td>
                        a. Tempat Berangkat
                        <br>
                        b. Tempat Tujuan
                    </td>

                    <td>
                        a. {{ $perjalanan->perjalanan->tempat_berangkat }}
                        <br>
                        b. {{ $perjalanan->perjalanan->tempat_tujuan }}
                    </td>
                </tr>

                <tr>
                    <td>7</td>
                    <td>
                        a. Lamanya Perjalanan Dinas
                        <br>
                        b. Tanggal berangkat
                        <br>
                        c. Tanggal harus kembali
                    </td>
                    <td>
                        a. {{ $dayInterval }} hari
                        <br>
                        b. {{str_replace("-", " ", $perjalanan->perjalanan->tanggal_berangkat)}}
                        <br>
                        c. {{ str_replace("-", " ", $perjalanan->perjalanan->tanggal_kembali)}}
                    </td>
                </tr>

                <tr>
                    <td>8</td>
                    <td>
                        <div class="row">
                            <div class="col-6">Pengikut</div>
                            <div class="col-6">Nama</div>
                        </div>
                    </td>

                    <td>
                        Tanggal lahir
                        keterangan
                    </td>
                </tr>

                <tr>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td>9</td>
                    <td>
                        Pembebanan Anggaran
                        <br>
                        a. Instansi
                        <br>
                        b. Akun
                    </td>

                    <td>
                        <br>
                        a. Kantor Pertanahan Kabupaten Pesisir Selatan
                        <br>
                        b. -
                    </td>
                </tr>

                <tr>
                    <td>10</td>
                    <td>Keterangan lain-lain</td>
                    <td>Surat Tugas No {{ $perjalanan->perjalanan->no_surat_tugas }}</td>
                </tr>
                </tbody>
            </table>


        </div>
@php
$tanggal = date('d');
$tahun = date('y');
@endphp
        <div class="row chapter">
            <div class="col-8"></div>
            <div class="col-4">
                <div class="row">Dikeluarkan di: Painan</div>
                <div class="row">Tanggal {{ $tanggal." ".$printDate." ".$tahun}}</div>
                <div class="row text-center"><strong>PEJABAT PEMBUAT KOMITMEN</strong></div>
                <br>
                <br>
                <br>
                <div class="row text-center"><strong><u>{{ strtoupper($pejabat[0]->name) }}</u></strong></div>
                <div class="row text-center"><strong>NIP. {{ $pejabat[0]->nip }}</strong></div>
            </div>
        </div>

        <div class="row">
            <table class="table table-bordered border-dark">
                <tbody>
                <tr>
                    <td style="width: 50%"></td>
                    <td style="width: 50%">
                        <table class="table table-borderless mt-0 mb-0">
                            <tr>
                                <td style="width: 3%">I.</td>
                                <td style="width: 40%">
                                    Berangkat dari
                                    <br>
                                    Ke
                                    <br>
                                    Pada Tanggal
                                </td>

                                <td>
                                    : {{ $perjalanan->perjalanan->tempat_berangkat }}
                                    <br>
                                    : {{ $perjalanan->perjalanan->tempat_tujuan }}
                                    <br>
                                    : {{ str_replace("-", " ", $perjalanan->perjalanan->tanggal_berangkat)}}
                                </td>
                            </tr>
                        </table>
                        <div class="text-center"><strong>A.n KEPALA KANWIL BPN PROV SUMBAR</strong></div>
                        <div class="text-center"><strong>KEPALA KANTOR PERTANAHAN</strong></div>
                        <div class="text-center"><strong>KABUPATEN PESISIR SELATAN</strong></div>
                        <br>
                        <br>
                        <br>
                        <div class="text-center"><strong>{{ strtoupper($kakan[0]->name) }}</strong></div>
                        <div class="text-center"><strong>NIP. {{ $kakan[0]->nip }}</strong></div>
                    </td>
                </tr>

                @php $i = 0 @endphp

                @forelse($perjalanan->perjalanan->riwayat as $riwayat)
                    <tr>
                        <td>
                            <table class="table-borderless table mt-0 mb-0">
                                <tr>
                                    <td style="width: 3%">{{ $nomor[$i++] }}.</td>
                                    <td style="width: 40%;">
                                        Tiba di
                                        <br>
                                        Pada Tanggal
                                    </td>
                                    <td>
                                        : {{ $riwayat->tiba_di }}
                                        <br>
                                        : {{ $riwayat->tiba_di_tanggal }}
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table class="table-borderless table mt-0 mb-0">
                                <tr>
                                    <td style="width: 3%"></td>
                                    <td style="width: 40%;">
                                        Berangkat Dari
                                        <br>
                                        Ke
                                        <br>
                                        Pada Tanggal
                                    </td>
                                    <td>
                                        : {{ $riwayat->tiba_di }}
                                        <br>
                                        : {{ $riwayat->berangkat_ke }}
                                        <br>
                                        : {{ $riwayat->berangkat_tanggal }}
                                        @if($i == 1)
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td>
                            <table class="table-borderless table mt-0 mb-0">
                                <tr>
                                    <td style="width: 3%">II.</td>
                                    <td style="width: 40%;">
                                        Tiba di
                                        <br>
                                        Pada Tanggal
                                    </td>
                                    <td>
                                        : {{ $perjalanan->perjalanan->tempat_tujuan }}
                                        <br>
                                        : {{ str_replace("-", " ", $perjalanan->perjalanan->tanggal_berangkat)}}
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table class="table-borderless table mt-0 mb-0">
                                <tr>
                                    <td style="width: 3%"></td>
                                    <td style="width: 40%;">
                                        Berangkat Dari
                                        <br>
                                        Ke
                                        <br>
                                        Pada Tanggal
                                    </td>
                                    <td>
                                        : {{ $perjalanan->perjalanan->tempat_tujuan }}
                                        <br>
                                        : {{ $perjalanan->perjalanan->tempat_berangkat }}
                                        <br>
                                        : {{ str_replace("-", " ", $perjalanan->perjalanan->tanggal_kembali)}}
                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                @endforelse

                    {{--<tr>
                        <td>
                            <table class="table-borderless table mt-0 mb-0">
                                <tr>
                                    <td style="width: 3%">III.</td>
                                    <td style="width: 40%;">
                                        Tiba di
                                        <br>
                                        Pada Tanggal
                                    </td>
                                    <td>
                                        : -
                                        <br>
                                        : -
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table class="table-borderless table mt-0 mb-0">
                                <tr>
                                    <td style="width: 3%"></td>
                                    <td style="width: 40%;">
                                        Berangkat Dari
                                        <br>
                                        Ke
                                        <br>
                                        Pada Tanggal
                                    </td>
                                    <td>
                                        : -
                                        <br>
                                        : -
                                        <br>
                                        : -
                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <table class="table-borderless table mt-0 mb-0">
                                <tr>
                                    <td style="width: 3%">IV.</td>
                                    <td style="width: 40%;">
                                        Tiba di
                                        <br>
                                        Pada Tanggal
                                    </td>
                                    <td>
                                        : -
                                        <br>
                                        : -
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table class="table-borderless table mt-0 mb-0">
                                <tr>
                                    <td style="width: 3%"></td>
                                    <td style="width: 40%;">
                                        Berangkat Dari
                                        <br>
                                        Ke
                                        <br>
                                        Pada Tanggal
                                    </td>
                                    <td>
                                        : -
                                        <br>
                                        : -
                                        <br>
                                        : -
                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <table class="table-borderless table mt-0 mb-0">
                                <tr>
                                    <td style="width: 3%">V.</td>
                                    <td style="width: 40%;">
                                        Tiba di
                                        <br>
                                        Pada Tanggal
                                    </td>
                                    <td>
                                        : -
                                        <br>
                                        : -
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td>
                            <table class="table-borderless table mt-0 mb-0">
                                <tr>
                                    <td style="width: 3%"></td>
                                    <td style="width: 40%;">
                                        Berangkat Dari
                                        <br>
                                        Ke
                                        <br>
                                        Pada Tanggal
                                    </td>
                                    <td>
                                        : -
                                        <br>
                                        : -
                                        <br>
                                        : -
                                    </td>
                                </tr>
                            </table>
                        </td>

                    </tr>--}}

                @if($perjalanan->perjalanan->riwayat->count() < 4)
                    @foreach($sisa as $nomer)
                        <tr>
                            <td>
                                <table class="table-borderless table mt-0 mb-0">
                                    <tr>
                                        <td style="width: 3%">{{$nomer }}</td>
                                        <td style="width: 40%;">
                                            Tiba di
                                            <br>
                                            Pada Tanggal
                                        </td>
                                        <td>
                                            : -
                                            <br>
                                            : -
                                        </td>
                                    </tr>
                                </table>
                            </td>

                            <td>
                                <table class="table-borderless table mt-0 mb-0">
                                    <tr>
                                        <td style="width: 3%"></td>
                                        <td style="width: 40%;">
                                            Berangkat Dari
                                            <br>
                                            Ke
                                            <br>
                                            Pada Tanggal
                                        </td>
                                        <td>
                                            : -
                                            <br>
                                            : -
                                            <br>
                                            : -
                                        </td>
                                    </tr>
                                </table>
                            </td>

                        </tr>

                    @endforeach
                @endif

                <tr>
                    <td style="width: 50%">
                        <table class="table table-borderless mt-0 mb-0">
                            <tr>
                                <td style="width: 3%">VI.</td>
                                <td style="width: 40%">
                                    Tiba di
                                    <br>
                                    (Tempat Kedudukan)
                                    <br>
                                    Pada Tanggal
                                </td>

                                <td>
                                    :
                                    <br>
                                    <br>
                                    :
                                </td>
                            </tr>
                        </table>
                        <br>
                        <div class="text-center"><strong>PEJABAT PEMBUAT KOMITMEN</strong></div>
                        <br>
                        <br>
                        <br>
                        <div class="text-center"><strong>{{ strtoupper($pejabat[0]->name) }}</strong></div>
                        <div class="text-center"><strong>NIP. {{ $pejabat[0]->nip }}</strong></div>
                    </td>
                    <td style="width: 50%">
                        <table class="table table-borderless mt-0 mb-0">
                            <tr>
                                <td style="width: 3%"></td>
                                <td style="width: 80%" class="text-justify">
                                    Telah diperiksa dengan keterangan bahwa perjalanan
                                    tersebut atas perintahnya dan semata-mata untuk
                                    kepentingan jabatan dalam waktu
                                    sesingkat-singkatnya.
                                </td>
                            </tr>
                        </table>
                        <br>
                        <div class="text-center"><strong>PEJABAT PEMBUAT KOMITMEN</strong></div>
                        <br>
                        <br>
                        <br>
                        <div class="text-center"><strong>{{ strtoupper($pejabat[0]->name) }}</strong></div>
                        <div class="text-center"><strong>NIP. {{ $pejabat[0]->nip }}</strong></div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <table class="mb-0 mt-0 table table-borderless">
                            <tr>
                                <td style="width: 3%">VII.</td>
                                <td class="text-justify" style="width: 70%">
                                    PERHATIAN :  PPK yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat
                                    yang mengesahkan tanggal berangkat /tiba, serta bendahara pengeluaran bertanggung
                                    jawab berdasarkan peraturan-peraturan Keuangan Negara apabila negara menderita
                                    rugi akibat kesalahan, kelalaian dan kealpaannya.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endforeach

<script>
    window.print();
</script>
</body>
</html>
