<?php
require 'conexion.php';
$sql = "SELECT * FROM compras";
$resultado = mysqli_query($mysqli, $sql);
$sql2 = "SELECT * FROM ventas ";
$resultado2 = mysqli_query($mysqli, $sql2);
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
      <a href="index.php" class="brand-link">
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
                  <a href="archivos.html" class="nav-link active">
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
          </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Tablas de Datos con Exportaciones</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      <th>ID</th>
                        <th>Fecha de Emisión</th>

                        <th>Serie</th>
                        <th>Número de DTE</th>
                        <th>ID de Receptor</th>
                        <th>Nombre completo del receptor</th> 
                        <th>Monto Gran Total</th>
                        <th>Monto sin IVA</th>
                        <th>Monto IVA</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php



                      if ($resultado2) {
                        while ($row2 = $resultado2->fetch_array()) {
                          echo "<tr>";
                          echo "<td>" . $row2['id'] . "</td>";
                          echo "<td>" . $row2['fecha_emision'] . "</td>";
                          echo "<td>" . $row2['serie'] . "</td>";
                          echo "<td>" . $row2['numero_DTE'] . "</td>";
                          echo "<td>" . $row2['id_receptor'] . "</td>";
                          echo "<td>" . $row2['nombre_completo_receptor'] . "</td>";
                          echo "<td>" . $row2['monto_grantotal'] . "</td>";
                          echo "<td>" . $row2['monto_sinIVA'] . "</td>";
                          echo "<td>" . $row2['monto_IVA'] . "</td>";

                          ?>
                          <td> <a
                              href="actualizarVentas.php?id=<?php echo urlencode($row2['id']); ?>&fecha_emision=<?php echo urlencode($row2['fecha_emision']); ?>&serie=<?php echo urlencode($row2['serie']); ?>&numero_DTE=<?php echo urlencode($row2['numero_DTE']); ?>&id_receptor=<?php echo urlencode($row2['id_receptor']); ?>&nombre_completo_receptor=<?php echo urlencode($row2['nombre_completo_receptor']); ?>&monto_grantotal=<?php echo urlencode($row2['monto_grantotal']); ?>&monto_sinIVA=<?php echo urlencode($row2['monto_sinIVA']); ?>&monto_IVA=<?php echo urlencode($row2['monto_IVA']); ?>">
                              <i class="bi bi-pencil"></i>
                            </a>
                            <a href="deleteV.php?id=<?php echo $row2['id']; ?>"><i class="bi bi-trash"></i></button></a>


                          </td>
                          <?php
                          echo "</tr>";
                          //include("aqdmindelete.php");
                        }
                      }


                      ?>

                      <!-- Add more rows as needed -->
                    </tbody>
                    <tfoot>
                      
                    </tfoot>

                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Libro de compras</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body mb-6">
                  <table id="example2" class="table table-bordered table-sm table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Fecha de Emisión</th>
                        <th>Tipo de DTE</th>
                        <th>Serie</th>
                        <th>Número de DTE</th>
                        <th>NIT emisor</th>
                        <th>Nombre completo del emisor</th>
                        <th>Código de Establecimiento</th>
                        <th>Moneda</th>
                        <th>Monto Gran Total</th>
                        <th>Monto sin IVA</th>
                        <th>Monto IVA</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php



                      if ($resultado) {
                        while ($row = $resultado->fetch_array()) {
                          echo "<tr>";
                          echo "<td>" . $row['id'] . "</td>";
                          echo "<td>" . $row['fecha_emision'] . "</td>";
                          echo "<td>" . $row['tipo_DTE'] . "</td>";
                          echo "<td>" . $row['serie'] . "</td>";
                          echo "<td>" . $row['numero_DTE'] . "</td>";
                          echo "<td>" . $row['NIT_emisor'] . "</td>";
                          echo "<td>" . $row['nombre_completo_emisor'] . "</td>";
                          echo "<td>" . $row['codigo_establecimiento'] . "</td>";
                          echo "<td>" . $row['moneda'] . "</td>";
                          echo "<td>" . $row['monto_grantotal'] . "</td>";
                          echo "<td>" . $row['monto_sinIVA'] . "</td>";
                          echo "<td>" . $row['monto_IVA'] . "</td>";
                          ?>
                          <td> <a
                              href="actualizar.php?id=<?php echo urlencode($row['id']); ?>&fecha_emision=<?php echo urlencode($row['fecha_emision']); ?>&tipo_DTE=<?php echo urlencode($row['tipo_DTE']); ?>&serie=<?php echo urlencode($row['serie']); ?>&numero_DTE=<?php echo urlencode($row['numero_DTE']); ?>&NIT_emisor=<?php echo urlencode($row['NIT_emisor']); ?>&nombre_completo_emisor=<?php echo urlencode($row['nombre_completo_emisor']); ?>&codigo_establecimiento=<?php echo urlencode($row['codigo_establecimiento']); ?>&moneda=<?php echo urlencode($row['moneda']); ?>&monto_grantotal=<?php echo urlencode($row['monto_grantotal']); ?>&monto_sinIVA=<?php echo urlencode($row['monto_sinIVA']); ?>&monto_IVA=<?php echo urlencode($row['monto_IVA']); ?>">
                              <i class="bi bi-pencil"></i>
                            </a>
                            <a href="deleteC.php?id=<?php echo $row['id']; ?>"><i class="bi bi-trash"></i></button></a>


                          </td>
                          <?php
                          echo "</tr>";
                          //include("aqdmindelete.php");
                        }
                      }


                      ?>

                      <!-- Add more rows as needed -->
                    </tbody>
                    <tfoot>

                    </tfoot>

                  </table>
                </div>
                <!-- /.card-body -->
              </div>
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