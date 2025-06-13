<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle . ' - ' : '' ?>TechTafu - Thiết Bị Điện Tử Chính Hãng</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootswatch Theme -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/flatly/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <!-- Choices.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/ui-lightness/jquery-ui.css">
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --dark-color: #34495e;
            --light-bg: #ecf0f1;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--primary-color) !important;
        }
        
        .navbar-brand i {
            color: var(--secondary-color);
            margin-right: 8px;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)" /></svg>');
            opacity: 0.5;
        }
        
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--secondary-color), #5dade2);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
        }
        
        .product-card {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
        }
        
        .product-card .card-img-top {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .product-card:hover .card-img-top {
            transform: scale(1.05);
        }
        
        .price {
            font-size: 1.4rem;
            font-weight: bold;
            color: var(--accent-color);
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }
        
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--secondary-color), #5dade2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: white;
        }

        /* User Avatar */
        .user-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, var(--secondary-color), #5dade2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .user-info {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            padding: 0.5rem 1rem;
        }

        .admin-badge {
            background: linear-gradient(45deg, #e74c3c, #c0392b);
            color: white;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 5px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.7); }
            70% { box-shadow: 0 0 0 5px rgba(231, 76, 60, 0); }
            100% { box-shadow: 0 0 0 0 rgba(231, 76, 60, 0); }
        }

        .admin-only {
            border-left: 3px solid var(--accent-color);
            background: rgba(231, 76, 60, 0.05);
        }

        /* Notification badges */
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 18px;
            height: 18px;
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: bounce 1s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-5px); }
            60% { transform: translateY(-3px); }
        }

        /* Swiper Styles */
        .hero-swiper {
            width: 100%;
            height: 400px;
        }

        .hero-swiper .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .swiper-pagination-bullet {
            background: rgba(255, 255, 255, 0.5);
        }

        .swiper-pagination-bullet-active {
            background: white;
        }
    </style>
</head>
<body>
    <?php
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Get user info
    $isLoggedIn = isset($_SESSION['username']);
    $username = $isLoggedIn ? $_SESSION['username'] : '';
    $userRole = $isLoggedIn ? ($_SESSION['role'] ?? 'user') : '';
    $isAdmin = $userRole === 'admin';
    ?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-microchip"></i>TechTafu
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fas fa-home me-1"></i>Trang Chủ</a>
                    </li>
                    
                    <!-- Sản phẩm menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-laptop me-1"></i>Sản Phẩm
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/product"><i class="fas fa-list me-2"></i>Tất Cả Sản Phẩm</a></li>
                            <li><a class="dropdown-item" href="/product/featured"><i class="fas fa-star me-2"></i>Sản Phẩm Nổi Bật</a></li>
                            <li><a class="dropdown-item" href="/product/sale"><i class="fas fa-fire me-2"></i>Khuyến Mại</a></li>
                            
                            <?php if ($isAdmin): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li class="admin-only">
                                    <a class="dropdown-item" href="/product/add">
                                        <i class="fas fa-plus me-2 text-danger"></i>Thêm Sản Phẩm
                                    </a>
                                </li>
                                <li class="admin-only">
                                    <a class="dropdown-item" href="/product/manage">
                                        <i class="fas fa-cogs me-2 text-danger"></i>Quản Lý Sản Phẩm
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    
                    <!-- Danh mục menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-tags me-1"></i>Danh Mục
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/category/list"><i class="fas fa-list me-2"></i>Tất Cả Danh Mục</a></li>
                            <li><a class="dropdown-item" href="/category/show/1"><i class="fas fa-laptop me-2"></i>Laptop</a></li>
                            <li><a class="dropdown-item" href="/category/show/2"><i class="fas fa-mobile-alt me-2"></i>Điện Thoại</a></li>
                            <li><a class="dropdown-item" href="/category/show/3"><i class="fas fa-tablet-alt me-2"></i>Tablet</a></li>
                            <li><a class="dropdown-item" href="/category/show/8"><i class="fas fa-headphones me-2"></i>Phụ Kiện</a></li>
                            
                            <?php if ($isAdmin): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li class="admin-only">
                                    <a class="dropdown-item" href="/category/create">
                                        <i class="fas fa-plus me-2 text-danger"></i>Thêm Danh Mục
                                    </a>
                                </li>
                                <li class="admin-only">
                                    <a class="dropdown-item" href="/category/manage">
                                        <i class="fas fa-cogs me-2 text-danger"></i>Quản Lý Danh Mục
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>

                    <!-- Admin menu (chỉ hiển thị với admin) -->
                    <?php if ($isAdmin): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-danger fw-bold" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-shield-alt me-1"></i>Quản Trị
                            </a>
                            <ul class="dropdown-menu">
                                <li class="admin-only">
                                    <a class="dropdown-item" href="/account/admin">
                                        <i class="fas fa-users me-2 text-danger"></i>Quản Lý Người Dùng
                                    </a>
                                </li>
                                <li class="admin-only">
                                    <a class="dropdown-item" href="/product/admin">
                                        <i class="fas fa-boxes me-2 text-danger"></i>Quản Lý Sản Phẩm
                                    </a>
                                </li>
                                <li class="admin-only">
                                    <a class="dropdown-item" href="/category/admin">
                                        <i class="fas fa-tags me-2 text-danger"></i>Quản Lý Danh Mục
                                    </a>
                                </li>
                                <li class="admin-only">
                                    <a class="dropdown-item" href="/order/admin">
                                        <i class="fas fa-shopping-bag me-2 text-danger"></i>Quản Lý Đơn Hàng
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="admin-only">
                                    <a class="dropdown-item" href="/admin/statistics">
                                        <i class="fas fa-chart-bar me-2 text-danger"></i>Thống Kê
                                    </a>
                                </li>
                                <li class="admin-only">
                                    <a class="dropdown-item" href="/admin/settings">
                                        <i class="fas fa-cog me-2 text-danger"></i>Cài Đặt Hệ Thống
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <!-- Support menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="supportDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-question-circle me-1"></i>Hỗ Trợ
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/support/contact"><i class="fas fa-envelope me-2"></i>Liên Hệ</a></li>
                            <li><a class="dropdown-item" href="/support/faq"><i class="fas fa-question me-2"></i>FAQ</a></li>
                            <li><a class="dropdown-item" href="/support/warranty"><i class="fas fa-shield me-2"></i>Bảo Hành</a></li>
                            <li><a class="dropdown-item" href="/support/return"><i class="fas fa-undo me-2"></i>Đổi Trả</a></li>
                        </ul>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center">
                    <!-- Search bar -->
                    <div class="me-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm..." id="searchInput">
                            <button class="btn btn-outline-secondary" type="button" id="searchBtn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Shopping cart -->
                    <a href="/product/cart" class="btn btn-outline-primary position-relative me-3" title="Giỏ hàng">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-badge" id="cartCount">
                            <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                        </span>
                    </a>
                    
                    <?php if ($isLoggedIn): ?>
                        <!-- Notifications (only for logged in users) -->
                        <div class="dropdown me-3">
                            <button class="btn btn-outline-info position-relative" type="button" data-bs-toggle="dropdown" title="Thông báo">
                                <i class="fas fa-bell"></i>
                                <span class="notification-badge">3</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="width: 300px;">
                                <li class="px-3 py-2 bg-light">
                                    <h6 class="mb-0">Thông Báo</h6>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-gift text-success me-2"></i>
                                        <small>Bạn có voucher giảm giá 20%</small>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-shipping-fast text-info me-2"></i>
                                        <small>Đơn hàng #123 đang được giao</small>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-star text-warning me-2"></i>
                                        <small>Sản phẩm mới cập nhật</small>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="text-center">
                                    <a class="dropdown-item" href="/notifications">Xem tất cả</a>
                                </li>
                            </ul>
                        </div>

                        <!-- User menu -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                                <?php if (isset($_SESSION['avatar']) && $_SESSION['avatar'] && file_exists($_SESSION['avatar'])): ?>
                                    <img src="/<?= htmlspecialchars($_SESSION['avatar']) ?>" 
                                         class="rounded-circle me-2" 
                                         style="width: 35px; height: 35px; object-fit: cover;" 
                                         alt="Avatar">
                                <?php else: ?>
                                    <div class="user-avatar me-2">
                                        <?= strtoupper(substr($username, 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                                <div class="d-none d-md-block text-start">
                                    <small class="text-muted d-block">Xin chào</small>
                                    <span class="fw-semibold">
                                        <?= htmlspecialchars($username) ?>
                                        <?php if ($isAdmin): ?>
                                            <span class="admin-badge">ADMIN</span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="px-3 py-2">
                                    <div class="user-info">
                                        <div class="fw-semibold"><?= htmlspecialchars($username) ?></div>
                                        <small class="text-muted">
                                            <?= $isAdmin ? 'Quản trị viên' : 'Người dùng' ?>
                                        </small>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/account/profile"><i class="fas fa-user-circle me-2"></i>Thông Tin Tài Khoản</a></li>
                                <li><a class="dropdown-item" href="/order/my-orders"><i class="fas fa-shopping-bag me-2"></i>Đơn Hàng Của Tôi</a></li>
                                <li><a class="dropdown-item" href="/account/wishlist"><i class="fas fa-heart me-2"></i>Sản Phẩm Yêu Thích</a></li>
                                <li><a class="dropdown-item" href="/account/addresses"><i class="fas fa-map-marker-alt me-2"></i>Địa Chỉ Giao Hàng</a></li>
                                
                                <?php if ($isAdmin): ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="admin-only">
                                        <a class="dropdown-item" href="/account/admin">
                                            <i class="fas fa-users me-2 text-danger"></i>Quản Lý Người Dùng
                                        </a>
                                    </li>
                                    <li class="admin-only">
                                        <a class="dropdown-item" href="/admin/statistics">
                                            <i class="fas fa-chart-line me-2 text-danger"></i>Báo Cáo
                                        </a>
                                    </li>
                                <?php endif; ?>
                                
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/account/settings"><i class="fas fa-cog me-2"></i>Cài Đặt</a></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="/account/logout" onclick="return confirmLogout()">
                                        <i class="fas fa-sign-out-alt me-2"></i>Đăng Xuất
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Not logged in -->
                        <div class="d-flex gap-2">
                            <a href="/account/login" class="btn btn-outline-primary">
                                <i class="fas fa-sign-in-alt me-1"></i>Đăng Nhập
                            </a>
                            <a href="/account/register" class="btn btn-primary">
                                <i class="fas fa-user-plus me-1"></i>Đăng Ký
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= $_SESSION['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?= $_SESSION['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-info alert-dismissible fade show m-0" role="alert">
            <i class="fas fa-info-circle me-2"></i><?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['errors'])): ?>
        <div class="alert alert-danger alert-dismissible fade show m-0" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <ul class="mb-0">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <!-- Scripts - Moved before closing body tag -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS - Load before usage -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- GLightbox -->
    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <!-- Choices.js -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <!-- Anime.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <script>
        // Confirm logout
        function confirmLogout() {
            return Swal.fire({
                title: 'Xác nhận đăng xuất',
                text: 'Bạn có chắc chắn muốn đăng xuất?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#e74c3c',
                cancelButtonColor: '#95a5a6',
                confirmButtonText: 'Đăng xuất',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/account/logout';
                }
                return false;
            });
        }

        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-in-out',
                    once: true
                });
            }

            // Initialize GLightbox
            if (typeof GLightbox !== 'undefined') {
                const lightbox = GLightbox({
                    selector: '.glightbox'
                });
            }

            // Initialize tooltips
            if (typeof bootstrap !== 'undefined') {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }
        });

        // jQuery ready function
        $(document).ready(function() {
            // Back to top button
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('#backToTop').fadeIn();
                } else {
                    $('#backToTop').fadeOut();
                }
            });

            $('#backToTop').click(function() {
                $('html, body').animate({scrollTop: 0}, 600);
                return false;
            });

            // Search functionality
            $('#searchInput').on('input', function() {
                const searchTerm = $(this).val().toLowerCase();
                // Implement search logic here
                console.log('Searching for:', searchTerm);
            });

            // Search button click
            $('#searchBtn').click(function() {
                const searchTerm = $('#searchInput').val().trim();
                if (searchTerm) {
                    window.location.href = `/product/search?q=${encodeURIComponent(searchTerm)}`;
                }
            });

            // Search on Enter key
            $('#searchInput').keypress(function(e) {
                if (e.which === 13) {
                    $('#searchBtn').click();
                }
            });

            // Auto-hide alerts
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 5000);

            // Admin menu highlight
            $('.admin-only').hover(
                function() {
                    $(this).addClass('bg-light');
                },
                function() {
                    $(this).removeClass('bg-light');
                }
            );
        });

        // Animate numbers function
        function animateValue(element, start, end, duration) {
            if (typeof anime !== 'undefined') {
                anime({
                    targets: element,
                    innerHTML: [start, end],
                    easing: 'easeInOutQuad',
                    duration: duration,
                    round: 1
                });
            }
        }

        // Initialize Swiper function (for pages that use it)
        function initializeSwiper(selector, options = {}) {
            if (typeof Swiper !== 'undefined') {
                const defaultOptions = {
                    loop: true,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    }
                };
                
                const mergedOptions = { ...defaultOptions, ...options };
                return new Swiper(selector, mergedOptions);
            }
            return null;
        }

        // Cart functions
        function updateCartCount() {
            fetch('/product/getCartInfo', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('cartCount').textContent = data.data.cart_info.product_count || 0;
                }
            })
            .catch(error => {
                console.error('Error updating cart count:', error);
            });
        }

        // Add to cart function
        function addToCart(productId) {
            fetch(`/product/addToCart/${productId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartCount();
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công!',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        alert(data.message);
                    }
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: data.message
                        });
                    } else {
                        alert(data.message);
                    }
                }
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng'
                    });
                }
            });
        }

        // Global error handler
        window.addEventListener('error', function(e) {
            console.error('JavaScript Error:', e.error);
        });
    </script>