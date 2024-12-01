
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SAKURA | Dashboard</title>
  @include('AkademikMHS.header')
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
            <h1 class="m-0">Akademik</h1>
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
  
          <div class="tab-content">
       <!-- Tab Buat IRS -->
        <!-- Menyertakan file JavaScript -->
        

        <div class="tab-pane fade show active" id="buat-irs" role="tabpanel">
    <div id="data-container" data-irs="{{ json_encode($irs) }}"></div>
    <script src="{{ asset('js/AkademikMHS.js') }}"></script>

    <!-- Container dengan latar belakang ungu -->
    <div class="bg-purpleepanel p-4">
        <div class="container-fluid py-4">
            <div class="row">
                <!-- Bagian Kiri (Informasi Mahasiswa dan Tambah Mata Kuliah) -->
                <div class="col-md-4">
                    <!-- Tambahkan Mata Kuliah -->
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-white">
                            <h5><i class="fas fa-plus-circle"></i> Tambahkan Mata Kuliah</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="select-matkul">Pilih Mata Kuliah</label>
                                <select id="select-matkul" class="form-control">
                                    @if ($jadwal_kuliah->isNotEmpty())
                                        @foreach ($jadwal_kuliah as $item)
                                            <option value="{{ $item->mata_kuliah_kode_mk }}" data-sks="{{ $item->sks }}">
                                                {{ $item->nama_mk }}
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

                    <!-- Informasi Mahasiswa -->
                    <div class="card mb-3">
                        <div class="card-header bg-info text-white">
                            <h5>Informasi Mahasiswa</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-1"><strong>Nama : {{ $mahasiswa->nama }}</strong></p>
                            <p class="mb-1">NIM : {{ $mahasiswa->nim }}</p>
                            <p class="text-muted">Email : {{ $mahasiswa->email }}</p>
                            <p class="mb-1">Tahun Masuk : {{ $mahasiswa->tahun_masuk }}</p>
                            <p class="mb-1"> Semester :{{ $mahasiswa->semester }}</p>

                            <!-- Mata Kuliah yang Dipilih -->
                            <div class="card mt-3">
                                <div class="card-header bg-primary text-white">
                                    <h5><i class="fas fa-user"></i> Mata Kuliah yang Dipilih</h5>
                                </div>
                                <div class="card-body">
                                    <h6><strong>Mata Kuliah yang Dipilih</strong></h6>
                                    <hr>
                                    <div id="selected-courses">
                                        <!-- Mata kuliah yang telah dipilih akan tampil di sini -->
                                        @foreach ($irs as $course)
                                            <div class="course-item" data-sks="{{ $course->mataKuliah->sks }}">
                                                {{ $course->mataKuliah->nama_mk }} ({{ $course->mataKuliah->sks }} SKS)
                                                <button class="btn btn-danger btn-sm remove-course" data-kode="{{ $course->mataKuliah->mata_kuliah_kode_mk }}">Hapus</button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                      <!-- Tombol Simpan di kiri -->
                                      <button class="btn btn-success btn-sm" id="save-btn">Simpan</button>
                                      <!-- Total SKS di kanan -->
                                      <strong>Total SKS: <span id="total-sks">{{ $totalSKS }}</span></strong>
                                  </div>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Penutup Bagian Kiri -->

                <!-- Bagian Kanan (Jadwal Kuliah) -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5><i class="fas fa-calendar"></i> Jadwal Kuliah</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Jam</th>
                                            <th>Senin</th>
                                            <th>Selasa</th>
                                            <th>Rabu</th>
                                            <th>Kamis</th>
                                            <th>Jumat</th>
                                            <th>Sabtu</th>
                                            <th>Minggu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                            $jamMulai = [
                                                '07:00', '08:00', '09:00', '10:00', '11:00',
                                                '12:00', '13:00', '14:00', '15:00', '16:00',
                                                '17:00', '18:00', '19:00', '20:00', '21:00'
                                            ];
                                        @endphp

                                        @foreach ($jamMulai as $jam)
                                            <tr>
                                                <td>{{ $jam }}</td>
                                                @foreach ($hari as $h)
                                                    @php
                                                        $jadwal_hari = $jadwal_kuliah->filter(function ($item) use ($h, $jam) {
                                                            return $item->hari === $h && $item->jam_mulai === $jam;
                                                        });
                                                    @endphp
                                                    <td>
                                                        @if ($jadwal_hari->isNotEmpty())
                                                            @foreach ($jadwal_hari as $jadwal)
                                                                <a href="#" class="card mb-2 p-2"
                                                                   data-id="{{ $jadwal->mata_kuliah_kode_mk }} "
                                                                   data-name="{{ $jadwal->nama_mk }} "
                                                                   data-sks="{{ $jadwal->sks }}">
                                                                    <strong>{{ $jadwal->nama_mk }}</strong><br>
                                                                    Ruang: {{ $jadwal->kode_ruang }}<br>
                                                                    Jam: {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                                                                </a>
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
                <!-- Penutup Bagian Kanan -->
            </div>
        </div>
    </div>
</div>

<!-- Script JavaScript -->
<!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        const addButton = document.querySelector(".btn-primary"); // Tombol "Tambahkan"
        const selectMatkul = document.getElementById("select-matkul"); // Dropdown mata kuliah
        const totalSksElem = document.getElementById("total-sks"); // Total SKS
        const selectedCoursesElem = document.getElementById("selected-courses"); // Daftar mata kuliah yang dipilih
        const dataContainer = document.getElementById("data-container");
        const irsData = JSON.parse(dataContainer.getAttribute("data-irs")); // Data IRS yang ada

        // Ambil NIM mahasiswa dari data yang ada
        const mahasiswaNim = "{{ $mahasiswa->nim }}";

        // Menambah mata kuliah ke IRS
        addButton.addEventListener("click", function() {
            const selectedOption = selectMatkul.options[selectMatkul.selectedIndex];
            const mataKuliahKodeMk = selectedOption.value;
            const mataKuliahNama = selectedOption.text;
            const mataKuliahSks = selectedOption.getAttribute("data-sks");

            // Kirim data ke server untuk menambah mata kuliah ke IRS
            fetch("{{ route('irs.tambah') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({
                    mahasiswa_nim: mahasiswaNim,
                    selected_courses: [{
                        mata_kuliah_kode_mk: mataKuliahKodeMk,
                        semester: {{ $mahasiswa->semester }},
                        tahun_akademik: "{{ $mahasiswa->tahun_akademik }}"
                    }]
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message); // Menampilkan pesan
                    if (data.added_courses.length > 0) {
                        // Update list mata kuliah yang dipilih
                        data.added_courses.forEach(course => {
                            const newCourse = document.createElement("div");
                            newCourse.classList.add("course-item");
                            newCourse.setAttribute("data-sks", course.sks);
                            newCourse.innerHTML = `
                                ${course.nama_mk} (${course.sks} SKS)
                                <button class="btn btn-danger btn-sm remove-course" data-kode="${course.mata_kuliah_kode_mk}">Hapus</button>
                            `;
                            selectedCoursesElem.appendChild(newCourse);
                        });
                        
                        // Update total SKS
                        const newTotalSks = parseInt(totalSksElem.textContent) + parseInt(mataKuliahSks);
                        totalSksElem.textContent = newTotalSks;
                    }
                } else {
                    alert("Terjadi kesalahan dalam menambah mata kuliah.");
                }
            })
            .catch(error => {
                console.error("Error adding course:", error);
                alert("Terjadi kesalahan pada server.");
            });
        });

        // Menghapus mata kuliah dari IRS
        selectedCoursesElem.addEventListener("click", function(event) {
            if (event.target.classList.contains("remove-course")) {
                const mataKuliahKodeMk = event.target.getAttribute("data-kode");
                const courseItem = event.target.closest(".course-item");
                const mataKuliahSks = courseItem.getAttribute("data-sks");

                // Kirim data ke server untuk menghapus mata kuliah dari IRS
                fetch("{{ route('irs.hapus') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify({
                        mahasiswa_nim: mahasiswaNim,
                        mata_kuliah_kode_mk: mataKuliahKodeMk
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message); // Menampilkan pesan
                        // Menghapus mata kuliah dari tampilan
                        selectedCoursesElem.removeChild(courseItem);
                        
                        // Update total SKS
                        const newTotalSks = parseInt(totalSksElem.textContent) - parseInt(mataKuliahSks);
                        totalSksElem.textContent = newTotalSks;
                    }
                })
                .catch(error => {
                    console.error("Error removing course:", error);
                    alert("Terjadi kesalahan pada server.");
                });
            }
        });
    });
</script> -->
<script>
  // Ambil data IRS dari HTML
let irs = JSON.parse(document.getElementById('data-container').getAttribute('data-irs'));

// Fungsi untuk memperbarui total SKS
function updateTotalSKS() {
    const totalSKS = irs.reduce((total, course) => total + course.total_sks, 0);
    document.getElementById('total-sks').textContent = totalSKS;
}

// Fungsi untuk menghapus mata kuliah dari IRS
function removeCourse(courseKodeMK) {
    irs = irs.filter(course => course.mata_kuliah_kode_mk !== courseKodeMK);
    renderSelectedCourses(); // Render ulang daftar mata kuliah
    updateTotalSKS();        // Update total SKS
}

// Fungsi untuk menambahkan mata kuliah ke IRS
function addCourse(courseKodeMK, courseName, courseSKS) {
    if (!irs.some(course => course.mata_kuliah_kode_mk === courseKodeMK)) {
        irs.push({ mata_kuliah_kode_mk: courseKodeMK, name: courseName, total_sks: courseSKS });
        renderSelectedCourses(); // Render ulang daftar mata kuliah
        updateTotalSKS();        // Update total SKS
    } else {
        alert('Mata kuliah ini sudah ditambahkan.');
    }
}

// Render daftar mata kuliah yang dipilih
function renderSelectedCourses() {
    const selectedCoursesContainer = document.getElementById('selected-courses');
    selectedCoursesContainer.innerHTML = ''; // Kosongkan daftar lama

    const fragment = document.createDocumentFragment();

    irs.forEach(course => {
        const courseDiv = document.createElement('div');
        courseDiv.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'mb-2');
        courseDiv.setAttribute('data-id', course.mata_kuliah_kode_mk); // Tambahkan data-id ke elemen

        const courseName = document.createElement('span');
        courseName.textContent = `${course.name} (${course.total_sks} SKS)`;

        const removeButton = document.createElement('button');
        removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
        removeButton.innerHTML = '<i class="fas fa-trash"></i>';
        removeButton.onclick = function() { removeCourse(course.mata_kuliah_kode_mk); };

        courseDiv.appendChild(courseName);
        courseDiv.appendChild(removeButton);
        fragment.appendChild(courseDiv);

        const hr = document.createElement('hr');
        fragment.appendChild(hr);
    });

    selectedCoursesContainer.appendChild(fragment);
}

// Tambahkan event listener pada dropdown Pilih Mata Kuliah
document.querySelector('.btn-primary.btn-block').addEventListener('click', function () {
    const select = document.getElementById('select-matkul');
    const selectedOption = select.options[select.selectedIndex];
    const courseName = selectedOption.textContent;
    const courseKodeMK = selectedOption.value;
    const courseSKS = parseInt(selectedOption.getAttribute('data-sks'));

    addCourse(courseKodeMK, courseName, courseSKS);
});

// Tambahkan event listener pada elemen jadwal kuliah
document.querySelectorAll('.card.mb-2.p-2').forEach(function(card) {
    card.addEventListener('click', function() {
        const courseKodeMK = card.getAttribute('data-id');
        const courseName = card.getAttribute('data-name');
        const courseSKS = parseInt(card.getAttribute('data-sks'));

        addCourse(courseKodeMK, courseName, courseSKS);
    });
});

// Event listener untuk tombol simpan jadwal
document.getElementById('save-irs-btn').addEventListener('click', function () {
    const selectedCourses = irs.map(course => course.mata_kuliah_kode_mk);

    // Kirim data ke server untuk disimpan di IRS
    fetch('/path/to/your/save/irs', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ selected_courses: selectedCourses })
    })
    .then(response => response.json())
    .then(data => {
        // Tangani respons sukses
        alert('Jadwal kuliah berhasil disimpan!');
    })
    .catch(error => {
        // Tangani kesalahan
        console.error('Terjadi kesalahan:', error);
        alert('Gagal menyimpan jadwal.');
    });
});

// Initial render
renderSelectedCourses();
updateTotalSKS();

</script>





          <!-- TAB LIAT MATKUL DIAMBIL -->
          <!-- Tab Buat IRS -->
          
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
