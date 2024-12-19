
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SAKURA | Akademik</title>
  @include('AkademikMHS.header')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  

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
@include('DashBMHS.navbar')
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
              <li class="breadcrumb-item"><a href="{{ route('mhsdb') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="tab-custom">
            <ul class="nav nav-tabs" id="custom-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="tab-buat-irs" data-toggle="pill" href="#buat-irs" role="tab">Buat IRS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="tab-irs" data-toggle="pill" href="#irs" role="tab">IRS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="tab-khs" data-toggle="pill" href="#khs" role="tab">KHS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="tab-transkrip" data-toggle="pill" href="#transkrip" role="tab">Transkrip</a>
              </li>
            </ul>
          </div>
  
        
          <!-- Tab Buat IRS -->
           <!-- Menyertakan file JavaScript -->
           <div class="tab-content">
    <!-- Tab Buat IRS -->
    <div class="tab-pane fade show active" id="buat-irs" role="tabpanel">
        @if ($mahasiswa->role === 'aktif')
            <!-- Jika mahasiswa aktif -->
            <div id="data-container" data-irs="{{ json_encode($irs) }}"></div>
            <div class="bg-purpleepanel p-4">
                <div class="container-fluid py-4">
                    <div class="row">
                        <!-- Kolom Tambah Mata Kuliah -->
                        <div class="col-md-4">
                        <div class="card mb-3">
                          <div class="card-header bg-primary text-white">
                              <h5><i class="fas fa-plus-circle"></i> Tambahkan Mata Kuliah</h5>
                          </div>
                          <div class="card-body">
                              <div class="form-group">
                                  <label for="select-matkul">Pilih Mata Kuliah</label>
                                  <select id="select-matkul" class="form-control">
                                      @if ($jadwal_pilihan->isNotEmpty())
                                          @foreach ($jadwal_pilihan as $item)
                                              <option 
                                                  value="{{ $item->mata_kuliah_kode_mk }}" 
                                                  data-sks="{{ $item->sks }}"
                                                  data-semester="{{ $item->semester }}"
                                                  data-tahun-akademik="{{ $item->tahun_akademik }}"
                                                  data-ruang="{{ $item->kode_ruang }}"
                                                  data-kelas-id="{{ $item->kelas_id }}">
                                                  Mata Kuliah: {{  $item->nama_mk  }}, 
                                                  SKS: {{  $item->sks  }},
                                                  Semester: {{  $item->semester  }}
                                              </option>
                                          @endforeach
                                      @else
                                          <option>-</option>
                                      @endif
                                  </select>
                              </div>
                              <button class="btn btn-primary btn-block mt-3">Tambahkan</button>
                          </div>
                      </div>


                            <div class="card mb-3">
                                <div class="card-header bg-info text-white">
                                    <h5>Informasi Mahasiswa</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-1"><strong>Nama : {{ $mahasiswa->nama }}</strong></p>
                                    <p class="mb-1">NIM : {{ $mahasiswa->nim }}</p>
                                    <p class="text-muted">Email : {{ $mahasiswa->email }}</p>
                                    <p class="mb-1">Tahun Masuk : {{ $mahasiswa->tahun_masuk }}</p>
                                    <p class="mb-1">Semester : {{ $mahasiswa->semester }}</p>
                                    <p class="mb-1">SKS_Kumulatif : {{ $mahasiswa->SKS_Kumulatif }}</p>
                                    <div class="card mt-3">
                                        <div class="card-header bg-primary text-white">
                                            <h5><i class="fas fa-user"></i> Mata Kuliah yang Dipilih</h5>
                                        </div>
                                        <div class="card-body">
                                            <h6><strong>Mata Kuliah yang Dipilih Mahasiswa</strong></h6>
                                            <hr>
                                            <div id="selected-courses">
                                              @foreach ($irs as $course)
                                              @if ($course->kelas && $course->kelas->mataKuliah)
                                                        <div class="course-item d-flex justify-content-between align-items-center" 
                                                             data-sks="{{ $course->kelas->mataKuliah->sks }}" 
                                                             data-kode="{{ $course->kelas->mataKuliah->kode_mk }}">
                                                            <div>
                                                                {{ $course->kelas->mataKuliah->nama_mk }} 
                                                                ({{ $course->kelas->mataKuliah->sks }} SKS) 
                                                                {{ $course->kelas->mataKuliah->kode_ruang }}
                                                            </div>
                                                            <button class="btn btn-danger btn-sm remove-course" 
                                                                    data-kode="{{ $course->kelas->mataKuliah->kode_mk }}">Hapus</button>
                                                        </div>
                                                    @else
                                                        <div class="course-item">
                                                            <p>Data mata kuliah tidak ditemukan untuk kelas ini.</p>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="card-footer d-flex justify-content-between">
                                                <button class="btn btn-success btn-sm" id="save-btn">Simpan</button>
                                                <button class="btn btn-warning btn-sm" id="edit-btn" style="display:none;">Edit</button>
                                                <strong>Total SKS: <span id="total-sks">{{ $totalSKS }}</span></strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Jadwal Kuliah -->
                        <div class="col-md-8">
                            <div class="card">
                            @if(isset($mahasiswa->semester))
                                <div class="card-header bg-primary text-white">
                                    <h5><i class="fas fa-calendar"></i> 
                                    Jadwal Kuliah
                                  </h5>
                                </div>
                                @endif  
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>Jam</th>
                                                    @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                                        <th>{{ $hari }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ([ '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00' ] as $jam)
                                                    <tr>
                                                        <td>{{ $jam }}</td>
                                                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                                            <td>
                                                                @php
                                                                    $jadwal_hari = $jadwal_tampilan->filter(function ($item) use ($hari, $jam) {
                                                                        return $item->hari === $hari && $item->jam_mulai === $jam;
                                                                    });
                                                                @endphp
                                                               @if ($jadwal_hari->isNotEmpty())
                                                                @foreach ($jadwal_hari as $jadwal)
                                                                    @if ($jadwal->semester%2 == ($mahasiswa->semester%2)) <!-- Menambahkan filter semester -->
                                                                        <a href="javascript:void(0)" class="card mb-2 p-2 add-course"
                                                                          data-id="{{ $jadwal->mata_kuliah_kode_mk }}"
                                                                          data-name="{{ $jadwal->nama_mk }}"
                                                                          data-sks="{{ $jadwal->sks }}"
                                                                          data-semester="{{ $jadwal->semester }}"
                                                                          data-tahun-akademik="{{ $jadwal->tahun_akademik }}"
                                                                          data-ruang="{{ $jadwal->kode_ruang }}"
                                                                          data-kelas-id="{{ $jadwal->kelas_id }}">
                                                                            <strong>{{ $jadwal->nama_mk }}</strong><br>
                                                                            <strong>Kelas '{{$jadwal->kelas}}'<br>
                                                                            Semester: {{$jadwal->semester}}<br></strong>
                                                                            Ruang: {{ $jadwal->kode_ruang }}<br>
                                                                            Jam: {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                                                        </a>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <span>-</span>
                                                            @endif

                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif ($mahasiswa->role === 'cuti')
            <div class="alert alert-warning text-center">
                <h5>Anda Sedang Cuti pada Semester ini</h5>
            </div>
        @else
            <div class="alert alert-danger text-center">
                <h5>Mohon isi Her-Registrasi Dahulu</h5>
            </div>
        @endif
    </div>


        



          <!-- TAB LIAT MATKUL DIAMBIL -->
           

  


      <!-- Tab IRS -->
      <div class="tab-pane fade" id="irs" role="tabpanel">
  <div class="panel">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Rencana Studi (IRS)</h3>
        </div>

        <div class="card-body">
          <!-- Dropdown Pilih Semester -->
          <div class="form-group">
            <label for="semester-select">Pilih Semester</label>
            <select id="semester-select" class="form-control">
              <option value="">Pilih Semester</option>
              <option value="1">Semester 1</option>
              <option value="2">Semester 2</option>
              <option value="3">Semester 3</option>
              <option value="4">Semester 4</option>
              <option value="5">Semester 5</option>
            </select>
          </div>
          <button id="show-irs-button" class="btn btn-primary">Tampilkan IRS</button>

          <!-- Tempat untuk menampilkan data IRS -->
          <div id="semester-data" class="mt-3">
            <!-- Data akan dimuat di sini -->
          </div>
          
          <!-- Tombol Print IRS (akan muncul setelah data IRS dimuat) -->
          <button id="print-irs-button" class="btn btn-success mt-3" style="display: none;">Print IRS</button>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- End Tab IRS -->


            <!-- Tab KHS -->
            <div class="tab-pane fade" id="khs" role="tabpanel">
              <div class="bg-purpleepanel p-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">KHS</h3>
      
                      <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                          <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search"> -->
      
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="max-height: 400px; overflow-y: auto;">
                      <table class="table table-hover text-nowrap sticky-header">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Reason</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>183</td>
                            <td>John Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-success">Approved</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>219</td>
                            <td>Alexander Pierce</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-warning">Pending</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>657</td>
                            <td>Bob Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-primary">Approved</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>175</td>
                            <td>Mike Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-danger">Denied</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>175</td>
                            <td>Mike Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-danger">Denied</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>175</td>
                            <td>Mike Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-danger">Denied</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>175</td>
                            <td>Mike Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-danger">Denied</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>175</td>
                            <td>Mike Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-danger">Denied</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>175</td>
                            <td>Mike Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-danger">Denied</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>175</td>
                            <td>Mike Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-danger">Denied</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                          <tr>
                            <td>175</td>
                            <td>Mike Doe</td>
                            <td>11-7-2014</td>
                            <td><span class="tag tag-danger">Denied</span></td>
                            <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
            </div>
  
            <!-- Tab Transkrip -->
            <div class="tab-pane fade" id="transkrip" role="tabpanel">
              <div class="panel">
                <h4>Transkrip Akademik (Terbaik)</h4>
                <p>Nama: Tito Dean</p>
                <p>Program Studi: Informatika</p>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Kode</th>
                      <th>Mata Kuliah</th>
                      <th>SKS</th>
                      <th>Nilai</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Isi data transkrip akademik sesuai kebutuhan -->
                  </tbody>
                </table>
                <button class="button-print">PRINT</button>
              </div>
            </div>
          </div>
        </div>
        
      </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  @include('AkademikMHS.controllersidebar')
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
@include('AkademikMHS.scriptdb')



</body>
</html>
