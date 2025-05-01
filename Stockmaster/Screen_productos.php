<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Panel de Productos - Stockmaster</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="stockmaster_solo_blanco_cortado.png" type="image/png">
    <style>
        body {
            background-color: #f8f9fa;
            padding-bottom: 2rem;
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
            margin-left: 20px;
        }
        .actions-column {
            min-width: 160px;
        }
        .card {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }
        .card-header {
            background-color: #343a40;
            color: white;
            font-weight: bold;
        }
        .filters-card {
            margin-bottom: 1.5rem;
        }
        .stock-warning {
            color: #dc3545;
            font-weight: bold;
        }
        .stock-ok {
            color: #198754;
        }
        .table-container {
            overflow-x: auto;
        }
        .badge-category {
            font-size: 0.85rem;
        }
        .page-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }
        .pagination {
            justify-content: center;
            margin-top: 1rem;
        }
        .modal-header {
            background-color: #343a40;
            color: white;
        }
        .modal-footer {
            justify-content: space-between;
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
                    <a class="nav-link" href="dashboard.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="Screen_productos.php">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Categorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Proveedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Usuarios</a>
                </li>
            </ul>

            <!-- Search bar -->
            <form class="d-flex navbar-search" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar producto..." aria-label="Buscar">
                <button class="btn btn-outline-light" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>

<!-- Main Section -->
<div class="container inventory-section">
    <div class="page-title">
        <h2>Gestión de Productos</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="fas fa-plus"></i> Nuevo Producto
        </button>
    </div>

    <!-- Filters Card -->
    <div class="card filters-card">
        <div class="card-header">
            <i class="fas fa-filter"></i> Filtros
        </div>
        <div class="card-body">
            <form class="row g-3">
                <div class="col-md-3">
                    <label for="filterCategory" class="form-label">Categoría</label>
                    <select class="form-select" id="filterCategory">
                        <option value="">Todas las categorías</option>
                        <option value="1">Electrónicos</option>
                        <option value="2">Accesorios</option>
                        <option value="3">Herramientas</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="filterStock" class="form-label">Stock</label>
                    <select class="form-select" id="filterStock">
                        <option value="">Todos</option>
                        <option value="low">Stock bajo</option>
                        <option value="out">Sin stock</option>
                        <option value="available">Disponible</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="filterPrice" class="form-label">Precio</label>
                    <select class="form-select" id="filterPrice">
                        <option value="">Todos</option>
                        <option value="asc">Menor a mayor</option>
                        <option value="desc">Mayor a menor</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Aplicar filtros</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Table Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-box"></i> Productos Registrados</span>
            <div class="btn-group">
                <button class="btn btn-sm btn-outline-light" title="Exportar a Excel">
                    <i class="fas fa-file-excel"></i>
                </button>
                <button class="btn btn-sm btn-outline-light" title="Exportar a PDF">
                    <i class="fas fa-file-pdf"></i>
                </button>
                <button class="btn btn-sm btn-outline-light" title="Imprimir">
                    <i class="fas fa-print"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Precio Costo</th>
                            <th>Precio Venta</th>
                            <th>Último Movimiento</th>
                            <th class="actions-column">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><img src="/api/placeholder/50/50" class="product-image" alt="Producto"></td>
                            <td>PROD001</td>
                            <td>Laptop HP Pavilion</td>
                            <td><span class="badge bg-info badge-category">Electrónicos</span></td>
                            <td><span class="stock-ok">15 unidades</span></td>
                            <td>$450.00</td>
                            <td>$699.99</td>
                            <td>24/04/2025</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Ver detalles" data-bs-toggle="modal" data-bs-target="#viewProductModal">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Editar" data-bs-toggle="modal" data-bs-target="#editProductModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success" title="Añadir stock" data-bs-toggle="modal" data-bs-target="#addStockModal">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" title="Reducir stock" data-bs-toggle="modal" data-bs-target="#reduceStockModal">
                                        <i class="fas fa-minus-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar" data-bs-toggle="modal" data-bs-target="#deleteProductModal">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><img src="/api/placeholder/50/50" class="product-image" alt="Producto"></td>
                            <td>PROD002</td>
                            <td>Mouse Inalámbrico Logitech</td>
                            <td><span class="badge bg-secondary badge-category">Accesorios</span></td>
                            <td><span class="stock-warning">3 unidades</span></td>
                            <td>$15.00</td>
                            <td>$29.99</td>
                            <td>26/04/2025</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success" title="Añadir stock">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" title="Reducir stock">
                                        <i class="fas fa-minus-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><img src="/api/placeholder/50/50" class="product-image" alt="Producto"></td>
                            <td>PROD003</td>
                            <td>Monitor Samsung 24"</td>
                            <td><span class="badge bg-info badge-category">Electrónicos</span></td>
                            <td><span class="stock-ok">8 unidades</span></td>
                            <td>$120.00</td>
                            <td>$199.99</td>
                            <td>20/04/2025</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success" title="Añadir stock">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" title="Reducir stock">
                                        <i class="fas fa-minus-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><img src="/api/placeholder/50/50" class="product-image" alt="Producto"></td>
                            <td>PROD004</td>
                            <td>Teclado Mecánico RGB</td>
                            <td><span class="badge bg-secondary badge-category">Accesorios</span></td>
                            <td><span class="stock-warning">2 unidades</span></td>
                            <td>$35.00</td>
                            <td>$59.99</td>
                            <td>27/04/2025</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success" title="Añadir stock">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" title="Reducir stock">
                                        <i class="fas fa-minus-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><img src="/api/placeholder/50/50" class="product-image" alt="Producto"></td>
                            <td>PROD005</td>
                            <td>Destornillador Phillips</td>
                            <td><span class="badge bg-warning text-dark badge-category">Herramientas</span></td>
                            <td><span class="stock-ok">25 unidades</span></td>
                            <td>$3.50</td>
                            <td>$7.99</td>
                            <td>15/04/2025</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-info" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-success" title="Añadir stock">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" title="Reducir stock">
                                        <i class="fas fa-minus-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <nav aria-label="Navegación de páginas">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel"><i class="fas fa-plus-circle"></i> Agregar Nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productCode" class="form-label">Código</label>
                            <input type="text" class="form-control" id="productCode" placeholder="Código único del producto" required>
                        </div>
                        <div class="col-md-6">
                            <label for="productName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="productName" placeholder="Nombre del producto" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Descripción</label>
                        <textarea class="form-control" id="productDescription" rows="3" placeholder="Descripción detallada del producto"></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productCategory" class="form-label">Categoría</label>
                            <select class="form-select" id="productCategory" required>
                                <option value="">Seleccionar categoría</option>
                                <option value="1">Electrónicos</option>
                                <option value="2">Accesorios</option>
                                <option value="3">Herramientas</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="productImage" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="productImage">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="productCostPrice" class="form-label">Precio de Costo</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="productCostPrice" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="productSalePrice" class="form-label">Precio de Venta</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="productSalePrice" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="productProfit" class="form-label">Ganancia</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="productProfit" readonly>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="productStock" class="form-label">Stock Inicial</label>
                            <input type="number" class="form-control" id="productStock" min="0" value="0" required>
                        </div>
                        <div class="col-md-6">
                            <label for="productMinStock" class="form-label">Stock Mínimo</label>
                            <input type="number" class="form-control" id="productMinStock" min="0" value="5">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Producto</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel"><i class="fas fa-edit"></i> Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editProductCode" class="form-label">Código</label>
                            <input type="text" class="form-control" id="editProductCode" value="PROD001" required>
                        </div>
                        <div class="col-md-6">
                            <label for="editProductName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editProductName" value="Laptop HP Pavilion" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editProductDescription" class="form-label">Descripción</label>
                        <textarea class="form-control" id="editProductDescription" rows="3">Laptop HP Pavilion con procesador Intel Core i5, 8GB RAM, 512GB SSD</textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editProductCategory" class="form-label">Categoría</label>
                            <select class="form-select" id="editProductCategory" required>
                                <option value="">Seleccionar categoría</option>
                                <option value="1" selected>Electrónicos</option>
                                <option value="2">Accesorios</option>
                                <option value="3">Herramientas</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="editProductImage" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="editProductImage">
                            <div class="mt-2">
                                <img src="/api/placeholder/100/100" class="img-thumbnail" alt="Imagen actual" style="height: 100px;">
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" id="deleteImage">
                                    <label class="form-check-label" for="deleteImage">
                                        Eliminar imagen actual
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="editProductCostPrice" class="form-label">Precio de Costo</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="editProductCostPrice" step="0.01" min="0" value="450.00" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="editProductSalePrice" class="form-label">Precio de Venta</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="editProductSalePrice" step="0.01" min="0" value="699.99" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="editProductProfit" class="form-label">Ganancia</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="editProductProfit" value="55.55" readonly>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="editProductStock" class="form-label">Stock Actual</label>
                            <input type="number" class="form-control" id="editProductStock" min="0" value="15" readonly>
                            <small class="form-text text-muted">Para modificar el stock, use las opciones de entrada/salida.</small>
                        </div>
                        <div class="col-md-6">
                            <label for="editProductMinStock" class="form-label">Stock Mínimo</label>
                            <input type="number" class="form-control" id="editProductMinStock" min="0" value="5">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<!-- View Product Modal -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewProductModalLabel"><i class="fas fa-info-circle"></i> Detalles del Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center mb-3">
                        <img src="/api/placeholder/200/200" class="img-fluid rounded" alt="Producto">
                    </div>
                    <div class="col-md-8">
                        <h4>Laptop HP Pavilion</h4>
                        <p class="text-muted">Código: PROD001</p>
                        <span class="badge bg-info mb-2">Electrónicos</span>
                        <p>Laptop HP Pavilion con procesador Intel Core i5, 8GB RAM, 512GB SSD</p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Stock Actual</h5>
                                <p class="card-text fs-3 fw-bold">$699.99</p>
                                <p class="card-text text-muted">Ganancia: 55.55%</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <h5 class="mt-4">Últimos Movimientos</h5>
                <div class="table-container">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th>Cantidad</th>
                                <th>Usuario</th>
                                <th>Motivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>24/04/2025</td>
                                <td><span class="badge bg-success">Entrada</span></td>
                                <td>+5</td>
                                <td>Administrador</td>
                                <td>Reposición de inventario</td>
                            </tr>
                            <tr>
                                <td>20/04/2025</td>
                                <td><span class="badge bg-danger">Salida</span></td>
                                <td>-2</td>
                                <td>Administrador</td>
                                <td>Venta</td>
                            </tr>
                            <tr>
                                <td>15/04/2025</td>
                                <td><span class="badge bg-success">Entrada</span></td>
                                <td>+12</td>
                                <td>Administrador</td>
                                <td>Compra inicial</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal" data-bs-dismiss="modal">Editar Producto</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Stock Modal -->
<div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStockModalLabel"><i class="fas fa-plus-circle"></i> Añadir Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" value="Laptop HP Pavilion (PROD001)" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="addStockQuantity" class="form-label">Cantidad a añadir</label>
                        <input type="number" class="form-control" id="addStockQuantity" min="1" value="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="addStockReason" class="form-label">Motivo</label>
                        <select class="form-select" id="addStockReason" required>
                            <option value="">Seleccionar motivo</option>
                            <option value="purchase">Compra</option>
                            <option value="return">Devolución</option>
                            <option value="adjustment">Ajuste de inventario</option>
                            <option value="other">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="addStockNotes" class="form-label">Notas adicionales</label>
                        <textarea class="form-control" id="addStockNotes" rows="2"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success">Confirmar Entrada</button>
            </div>
        </div>
    </div>
</div>

<!-- Reduce Stock Modal -->
<div class="modal fade" id="reduceStockModal" tabindex="-1" aria-labelledby="reduceStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reduceStockModalLabel"><i class="fas fa-minus-circle"></i> Reducir Stock</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Producto</label>
                        <input type="text" class="form-control" value="Laptop HP Pavilion (PROD001)" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="reduceStockQuantity" class="form-label">Cantidad a reducir</label>
                        <input type="number" class="form-control" id="reduceStockQuantity" min="1" max="15" value="1" required>
                        <small class="form-text text-muted">Stock actual: 15 unidades</small>
                    </div>
                    <div class="mb-3">
                        <label for="reduceStockReason" class="form-label">Motivo</label>
                        <select class="form-select" id="reduceStockReason" required>
                            <option value="">Seleccionar motivo</option>
                            <option value="sale">Venta</option>
                            <option value="damage">Producto dañado</option>
                            <option value="loss">Pérdida</option>
                            <option value="return">Devolución a proveedor</option>
                            <option value="adjustment">Ajuste de inventario</option>
                            <option value="other">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="reduceStockNotes" class="form-label">Notas adicionales</label>
                        <textarea class="form-control" id="reduceStockNotes" rows="2"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-warning">Confirmar Salida</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Product Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteProductModalLabel"><i class="fas fa-exclamation-triangle"></i> Eliminar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea eliminar el producto <strong>Laptop HP Pavilion (PROD001)</strong>?</p>
                <p class="text-danger">Esta acción no se puede deshacer y eliminará también todos los movimientos asociados al producto.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Eliminar Permanentemente</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Calculate profit percentage when cost or sale price changes
    document.addEventListener('DOMContentLoaded', function() {
        // For new product form
        const costInput = document.getElementById('productCostPrice');
        const saleInput = document.getElementById('productSalePrice');
        const profitInput = document.getElementById('productProfit');
        
        // For edit product form
        const editCostInput = document.getElementById('editProductCostPrice');
        const editSaleInput = document.getElementById('editProductSalePrice');
        const editProfitInput = document.getElementById('editProductProfit');
        
        // Calculate profit function
        function calculateProfit(cost, sale, profitField) {
            if (cost > 0 && sale > 0) {
                const profit = ((sale - cost) / cost) * 100;
                profitField.value = profit.toFixed(2);
            } else {
                profitField.value = "";
            }
        }
        
        // Add event listeners for new product form
        if (costInput && saleInput && profitInput) {
            costInput.addEventListener('input', () => {
                calculateProfit(parseFloat(costInput.value) || 0, parseFloat(saleInput.value) || 0, profitInput);
            });
            
            saleInput.addEventListener('input', () => {
                calculateProfit(parseFloat(costInput.value) || 0, parseFloat(saleInput.value) || 0, profitInput);
            });
        }
        
        // Add event listeners for edit product form
        if (editCostInput && editSaleInput && editProfitInput) {
            editCostInput.addEventListener('input', () => {
                calculateProfit(parseFloat(editCostInput.value) || 0, parseFloat(editSaleInput.value) || 0, editProfitInput);
            });
            
            editSaleInput.addEventListener('input', () => {
                calculateProfit(parseFloat(editCostInput.value) || 0, parseFloat(editSaleInput.value) || 0, editProfitInput);
            });
        }
    });
</script>
</body>
</html>