<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- overlayScrollbars -->
<script src="{{asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{asset('AdminLTE/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('AdminLTE/plugins/chart.js/Chart.min.js')}}"></script>

<script>
    // JavaScript untuk menangani tombol
    document.getElementById('btnLengkap').addEventListener('click', function() {
      toggleTab('Lengkap');
    });
  
    document.getElementById('btnTerbaik').addEventListener('click', function() {
      toggleTab('Terbaik');
    });
  
    document.getElementById('btnInggris').addEventListener('click', function() {
      toggleTab('Inggris');
    });
  
    function toggleTab(tab) {
      // Sembunyikan semua konten
      document.getElementById('contentLengkap').classList.remove('show', 'active');
      document.getElementById('contentTerbaik').classList.remove('show', 'active');
      document.getElementById('contentInggris').classList.remove('show', 'active');
  
      // Tampilkan konten sesuai tombol yang diklik
      if(tab === 'Lengkap') {
        document.getElementById('contentLengkap').classList.add('show', 'active');
      } else if(tab === 'Terbaik') {
        document.getElementById('contentTerbaik').classList.add('show', 'active');
      } else if(tab === 'Inggris') {
        document.getElementById('contentInggris').classList.add('show', 'active');
      }
    }
  </script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
  </script>

  {{-- <script>
  document.addEventListener('DOMContentLoaded', function () {
    // Seleksi semua tombol dengan class "remove-course"
    const removeButtons = document.querySelectorAll('.remove-course');

    removeButtons.forEach(button => {
        button.addEventListener('click', function () {
            const courseCode = this.getAttribute('data-kode');
            if (confirm(`Apakah Anda yakin ingin menghapus mata kuliah dengan kode ${courseCode}?`)) {
                // Kirimkan request AJAX untuk menghapus course
                console.log(`Hapus mata kuliah dengan kode: ${courseCode}`);
                // Tambahkan logika penghapusan sesuai kebutuhan
            }
        });
    });
});
  </script> --}}
  <!-- <script>
// Fungsi untuk memuat data semester berdasarkan pilihan dropdown
function loadSemesterData(semester) {
  if (semester === "") {
    document.getElementById('semester-data').innerHTML = "";
    return;
  }

  // Menyiapkan AJAX request untuk mengambil data dari server
  const xhr = new XMLHttpRequest();
  xhr.open('GET', `/getIrsBySemester/${semester}`, true);
  xhr.onload = function() {
    if (xhr.status === 200) {
      const irsData = JSON.parse(xhr.responseText);
      let tableContent = `
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>NO</th>
                <th>KODE</th>
                <th>MATA KULIAH</th>
                <th>KELAS</th>
                <th>SKS</th>
                <th>RUANG</th>
                <th>STATUS</th>
                <th>NAMA DOSEN</th>
              </tr>
            </thead>
            <tbody>
      `;
      
      irsData.forEach((course, index) => {
        tableContent += `
          <tr>
            <td>${index + 1}</td>
            <td>${course.kode_mk}</td>
            <td>${course.nama_mk}</td>
            <td>${course.kelas}</td>
            <td>${course.sks}</td>
            <td>${course.ruang}</td>
            <td>${course.status}</td>
            <td>${course.dosen}</td>
          </tr>
        `;
      });

      tableContent += `</tbody></table></div>`;
      document.getElementById('semester-data').innerHTML = tableContent;
    }
  };
  xhr.send();
}
</script> -->


<script>
  function loadIrsData() {
    const semester = document.getElementById('semester-select').value;

    if (!semester) {
      alert('Semester tidak valid!');
      return;
    }

    const url = `/getIrsBySemester/${semester}`;

    fetch(url)
      .then(response => response.json())
      .then(data => {
        if (data.length === 0) {
          document.getElementById('semester-data').innerHTML = '<p>Data IRS tidak ditemukan untuk semester ini.</p>';
          return;
        }

        let htmlContent = `<table class="table table-bordered">
                            <thead>
                              <tr>
                                <th>Semester</th>
                                <th>Tahun Akademik</th>
                                <th>Ruang</th>
                                <th>Total SKS</th>
                              </tr>
                            </thead>
                            <tbody>`;

        data.forEach(item => {
          htmlContent += `<tr>
                            <td>${item.semester}</td>
                            <td>${item.tahun_akademik}</td>
                            <td>${item.ruang}</td>
                            <td>${item.total_sks}</td>
                          </tr>`;
        });

        htmlContent += `</tbody></table>`;

        document.getElementById('semester-data').innerHTML = htmlContent;

        // Tampilkan tombol Print IRS setelah data ditampilkan
        const printButton = document.getElementById('print-irs-button');
        printButton.style.display = 'block';

        // Fungsi untuk print IRS
        printButton.onclick = function () {
          window.location.href = `/irs/history/pdf/${semester}`; // Route untuk mengunduh PDF
        };
      })
      .catch(error => {
        console.error('Terjadi kesalahan:', error);
        document.getElementById('semester-data').innerHTML = '<p>Terjadi kesalahan saat mengambil data.</p>';
      });
  }

  document.getElementById("show-irs-button").addEventListener("click", function () {
    const semester = document.getElementById("semester-select").value;

    if (!semester) {
        alert("Pilih semester terlebih dahulu!");
        return;
    }

    const url = `/api/irs/${semester}`; // Pastikan route ini sesuai

    fetch(url)
        .then((response) => {
            if (!response.ok) {
                throw new Error("Terjadi kesalahan saat mengambil data.");
            }
            return response.json();
        })
        .then((data) => {
            console.log(data);  // Debug untuk melihat data yang diterima
            const container = document.getElementById("semester-data");

            if (data.length === 0) {
                container.innerHTML = "<div class='alert alert-warning'>Data IRS tidak ditemukan untuk semester ini.</div>";
                return;
            }

            // Generate tabel HTML
            let html = `
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Kode Matakuliah</th>
                            <th>Mata Kuliah</th>
                            <th>Semester</th>
                            <th>Tahun Akademik</th>
                            <th>Ruang</th>
                            <th>Total SKS</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            data.forEach((item) => {
                // Memastikan akses data yang aman
                const mataKuliah = item.kelas && item.kelas.mata_kuliah ? item.kelas.mata_kuliah.nama_mk : 'Mata Kuliah Tidak Ditemukan';
                const ruang = item.ruang_kuliah_kode_ruang || 'Ruang Tidak Ditemukan';  // Menggunakan fallback untuk ruang
                
                html += `
                    <tr>
                        <td>${item.kode_mk}</td>
                        <td>${item.nama_mk}</td>
                        <td>${item.semester}</td>
                        <td>${item.tahun_akademik}</td>
                        <td>${item.ruang}</td>
                        <td>${item.total_sks}</td>
                    </tr>
                `;
            });

            html += `
                    </tbody>
                </table>
            `;

            container.innerHTML = html;

            // Menampilkan tombol Print IRS setelah data ditampilkan
            const printButton = document.getElementById('print-irs-button');
            printButton.style.display = 'block';

            // Fungsi untuk print IRS
            printButton.onclick = function () {
              window.location.href = `/irs/history/pdf/${semester}`; // Route untuk mengunduh PDF
            };
        })
        .catch((error) => {
            console.error("Error fetching IRS data:", error);
            document.getElementById("semester-data").innerHTML = "<div class='alert alert-danger'>Terjadi kesalahan saat memuat data IRS.</div>";
        });
  });
</script>





<!-- SCRIPT BUAT IRS -->
<script>
// Ambil data IRS dari HTML
let irs = JSON.parse(document.getElementById('data-container').getAttribute('data-irs') || '[]');

// Ambil CSRF token dari meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Fungsi untuk memperbarui total SKS
function updateTotalSKS() {
    const totalSKS = irs.reduce((total, course) => total + course.total_sks, 0);
    // const newTotalSKS = totalSKS + parseInt(courseSKS);
    document.getElementById('total-sks').textContent = totalSKS;
}

// Fungsi untuk menghapus mata kuliah dari IRS
function removeCourse(courseKodeMK) {
    irs = irs.filter(course => course.mata_kuliah_kode_mk !== courseKodeMK);
    renderSelectedCourses2(); // Render ulang daftar mata kuliah
    updateTotalSKS();        // Update total SKS

    // Kirimkan request AJAX untuk menghapus mata kuliah dari server
    fetch(`/irs/${courseKodeMK}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken, // Sertakan token CSRF
            'Content-Type': 'application/json', // Tipe konten JSON
        },
    })
    .then(response => {
        if (response.ok) {
            alert('Mata kuliah berhasil dihapus.');
        } else {
            response.json().then(data => alert(data.message));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus mata kuliah.');
    });
}

// Fungsi untuk menambahkan mata kuliah ke IRS
function addCourse(courseKodeMK, courseName, courseSKS, semester, tahunAkademik, ruang, kelasId) {
  // Hitung total SKS yang sudah diambil
  // const totalSKS = irs.reduce((total, course) => total + course.total_sks, 0);
      if (!irs.some(course => course.mata_kuliah_kode_mk === courseKodeMK)) {

          irs.push({
            mata_kuliah_kode_mk: courseKodeMK,
            nama_mk: courseName,
            total_sks: parseInt(courseSKS),
            semester: semester,
            tahun_akademik: tahunAkademik,
            ruang_kuliah_kode_ruang: ruang,
            kelas_id: kelasId
        });
        // Panggil fungsi untuk merender dan menghitung ulang SKS
            renderSelectedCourses2();
            updateTotalSKS();
          } else {
              // Tampilkan alert jika mata kuliah sudah ada di IRS
              alert('Mata kuliah ini sudah ditambahkan.');
          }
}


// Render daftar mata kuliah yang dipilih
function renderSelectedCourses2() {
    const selectedCoursesContainer = document.getElementById('selected-courses');
    selectedCoursesContainer.innerHTML = ''; // Kosongkan daftar lama

    const fragment = document.createDocumentFragment();

    irs.forEach(course => {
        const courseDiv = document.createElement('div');
        courseDiv.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'mb-2');
        courseDiv.setAttribute('data-id', course.mata_kuliah_kode_mk); // Tambahkan data ID untuk penghapusan

        const courseName = document.createElement('div');
        courseName.textContent = `${course.nama_mk} (${course.total_sks} SKS)`;

        const removeButton = document.createElement('button');
        removeButton.classList.add('btn', 'btn-danger', 'btn-sm','remove-course');
        removeButton.textContent = 'Hapus';
        removeButton.addEventListener('click', () => removeCourse(course.mata_kuliah_kode_mk));

        // Cek apakah tombol Simpan sedang aktif atau tidak
        if (document.getElementById('save-btn').style.display === 'none') {
            removeButton.style.display = 'none'; // Menyembunyikan tombol Hapus saat Simpan aktif
        } else {
            removeButton.style.display = 'inline-block'; // Menampilkan tombol Hapus saat Edit aktif
        }

        courseDiv.appendChild(courseName);
        courseDiv.appendChild(removeButton);

        fragment.appendChild(courseDiv);
    });

    selectedCoursesContainer.appendChild(fragment);
}

// Menangani klik tombol "Simpan"
document.getElementById('save-btn')?.addEventListener('click', () => {
    const formData = {
        irs: irs // Data IRS yang telah disiapkan
    };

    // Langkah 1: Validasi SKS melalui endpoint cekSksKumulatif
    fetch('/cekSksKumulatif', {
        method: 'POST', // Metode POST untuk validasi
        headers: {
            'Content-Type': 'application/json', // Tipe konten JSON
            'X-CSRF-TOKEN': csrfToken // Sertakan CSRF token untuk keamanan
        },
        body: JSON.stringify(formData) // Kirim data IRS untuk validasi
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'invalid') {
            // Jika SKS tidak valid, tampilkan pesan error dan hentikan proses
            alert(data.message);
            console.error('Validasi gagal:', data);
            return;
        }

        // Langkah 2: Jika validasi berhasil, kirim data IRS ke endpoint simpanirs
        fetch('/simpanirs', {
            method: 'POST', // Metode POST untuk menyimpan data
            headers: {
                'Content-Type': 'application/json', // Tipe konten JSON
                'X-CSRF-TOKEN': csrfToken // Sertakan CSRF token untuk keamanan
            },
            body: JSON.stringify(formData) // Kirim data dalam format JSON
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP error ${response.status}`);
            }
            return response.json(); // Parse response JSON jika berhasil
        })
        .then(data => {
            const removeButtons = document.querySelectorAll('.remove-course');
            removeButtons.forEach(button => {
                button.style.display = 'none';
            });
            console.log('Simpan IRS berhasil:', data);
            document.getElementById('edit-btn').style.display = 'inline-block'; // Tampilkan tombol Edit
            document.getElementById('save-btn').style.display = 'none'; // Sembunyikan tombol Simpan
            alert('Data IRS berhasil disimpan.');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal menyimpan IRS. Periksa kembali data atau coba lagi.');
        });
    })
    .catch(error => {
        console.error('Error saat validasi SKS:', error);
        alert('Terjadi kesalahan saat validasi SKS. Coba lagi.');
    });
});


// Menangani klik pada jadwal kuliah untuk menambahkannya
document.querySelectorAll('.add-course').forEach(button => {
    button.addEventListener('click', () => {
        const courseKodeMK = button.getAttribute('data-id');
        const semester = button.getAttribute('data-semester');
        const tahunAkademik = button.getAttribute('data-tahun-akademik');
        const courseName = button.getAttribute('data-name');
        const courseSKS = button.getAttribute('data-sks');
        const ruang = button.getAttribute('data-ruang');
        const kelasId = button.getAttribute('data-kelas-id');

        addCourse(courseKodeMK, courseName, courseSKS, semester, tahunAkademik, ruang, kelasId);
    });
});

// Fungsi untuk memperbarui tampilan tombol Simpan/Edit
function toggleSaveEditButtons(isEditing) {
    document.getElementById('save-btn').style.display = isEditing ? 'none' : 'inline-block';
    document.getElementById('edit-btn').style.display = isEditing ? 'inline-block' : 'none';
}

// Event listener untuk tombol Edit
document.getElementById('edit-btn')?.addEventListener('click', () => {
    document.getElementById('save-btn').style.display = 'inline-block'; // Menampilkan tombol Simpan
    document.getElementById('edit-btn').style.display = 'none'; // Menyembunyikan tombol Edit
    renderSelectedCourses2();
});

// Inisialisasi total SKS saat halaman dimuat
document.addEventListener('DOMContentLoaded', function () {
    updateTotalSKS(); // Pastikan nilai langsung disesuaikan
});

// Fungsi untuk menghapus mata kuliah (dari tombol Hapus)
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-course')) {
        const courseKodeMK = event.target.getAttribute('data-kode');
        const confirmed = confirm(`Apakah Anda yakin ingin menghapus mata kuliah dengan kode ${courseKodeMK}?`);
        if (confirmed) {
            fetch(`/irs/${courseKodeMK}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (response.ok) {
                    removeCourse(courseKodeMK); // Fungsi ini akan memperbarui frontend
                    alert('Mata kuliah berhasil dihapus.');
                } else {
                    throw new Error('Gagal menghapus data.');
                }
            })
            .catch(error => {
                console.error(error);
                alert('Terjadi kesalahan saat menghapus mata kuliah.');
            });
        }
    }
});
</script>


<!-- Pilih Mata Kuliah -->
<script>

  document.getElementById('select-matkul').addEventListener('change', function() {
      var selectedOption = this.options[this.selectedIndex];
      var sks = selectedOption.getAttribute('data-sks');
      var semester = selectedOption.getAttribute('data-semester');
      
      // Menampilkan detail pada elemen tertentu (misalnya di bawah dropdown)
      document.getElementById('matkul-sks').innerText = 'SKS: ' + sks;
      document.getElementById('matkul-semester').innerText = 'Semester: ' + semester;
  });

</script>  
