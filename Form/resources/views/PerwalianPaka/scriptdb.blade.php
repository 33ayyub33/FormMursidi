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