<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Barang | Admin M-GOLEM</title>

    <link rel="apple-touch-icon" href="/images/icon.png">
    <link rel="shortcut icon" href="/images/icon.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="/assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->

    <!-- <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" /> -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('dashboardAdmin') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">Data</li><!-- /.menu-title -->
                    <li>
                        <a href="{{ route('dataMhsAdmin') }}"><i class="menu-icon fa fa-user"></i>Data Mahasiswa </a>
                    </li>
                    <li>
                        <a href="{{ route('dataTeknisiAdmin') }}"><i class="menu-icon fa fa-user-secret"></i>Data Teknisi </a>
                    </li>
                    <li class="active">
                        <a href="{{ route('dataBarangAdmin') }}"><i class="menu-icon fa fa-qrcode"></i>Data Barang </a>
                    </li>
                    <li>
                        <a href="{{ route('dataMerkAdmin') }}"><i class="menu-icon fa fa-tags"></i>Data Merk </a>
                    </li>
                    <li>
                        <a href="{{ route('dataTipeAdmin') }}"><i class="menu-icon fa fa-bookmark-o"></i>Data Tipe </a>
                    </li>
                    <li>
                        <a href="{{ route('dataKategoriAdmin') }}"><i class="menu-icon fa fa-bookmark"></i>Data Kategori </a>
                    </li>
                    <li>
                        <a href="{{ route('dataKelasAdmin') }}"><i class="menu-icon fa fa-star"></i>Data Kelas </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('dashboardAdmin')}}"><img src="/images/Logo_MGOLEM_Web1.png" width="170" height="40" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="{{ route('dashboardAdmin') }}"><img src="/images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <!-- <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div> -->

                        <!-- <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div> -->

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="/images/boy.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href=""><i class="fa fa- user"></i>> Hello, {{ $nama_admin }}</a>

                            <!-- <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">3</span></a> -->

                            <!-- <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a> -->

                            <a class="nav-link" href="{{ route('logoutAdmin') }}"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{ route('dashboardAdmin') }}">Dashboard</a></li>
                                    <li class="active">Data Barang</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Barang <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addData"><i class="fa fa-plus-circle"></i> Add</button>
                                 <a href="{{ route('allDtBarang') }}" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Print All</a>
                                 <a href="{{ route('allQrCode') }}" class="btn btn-warning btn-sm"><i class="fa fa-qrcode"></i> Print QR Code</a></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>QR Code</th>
                                            <th>Id Barang</th>
                                            <th>Kategori</th>
                                            <th>Merk</th>
                                            <th>Tipe</th>
                                            <th>Kuantitas</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($barang as $key => $data)
                                          <tr>
                                            <td>{{ ++$key }}</td>
                                            <!-- <td>{!! DNS2D::getBarcodeHTML($data->id_barang, 'QRCODE',3,3) !!}</td> -->
                                            <!-- <td><img src="data:'string(9) 'image/png'';base64,{{ $data->generate }}" width="50" height="50"/></td> -->
                                            <td>
                                              <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#qrcode" data-generate="data:'string(9) 'image/png'';base64,{{ $data->generate }}" data-png="{{ route('downloadPng', $data->id_barang) }}"> -->
                                                <a href="{{ route('downloadPng', $data->id_barang) }}" class="btn btn-warning"><i class="fa fa-qrcode"></i></a>
                                                <!-- <img src="data:'string(9) 'image/png'';base64,{{ $data->generate }}" width="50" height="50"/></td> -->
                                              </button>
                                            <td>{{ $data->id_barang }}</td>
                                            <td>{{ $data->kategori->nama_kategori }}</td>
                                            <td>{{ $data->merk->nama_merk }}</td>
                                            <td>{{ $data->tipe->nama_tipe }}</td>
                                            <td>{{ $data->kuantitas }}</td>
                                            <td>
                                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editData" data-id_barang="{{ $data->id_barang }}" data-kategori="{{ $data->id_kategori }}" data-merk="{{ $data->id_merk }}" data-tipe="{{ $data->id_tipe }}" data-kuantitas="{{ $data->kuantitas }}"><i class="fa fa-edit"></i> Edit</button>
                                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteData" data-id_barang="{{ $data->id_barang }}"><i class="fa fa-trash"></i> Delete</button>
                                            </td>
                                          </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div>
        <!-- .content -->

        <!-- Modal QR CODE-->
        <div id="qrcode" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="fa fa-qrcode"></span> QR CODE</h4>
              </div>
              <div class="modal-body">
                <img id="imgQrcode" src="" width="500" height="500"/></td>
              </div>
              <div class="modal-footer">
                  <a id="downloadPng" href="#" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
                  <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
              </div>
          </div>
        </div>
      </div>

      <!-- Modal Add Data-->
      <div id="addData" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><span class="fa fa-plus-circle"></span> Add Data Barang</h4>
            </div>
            <div class="modal-body">
              <form id="modal-form-add" action="{{ route('data-barang.store') }}" method="post" role="form">
                {{ csrf_field() }}
                <div class="form-group has-success">
                  <label for="id_barang" class="form-control-label">Id Barang</label>
                  <input type="text" id="id_barang" name="id_barang" class="form-control" required/>
                  <span class="text-warning" ></span>
                </div>
                <div class="form-group has-success">
                  <label for="id_kategori" class="form-control-label">Kategori</label>
                  <select name="id_kategori" class="form-control">
                    @foreach($kategori as $data)
                      <option value="{{ $data->id_kategori }}">{{ $data->nama_kategori }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group has-success">
                  <label for="id_merk" class="form-control-label">Merk</label>
                  <select name="id_merk" class="form-control">
                    @foreach($merk as $data)
                      <option value="{{ $data->id_merk }}">{{ $data->nama_merk }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group has-success">
                  <label for="id_tipe" class="form-control-label">Tipe</label>
                  <select name="id_tipe" class="form-control">
                    @foreach($tipe as $data)
                      <option value="{{ $data->id_tipe }}">{{ $data->nama_tipe }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group has-success">
                  <label for="kuantitas" class="form-control-label">Kuantitas</label>
                  <input type="number" id="kuantitas" name="kuantitas" class="form-control" required/>
                  <span class="text-warning" ></span>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class=" btn btn-success"><span class="fa fa-plus-circle"></span> Submit</button>
              <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Edit Data-->
      <div id="editData" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><span class="fa fa-edit"></span> Edit Data</h4>
            </div>
              <form id="modal-form-edit" method="post" action="{{ route('data-barang.update', 'update') }}">
                  {{ method_field('patch') }}
                  {{ csrf_field() }}
            <div class="modal-body">
                  <input type="hidden" name="id_barang" id="cat_id" value="">
                  <div class="form-group has-success">
                    <label for="id_barang" class="form-control-label">Id Barang</label>
                    <input type="text" id="id_barang" name="id_barang" class="form-control" readonly/>
                    <span class="text-warning" ></span>
                  </div>
                  <div class="form-group has-success">
                    <label for="id_kategori" class="form-control-label">Kategori</label>
                    <select id="id_kategori" name="id_kategori" class="form-control">
                      @foreach($kategori as $data)
                        <option value="{{ $data->id_kategori }}">{{ $data->nama_kategori }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group has-success">
                    <label for="id_merk" class="form-control-label">Merk</label>
                    <select id="id_merk" name="id_merk" class="form-control">
                      @foreach($merk as $data)
                        <option value="{{ $data->id_merk }}">{{ $data->nama_merk }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group has-success">
                    <label for="id_tipe" class="form-control-label">Tipe</label>
                    <select id="id_tipe" name="id_tipe" class="form-control">
                      @foreach($tipe as $data)
                        <option value="{{ $data->id_tipe }}">{{ $data->nama_tipe }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group has-success">
                    <label for="kuantitas" class="form-control-label">Kuantitas</label>
                    <input type="number" id="kuantitas" name="kuantitas" class="form-control" required/>
                    <span class="text-warning" ></span>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-warning" id="btnEdit"><span class="fa fa-edit"></span> Edit</button>
              <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
            </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal Delete Data-->
      <div id="deleteData" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title text-center"><span class="fa fa-check"></span> Delete Confirmation</h4>
            </div>
              <form id="modal-form-delete" method="post" action="{{ route('data-barang.destroy', 'destroy') }}">
                  {{ method_field('delete') }}
                  {{ csrf_field() }}
            <div class="modal-body">
                  <input type="hidden" name="id_barang" id="cat_id" value="">
                  <p><center>Are you sure you want to delete this ?</center></p>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-danger" id="btnDelete"><span class="fa fa-trash"></span> Yes, Delete</button>
              <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times-circle"></span> No, Cancel</button>
            </div>
            </form>
          </div>
        </div>
      </div>

        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2019 M-GOLEM
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.1.0/dist/sweetalert2.all.js"></script>
    <script src="/assets/js/main.js"></script>


    <script src="/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="/assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="/assets/js/init/datatables-init.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();

          $('#qrcode').on('show.bs.modal', function (event) {
            event.preventDefault();

            var button = $(event.relatedTarget) // Button that triggered the modal
            var generate   = button.data('generate') // Extract info from data-* attributes
            var png  = button.data('png')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body #imgQrcode').attr("src", generate);
            modal.find('.modal-footer #downloadPng').attr("href", png);
          });

          $('#addData').on('show.bs.modal', function(event) {
            event.preventDefault();
          });

          var formAdd    = $('#modal-form-add');
          formAdd.submit(function (e) {
              e.preventDefault();

              $.ajax({
                  url: formAdd.attr('action'),
                  type: "POST",
                  data: formAdd.serialize(),
                  dataType: "json",
                  success: function( res ){
                    console.log(res)
                    if( res.error == 0 ){
                      $('#addData').modal('hide');
                      swal(
                        'Success',
                        res.message,
                            'success'
                        ).then(OK => {
                          if(OK){
                            window.location.href = "{{ route('dataBarangAdmin') }}";
                          }
                        });
                    } else{
                        $('#addData').modal('hide');
                        swal(
                          'Fail',
                          res.message,
                          'error'
                        ).then(OK => {
                          if(OK){
                            window.location.href = "{{ route('dataBarangAdmin') }}";
                          }
                        });
                      }
                    }
                })
            });

            $('#editData').on('show.bs.modal', function (event) {
              event.preventDefault();

              var button = $(event.relatedTarget) // Button that triggered the modal
              var id_barang = button.data('id_barang')
              var kategori = button.data('kategori') // Extract info from data-* attributes
              var merk = button.data('merk')
              var tipe = button.data('tipe')
              var qty  = button.data('kuantitas')

              // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
              // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
              var modal = $(this)
              modal.find('.modal-body #id_barang').val(id_barang)
              modal.find('.modal-body #id_kategori').val(kategori)
              modal.find('.modal-body #id_merk').val(merk)
              modal.find('.modal-body #id_tipe').val(tipe)
              modal.find('.modal-body #kuantitas').val(qty)
              // $("#id_tipe").prop('disabled', true);
            });

            var formEdit   = $('#modal-form-edit');
            formEdit.submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: formEdit.attr('action'),
                type: "POST",
                data: formEdit.serialize(),
                dataType: "json",
                success: function( res ){
                  console.log(res)
                  if( res.error == 0 ){
                    $('#editData').modal('hide');
                    swal(
                      'Success',
                      res.message,
                          'success'
                      ).then(OK => {
                        if(OK){
                          window.location.href = "{{ route('dataBarangAdmin') }}";
                        }
                      });
                  } else{
                      $('#editData').modal('hide');
                      swal(
                        'Fail',
                        res.message,
                        'error'
                      ).then(OK => {
                        if(OK){
                          window.location.href = "{{ route('dataBarangAdmin') }}";
                        }
                      });
                    }
                  }
                })
            });

            $('#deleteData').on('show.bs.modal', function (event) {
              event.preventDefault();

              var button     = $(event.relatedTarget)
              var id_barang = button.data('id_barang')
              var modal      = $(this)
              modal.find('.modal-body #cat_id').val(id_barang)
            });

            var formDelete = $('#modal-form-delete');
            formDelete.submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: formDelete.attr('action'),
                    type: "POST",
                    data: formDelete.serialize(),
                    dataType: "json",
                    success: function( res ){
              				console.log(res)
              				if( res.error == 0 ){
                        $('#deleteData').modal('hide');
              					swal(
              					  'Success',
              					  res.message,
                  					  'success'
                					).then(OK => {
                            if(OK){
                                window.location.href = "{{ route('dataBarangAdmin') }}";
                            }
                          });
                  		}else{
                          $('#deleteData').modal('hide');
                  				swal(
                  				  'Fail',
                					  res.message,
                					  'error'
                					).then(OK => {
                            if(OK){
                              window.location.href = "{{ route('dataBarangAdmin') }}";
                            }
                          });
                				}
                			}
                  })
              });

      } );
    </script>

</body>
</html>
