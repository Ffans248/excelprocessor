<?php
$id =$_GET['id'];
$nombre =$_GET['nombre'];
$telefono =$_GET['telefono'];
$descripcion =$_GET['descripcion'];
$email =$_GET['email'];


 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EXCELPROCESSOR | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Option 1: Include in HTML -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">EXCELPROCESSOR</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Empresas
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="newempresa.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Crear empresa</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="empresas.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Ver empresas existentes</p>
                  </a>
                </li>
              </ul>

            </li>

            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Tablas
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tablas</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Archivos
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="archivos.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Subir Archivos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="descargarArchivos.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Descargar Archivos</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Tablas</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Tablas</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
           <div class="col-12">
           <div class="mb-3 text-center"><h1>Editar estudiantes</h1></div> 
    <form action="updateEmpresa.php" method="POST">
        <div style="margin: 15px;">
            <div class="mb-3">
                <label for="Clave" class="form-label">ID</label>
                <input type="text" class="form-control" name="clave" placeholder="ID" value="<?php echo $id;?>"
                    readonly>
            </div>
            <div class="mb-3">
                <label for="PNombre" class="form-label">Nombre de la empresa:</label>
                <input type="text" class="form-control" name="nombre" placeholder="Fecha de emisión" value="<?php echo $nombre;?>" required>
            </div>
           
            <div class="mb-3">
                <label for="TNombre" class="form-label">Telefono:</label>
                <input type="text" class="form-control" name="telefono" placeholder="Telefono" value="<?php echo $telefono;?>">
            </div>

            <div class="mb-3">
                <label for="PApellido" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" placeholder="Descripción de la empresa" required value="<?php echo $descripcion;?>">
            </div>
            <div class="mb-3">
                <label for="SApellido" class="form-label">Correo</label>
                <input type="text" class="form-control" name="email" placeholder="Correo de la empresa" required value="<?php echo $email;?>">
            </div>

            <div class="d-grid mb-3">
                <button class="btn btn-success" type="submit">Registrar</button>
            </div>
            
        </div>
    </form>
           </div>
          </div>
        </div>
      </section>
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <!-- Page specific script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>

  <script>
    $(document).ready(function () {
      // Inicializa DataTables después de que los datos estén en la tabla
      $('#example2').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
  </script>
</body>

</html> 