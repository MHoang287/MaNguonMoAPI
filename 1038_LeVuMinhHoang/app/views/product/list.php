<?php 
$pageTitle = "Danh Sách Sản Phẩm";
include_once 'app/views/shares/header.php'; 

// Set default values if not set
$search = $_GET['search'] ?? '';
$selectedCategory = $_GET['category'] ?? '';
$selectedSort = $_GET['sort'] ?? 'newest';
$minPrice = $_GET['min_price'] ?? '';
$maxPrice = $_GET['max_price'] ?? '';
$currentPage = max(1, (int)($_GET['page'] ?? 1));
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-4">
                    Khám Phá Thế Giới <span class="text-warning">Công Nghệ</span>
                </h1>
                <p class="lead mb-4">
                    Tìm kiếm những sản phẩm điện tử chất lượng cao với giá cả hợp lý. 
                    Từ smartphone đến laptop, tất cả đều có tại TechTafu.
                </p>
                <div class="d-flex gap-3">
                    <?php if (SessionHelper::isAdmin()): ?>
                    <a href="/product/add" class="btn btn-warning btn-lg">
                        <i class="fas fa-plus me-2"></i>Thêm Sản Phẩm
                    </a>
                    <?php endif; ?>
                    <a href="#products" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-arrow-down me-2"></i>Xem Sản Phẩm
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="swiper hero-swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://product.hstatic.net/200000722513/product/-gaming-asus-tuf-a15-fa507rc-hn051w-1_c5df613e590d466696cd74ed2f30ce2d_559d2e06c42b4fdd8b64e5e32a6123b7.jpg" 
                                 alt="Laptop Gaming" class="img-fluid rounded-3">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images-na.ssl-images-amazon.com/images/I/417sDBMOxVL.jpg" 
                                 alt="Smartphone" class="img-fluid rounded-3">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images-na.ssl-images-amazon.com/images/I/71k7Ssjzo7L.jpg" 
                                 alt="Tablet" class="img-fluid rounded-3">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                <div class="stats-card">
                    <i class="fas fa-laptop fa-3x mb-3"></i>
                    <h3 class="counter" data-count="<?= $totalProducts ?? count($products) ?>">0</h3>
                    <p class="mb-0">Sản Phẩm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h3 class="counter" data-count="0">0</h3>
                    <p class="mb-0">Khách Hàng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-card">
                    <i class="fas fa-truck fa-3x mb-3"></i>
                    <h3 class="counter" data-count="0">0</h3>
                    <p class="mb-0">Đơn Hàng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card">
                    <i class="fas fa-star fa-3x mb-3"></i>
                    <h3 class="counter" data-count="0">0</h3>
                    <p class="mb-0">Đánh Giá</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section id="products" class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6 mx-auto text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-3">Sản Phẩm Nổi Bật</h2>
                <p class="lead text-muted">
                    Khám phá bộ sưu tập sản phẩm điện tử hàng đầu của chúng tôi
                </p>
            </div>
        </div>

        <!-- Advanced Filter Panel -->
        <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-filter me-2"></i>Bộ Lọc Sản Phẩm
                    <button class="btn btn-sm btn-outline-light float-end" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </h5>
            </div>
            <div class="collapse show" id="filterCollapse">
                <div class="card-body">
                    <form id="filterForm" method="GET" action="/product">
                        <div class="row">
                            <!-- Search -->
                            <div class="col-lg-3 col-md-6 mb-3">
                                <label for="search" class="form-label fw-semibold">
                                    <i class="fas fa-search text-primary me-2"></i>Tìm kiếm
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="search" 
                                       name="search" 
                                       value="<?= htmlspecialchars($search) ?>"
                                       placeholder="Nhập tên sản phẩm...">
                            </div>

                            <!-- Category Filter -->
                            <div class="col-lg-3 col-md-6 mb-3">
                                <label for="category" class="form-label fw-semibold">
                                    <i class="fas fa-tags text-primary me-2"></i>Danh mục
                                </label>
                                <select class="form-select" id="category" name="category">
                                    <option value="">Tất cả danh mục</option>
                                    <?php if (!empty($categories)): ?>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category->id ?>" 
                                                    <?= $selectedCategory == $category->id ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($category->name) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <!-- Sort -->
                            <div class="col-lg-3 col-md-6 mb-3">
                                <label for="sort" class="form-label fw-semibold">
                                    <i class="fas fa-sort text-primary me-2"></i>Sắp xếp
                                </label>
                                <select class="form-select" id="sort" name="sort">
                                    <option value="newest" <?= $selectedSort == 'newest' ? 'selected' : '' ?>>Mới nhất</option>
                                    <option value="oldest" <?= $selectedSort == 'oldest' ? 'selected' : '' ?>>Cũ nhất</option>
                                    <option value="name" <?= $selectedSort == 'name' ? 'selected' : '' ?>>Tên A-Z</option>
                                    <option value="price_asc" <?= $selectedSort == 'price_asc' ? 'selected' : '' ?>>Giá tăng dần</option>
                                    <option value="price_desc" <?= $selectedSort == 'price_desc' ? 'selected' : '' ?>>Giá giảm dần</option>
                                    <option value="category" <?= $selectedSort == 'category' ? 'selected' : '' ?>>Theo danh mục</option>
                                </select>
                            </div>

                            <!-- Price Range -->
                            <div class="col-lg-3 col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-dollar-sign text-primary me-2"></i>Khoảng giá
                                </label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" 
                                               class="form-control form-control-sm" 
                                               id="min_price" 
                                               name="min_price" 
                                               value="<?= htmlspecialchars($minPrice) ?>"
                                               placeholder="Từ" 
                                               min="0">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" 
                                               class="form-control form-control-sm" 
                                               id="max_price" 
                                               name="max_price" 
                                               value="<?= htmlspecialchars($maxPrice) ?>"
                                               placeholder="Đến" 
                                               min="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Actions -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-between">
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search me-2"></i>Lọc Sản Phẩm
                                        </button>
                                        <button type="button" id="clearFilters" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-2"></i>Xóa Bộ Lọc
                                        </button>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <?php if (!empty($search) || !empty($selectedCategory) || !empty($minPrice) || !empty($maxPrice)): ?>
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Hiển thị <?= $totalProducts ?? count($products) ?> kết quả
                                                <?php if (!empty($search)): ?>
                                                    cho "<strong><?= htmlspecialchars($search) ?></strong>"
                                                <?php endif; ?>
                                            </small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Quick Filters -->
        <div class="row mb-4" data-aos="fade-up">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-semibold text-muted me-2">Lọc nhanh:</span>
                    <a href="/product?sort=price_asc" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-up me-1"></i>Giá tăng dần
                    </a>
                    <a href="/product?sort=price_desc" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-down me-1"></i>Giá giảm dần
                    </a>
                    <a href="/product?sort=newest" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-clock me-1"></i>Mới nhất
                    </a>
                    <?php if (!empty($categories)): ?>
                        <?php foreach (array_slice($categories, 0, 3) as $category): ?>
                            <a href="/product?category=<?= $category->id ?>" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-tag me-1"></i><?= htmlspecialchars($category->name) ?>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    
                    <?php if (!empty($search) || !empty($selectedCategory) || !empty($minPrice) || !empty($maxPrice)): ?>
                        <a href="/product" class="btn btn-outline-danger btn-sm ms-auto">
                            <i class="fas fa-times me-1"></i>Xóa tất cả bộ lọc
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row" id="productsContainer">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $index => $product): ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                        <div class="card product-card h-100 border-0 shadow-sm">
                            <div class="position-relative overflow-hidden">
                                <img src="<?= !empty($product->image) ? $product->image : 'https://via.placeholder.com/300x250/f8f9fa/6c757d?text=No+Image' ?>" 
                                     class="card-img-top" 
                                     alt="<?= htmlspecialchars($product->name) ?>"
                                     style="height: 250px; object-fit: cover; cursor: pointer;"
                                     onclick="showProductModal(<?= $product->id ?>)">
                                
                                <!-- Product badges -->
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-primary rounded-pill">
                                        <?= htmlspecialchars($product->category_name ?? 'Chưa phân loại') ?>
                                    </span>
                                </div>
                                
                                <!-- Quick actions overlay -->
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 opacity-0 transition-opacity product-overlay">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-light btn-sm rounded-circle" 
                                                onclick="showProductModal(<?= $product->id ?>)" 
                                                title="Xem nhanh">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-primary btn-sm rounded-circle" 
                                                onclick="addToCartQuick(<?= $product->id ?>)" 
                                                title="Thêm vào giỏ">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold mb-2" style="min-height: 48px;">
                                    <a href="/product/show/<?= $product->id ?>" class="text-decoration-none text-dark">
                                        <?= htmlspecialchars($product->name) ?>
                                    </a>
                                </h5>
                                
                                <p class="card-text text-muted small flex-grow-1" style="min-height: 60px;">
                                    <?= htmlspecialchars(substr($product->description, 0, 100)) ?>...
                                </p>
                                
                                <div class="price mb-3">
                                    <span class="h5 text-danger fw-bold">
                                        <?= number_format($product->price) ?> đ
                                    </span>
                                </div>
                                
                                <!-- Action buttons -->
                                <div class="mt-auto">
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <a href="/product/show/<?= $product->id ?>" 
                                               class="btn btn-outline-primary btn-sm w-100" 
                                               title="Xem chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                        <div class="col-8">
                                            <button onclick="addToCartQuick(<?= $product->id ?>)" 
                                                    class="btn btn-primary btn-sm w-100">
                                                <i class="fas fa-cart-plus me-1"></i>Thêm vào giỏ
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <?php if (SessionHelper::isAdmin()): ?>
                                        <div class="row g-2 mt-1">
                                            <div class="col-6">
                                                <a href="/product/edit/<?= $product->id ?>" 
                                                   class="btn btn-outline-warning btn-sm w-100">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <button onclick="deleteProduct(<?= $product->id ?>)" 
                                                        class="btn btn-outline-danger btn-sm w-100">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="text-center py-5" data-aos="fade-up">
                        <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                        <h3 class="text-muted">
                            <?php if (!empty($search) || !empty($selectedCategory) || !empty($minPrice) || !empty($maxPrice)): ?>
                                Không tìm thấy sản phẩm phù hợp
                            <?php else: ?>
                                Chưa có sản phẩm nào
                            <?php endif; ?>
                        </h3>
                        <p class="text-muted mb-4">
                            <?php if (!empty($search) || !empty($selectedCategory) || !empty($minPrice) || !empty($maxPrice)): ?>
                                Hãy thử thay đổi tiêu chí tìm kiếm hoặc bộ lọc của bạn.
                            <?php else: ?>
                                Hãy thêm sản phẩm đầu tiên để bắt đầu!
                            <?php endif; ?>
                        </p>
                        
                        <div class="d-flex gap-2 justify-content-center">
                            <?php if (!empty($search) || !empty($selectedCategory) || !empty($minPrice) || !empty($maxPrice)): ?>
                                <a href="/product" class="btn btn-primary">
                                    <i class="fas fa-times me-2"></i>Xóa Bộ Lọc
                                </a>
                            <?php endif; ?>
                            
                            <?php if (SessionHelper::isAdmin()): ?>
                                <a href="/product/add" class="btn btn-success">
                                    <i class="fas fa-plus me-2"></i>Thêm Sản Phẩm
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if (!empty($products) && isset($totalPages) && $totalPages > 1): ?>
            <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Product pagination" data-aos="fade-up">
                        <ul class="pagination justify-content-center">
                            <!-- Previous button -->
                            <?php if ($currentPage > 1): ?>
                                                            <li class="page-item">
                                <a class="page-link" href="<?= $this->buildPaginationUrl($currentPage - 1) ?>">
                                    <i class="fas fa-chevron-left"></i> Trước
                                </a>
                            </li>
                            <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="fas fa-chevron-left"></i> Trước
                                </span>
                            </li>
                            <?php endif; ?>

                            <!-- Page numbers -->
                            <?php
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($totalPages, $currentPage + 2);
                            
                            if ($startPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= $this->buildPaginationUrl(1) ?>">1</a>
                                </li>
                                <?php if ($startPage > 2): ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= $this->buildPaginationUrl($i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($endPage < $totalPages): ?>
                                <?php if ($endPage < $totalPages - 1): ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                <?php endif; ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= $this->buildPaginationUrl($totalPages) ?>"><?= $totalPages ?></a>
                                </li>
                            <?php endif; ?>

                            <!-- Next button -->
                            <?php if ($currentPage < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= $this->buildPaginationUrl($currentPage + 1) ?>">
                                    Sau <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link">
                                    Sau <i class="fas fa-chevron-right"></i>
                                </span>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                    
                    <!-- Pagination info -->
                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Trang <?= $currentPage ?> / <?= $totalPages ?> 
                            (<?= $totalProducts ?? count($products) ?> sản phẩm)
                        </small>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xem Nhanh Sản Phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="quickViewContent">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Đang tải...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.product-card {
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

.product-overlay {
    transition: opacity 0.3s ease;
}

.product-card:hover .product-overlay {
    opacity: 1 !important;
}

.filter-active {
    background: linear-gradient(45deg, #007bff, #0056b3);
    color: white;
}

.price-range-display {
    background: #f8f9fa;
    padding: 0.5rem;
    border-radius: 0.375rem;
    font-weight: 500;
}

.transition-opacity {
    transition: opacity 0.3s ease;
}

@media (max-width: 768px) {
    .product-card {
        margin-bottom: 1.5rem;
    }
    
    .stats-card {
        margin-bottom: 1rem;
    }
}

/* Thêm vào CSS của bạn */
#quickViewModal .modal-dialog {
    max-width: 900px;
}

#quickViewModal .modal-body {
    padding: 1.5rem;
}

.quick-view-image {
    transition: transform 0.3s ease;
}

.quick-view-image:hover {
    transform: scale(1.05);
}

.stars {
    font-size: 0.9rem;
}

.price-section h3 {
    font-size: 1.5rem;
}

@media (max-width: 768px) {
    #quickViewModal .modal-dialog {
        max-width: 95%;
        margin: 1rem;
    }
    
    #quickViewModal .modal-body {
        padding: 1rem;
    }
}
</style>

<script>
// Helper function to build pagination URLs
<?php
function buildPaginationUrl($page) {
    $params = $_GET;
    $params['page'] = $page;
    return '/product?' . http_build_query($params);
}
?>

$(document).ready(function() {
    // Initialize Hero Swiper
    if (typeof Swiper !== 'undefined') {
        const heroSwiper = new Swiper('.hero-swiper', {
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            }
        });
    }

    // Animate counters
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseFloat(counter.getAttribute('data-count'));
                animateValue(counter, 0, target, 2000);
                observer.unobserve(counter);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.counter').forEach(counter => {
        observer.observe(counter);
    });

    // Clear filters
    $('#clearFilters').on('click', function() {
        window.location.href = '/product';
    });

    // Auto-submit form on filter change
    $('#category, #sort').on('change', function() {
        $('#filterForm').submit();
    });

    // Price range validation
    $('#min_price, #max_price').on('input', function() {
        const minPrice = parseFloat($('#min_price').val()) || 0;
        const maxPrice = parseFloat($('#max_price').val()) || 0;
        
        if (maxPrice > 0 && minPrice > maxPrice) {
            $(this).addClass('is-invalid');
            $(this).siblings('.invalid-feedback').remove();
            $(this).after('<div class="invalid-feedback">Giá tối thiểu không được lớn hơn giá tối đa</div>');
        } else {
            $(this).removeClass('is-invalid');
            $(this).siblings('.invalid-feedback').remove();
        }
    });

    // Debounced search
    let searchTimeout;
    $('#search').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            if ($(this).val().length >= 2 || $(this).val().length === 0) {
                $('#filterForm').submit();
            }
        }, 500);
    });

    // Show active filters
    updateActiveFilters();
});

// Add to cart quick function
function addToCartQuick(productId) {
    // Show loading state
    const button = event.target.closest('button');
    const originalContent = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    button.disabled = true;

    fetch(`/product/addToCart/${productId}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update cart count
            updateCartCount();
            
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: data.message,
                timer: 1500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: data.message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng'
        });
    })
    .finally(() => {
        // Restore button
        button.innerHTML = originalContent;
        button.disabled = false;
    });
}

// Cập nhật function showProductModal trong list.php
function showProductModal(productId) {
    const modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
    
    // Reset modal content
    document.getElementById('quickViewContent').innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <div class="mt-2">Đang tải thông tin sản phẩm...</div>
        </div>
    `;
    
    modal.show();
    
    // Load product details với endpoint mới
    fetch(`/product/quickView/${productId}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('quickViewContent').innerHTML = data.data.html;
        } else {
            document.getElementById('quickViewContent').innerHTML = `
                <div class="alert alert-danger text-center">
                    <i class="fas fa-exclamation-triangle"></i>
                    ${data.message || 'Có lỗi xảy ra khi tải thông tin sản phẩm.'}
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('quickViewContent').innerHTML = `
            <div class="alert alert-danger text-center">
                <i class="fas fa-exclamation-triangle"></i>
                Có lỗi xảy ra khi tải thông tin sản phẩm. Vui lòng thử lại sau.
            </div>
        `;
    });
}

// Delete product function
function deleteProduct(id) {
    Swal.fire({
        title: 'Xác nhận xóa',
        text: "Sản phẩm sẽ bị xóa vĩnh viễn và không thể khôi phục!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash"></i> Xóa',
        cancelButtonText: '<i class="fas fa-times"></i> Hủy',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Đang xóa...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            window.location.href = '/product/delete/' + id;
        }
    });
}

// Update active filters display
function updateActiveFilters() {
    const urlParams = new URLSearchParams(window.location.search);
    const activeFilters = [];
    
    if (urlParams.get('search')) {
        activeFilters.push(`Tìm kiếm: "${urlParams.get('search')}"`);
    }
    
    if (urlParams.get('category')) {
        const categorySelect = document.getElementById('category');
        const selectedOption = categorySelect.options[categorySelect.selectedIndex];
        if (selectedOption && selectedOption.value) {
            activeFilters.push(`Danh mục: ${selectedOption.text}`);
        }
    }
    
    if (urlParams.get('min_price') || urlParams.get('max_price')) {
        const min = urlParams.get('min_price') || '0';
        const max = urlParams.get('max_price') || '∞';
        activeFilters.push(`Giá: ${parseInt(min).toLocaleString()} - ${max === '∞' ? max : parseInt(max).toLocaleString()} đ`);
    }
    
    if (urlParams.get('sort') && urlParams.get('sort') !== 'newest') {
        const sortSelect = document.getElementById('sort');
        const selectedOption = sortSelect.options[sortSelect.selectedIndex];
        if (selectedOption) {
            activeFilters.push(`Sắp xếp: ${selectedOption.text}`);
        }
    }
    
    // Display active filters
    if (activeFilters.length > 0) {
        const filterDisplay = document.createElement('div');
        filterDisplay.className = 'alert alert-info mt-3';
        filterDisplay.innerHTML = `
            <h6 class="mb-2"><i class="fas fa-filter"></i> Bộ lọc đang áp dụng:</h6>
            <div class="d-flex flex-wrap gap-2">
                ${activeFilters.map(filter => `
                    <span class="badge bg-primary">${filter}</span>
                `).join('')}
                <a href="/product" class="badge bg-danger text-decoration-none">
                    <i class="fas fa-times"></i> Xóa tất cả
                </a>
            </div>
        `;
        
        const filterForm = document.getElementById('filterForm');
        const existingDisplay = filterForm.parentNode.querySelector('.alert-info');
        if (existingDisplay) {
            existingDisplay.remove();
        }
        filterForm.parentNode.insertBefore(filterDisplay, filterForm.nextSibling);
    }
}

// Update cart count in header
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
            const cartCount = document.getElementById('cartCount');
            if (cartCount) {
                cartCount.textContent = data.data.cart_info.product_count || 0;
            }
        }
    })
    .catch(error => {
        console.error('Error updating cart count:', error);
    });
}

// Smooth scroll to products section
document.addEventListener('DOMContentLoaded', function() {
    const scrollLinks = document.querySelectorAll('a[href="#products"]');
    scrollLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('products').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });
});

// Lazy loading for product images
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    });

    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}

// Performance optimization: Debounce scroll events
let ticking = false;
function updateScrollPosition() {
    // Update any scroll-based animations here
    ticking = false;
}

window.addEventListener('scroll', function() {
    if (!ticking) {
        requestAnimationFrame(updateScrollPosition);
        ticking = true;
    }
});
</script>

<?php include_once 'app/views/shares/footer.php'; ?>