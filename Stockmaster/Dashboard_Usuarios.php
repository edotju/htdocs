<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Panel Principal - Inventario</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="stockmaster_solo_blanco_cortado.png" type="image/png">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .inventory-section {
            margin-top: 80px;
        }
        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }
        .navbar-search {
            margin-left: 20px;
        }
            /* New CSS for keeping nav links horizontal after collapse */
       @media (max-width: 991.98px) {
        .navbar-collapse .navbar-nav {
            flex-direction: row;
        }
        .navbar-collapse .nav-item {
            margin-right: 10px;
        }
        .navbar-collapse .navbar-search {
            margin-left: auto;
        }
        }
        .user-image {
        margin-left: 20px; /* Add left margin by default */
    }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="stockmaster_solo_blanco_cortado.png" alt="Logo Stockmaster">
            Stockmaster
        </a>
        <!-- User Image on the right -->
        <div class="d-flex align-items-center order-lg-2">
            <img src="user-removebg.png" height="40" width="40" class="rounded-circle me-2 user-image">
            <!-- Toggler button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Screen_productos.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Categorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Movimiento</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Usuarios</a>
                </li>
            </ul>

            <!-- Search bar -->
            <form class="d-flex navbar-search" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Buscar">
                <button class="btn btn-outline-light" type="submit">Buscar</button>
            </form>

            
        </div>
    </div>
</nav>
<!-- Navbar -->

<!-- Main Section -->
<div class="container inventory-section">
    <h2 class="mb-4">Panel de Inventario</h2>

    <!-- Placeholder for Inventory Table -->
    <div class="card">
        <div class="card-header">
            Productos Disponibles
        </div>
        <div class="card-body">
            <p>Aquí puedes ver todos los productos registrados en el sistema.</p>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Producto A</td>
                        <td>Categoría X</td>
                        <td>15</td>
                        <td>$25.00</td>
                        <td>
                            <button class="btn btn-sm btn-primary">Editar</button>
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </td>
                    </tr>
                    <!-- More rows can go here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
