<?php 
$pageTitle = "Danh Sách Sản Phẩm";
include_once 'app/views/shares/header.php'; 
?>

<!-- Hero Section - Phần banner chính -->
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
                    <a href="/product/add" class="btn btn-warning btn-lg">
                        <i class="fas fa-plus me-2"></i>Thêm Sản Phẩm
                    </a>
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

<!-- Stats Section - Phần thống kê -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <!-- Thống kê số sản phẩm -->
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                <div class="stats-card">
                    <i class="fas fa-laptop fa-3x mb-3"></i>
                    <h3 class="counter" id="totalProducts">0</h3>
                    <p class="mb-0">Sản Phẩm</p>
                </div>
            </div>
            <!-- Các thống kê khác -->
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h3 class="counter" data-count="1250">0</h3>
                    <p class="mb-0">Khách Hàng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-card">
                    <i class="fas fa-truck fa-3x mb-3"></i>
                    <h3 class="counter" data-count="890">0</h3>
                    <p class="mb-0">Đơn Hàng</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card">
                    <i class="fas fa-star fa-3x mb-3"></i>
                    <h3 class="counter" data-count="4.8">0</h3>
                    <p class="mb-0">Đánh Giá TB</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section - Phần sản phẩm chính -->
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

        <!-- Filter Panel - Bảng điều khiển lọc -->
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
                    <!-- Form lọc sản phẩm -->
                    <form id="filterForm">
                        <div class="row">
                            <!-- Ô tìm kiếm -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="search" class="form-label fw-semibold">
                                    <i class="fas fa-search text-primary me-2"></i>Tìm kiếm
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="search" 
                                       name="search" 
                                       placeholder="Nhập tên sản phẩm...">
                            </div>

                            <!-- Chọn danh mục -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="category" class="form-label fw-semibold">
                                    <i class="fas fa-tags text-primary me-2"></i>Danh mục
                                </label>
                                <select class="form-select" id="category" name="category">
                                    <option value="">Tất cả danh mục</option>
                                    <!-- Danh mục sẽ được load từ API -->
                                </select>
                            </div>

                            <!-- Sắp xếp -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="sort" class="form-label fw-semibold">
                                    <i class="fas fa-sort text-primary me-2"></i>Sắp xếp
                                </label>
                                <select class="form-select" id="sort" name="sort">
                                    <option value="newest">Mới nhất</option>
                                    <option value="oldest">Cũ nhất</option>
                                    <option value="name">Tên A-Z</option>
                                    <option value="price_asc">Giá tăng dần</option>
                                    <option value="price_desc">Giá giảm dần</option>
                                </select>
                            </div>
                        </div>

                        <!-- Nút điều khiển -->
                        <div class="row">
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
                                        <small class="text-muted" id="resultsInfo">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Đang tải...
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Loading Spinner - Biểu tượng tải -->
        <div id="loadingSpinner" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <div class="mt-2">Đang tải sản phẩm...</div>
        </div>

        <!-- Products Grid - Lưới hiển thị sản phẩm -->
        <div class="row" id="productsContainer" style="display: none;">
            <!-- Sản phẩm sẽ được load bằng JavaScript -->
        </div>

        <!-- Empty State - Trạng thái rỗng -->
        <div id="emptyState" class="col-12 text-center py-5" style="display: none;" data-aos="fade-up">
            <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
            <h3 class="text-muted">Không tìm thấy sản phẩm</h3>
            <p class="text-muted mb-4">Hãy thử thay đổi tiêu chí tìm kiếm hoặc bộ lọc.</p>
            <button class="btn btn-primary" id="clearFiltersEmpty">
                <i class="fas fa-times me-2"></i>Xóa Bộ Lọc
            </button>
        </div>
    </div>
</section>

<!-- Quick View Modal - Modal xem nhanh -->
<div class="modal fade" id="quickViewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Xem Nhanh Sản Phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="quickViewContent">
                    <!-- Nội dung modal sẽ được load bằng JavaScript -->
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
/* CSS Styles với giải thích */

/* Hiệu ứng hover cho card sản phẩm */
.product-card {
    transition: all 0.3s ease; /* Chuyển đổi mượt trong 0.3 giây */
}

.product-card:hover {
    transform: translateY(-8px); /* Di chuyển lên 8px khi hover */
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important; /* Tạo bóng đổ */
}

/* Overlay hiển thị khi hover */
.product-overlay {
    transition: opacity 0.3s ease; /* Chuyển đổi độ trong suốt */
}

.product-card:hover .product-overlay {
    opacity: 1 !important; /* Hiển thị overlay khi hover */
}

/* Placeholder cho hình ảnh đang tải */
.image-placeholder {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite; /* Hiệu ứng loading */
    width: 100%;
    height: 250px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    border-radius: 0.375rem;
}

/* Keyframes cho hiệu ứng loading */
@keyframes loading {
    0% {
        background-position: 200% 0;
    }
    100% {
        background-position: -200% 0;
    }
}

/* Responsive design cho mobile */
@media (max-width: 768px) {
    .product-card {
        margin-bottom: 1.5rem;
    }
    
    .stats-card {
        margin-bottom: 1rem;
    }
}
</style>

<script>
// Biến toàn cục để quản lý trạng thái
let currentPage = 1; // Trang hiện tại
let currentFilters = {}; // Bộ lọc hiện tại
let loadedImages = new Set(); // Danh sách hình ảnh đã tải thành công

// Khởi tạo khi tài liệu được tải xong
$(document).ready(function() {
    console.log('Bắt đầu khởi tạo trang danh sách sản phẩm');
    
    // Tải dữ liệu ban đầu
    loadProducts();
    
    // Thiết lập các event listener cho form lọc
    setupFilterListeners();
    
    // Khởi tạo các thành phần UI
    initializeUI();
});

/**
 * Thiết lập các event listener cho form lọc
 */
function setupFilterListeners() {
    // Xử lý submit form lọc
    $('#filterForm').on('submit', function(e) {
        e.preventDefault(); // Ngăn form submit theo cách thông thường
        console.log('Form lọc được submit');
        currentPage = 1; // Reset về trang đầu
        loadProducts(); // Tải lại sản phẩm với bộ lọc mới
    });
    
    // Nút xóa bộ lọc
    $('#clearFilters, #clearFiltersEmpty').on('click', function() {
        console.log('Xóa tất cả bộ lọc');
        resetFilters();
    });
    
    // Tự động submit khi thay đổi dropdown
    $('#category, #sort').on('change', function() {
        console.log('Thay đổi bộ lọc:', this.id, '=', this.value);
        currentPage = 1;
        loadProducts();
    });
    
    // Tìm kiếm với debounce (trì hoãn)
    let searchTimeout;
    $('#search').on('input', function() {
        clearTimeout(searchTimeout); // Xóa timeout cũ
        const searchValue = this.value;
        
        // Đợi 500ms sau khi người dùng ngừng gõ mới tìm kiếm
        searchTimeout = setTimeout(() => {
            console.log('Tìm kiếm:', searchValue);
            currentPage = 1;
            loadProducts();
        }, 500);
    });
}

/**
 * Khởi tạo các thành phần UI
 */
function initializeUI() {
    // Khởi tạo Hero Swiper nếu có
    if (typeof Swiper !== 'undefined') {
        const heroSwiper = new Swiper('.hero-swiper', {
            loop: true, // Lặp vô hạn
            autoplay: {
                delay: 4000, // Tự động chuyển sau 4 giây
                disableOnInteraction: false, // Không dừng khi người dùng tương tác
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true, // Cho phép click vào pagination
            },
            effect: 'fade', // Hiệu ứng fade
            fadeEffect: {
                crossFade: true
            }
        });
        console.log('Đã khởi tạo Hero Swiper');
    }
    
    // Animate counters khi scroll đến
    animateCounters();
}

/**
 * Tải danh sách sản phẩm từ API
 */
function loadProducts() {
    console.log('Bắt đầu tải sản phẩm từ API');
    showLoading(); // Hiển thị trạng thái loading
    
    // Lấy giá trị từ form lọc
    const filters = {
        search: document.getElementById('search').value.trim(),
        category_id: document.getElementById('category').value,
        sort: document.getElementById('sort').value,
        page: currentPage
    };
    
    currentFilters = filters; // Lưu bộ lọc hiện tại
    console.log('Bộ lọc hiện tại:', filters);
    
    // Tạo query string từ bộ lọc
    const queryString = Object.keys(filters)
        .filter(key => filters[key] !== '') // Chỉ lấy các giá trị không rỗng
        .map(key => `${key}=${encodeURIComponent(filters[key])}`) // Mã hóa URL
        .join('&');
    
    console.log('Query string:', queryString);
    
    // Gọi API để lấy sản phẩm
    fetch(`/api/product?${queryString}`)
        .then(response => {
            console.log('Nhận response từ API:', response.status);
            return response.json(); // Chuyển đổi response thành JSON
        })
        .then(data => {
            console.log('Dữ liệu nhận được:', data);
            
            if (data && Array.isArray(data)) { // Kiểm tra dữ liệu hợp lệ
                displayProducts(data); // Hiển thị sản phẩm
                updateResultsInfo(data.length); // Cập nhật thông tin kết quả
                updateTotalProductsCounter(data.length); // Cập nhật counter
            } else {
                console.log('Không có sản phẩm nào');
                showEmptyState(); // Hiển thị trạng thái rỗng
            }
        })
        .catch(error => {
            console.error('Lỗi khi tải sản phẩm:', error);
            showError('Có lỗi xảy ra khi tải sản phẩm. Vui lòng thử lại sau.');
        })
        .finally(() => {
            hideLoading(); // Ẩn trạng thái loading
        });
}

/**
 * Hiển thị danh sách sản phẩm trên giao diện
 */
function displayProducts(products) {
    console.log('Hiển thị', products.length, 'sản phẩm');
    
    const container = document.getElementById('productsContainer');
    const emptyState = document.getElementById('emptyState');
    
    if (!products || products.length === 0) {
        // Không có sản phẩm
        container.style.display = 'none';
        emptyState.style.display = 'block';
        return;
    }
    
    // Có sản phẩm
    emptyState.style.display = 'none';
    container.style.display = 'flex';
    container.innerHTML = ''; // Xóa nội dung cũ
    
    // Tạo card cho từng sản phẩm
    products.forEach((product, index) => {
        const productCard = createProductCard(product, index);
        container.appendChild(productCard);
    });
    
    console.log('Đã hiển thị xong tất cả sản phẩm');
}

/**
 * Tạo card sản phẩm
 */
function createProductCard(product, index) {
    console.log('Tạo card cho sản phẩm:', product.name);
    
    const col = document.createElement('div');
    col.className = 'col-xl-3 col-lg-4 col-md-6 mb-4';
    col.setAttribute('data-aos', 'fade-up');
    col.setAttribute('data-aos-delay', index * 50); // Delay tăng dần cho hiệu ứng
    
    // Xử lý hình ảnh thông minh
    const imageHtml = createImageHtml(product);
    
    col.innerHTML = `
        <div class="card product-card h-100 border-0 shadow-sm">
            <div class="position-relative overflow-hidden">
                ${imageHtml}
                
                <!-- Badge danh mục -->
                <div class="position-absolute top-0 end-0 m-2">
                    <span class="badge bg-primary rounded-pill">
                        ${product.category_name || 'Chưa phân loại'}
                    </span>
                </div>
                
                <!-- Overlay hiện khi hover -->
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 opacity-0 transition-opacity product-overlay">
                    <div class="d-flex gap-2">
                        <button class="btn btn-light btn-sm rounded-circle" 
                                onclick="showProductModal(${product.id})" 
                                title="Xem nhanh">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-primary btn-sm rounded-circle" 
                                onclick="addToCartQuick(${product.id})" 
                                title="Thêm vào giỏ">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Nội dung card -->
            <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-bold mb-2" style="min-height: 48px;">
                    <a href="/product/show/${product.id}" class="text-decoration-none text-dark">
                        ${escapeHtml(product.name)}
                    </a>
                </h5>
                
                <p class="card-text text-muted small flex-grow-1" style="min-height: 60px;">
                    ${product.description ? escapeHtml(product.description.substring(0, 100)) + '...' : 'Không có mô tả'}
                </p>
                
                <!-- Giá sản phẩm -->
                <div class="price mb-3">
                    <span class="h5 text-danger fw-bold">
                        ${formatPrice(product.price)} đ
                    </span>
                </div>
                
                <!-- Nút hành động -->
                <div class="mt-auto">
                    <div class="row g-2">
                        <div class="col-4">
                            <a href="/product/show/${product.id}" 
                               class="btn btn-outline-primary btn-sm w-100" 
                               title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                        <div class="col-8">
                            <button onclick="addToCartQuick(${product.id})" 
                                    class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-cart-plus me-1"></i>Thêm vào giỏ
                            </button>
                        </div>
                    </div>
                    
                    <!-- Nút admin (chỉ hiện với user MHoang287) -->
                    <div class="row g-2 mt-1 admin-actions">
                        <div class="col-6">
                            <a href="/product/edit/${product.id}" 
                               class="btn btn-outline-warning btn-sm w-100">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                        </div>
                        <div class="col-6">
                            <button onclick="deleteProduct(${product.id})" 
                                    class="btn btn-outline-danger btn-sm w-100">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    return col;
}

/**
 * Tạo HTML cho hình ảnh với xử lý lỗi thông minh
 */
function createImageHtml(product) {
    const imageKey = `product_${product.id}`;
    
    // Nếu đã biết hình ảnh lỗi, không cố gắng tải lại
    if (loadedImages.has(`${imageKey}_failed`)) {
        return `
            <div class="image-placeholder">
                <div class="text-center">
                    <i class="fas fa-image fa-3x mb-2"></i>
                    <div>Không có hình ảnh</div>
                </div>
            </div>
        `;
    }
    
    // Nếu có đường dẫn hình ảnh
    if (product.image) {
        const imageUrl = getImageUrl(product.image);
        
        return `
            <img src="${imageUrl}" 
                 class="card-img-top product-image" 
                 alt="${escapeHtml(product.name)}"
                 style="height: 250px; object-fit: cover; cursor: pointer;"
                 onclick="showProductModal(${product.id})"
                 onload="handleImageLoad('${imageKey}')"
                 onerror="handleImageError('${imageKey}', this)">
        `;
    } else {
        // Không có đường dẫn hình ảnh
        return `
            <div class="image-placeholder">
                <div class="text-center">
                    <i class="fas fa-image fa-3x mb-2"></i>
                    <div>Chưa có hình ảnh</div>
                </div>
            </div>
        `;
    }
}

/**
 * Xử lý khi hình ảnh tải thành công
 */
function handleImageLoad(imageKey) {
    console.log('Hình ảnh tải thành công:', imageKey);
    loadedImages.add(`${imageKey}_success`);
}

/**
 * Xử lý khi hình ảnh tải thất bại
 */
function handleImageError(imageKey, imgElement) {
    console.log('Hình ảnh tải thất bại:', imageKey);
    loadedImages.add(`${imageKey}_failed`);
    
    // Thay thế bằng placeholder
    const placeholder = document.createElement('div');
    placeholder.className = 'image-placeholder';
    placeholder.innerHTML = `
        <div class="text-center">
            <i class="fas fa-image fa-3x mb-2"></i>
            <div>Lỗi tải hình ảnh</div>
        </div>
    `;
    
    imgElement.parentNode.replaceChild(placeholder, imgElement);
}

/**
 * Lấy URL hình ảnh với fallback
 */
function getImageUrl(imagePath) {
    if (!imagePath) {
        return null;
    }
    
    if (imagePath.startsWith('http')) {
        return imagePath;
    }
    
    if (imagePath.startsWith('uploads/')) {
        return '/' + imagePath;
    }
    
    return '/uploads/' + imagePath;
}

/**
 * Hiển thị modal xem nhanh sản phẩm
 */
function showProductModal(productId) {
    console.log('Hiển thị modal cho sản phẩm ID:', productId);
    
    const modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
    
    // Reset nội dung modal
    document.getElementById('quickViewContent').innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <div class="mt-2">Đang tải thông tin sản phẩm...</div>
        </div>
    `;
    
    modal.show();
    
    // Gọi API để lấy thông tin sản phẩm
    fetch(`/api/product/${productId}`)
        .then(response => response.json())
        .then(data => {
            console.log('Dữ liệu sản phẩm cho modal:', data);
            
            if (data) {
                document.getElementById('quickViewContent').innerHTML = generateQuickViewHtml(data);
            } else {
                throw new Error('Product not found');
            }
        })
        .catch(error => {
            console.error('Lỗi khi tải thông tin sản phẩm:', error);
            document.getElementById('quickViewContent').innerHTML = `
                <div class="alert alert-danger text-center">
                    <i class="fas fa-exclamation-triangle"></i>
                    Có lỗi xảy ra khi tải thông tin sản phẩm. Vui lòng thử lại sau.
                </div>
            `;
        });
}

/**
 * Tạo HTML cho modal xem nhanh
 */
function generateQuickViewHtml(product) {
    const imageHtml = product.image ? 
        `<img src="${getImageUrl(product.image)}" 
             class="img-fluid rounded" 
             alt="${escapeHtml(product.name)}"
             style="width: 100%; height: 300px; object-fit: cover;"
             onerror="this.parentNode.innerHTML='<div class=\\'image-placeholder\\' style=\\'height: 300px;\\'><div class=\\'text-center\\' style=\\'padding-top: 120px;\\'><i class=\\'fas fa-image fa-3x mb-2\\'></i><div>Không có hình ảnh</div></div></div>'">` :
        `<div class="image-placeholder" style="height: 300px;">
            <div class="text-center" style="padding-top: 120px;">
                <i class="fas fa-image fa-3x mb-2"></i>
                <div>Chưa có hình ảnh</div>
            </div>
        </div>`;
    
    return `
        <div class="row">
            <div class="col-md-6">
                ${imageHtml}
            </div>
            <div class="col-md-6">
                <h4 class="fw-bold mb-3">${escapeHtml(product.name)}</h4>
                
                <div class="mb-3">
                    <span class="badge bg-primary">${product.category_name || 'Chưa phân loại'}</span>
                </div>

                <div class="mb-3">
                    <div class="stars text-warning mb-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="text-muted ms-2">(4.5/5)</span>
                    </div>
                </div>

                <div class="price-section mb-4">
                    <h3 class="text-danger mb-0">${formatPrice(product.price)} VNĐ</h3>
                </div>

                <div class="mb-4">
                    <h6>Mô tả:</h6>
                    <p class="text-muted">${product.description ? escapeHtml(product.description.substring(0, 200)) + '...' : 'Không có mô tả'}</p>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary" onclick="addToCartQuick(${product.id})">
                        <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                    </button>
                    <a href="/product/show/${product.id}" class="btn btn-outline-primary">
                        <i class="fas fa-eye me-2"></i>Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
    `;
}

/**
 * Xóa sản phẩm sử dụng API
 */
function deleteProduct(id) {
    console.log('Yêu cầu xóa sản phẩm ID:', id);
    
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
            console.log('Người dùng xác nhận xóa');
            
            // Hiển thị loading
            Swal.fire({
                title: 'Đang xóa...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Gọi API DELETE
            fetch(`/api/product/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Kết quả xóa:', data);
                
                if (data.message) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã xóa!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    loadProducts(); // Tải lại danh sách sản phẩm
                } else {
                    throw new Error('Delete failed');
                }
            })
            .catch(error => {
                console.error('Lỗi khi xóa sản phẩm:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Có lỗi xảy ra khi xóa sản phẩm'
                });
            });
        }
    });
}

/**
 * Thêm sản phẩm vào giỏ hàng nhanh
 */
function addToCartQuick(productId) {
    console.log('Thêm vào giỏ hàng sản phẩm ID:', productId);
    
    const button = event.target.closest('button');
    const originalContent = button.innerHTML;
    
    // Hiển thị trạng thái loading
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    button.disabled = true;

    // Giả lập gọi API (thay bằng API thực tế)
    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: 'Sản phẩm đã được thêm vào giỏ hàng',
            timer: 1500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
        
        // Khôi phục nút
        button.innerHTML = originalContent;
        button.disabled = false;
    }, 1000);
}

// Các hàm tiện ích

/**
 * Escape HTML để tránh XSS
 */
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

/**
 * Định dạng giá tiền
 */
function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price);
}

/**
 * Hiển thị trạng thái loading
 */
function showLoading() {
    document.getElementById('loadingSpinner').style.display = 'block';
    document.getElementById('productsContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'none';
}

/**
 * Ẩn trạng thái loading
 */
function hideLoading() {
    document.getElementById('loadingSpinner').style.display = 'none';
}

/**
 * Hiển thị trạng thái rỗng
 */
function showEmptyState() {
    document.getElementById('productsContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'block';
}

/**
 * Reset tất cả bộ lọc
 */
function resetFilters() {
    document.getElementById('filterForm').reset();
    currentPage = 1;
    loadProducts();
}

/**
 * Cập nhật thông tin kết quả
 */
function updateResultsInfo(total) {
    const resultsInfo = document.getElementById('resultsInfo');
    resultsInfo.innerHTML = `
        <i class="fas fa-info-circle me-1"></i>
        Hiển thị ${total} sản phẩm
    `;
}

/**
 * Cập nhật counter tổng số sản phẩm
 */
function updateTotalProductsCounter(total) {
    const counter = document.getElementById('totalProducts');
    if (counter) {
        animateValue(counter, 0, total, 1000);
    }
}

/**
 * Animate counter với hiệu ứng
 */
function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.textContent = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

/**
 * Animate tất cả counters khi scroll đến
 */
function animateCounters() {
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseFloat(counter.getAttribute('data-count')) || 0;
                animateValue(counter, 0, target, 2000);
                observer.unobserve(counter); // Chỉ animate một lần
            }
        });
    }, observerOptions);

    // Observe tất cả counters
    document.querySelectorAll('.counter').forEach(counter => {
        observer.observe(counter);
    });
}

/**
 * Hiển thị thông báo lỗi
 */
function showError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Lỗi!',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
}
</script>

<?php include_once 'app/views/shares/footer.php'; ?>