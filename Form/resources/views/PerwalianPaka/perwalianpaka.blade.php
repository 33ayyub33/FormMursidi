<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SAKURA | Persetujuan IRS</title>
@include('PerwalianPaka.header')
 
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed layout-footer-fixed bg-ungubg">
<div class="wrapper">

  <!-- Navbar -->
  @include('DashBPAKA.navbar')
  <!-- /.navbar -->

<!-- Main Content -->
<div class="container mt-5">

    <!-- Kotak Status -->
    <div class="row text-center mb-4">
        <div class="col-md-6">
            <div class="info-box bg-primary">
                <span class="info-box-icon"><i class="fas fa-user-clock"></i></span>
                <div class="info-box-content">
                    <h5>Belum Mengisi IRS</h5>
                    <h3>{{ $mahasiswa->whereNotIn('nim', $irs->pluck('mahasiswa_nim'))->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-box bg-success">
                <span class="info-box-icon"><i class="fas fa-user-check"></i></span>
                <div class="info-box-content">
                    <h5>Sudah Mengisi IRS</h5>
                    <h3>{{ $irs->pluck('mahasiswa_nim')->unique()->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Mahasiswa -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Rekap Mahasiswa Perwalian</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Mahasiswa Belum Mengisi IRS -->
                <div class="col-md-6">
                    <h4>Belum Mengisi IRS</h4>
                    <ul class="list-group">
                        @foreach ($mahasiswa->whereNotIn('nim', $irs->pluck('mahasiswa_nim')) as $mhs)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $mhs->nim }} - {{ $mhs->nama }}
                                <a href="{{ route('pembimbing.cetak', $mhs->nim) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-print"></i> Cetak IRS
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Mahasiswa Sudah Mengisi IRS -->
                <div class="col-md-6">
                    <h4>Sudah Mengisi IRS</h4>
                    <ul class="list-group">
                        @foreach ($irs->pluck('mahasiswa_nim')->unique() as $nim)
                            @php
                                $mhs = $mahasiswa->firstWhere('nim', $nim);
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $mhs->nim }} - {{ $mhs->nama }}
                                <a href="{{ route('pembimbing.cetak', $mhs->nim) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-print"></i> Cetak IRS
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>


  <!-- /.content-wrapper -->
  @include('PerwalianPaka.controllersidebar')
  <!-- Footer -->
  <footer class="main-footer bg-ungu">
    <strong>Form Pengisian IRS &copy; 2024 <a href="https://SAKURAIRS.COM">SAKURA</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>SAKURA</b> 1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->  

<!-- Scripts -->
@include('PerwalianPaka.scriptdb')
</body>
</html>
