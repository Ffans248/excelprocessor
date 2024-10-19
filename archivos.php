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
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
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
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
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
                            <h1>Subir Archivos</h1>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content mb-4">
                <!-- <form action="Importar.php" method="POST" enctype="multipart/form-data"> 
                    <div class="mb-12">
                        <label for="formFile" class="form-label">Subir Archivos de Compras y Ventas Juntos (Subir primero el de Ventas y luego el de Compras) </label>
                        <div class="mb-6 row">
                            <div class="col">
                                <input class="form-control" type="file" id="formFile" name="archivo">
                            </div>
                            <div class="col">
                                <input class="form-control" type="file" id="formFile2" name="archivo2">
                            </div>
                        </div>
                        <div class="mb-6 d-flex justify-content-center">
                            <input class="form-control" type="submit" value="Subir Archivos">
                        </div>
                    </div>
                </form>-->


                <form action="ImportarCompras.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-12">
                        <label for="empresaCompras" class="form-label">Seleccionar Empresa para Compras</label>
                        <div class="mb-6 row">
                            <div class="col">
                                <select class="form-select" name="empresaCompras" id="empresaCompras" required>
                                    <option value="">--Selecciona una empresa--</option>
                                    <?php

                                    require 'conexion.php';

                                    // Obtener todas las empresas para el filtro
                                    $sql_empresas = "SELECT id, nombre FROM empresa";
                                    $resultado_empresas = mysqli_query($mysqli, $sql_empresas);

                                    // Verificar si se ha seleccionado una empresa
                                    $filtro_empresa = '';
                                    if (isset($_GET['empresa']) && $_GET['empresa'] != '') {
                                        $filtro_empresa = $_GET['empresa'];
                                        $sql = "SELECT * FROM compras WHERE fk_empresa = '$filtro_empresa'";
                                        $sql2 = "SELECT * FROM ventas WHERE fk_empresa = '$filtro_empresa'";
                                    } else {
                                        // Si no hay filtro, mostrar todos los registros
                                        $sql = "SELECT * FROM compras";
                                        $sql2 = "SELECT * FROM ventas";
                                    }

                                    if ($resultado_empresas) {
                                        while ($empresa = mysqli_fetch_assoc($resultado_empresas)) {
                                            echo "<option value='" . $empresa['id'] . "'>" . $empresa['nombre'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <label for="formFileCompras" class="form-label">Subir Archivos de Compras</label>
                        <div class="mb-6 row">
                            <div class="col">
                                <input class="form-control" type="file" id="formFileCompras" name="archivo" required>
                            </div>
                        </div>
                        <div class="mb-6 d-flex justify-content-center">
                            <input class="form-control" type="submit" value="Subir Archivos de Compras">
                        </div>
                    </div>
                </form>
                <br><br>

                <form action="ImportarVentas.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-12">
                        <label for="empresaVentas" class="form-label">Seleccionar Empresa para Ventas</label>
                        <div class="mb-6 row">
                            <div class="col">
                                <select class="form-select" name="empresaVentas" id="empresaVentas" required>
                                    <option value="">--Selecciona una empresa--</option>
                                    <?php

                                    require 'conexion.php';

                                    // Obtener todas las empresas para el filtro
                                    $sql_empresas = "SELECT id, nombre FROM empresa";
                                    $resultado_empresas = mysqli_query($mysqli, $sql_empresas);

                                    // Verificar si se ha seleccionado una empresa
                                    $filtro_empresa = '';
                                    if (isset($_GET['empresa']) && $_GET['empresa'] != '') {
                                        $filtro_empresa = $_GET['empresa'];
                                        $sql = "SELECT * FROM compras WHERE fk_empresa = '$filtro_empresa'";
                                        $sql2 = "SELECT * FROM ventas WHERE fk_empresa = '$filtro_empresa'";
                                    } else {
                                        // Si no hay filtro, mostrar todos los registros
                                        $sql = "SELECT * FROM compras";
                                        $sql2 = "SELECT * FROM ventas";
                                    }

                                    if ($resultado_empresas) {
                                        while ($empresa = mysqli_fetch_assoc($resultado_empresas)) {
                                            echo "<option value='" . $empresa['id'] . "'>" . $empresa['nombre'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <label for="formFileVentas" class="form-label">Subir Archivos de Ventas</label>
                        <div class="mb-6 row">
                            <div class="col">
                                <input class="form-control" type="file" id="formFileVentas" name="archivo2" required>
                            </div>
                        </div>
                        <div class="mb-6 d-flex justify-content-center">
                            <input class="form-control" type="submit" value="Subir Archivos de Ventas">
                        </div>
                    </div>
                </form>

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
</body>

</html>