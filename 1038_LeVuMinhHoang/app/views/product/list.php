<?php 
$pageTitle = "Danh Sách Sản Phẩm";
include_once 'app/views/shares/header.php'; 
?>

<!-- Hero Section - Phần banner chính của trang -->
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
                    <!-- Hiển thị nút thêm sản phẩm chỉ cho admin (MHoang287) -->
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
                <!-- Slider banner với các hình ảnh sản phẩm nổi bật -->
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

<!-- Stats Section - Phần hiển thị thống kê tổng quan -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <!-- Counter hiển thị tổng số sản phẩm -->
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                <div class="stats-card">
                    <i class="fas fa-laptop fa-3x mb-3"></i>
                    <h3 class="counter" id="totalProducts">0</h3>
                    <p class="mb-0">Sản Phẩm</p>
                </div>
            </div>
            <!-- Counter hiển thị tổng số danh mục -->
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card">
                    <i class="fas fa-tags fa-3x mb-3"></i>
                    <h3 class="counter" id="totalCategories">0</h3>
                    <p class="mb-0">Danh Mục</p>
                </div>
            </div>
            <!-- Các thống kê khác -->
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

<!-- Products Section - Phần chính hiển thị sản phẩm -->
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

        <!-- Filter Panel - Bảng điều khiển lọc và tìm kiếm -->
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
                            <!-- Ô tìm kiếm theo tên sản phẩm -->
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

                            <!-- Dropdown chọn danh mục - sẽ được load từ CategoryApiController -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="category" class="form-label fw-semibold">
                                    <i class="fas fa-tags text-primary me-2"></i>Danh mục
                                </label>
                                <select class="form-select" id="category" name="category">
                                    <option value="">Tất cả danh mục</option>
                                    <!-- Danh mục sẽ được load từ API -->
                                </select>
                                <!-- Loading indicator cho danh mục -->
                                <div id="categoryLoading" class="text-center mt-2" style="display: none;">
                                    <small class="text-muted">
                                        <i class="fas fa-spinner fa-spin me-1"></i>Đang tải danh mục...
                                    </small>
                                </div>
                                <!-- Error message cho danh mục -->
                                <div id="categoryError" class="text-danger mt-2" style="display: none;">
                                    <small>
                                        <i class="fas fa-exclamation-triangle me-1"></i>Không thể tải danh mục
                                    </small>
                                </div>
                            </div>

                            <!-- Dropdown sắp xếp -->
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

                        <!-- Bộ lọc nâng cao - khoảng giá -->
                        <div class="row">
                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-dollar-sign text-primary me-2"></i>Khoảng giá (VNĐ)
                                </label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" 
                                               class="form-control" 
                                               id="min_price" 
                                               name="min_price" 
                                               placeholder="Từ" 
                                               min="0"
                                               step="100000">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" 
                                               class="form-control" 
                                               id="max_price" 
                                               name="max_price" 
                                               placeholder="Đến" 
                                               min="0"
                                               step="100000">
                                    </div>
                                </div>
                            </div>

                            <!-- Hiển thị bộ lọc đang active -->
                            <div class="col-lg-6 col-md-12 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-filter text-primary me-2"></i>Bộ lọc đang áp dụng
                                </label>
                                <div id="activeFilters" class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-secondary">Chưa có bộ lọc</span>
                                </div>
                            </div>
                        </div>

                        <!-- Nút điều khiển bộ lọc -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-2 justify-content-between flex-wrap">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search me-2"></i>Lọc Sản Phẩm
                                        </button>
                                        <button type="button" id="clearFilters" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-2"></i>Xóa Bộ Lọc
                                        </button>
                                        <button type="button" id="saveFilter" class="btn btn-outline-info">
                                            <i class="fas fa-bookmark me-2"></i>Lưu Bộ Lọc
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

        <!-- Quick Category Filter - Lọc nhanh theo danh mục -->
        <div class="row mb-4" data-aos="fade-up">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-semibold text-muted me-2">Danh mục phổ biến:</span>
                    <div id="quickCategoryFilters" class="d-flex flex-wrap gap-2">
                        <!-- Quick category buttons sẽ được tạo bằng JavaScript -->
                        <div class="d-flex gap-2">
                            <div class="placeholder-glow">
                                <span class="placeholder col-3 btn btn-sm"></span>
                                <span class="placeholder col-4 btn btn-sm"></span>
                                <span class="placeholder col-3 btn btn-sm"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Spinner - Hiển thị khi đang tải dữ liệu -->
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

        <!-- Empty State - Trạng thái khi không có sản phẩm -->
        <div id="emptyState" class="col-12 text-center py-5" style="display: none;" data-aos="fade-up">
            <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
            <h3 class="text-muted">Không tìm thấy sản phẩm</h3>
            <p class="text-muted mb-4">Hãy thử thay đổi tiêu chí tìm kiếm hoặc bộ lọc.</p>
            <button class="btn btn-primary" id="clearFiltersEmpty">
                <i class="fas fa-times me-2"></i>Xóa Bộ Lọc
            </button>
        </div>

        <!-- Pagination - Phân trang -->
        <div class="row mt-5" id="paginationContainer" style="display: none;">
            <div class="col-12">
                <nav aria-label="Product pagination" data-aos="fade-up">
                    <ul class="pagination justify-content-center" id="paginationList">
                        <!-- Pagination sẽ được tạo bằng JavaScript -->
                    </ul>
                </nav>
                
                <div class="text-center mt-3">
                    <small class="text-muted" id="paginationInfo">
                        <!-- Thông tin phân trang sẽ được hiển thị ở đây -->
                    </small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick View Modal - Modal xem nhanh sản phẩm -->
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

<!-- CSS Styles với giải thích -->
<style>
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
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Style cho quick category filters */
.quick-category-btn {
    transition: all 0.3s ease;
    border-radius: 20px;
}

.quick-category-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.quick-category-btn.active {
    background: linear-gradient(45deg, #007bff, #0056b3);
    color: white;
    transform: scale(1.05);
}

/* Style cho active filters */
.filter-badge {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 15px;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.filter-badge:hover {
    transform: scale(1.1);
}

/* Responsive design cho mobile */
@media (max-width: 768px) {
    .product-card {
        margin-bottom: 1.5rem;
    }
    
    .stats-card {
        margin-bottom: 1rem;
    }
    
    #quickCategoryFilters {
        justify-content: center;
    }
    
    .filter-controls {
        flex-direction: column;
        gap: 1rem;
    }
}

/* Animation cho việc load danh mục */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.category-loaded {
    animation: fadeInUp 0.5s ease;
}
</style>

<script>
// Biến toàn cục để quản lý trạng thái
let currentPage = 1; // Trang hiện tại
let currentFilters = {}; // Bộ lọc hiện tại
let categoriesData = []; // Dữ liệu danh mục từ API
let productsData = []; // Dữ liệu sản phẩm hiện tại
let totalPages = 0; // Tổng số trang
let savedFilters = []; // Bộ lọc đã lưu

// Khởi tạo khi tài liệu được tải xong
$(document).ready(function() {
    console.log('🚀 Bắt đầu khởi tạo trang danh sách sản phẩm');
    
    // Tải dữ liệu ban đầu theo thứ tự ưu tiên
    initializePage();
});

/**
 * Khởi tạo trang - Load dữ liệu theo thứ tự
 */
async function initializePage() {
    try {
        console.log('📚 Bắt đầu tải dữ liệu danh mục từ CategoryApiController');
        
        // Bước 1: Load danh mục trước (quan trọng cho bộ lọc)
        await loadCategories();
        
        // Bước 2: Load sản phẩm
        console.log('📦 Bắt đầu tải dữ liệu sản phẩm từ ProductApiController');
        await loadProducts();
        
        // Bước 3: Thiết lập các event listener
        setupEventListeners();
        
        // Bước 4: Khởi tạo các thành phần UI
        initializeUIComponents();
        
        console.log('✅ Khởi tạo trang hoàn tất');
        
    } catch (error) {
        console.error('❌ Lỗi khởi tạo trang:', error);
        showError('Có lỗi xảy ra khi tải trang. Vui lòng thử lại sau.');
    }
}

/**
 * Tải danh sách danh mục từ CategoryApiController
 */
async function loadCategories() {
    console.log('🏷️ Gọi API để lấy danh sách danh mục');
    
    const categorySelect = document.getElementById('category');
    const categoryLoading = document.getElementById('categoryLoading');
    const categoryError = document.getElementById('categoryError');
    
    try {
        // Hiển thị loading cho danh mục
        categoryLoading.style.display = 'block';
        categoryError.style.display = 'none';
        
        // Gọi CategoryApiController để lấy danh sách danh mục
        const response = await fetch('/api/category', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        console.log('📡 Response từ CategoryApiController:', response.status);
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        const categories = await response.json();
        console.log('📝 Dữ liệu danh mục nhận được:', categories);
        
        if (Array.isArray(categories) && categories.length > 0) {
            // Lưu dữ liệu danh mục vào biến global
            categoriesData = categories;
            
            // Cập nhật dropdown danh mục
            updateCategoryDropdown(categories);
            
            // Tạo quick category filters
            createQuickCategoryFilters(categories);
            
            // Cập nhật counter tổng số danh mục
            updateCategoriesCounter(categories.length);
            
            console.log(`✅ Đã load thành công ${categories.length} danh mục`);
        } else {
            console.log('⚠️ Không có danh mục nào hoặc dữ liệu không hợp lệ');
            showCategoryEmptyState();
        }
        
    } catch (error) {
        console.error('❌ Lỗi khi tải danh mục:', error);
        
        // Hiển thị thông báo lỗi
        categoryError.style.display = 'block';
        categoryError.innerHTML = `
            <small>
                <i class="fas fa-exclamation-triangle me-1"></i>
                Không thể tải danh mục: ${error.message}
            </small>
        `;
        
        // Fallback: tạo option mặc định
        categorySelect.innerHTML = '<option value="">Tất cả danh mục (Lỗi tải danh mục)</option>';
        
    } finally {
        // Ẩn loading indicator
        categoryLoading.style.display = 'none';
    }
}

/**
 * Cập nhật dropdown danh mục với dữ liệu từ API
 */
function updateCategoryDropdown(categories) {
    console.log('🔄 Cập nhật dropdown danh mục');
    
    const categorySelect = document.getElementById('category');
    
    // Xóa các option cũ (trừ option "Tất cả danh mục")
    categorySelect.innerHTML = '<option value="">Tất cả danh mục</option>';
    
    // Thêm option cho mỗi danh mục
    categories.forEach((category, index) => {
        const option = document.createElement('option');
        option.value = category.id;
        option.textContent = category.name;
        option.title = category.description || category.name; // Tooltip hiển thị mô tả
        
        categorySelect.appendChild(option);
        
        console.log(`➕ Đã thêm danh mục: ${category.name} (ID: ${category.id})`);
        
        // Animation delay cho từng option (chỉ cho 5 option đầu)
        if (index < 5) {
            setTimeout(() => {
                option.classList.add('category-loaded');
            }, index * 100);
        }
    });
    
    console.log(`✅ Đã cập nhật dropdown với ${categories.length} danh mục`);
}

/**
 * Tạo các nút lọc nhanh theo danh mục phổ biến
 */
function createQuickCategoryFilters(categories) {
    console.log('⚡ Tạo quick category filters');
    
    const container = document.getElementById('quickCategoryFilters');
    
    // Xóa placeholder
    container.innerHTML = '';
    
    // Lấy top 5 danh mục đầu tiên làm danh mục phổ biến
    const popularCategories = categories.slice(0, 5);
    
    // Nút "Tất cả"
    const allBtn = document.createElement('button');
    allBtn.className = 'btn btn-outline-primary btn-sm quick-category-btn active';
    allBtn.innerHTML = '<i class="fas fa-th me-1"></i>Tất cả';
    allBtn.onclick = () => selectQuickCategory('', allBtn);
    container.appendChild(allBtn);
    
    // Nút cho từng danh mục phổ biến
    popularCategories.forEach((category, index) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-outline-secondary btn-sm quick-category-btn';
        btn.innerHTML = `<i class="fas fa-tag me-1"></i>${category.name}`;
        btn.onclick = () => selectQuickCategory(category.id, btn);
        btn.title = category.description || `Xem sản phẩm trong danh mục ${category.name}`;
        
        // Animation delay
        setTimeout(() => {
            container.appendChild(btn);
        }, index * 150);
        
        console.log(`🏷️ Đã tạo quick filter cho: ${category.name}`);
    });
    
    console.log(`✅ Đã tạo ${popularCategories.length + 1} quick category filters`);
}

/**
 * Xử lý khi chọn quick category filter
 */
function selectQuickCategory(categoryId, buttonElement) {
    console.log('🎯 Chọn quick category:', categoryId || 'Tất cả');
    
    // Cập nhật trạng thái active cho nút
    document.querySelectorAll('.quick-category-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.classList.replace('btn-primary', 'btn-outline-secondary');
    });
    
    buttonElement.classList.add('active');
    buttonElement.classList.replace('btn-outline-secondary', 'btn-primary');
    
    // Cập nhật dropdown danh mục
    document.getElementById('category').value = categoryId;
    
    // Reset về trang đầu và load sản phẩm
    currentPage = 1;
    loadProducts();
    
    // Scroll smooth đến phần sản phẩm
    document.getElementById('products').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

/**
 * Tải danh sách sản phẩm từ ProductApiController
 */
async function loadProducts() {
    console.log('📦 Tải danh sách sản phẩm từ ProductApiController');
    
    showLoading(); // Hiển thị loading spinner
    
    try {
        // Lấy giá trị từ form lọc
        const filters = getFilterValues();
        currentFilters = filters;
        
        console.log('🔍 Bộ lọc hiện tại:', filters);
        
        // Tạo query string từ bộ lọc
        const queryString = buildQueryString(filters);
        console.log('🔗 Query string:', queryString);
        
        // Gọi ProductApiController để lấy sản phẩm
        const response = await fetch(`/api/product?${queryString}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        console.log('📡 Response từ ProductApiController:', response.status);
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        const data = await response.json();
        console.log('📦 Dữ liệu sản phẩm nhận được:', data);
        
        if (Array.isArray(data) && data.length > 0) {
            // Lưu dữ liệu sản phẩm
            productsData = data;
            
            // Hiển thị sản phẩm
            displayProducts(data);
            
            // Cập nhật thông tin kết quả
            updateResultsInfo(data.length);
            
            // Cập nhật counter
            updateProductsCounter(data.length);
            
            // Cập nhật active filters
            updateActiveFilters(filters);
            
            console.log(`✅ Đã hiển thị ${data.length} sản phẩm`);
        } else {
            console.log('📭 Không có sản phẩm nào phù hợp với bộ lọc');
            showEmptyState();
        }
        
    } catch (error) {
        console.error('❌ Lỗi khi tải sản phẩm:', error);
        showError(`Có lỗi xảy ra khi tải sản phẩm: ${error.message}`);
    } finally {
        hideLoading(); // Ẩn loading spinner
    }
}

/**
 * Lấy giá trị từ form lọc
 */
function getFilterValues() {
    const filters = {
        search: document.getElementById('search').value.trim(),
        category_id: document.getElementById('category').value,
        sort: document.getElementById('sort').value,
        min_price: document.getElementById('min_price').value,
        max_price: document.getElementById('max_price').value,
        page: currentPage,
        limit: 12 // Số sản phẩm mỗi trang
    };
    
    console.log('📋 Giá trị bộ lọc:', filters);
    return filters;
}

/**
 * Tạo query string từ bộ lọc
 */
function buildQueryString(filters) {
    const params = new URLSearchParams();
    
    // Chỉ thêm các tham số có giá trị
    Object.keys(filters).forEach(key => {
        const value = filters[key];
        if (value !== '' && value !== null && value !== undefined) {
            params.append(key, value);
        }
    });
    
    return params.toString();
}

/**
 * Hiển thị danh sách sản phẩm trên giao diện
 */
function displayProducts(products) {
    console.log(`🎨 Hiển thị ${products.length} sản phẩm`);
    
    const container = document.getElementById('productsContainer');
    const emptyState = document.getElementById('emptyState');
    
    if (!products || products.length === 0) {
        container.style.display = 'none';
        emptyState.style.display = 'block';
        return;
    }
    
    // Hiển thị container sản phẩm
    emptyState.style.display = 'none';
    container.style.display = 'flex';
    container.innerHTML = ''; // Xóa nội dung cũ
    
    // Tạo card cho từng sản phẩm
    products.forEach((product, index) => {
        const productCard = createProductCard(product, index);
        container.appendChild(productCard);
        
        // Animation delay cho từng card
        setTimeout(() => {
            productCard.style.opacity = '1';
            productCard.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    console.log('✅ Đã hiển thị xong tất cả sản phẩm');
}

/**
 * Tạo card sản phẩm với xử lý hình ảnh thông minh
 */
function createProductCard(product, index) {
    console.log(`🎴 Tạo card cho sản phẩm: ${product.name}`);
    
    const col = document.createElement('div');
    col.className = 'col-xl-3 col-lg-4 col-md-6 mb-4';
    col.setAttribute('data-aos', 'fade-up');
    col.setAttribute('data-aos-delay', index * 50);
    col.style.opacity = '0';
    col.style.transform = 'translateY(20px)';
    col.style.transition = 'all 0.5s ease';
    
    // Tìm tên danh mục từ dữ liệu đã load
    const categoryName = findCategoryName(product.category_id);
    
    // Xử lý hình ảnh với fallback
    const imageHtml = createImageHtml(product);
    
    col.innerHTML = `
        <div class="card product-card h-100 border-0 shadow-sm">
            <div class="position-relative overflow-hidden">
                ${imageHtml}
                
                <!-- Badge danh mục -->
                <div class="position-absolute top-0 end-0 m-2">
                    <span class="badge bg-primary rounded-pill" title="Danh mục: ${categoryName}">
                        <i class="fas fa-tag me-1"></i>${categoryName}
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
                    <!-- Giá gốc (giả lập) -->
                    <small class="text-muted text-decoration-line-through ms-2">
                        ${formatPrice(Math.round(product.price * 1.2))} đ
                    </small>
                </div>
                
                <!-- Rating giả lập -->
                <div class="rating mb-3">
                    <div class="stars text-warning">
                        ${generateStarRating(4.5)}
                    </div>
                    <small class="text-muted ms-2">(${Math.floor(Math.random() * 50) + 10} đánh giá)</small>
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
 * Tìm tên danh mục từ ID
 */
function findCategoryName(categoryId) {
    if (!categoryId || !categoriesData.length) {
        return 'Chưa phân loại';
    }
    
    const category = categoriesData.find(cat => cat.id == categoryId);
    return category ? category.name : 'Chưa phân loại';
}

/**
 * Tạo HTML cho hình ảnh với xử lý lỗi
 */
function createImageHtml(product) {
    if (product.image) {
        const imageUrl = getImageUrl(product.image);
        return `
            <img src="${imageUrl}" 
                 class="card-img-top product-image" 
                 alt="${escapeHtml(product.name)}"
                 style="height: 250px; object-fit: cover; cursor: pointer;"
                 onclick="showProductModal(${product.id})"
                 onload="handleImageLoad(this)"
                 onerror="handleImageError(this)">
        `;
    } else {
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
function handleImageLoad(imgElement) {
    console.log('🖼️ Hình ảnh tải thành công');
    imgElement.style.opacity = '1';
}

/**
 * Xử lý khi hình ảnh tải thất bại
 */
function handleImageError(imgElement) {
    console.log('❌ Hình ảnh tải thất bại, thay thế bằng placeholder');
    
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
 * Lấy URL hình ảnh với xử lý đường dẫn
 */
function getImageUrl(imagePath) {
    if (!imagePath) return null;
    
    if (imagePath.startsWith('http')) {
        return imagePath;
    }
    
    if (imagePath.startsWith('uploads/')) {
        return '/' + imagePath;
    }
    
    return '/uploads/' + imagePath;
}

/**
 * Tạo rating stars
 */
function generateStarRating(rating) {
    const fullStars = Math.floor(rating);
    const hasHalfStar = rating % 1 >= 0.5;
    const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
    
    let starsHtml = '';
    
    // Full stars
    for (let i = 0; i < fullStars; i++) {
        starsHtml += '<i class="fas fa-star"></i>';
    }
    
    // Half star
    if (hasHalfStar) {
        starsHtml += '<i class="fas fa-star-half-alt"></i>';
    }
    
    // Empty stars
    for (let i = 0; i < emptyStars; i++) {
        starsHtml += '<i class="far fa-star"></i>';
    }
    
    return starsHtml;
}

/**
 * Thiết lập các event listener
 */
function setupEventListeners() {
    console.log('🎧 Thiết lập event listeners');
    
    // Form lọc
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        console.log('🔍 Form lọc được submit');
        currentPage = 1;
        loadProducts();
    });
    
    // Nút xóa bộ lọc
    $('#clearFilters, #clearFiltersEmpty').on('click', function() {
        console.log('🗑️ Xóa tất cả bộ lọc');
        resetFilters();
    });
    
    // Tự động lọc khi thay đổi dropdown
    $('#category, #sort').on('change', function() {
        console.log('🔄 Thay đổi bộ lọc:', this.id, '=', this.value);
        currentPage = 1;
        loadProducts();
    });
    
    // Tìm kiếm với debounce (trì hoãn 500ms)
    let searchTimeout;
    $('#search').on('input', function() {
        clearTimeout(searchTimeout);
        const searchValue = this.value;
        
        searchTimeout = setTimeout(() => {
            console.log('🔍 Tìm kiếm:', searchValue);
            currentPage = 1;
            loadProducts();
        }, 500);
    });
    
    // Lọc theo khoảng giá với debounce
    let priceTimeout;
    $('#min_price, #max_price').on('input', function() {
        clearTimeout(priceTimeout);
        
        priceTimeout = setTimeout(() => {
            console.log('💰 Thay đổi khoảng giá');
            currentPage = 1;
            loadProducts();
        }, 1000);
    });
    
    // Nút lưu bộ lọc
    $('#saveFilter').on('click', function() {
        saveCurrentFilter();
    });
}

/**
 * Cập nhật hiển thị các bộ lọc đang active
 */
function updateActiveFilters(filters) {
    console.log('🏷️ Cập nhật active filters');
    
    const container = document.getElementById('activeFilters');
    container.innerHTML = '';
    
    let hasActiveFilters = false;
    
    // Tìm kiếm
    if (filters.search) {
        addFilterBadge(container, 'Tìm kiếm', `"${filters.search}"`, () => {
            document.getElementById('search').value = '';
            loadProducts();
        });
        hasActiveFilters = true;
    }
    
    // Danh mục
    if (filters.category_id) {
        const categoryName = findCategoryName(filters.category_id);
        addFilterBadge(container, 'Danh mục', categoryName, () => {
            document.getElementById('category').value = '';
            loadProducts();
        });
        hasActiveFilters = true;
    }
    
    // Khoảng giá
    if (filters.min_price || filters.max_price) {
        const minPrice = filters.min_price ? formatPrice(filters.min_price) : '0';
        const maxPrice = filters.max_price ? formatPrice(filters.max_price) : '∞';
        addFilterBadge(container, 'Giá', `${minPrice} - ${maxPrice} đ`, () => {
            document.getElementById('min_price').value = '';
            document.getElementById('max_price').value = '';
            loadProducts();
        });
        hasActiveFilters = true;
    }
    
    // Sắp xếp (nếu không phải mặc định)
    if (filters.sort && filters.sort !== 'newest') {
        const sortText = getSortText(filters.sort);
        addFilterBadge(container, 'Sắp xếp', sortText, () => {
            document.getElementById('sort').value = 'newest';
            loadProducts();
        });
        hasActiveFilters = true;
    }
    
    if (!hasActiveFilters) {
        container.innerHTML = '<span class="badge bg-secondary">Chưa có bộ lọc</span>';
    }
}

/**
 * Thêm badge cho bộ lọc active
 */
function addFilterBadge(container, label, value, removeCallback) {
    const badge = document.createElement('span');
    badge.className = 'filter-badge';
    badge.innerHTML = `
        ${label}: ${value}
        <button type="button" class="btn-close btn-close-white btn-sm ms-2" 
                onclick="this.parentElement.remove(); (${removeCallback.toString()})()"></button>
    `;
    container.appendChild(badge);
}

/**
 * Lấy text hiển thị cho sort option
 */
function getSortText(sortValue) {
    const sortOptions = {
        'newest': 'Mới nhất',
        'oldest': 'Cũ nhất', 
        'name': 'Tên A-Z',
        'price_asc': 'Giá tăng dần',
        'price_desc': 'Giá giảm dần'
    };
    
    return sortOptions[sortValue] || sortValue;
}

/**
 * Lưu bộ lọc hiện tại
 */
function saveCurrentFilter() {
    const filterName = prompt('Nhập tên cho bộ lọc này:');
    if (filterName) {
        const filter = {
            name: filterName,
            filters: {...currentFilters},
            timestamp: new Date().toISOString()
        };
        
        savedFilters.push(filter);
        localStorage.setItem('savedProductFilters', JSON.stringify(savedFilters));
        
        Swal.fire({
            icon: 'success',
            title: 'Đã lưu!',
            text: `Bộ lọc "${filterName}" đã được lưu`,
            timer: 2000,
            showConfirmButton: false
        });
        
        console.log('💾 Đã lưu bộ lọc:', filter);
    }
}

/**
 * Reset tất cả bộ lọc về mặc định
 */
function resetFilters() {
    console.log('🔄 Reset tất cả bộ lọc');
    
    document.getElementById('filterForm').reset();
    document.getElementById('sort').value = 'newest';
    
    // Reset quick category buttons
    document.querySelectorAll('.quick-category-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.classList.replace('btn-primary', 'btn-outline-secondary');
    });
    
    // Active nút "Tất cả"
    const allBtn = document.querySelector('.quick-category-btn');
    if (allBtn) {
        allBtn.classList.add('active');
        allBtn.classList.replace('btn-outline-secondary', 'btn-primary');
    }
    
    currentPage = 1;
    loadProducts();
}

/**
 * Hiển thị modal xem nhanh sản phẩm
 */
function showProductModal(productId) {
    console.log('👁️ Hiển thị modal cho sản phẩm ID:', productId);
    
    const modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
    
    document.getElementById('quickViewContent').innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <div class="mt-2">Đang tải thông tin sản phẩm...</div>
        </div>
    `;
    
    modal.show();
    
    // Gọi API để lấy chi tiết sản phẩm
    fetch(`/api/product/${productId}`)
        .then(response => response.json())
        .then(data => {
            console.log('📋 Dữ liệu sản phẩm cho modal:', data);
            
            if (data) {
                document.getElementById('quickViewContent').innerHTML = generateQuickViewHtml(data);
            } else {
                throw new Error('Product not found');
            }
        })
        .catch(error => {
            console.error('❌ Lỗi khi tải thông tin sản phẩm:', error);
            document.getElementById('quickViewContent').innerHTML = `
                <div class="alert alert-danger text-center">
                    <i class="fas fa-exclamation-triangle"></i>
                    Có lỗi xảy ra khi tải thông tin sản phẩm.
                </div>
            `;
        });
}

/**
 * Tạo HTML cho modal xem nhanh
 */
function generateQuickViewHtml(product) {
    const categoryName = findCategoryName(product.category_id);
    const imageUrl = product.image ? getImageUrl(product.image) : 'https://via.placeholder.com/600x400/f8f9fa/6c757d?text=No+Image';
    
    return `
        <div class="row">
            <div class="col-md-6">
                <img src="${imageUrl}" 
                     class="img-fluid rounded" 
                     alt="${escapeHtml(product.name)}"
                     style="width: 100%; height: 300px; object-fit: cover;"
                     onerror="this.src='https://via.placeholder.com/600x400/f8f9fa/6c757d?text=No+Image'">
            </div>
            <div class="col-md-6">
                <h4 class="fw-bold mb-3">${escapeHtml(product.name)}</h4>
                
                <div class="mb-3">
                    <span class="badge bg-primary">${categoryName}</span>
                </div>

                <div class="mb-3">
                    <div class="stars text-warning mb-2">
                        ${generateStarRating(4.5)}
                        <span class="text-muted ms-2">(4.5/5)</span>
                    </div>
                </div>

                <div class="price-section mb-4">
                    <h3 class="text-danger mb-0">${formatPrice(product.price)} VNĐ</h3>
                    <small class="text-muted text-decoration-line-through">
                        ${formatPrice(Math.round(product.price * 1.2))} VNĐ
                    </small>
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
 * Thêm sản phẩm vào giỏ hàng nhanh
 */
function addToCartQuick(productId) {
    console.log('🛒 Thêm vào giỏ hàng sản phẩm ID:', productId);
    
    const button = event.target.closest('button');
    const originalContent = button.innerHTML;
    
    // Hiển thị loading
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    button.disabled = true;

    // Giả lập API call (1 giây)
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
        
        // Cập nhật số lượng giỏ hàng
        updateCartCount();
    }, 1000);
}

/**
 * Xóa sản phẩm (chỉ admin)
 */
function deleteProduct(id) {
    console.log('🗑️ Yêu cầu xóa sản phẩm ID:', id);
    
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
            console.log('✅ Người dùng xác nhận xóa');
            
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
                console.log('📋 Kết quả xóa:', data);
                
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
                console.error('❌ Lỗi khi xóa sản phẩm:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Có lỗi xảy ra khi xóa sản phẩm'
                });
            });
        }
    });
}

// Các hàm utility

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
 * Định dạng giá tiền VNĐ
 */
function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price);
}

/**
 * Cập nhật counter tổng số sản phẩm
 */
function updateProductsCounter(total) {
    const counter = document.getElementById('totalProducts');
    if (counter) {
        animateValue(counter, 0, total, 1000);
    }
}

/**
 * Cập nhật counter tổng số danh mục
 */
function updateCategoriesCounter(total) {
    const counter = document.getElementById('totalCategories');
    if (counter) {
        animateValue(counter, 0, total, 1200);
    }
}

/**
 * Animate counter với hiệu ứng đếm
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
 * Cập nhật thông tin kết quả tìm kiếm
 */
function updateResultsInfo(total) {
    const resultsInfo = document.getElementById('resultsInfo');
    const hasFilters = Object.values(currentFilters).some(value => 
        value && value !== 'newest' && value !== 1 && value !== 12
    );
    
    if (hasFilters) {
        resultsInfo.innerHTML = `
            <i class="fas fa-info-circle me-1"></i>
            Tìm thấy ${total} sản phẩm phù hợp
        `;
    } else {
        resultsInfo.innerHTML = `
            <i class="fas fa-info-circle me-1"></i>
            Hiển thị ${total} sản phẩm
        `;
    }
}

/**
 * Cập nhật số lượng giỏ hàng trên header
 */
function updateCartCount() {
    // Giả lập cập nhật số lượng giỏ hàng
    const cartCount = document.getElementById('cartCount');
    if (cartCount) {
        const currentCount = parseInt(cartCount.textContent || '0');
        const newCount = currentCount + 1;
        cartCount.textContent = newCount;
        
        // Hiệu ứng bounce cho icon giỏ hàng
        cartCount.style.transform = 'scale(1.2)';
        setTimeout(() => {
            cartCount.style.transform = 'scale(1)';
        }, 200);
        
        console.log('🛒 Cập nhật số lượng giỏ hàng:', newCount);
    }
}

/**
 * Hiển thị trạng thái loading
 */
function showLoading() {
    document.getElementById('loadingSpinner').style.display = 'block';
    document.getElementById('productsContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'none';
    document.getElementById('paginationContainer').style.display = 'none';
}

/**
 * Ẩn trạng thái loading
 */
function hideLoading() {
    document.getElementById('loadingSpinner').style.display = 'none';
}

/**
 * Hiển thị trạng thái rỗng khi không có sản phẩm
 */
function showEmptyState() {
    document.getElementById('productsContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'block';
    document.getElementById('paginationContainer').style.display = 'none';
}

/**
 * Hiển thị trạng thái rỗng cho danh mục
 */
function showCategoryEmptyState() {
    const categorySelect = document.getElementById('category');
    categorySelect.innerHTML = '<option value="">Tất cả danh mục (Chưa có danh mục)</option>';
    
    // Ẩn quick category filters
    const quickFilters = document.getElementById('quickCategoryFilters');
    quickFilters.innerHTML = '<span class="text-muted"><i class="fas fa-info-circle me-1"></i>Chưa có danh mục nào</span>';
}

/**
 * Khởi tạo các thành phần UI
 */
function initializeUIComponents() {
    console.log('🎨 Khởi tạo các thành phần UI');
    
    // Khởi tạo Hero Swiper nếu có thư viện Swiper
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
        console.log('✅ Đã khởi tạo Hero Swiper');
    }
    
    // Animate các counter khi scroll đến
    animateCountersOnScroll();
    
    // Load saved filters nếu có
    loadSavedFilters();
    
    // Thiết lập auto-refresh (tùy chọn)
    setupAutoRefresh();
}

/**
 * Animate counters khi scroll đến phần stats
 */
function animateCountersOnScroll() {
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
 * Load các bộ lọc đã lưu
 */
function loadSavedFilters() {
    try {
        const saved = localStorage.getItem('savedProductFilters');
        if (saved) {
            savedFilters = JSON.parse(saved);
            console.log(`💾 Đã load ${savedFilters.length} bộ lọc đã lưu`);
        }
    } catch (error) {
        console.error('❌ Lỗi khi load saved filters:', error);
        savedFilters = [];
    }
}

/**
 * Thiết lập auto-refresh (tùy chọn)
 */
function setupAutoRefresh() {
    // Refresh data mỗi 5 phút (chỉ khi tab active)
    setInterval(() => {
        if (!document.hidden) {
            console.log('🔄 Auto-refresh dữ liệu');
            // Refresh danh mục và sản phẩm
            loadCategories().then(() => {
                loadProducts();
            });
        }
    }, 300000); // 5 phút
    
    // Refresh khi tab được focus lại
    document.addEventListener('visibilitychange', () => {
        if (!document.hidden) {
            console.log('👁️ Tab được focus lại, refresh dữ liệu');
            loadCategories().then(() => {
                loadProducts();
            });
        }
    });
}

/**
 * Hiển thị thông báo lỗi chung
 */
function showError(message) {
    console.error('❌ Hiển thị lỗi:', message);
    
    Swal.fire({
        icon: 'error',
        title: 'Lỗi!',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true
    });
}

/**
 * Hiển thị thông báo thành công
 */
function showSuccess(message) {
    console.log('✅ Hiển thị thông báo thành công:', message);
    
    Swal.fire({
        icon: 'success',
        title: 'Thành công!',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
}

/**
 * Hiển thị thông báo thông tin
 */
function showInfo(message) {
    console.log('ℹ️ Hiển thị thông tin:', message);
    
    Swal.fire({
        icon: 'info',
        title: 'Thông báo',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
}

// Smooth scroll cho các anchor links
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll đến phần sản phẩm
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

// Lazy loading cho hình ảnh (nếu trình duyệt hỗ trợ)
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            }
        });
    });

    // Observe tất cả hình ảnh có class 'lazy'
    document.querySelectorAll('img.lazy').forEach(img => {
        imageObserver.observe(img);
    });
}

// Performance optimization: Debounce scroll events
let ticking = false;
function updateScrollPosition() {
    // Cập nhật các animation dựa trên scroll ở đây
    ticking = false;
}

window.addEventListener('scroll', function() {
    if (!ticking) {
        requestAnimationFrame(updateScrollPosition);
        ticking = true;
    }
});

// Xử lý offline/online status
window.addEventListener('online', function() {
    console.log('🌐 Kết nối mạng được khôi phục');
    showSuccess('Kết nối mạng đã được khôi phục');
    
    // Retry load data nếu cần
    if (categoriesData.length === 0) {
        loadCategories();
    }
    if (productsData.length === 0) {
        loadProducts();
    }
});

window.addEventListener('offline', function() {
    console.log('📡 Mất kết nối mạng');
    showError('Mất kết nối mạng. Một số tính năng có thể không hoạt động.');
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + K để focus vào ô tìm kiếm
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        document.getElementById('search').focus();
    }
    
    // Escape để xóa bộ lọc
    if (e.key === 'Escape') {
        const modal = document.querySelector('.modal.show');
        if (!modal) { // Chỉ xóa filter nếu không có modal nào đang mở
            resetFilters();
        }
    }
});

// Debug helpers (chỉ trong development)
if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
    // Expose các function để debug
    window.debugProduct = {
        loadCategories,
        loadProducts,
        currentFilters,
        categoriesData,
        productsData,
        resetFilters
    };
    
    console.log('🔧 Debug helpers available in window.debugProduct');
}

// Analytics tracking (nếu có Google Analytics)
function trackEvent(action, category = 'Product List', label = '') {
    if (typeof gtag !== 'undefined') {
        gtag('event', action, {
            event_category: category,
            event_label: label
        });
    }
}

// Track các hành động quan trọng
function trackProductView(productId) {
    trackEvent('view_product', 'Product', `Product ID: ${productId}`);
}

function trackAddToCart(productId) {
    trackEvent('add_to_cart', 'Product', `Product ID: ${productId}`);
}

function trackSearch(searchTerm) {
    trackEvent('search', 'Product', searchTerm);
}

// Error boundary cho JavaScript
window.addEventListener('error', function(e) {
    console.error('💥 JavaScript Error:', e.error);
    
    // Gửi error đến service monitoring (nếu có)
    if (typeof Sentry !== 'undefined') {
        Sentry.captureException(e.error);
    }
    
    // Hiển thị thông báo lỗi user-friendly
    showError('Đã xảy ra lỗi. Vui lòng thử refresh trang.');
});

// Service Worker registration (nếu có)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('✅ ServiceWorker registered successfully');
            })
            .catch(function(error) {
                console.log('❌ ServiceWorker registration failed:', error);
            });
    });
}

console.log('🎉 Product List API Script loaded successfully');
console.log(`👤 Current user: <?= $_SESSION['username'] ?? 'Guest' ?>`);
console.log(`📅 Current time: <?= date('Y-m-d H:i:s') ?>`);
</script>

<?php include_once 'app/views/shares/footer.php'; ?>