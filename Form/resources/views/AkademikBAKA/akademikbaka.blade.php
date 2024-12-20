
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SAKURA | Room Management</title>
  @include('AkademikBAKA.header')
  <style>
    /* Mengubah background seluruh halaman */
    body {
      background-color: #D8BFD8; /* Warna ungu pastel */
    }

    /* Mengubah background konten utama */
    .content-wrapper {
      background-color: #D8BFD8; /* Warna ungu pastel untuk konten utama */
    }
  </style>
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed layout-footer-fixed bg-ungubg">
<div class="wrapper">

  <!-- Navbar -->
@include('DashBBAKA.navbar')
  <!-- /.navbar -->
  
  <!-- Main Sidebar Container -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('bakadb') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <!-- Main content -->
<div class="container mt-5">

  <!-- Tambah Ruangan -->
  <div class="card mt-4">
    <div class="card-header">
      <h3 class="card-title">Tambah Ruangan</h3>
    </div>
    <form method="POST" action="{{ route('ruangan.store') }}">
      @csrf
      <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <div class="form-group">
          <label for="kode_ruang">Kode Ruang</label>
          <input type="text" class="form-control form-control-border border-width-2" id="kode_ruang" name="kode_ruang" placeholder="Masukkan kode ruang" required>
        </div>

        <div class="form-group">
          <label for="kapasitas">Kapasitas</label>
          <input type="text" class="form-control rounded-0" id="kapasitas" name="kapasitas" placeholder="Masukkan kapasitas" required>
        </div>

        <div class="form-group">
          <label for="program_studi_kode_prodi">Program Studi</label>
          <select class="custom-select form-control-border" id="program_studi_kode_prodi" name="program_studi_kode_prodi" required>
            <option value="" disabled selected>Pilih Program Studi</option>
            @foreach($programStudi as $prodi)
            <option value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Tambah Ruang</button>
      </div>
    </form>
  </div>
  <!-- /.card -->

  <!-- Daftar Ruang -->
  <div class="card mt-5">
    <div class="card-header">
      <h3 class="card-title">Daftar Ruangan</h3>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Kode Ruang</th>
            <th>Kapasitas</th>
            <th>Kode Prodi</th>
            <th>Kode Fakultas</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($ruangan as $r)
          <tr>
            <td>{{ $r->kode_ruang }}</td>
            <td>{{ $r->kapasitas }}</td>
            <td>{{ $r->nama_prodi }}</td>
            <td>{{ $r->nama_fakultas }}</td>
            <td>{{ $r->status }}</td>
            <td>
              <form action="{{ route('ruangan.destroy', $r->kode_ruang) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center">Tidak ada data ruangan.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  @include('AkademikBAKA.controllersidebar')
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer bg-ungu">
    <strong>Form Pengisian IRS &copy; 2024 <a href="https://SAKURAIRS.COM">SAKURA</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>SAKURA</b> 1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('AkademikBAKA.scriptdb')
</body>
</html>
