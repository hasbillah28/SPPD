<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <div class="sidebar-brand-full row">
            <img  src="{{ asset('storage/logobpn.png') }}" class="brand-image img-circle col-4" width="20%" height="30%">
            <p style="font-style: italic; font-family:'Times New Roman'; margin-left: -5%;" class=" col-8 mt-2"  >(SIPD)
                Sistem Informasi Perjalanan Dinas</p>
        </div>
        <div class="sidebar-brand-narrow">
            <img  src="{{ asset('storage/logobpn.png') }}" class="brand-image img-circle" width="100%" >
        </div>

    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar role="navigation">

        @role('admin')
        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">
                <i class="nav-icon cil-speedometer"></i>Dashboard</a></li>
        <li class="nav-title">Pengelolaan Perjalanan Dinas</li>

        <li class="nav-item"><a class="nav-link" href="{{ route('perjalanan.index') }}">
                <i class="nav-icon cil-airplane-mode"></i>Perjalanan Dinas</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('kwitansi.index') }}">
                <i class="nav-icon cil-description"></i>Kwitansi</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('admin.surattugas.index') }}">
                <i class="nav-icon cil-file"></i> Surat Tugas</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('admin.sppd.index') }}">
                <i class="nav-icon cil-address-book"></i>SPPD</a></li>

        <li class="nav-title">Master</li>

        <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">
                <i class="nav-icon cil-contact"></i> Users</a></li>
        <li class="nav-divider"></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('jabatan.index') }}">
                <i class="nav-icon cil-lock-locked"></i> Jabatan</a></li>
        <li class="nav-divider"></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('pangkat.index') }}">
                <i class="nav-icon cil-shield-alt"></i> Pangkat</a></li>
        <li class="nav-divider"></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('golongan.index') }}">
                <i class="nav-icon cil-group"></i>Golongan</a></li>
        <li class="nav-divider"></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('angkutan.index') }}">
                <i class="nav-icon cil-car-alt"></i> Jenis Angkutan</a></li>
        @endrole

        @role('kakan')
        <li class="nav-title">Persetujuan</li>
        <li class="nav-item"><a class="nav-link" href="{{ route('kakan.persetujuan') }}">
                <i class="nav-icon cil-airplane-mode"></i>Persetujuan Perjalanan</a></li>
        @endrole

        @role('kaur')
        <li class="nav-title">Persetujuan</li>

        <li class="nav-item"><a class="nav-link" href="{{ route('kaur.perjalanan') }}">
                <i class="nav-icon cil-airplane-mode"></i>Persetujuan Perjalanan</a></li>
        @endrole

        @role('kasubag')
        <li class="nav-title">Persetujuan</li>

        <li class="nav-item"><a class="nav-link" href="{{ route('kasubag.perjalanan') }}">
                <i class="nav-icon cil-airplane-mode"></i>Persetujuan Perjalanan</a></li>
        @endrole

        @role('pegawai')
        <li class="nav-title">Perjalanan Dinas</li>

        <li class="nav-item"><a class="nav-link" href="{{ route('pegawai.perjalanan') }}">
                <i class="nav-icon cil-airplane-mode"></i>Daftar Perjalanan</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('pegawai.surattugas.index') }}">
                <i class="nav-icon cil-airplane-mode"></i>Surat Tugas</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('pegawai.spd.index') }}">
                <i class="nav-icon cil-airplane-mode"></i>SPPD</a></li>
        @endrole
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
