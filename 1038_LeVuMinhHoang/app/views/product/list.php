<?php 
$pageTitle = "Danh Sách Sản Phẩm";
include_once 'app/views/shares/header.php'; 
?>

<!-- Hero Section - Phần banner chính của trang với comment tiếng Việt -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-4">
                    Khám Phá Thế Giới <span class="text-warning">Công Nghệ</span>
                </h1>
                <p class="lead mb-4">
                    Tìm kiếm những sản phẩm điện tử chất lượng cao với giá cả hợp lý. 
                    Từ smartphone đến laptop, tất cả đều có tại TechTafu với hình ảnh sắc nét.
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

<!-- Stats Section - Phần hiển thị thống kê tổng quan từ API -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <!-- Counter hiển thị tổng số sản phẩm từ ProductApiController -->
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                <div class="stats-card">
                    <i class="fas fa-laptop fa-3x mb-3 text-primary"></i>
                    <h3 class="counter" id="totalProducts">0</h3>
                    <p class="mb-0">Sản Phẩm</p>
                    <small class="text-muted">Từ ProductApiController</small>
                </div>
            </div>
            <!-- Counter hiển thị tổng số danh mục từ CategoryApiController -->
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-card">
                    <i class="fas fa-tags fa-3x mb-3 text-success"></i>
                    <h3 class="counter" id="totalCategories">0</h3>
                    <p class="mb-0">Danh Mục</p>
                    <small class="text-muted">Từ CategoryApiController</small>
                </div>
            </div>
            <!-- Thống kê sản phẩm có hình ảnh -->
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-card">
                    <i class="fas fa-images fa-3x mb-3 text-info"></i>
                    <h3 class="counter" id="totalImagesProduct">0</h3>
                    <p class="mb-0">Có Hình Ảnh</p>
                    <small class="text-muted">Sản phẩm với hình ảnh</small>
                </div>
            </div>
            <!-- Đánh giá trung bình -->
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-card">
                    <i class="fas fa-star fa-3x mb-3 text-warning"></i>
                    <h3 class="counter" data-count="4.8">0</h3>
                    <p class="mb-0">Đánh Giá TB</p>
                    <small class="text-muted">⭐⭐⭐⭐⭐</small>
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
                    Khám phá bộ sưu tập sản phẩm điện tử hàng đầu với hình ảnh chất lượng cao
                </p>
            </div>
        </div>

        <!-- Filter Panel - Bảng điều khiển lọc và tìm kiếm nâng cao -->
        <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-filter me-2"></i>Bộ Lọc Sản Phẩm Nâng Cao
                    <button class="btn btn-sm btn-outline-light float-end" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                        <i class="fas fa-chevron-down" id="filterToggleIcon"></i>
                    </button>
                </h5>
            </div>
            <div class="collapse show" id="filterCollapse">
                <div class="card-body">
                    <!-- Form lọc sản phẩm -->
                    <form id="filterForm">
                        <div class="row">
                            <!-- Ô tìm kiếm theo tên sản phẩm với debounce -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="search" class="form-label fw-semibold">
                                    <i class="fas fa-search text-primary me-2"></i>Tìm kiếm
                                </label>
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-control" 
                                           id="search" 
                                           name="search" 
                                           placeholder="Nhập tên sản phẩm...">
                                    <button class="btn btn-outline-secondary" type="button" id="clearSearchBtn">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="form-text">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>Tìm kiếm tự động sau 500ms
                                    </small>
                                </div>
                            </div>

                            <!-- Dropdown chọn danh mục - được load từ CategoryApiController -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label for="category" class="form-label fw-semibold">
                                    <i class="fas fa-tags text-primary me-2"></i>Danh mục
                                </label>
                                <select class="form-select" id="category" name="category">
                                    <option value="">Tất cả danh mục</option>
                                    <!-- Danh mục sẽ được load từ CategoryApiController -->
                                </select>
                                <!-- Loading indicator cho danh mục -->
                                <div id="categoryLoading" class="text-center mt-2" style="display: none;">
                                    <small class="text-muted">
                                        <i class="fas fa-spinner fa-spin me-1"></i>Đang tải từ CategoryApiController...
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
                                    <option value="name_asc">Tên A-Z</option>
                                    <option value="name_desc">Tên Z-A</option>
                                    <option value="price_asc">Giá tăng dần</option>
                                    <option value="price_desc">Giá giảm dần</option>
                                    <option value="with_image">Có hình ảnh</option>
                                    <option value="no_image">Chưa có hình ảnh</option>
                                </select>
                            </div>
                        </div>

                        <!-- Bộ lọc nâng cao - khoảng giá và hình ảnh -->
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-3">
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

                            <!-- Bộ lọc theo hình ảnh -->
                            <div class="col-lg-4 col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-image text-primary me-2"></i>Bộ lọc hình ảnh
                                </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="has_image" name="has_image">
                                    <label class="form-check-label" for="has_image">
                                        Chỉ hiển thị sản phẩm có hình ảnh
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="high_quality_image" name="high_quality_image">
                                    <label class="form-check-label" for="high_quality_image">
                                        Hình ảnh chất lượng cao
                                    </label>
                                </div>
                            </div>

                            <!-- Hiển thị bộ lọc đang active -->
                            <div class="col-lg-4 col-md-12 mb-3">
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
                                        <button type="button" id="exportResults" class="btn btn-outline-success">
                                            <i class="fas fa-download me-2"></i>Xuất Kết Quả
                                        </button>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted" id="resultsInfo">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Đang tải từ ProductApiController...
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Quick Category Filter - Lọc nhanh theo danh mục phổ biến -->
        <div class="row mb-4" data-aos="fade-up">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-semibold text-muted me-2">Danh mục phổ biến:</span>
                    <div id="quickCategoryFilters" class="d-flex flex-wrap gap-2">
                        <!-- Quick category buttons sẽ được tạo bằng JavaScript từ CategoryApiController -->
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

        <!-- View Mode Toggle - Chọn cách hiển thị sản phẩm -->
        <div class="row mb-4" data-aos="fade-up">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <span class="fw-semibold">Cách hiển thị:</span>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary active" id="gridViewBtn" onclick="setViewMode('grid')">
                                <i class="fas fa-th-large me-1"></i>Lưới
                            </button>
                            <button type="button" class="btn btn-outline-primary" id="listViewBtn" onclick="setViewMode('list')">
                                <i class="fas fa-list me-1"></i>Danh sách
                            </button>
                            <button type="button" class="btn btn-outline-primary" id="compactViewBtn" onclick="setViewMode('compact')">
                                <i class="fas fa-th me-1"></i>Compact
                            </button>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <label for="itemsPerPage" class="form-label mb-0 fw-semibold">Hiển thị:</label>
                        <select class="form-select form-select-sm" id="itemsPerPage" style="width: auto;">
                            <option value="12">12 sản phẩm</option>
                            <option value="24">24 sản phẩm</option>
                            <option value="48">48 sản phẩm</option>
                            <option value="96">96 sản phẩm</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Spinner - Hiển thị khi đang tải dữ liệu từ ProductApiController -->
        <div id="loadingSpinner" class="text-center py-5">
            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <div class="mt-3">
                <h5>Đang tải sản phẩm từ ProductApiController...</h5>
                <p class="text-muted">Vui lòng đợi trong giây lát</p>
                <div class="progress mx-auto" style="width: 300px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" 
                         role="progressbar" style="width: 0%" id="loadingProgress"></div>
                </div>
            </div>
        </div>

        <!-- Products Grid - Lưới hiển thị sản phẩm -->
        <div class="row" id="productsContainer" style="display: none;">
            <!-- Sản phẩm sẽ được load bằng JavaScript từ ProductApiController -->
        </div>

        <!-- Empty State - Trạng thái khi không có sản phẩm -->
        <div id="emptyState" class="col-12 text-center py-5" style="display: none;" data-aos="fade-up">
            <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
            <h3 class="text-muted">Không tìm thấy sản phẩm</h3>
            <p class="text-muted mb-4">
                Hãy thử thay đổi tiêu chí tìm kiếm hoặc bộ lọc.<br>
                <small>Hoặc có thể ProductApiController chưa có dữ liệu phù hợp.</small>
            </p>
            <div class="d-flex gap-2 justify-content-center">
                <button class="btn btn-primary" id="clearFiltersEmpty">
                    <i class="fas fa-times me-2"></i>Xóa Bộ Lọc
                </button>
                <?php if (SessionHelper::isAdmin()): ?>
                <a href="/product/add" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>Thêm Sản Phẩm Mới
                </a>
                <?php endif; ?>
            </div>
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

<!-- Quick View Modal - Modal xem nhanh sản phẩm với hình ảnh -->
<div class="modal fade" id="quickViewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye me-2"></i>Xem Nhanh Sản Phẩm
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="quickViewContent">
                    <!-- Nội dung modal sẽ được load bằng JavaScript từ ProductApiController -->
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Đang tải từ ProductApiController...</span>
                        </div>
                        <div class="mt-2">Đang tải thông tin sản phẩm...</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Đóng
                </button>
                <button type="button" class="btn btn-primary" id="viewDetailBtn">
                    <i class="fas fa-external-link-alt me-2"></i>Xem Chi Tiết
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview Modal - Modal xem hình ảnh full size -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="imagePreviewTitle">Hình Ảnh Sản Phẩm</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-2">
                <img id="previewImage" class="img-fluid rounded" alt="Product Image">
                <div class="mt-3">
                    <button class="btn btn-outline-light me-2" onclick="downloadPreviewImage()">
                        <i class="fas fa-download me-1"></i>Tải về
                    </button>
                    <button class="btn btn-outline-light" onclick="sharePreviewImage()">
                        <i class="fas fa-share me-1"></i>Chia sẻ
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS Styles với comment tiếng Việt -->
<style>
/* Hiệu ứng hover cho card sản phẩm */
.product-card {
    transition: all 0.3s ease; /* Chuyển đổi mượt trong 0.3 giây */
    border: none;
    border-radius: 1rem;
    overflow: hidden;
}

.product-card:hover {
    transform: translateY(-8px); /* Di chuyển lên 8px khi hover */
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important; /* Tạo bóng đổ */
}

/* Container hình ảnh sản phẩm */
.product-image-container {
    position: relative;
    overflow: hidden;
    height: 250px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

/* Hình ảnh sản phẩm */
.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Giữ tỷ lệ và cắt bớt nếu cần */
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05); /* Phóng to hình ảnh khi hover card */
}

/* Overlay hiển thị khi hover */
.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
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

/* Placeholder khi không có hình ảnh */
.no-image-placeholder {
    background: linear-gradient(135deg, #e9ecef, #f8f9fa);
    border: 2px dashed #dee2e6;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 250px;
    color: #6c757d;
}

/* Badge trạng thái hình ảnh */
.image-status-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.9);
}

/* Keyframes cho hiệu ứng loading */
@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Style cho quick category filters */
.quick-category-btn {
    transition: all 0.3s ease;
    border-radius: 25px;
    padding: 0.5rem 1rem;
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
    border-radius: 20px;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.filter-badge:hover {
    transform: scale(1.05);
}

.filter-badge .remove-filter {
    background: rgba(255,255,255,0.3);
    border: none;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 12px;
    cursor: pointer;
}

/* Loading progress animation */
.loading-progress {
    animation: progressAnimation 2s ease-in-out infinite;
}

@keyframes progressAnimation {
    0% { width: 0%; }
    50% { width: 60%; }
    100% { width: 90%; }
}

/* View modes - Grid, List, Compact */
.view-mode-grid .product-card {
    margin-bottom: 2rem;
}

.view-mode-list .product-card {
    margin-bottom: 1rem;
}

.view-mode-list .product-image-container {
    height: 150px;
}

.view-mode-compact .product-card {
    margin-bottom: 0.5rem;
}

.view-mode-compact .product-image-container {
    height: 120px;
}

/* Stats card animation */
.stats-card {
    transition: all 0.3s ease;
    padding: 2rem;
    border-radius: 1rem;
    background: white;
    border: 1px solid #e9ecef;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

/* Responsive design cho mobile */
@media (max-width: 768px) {
    .product-card {
        margin-bottom: 1.5rem;
    }
    
    .product-image-container {
        height: 200px;
    }
    
    .stats-card {
        margin-bottom: 1rem;
        padding: 1.5rem;
    }
    
    #quickCategoryFilters {
        justify-content: center;
    }
    
    .filter-controls {
        flex-direction: column;
        gap: 1rem;
    }
    
    .hero-section .display-4 {
        font-size: 2rem;
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

/* Hero section styles */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4rem 0;
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
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="rgba(255,255,255,0.1)"><polygon points="1000,100 1000,0 0,100"/></svg>');
    background-size: cover;
}

/* Product badge styles */
.product-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    z-index: 2;
}

.badge-new {
    background: linear-gradient(45deg, #ff6b6b, #ee5a24);
}

.badge-sale {
    background: linear-gradient(45deg, #26de81, #20bf6b);
}

.badge-hot {
    background: linear-gradient(45deg, #fd79a8, #fdcb6e);
}

/* Price display */
.price-display {
    font-size: 1.25rem;
    font-weight: bold;
    color: #e74c3c;
}

.price-original {
    text-decoration: line-through;
    color: #95a5a6;
    font-size: 0.9rem;
    margin-left: 0.5rem;
}

/* Rating stars */
.rating-stars {
    color: #f39c12;
    font-size: 0.9rem;
}

.rating-count {
    color: #7f8c8d;
    font-size: 0.8rem;
    margin-left: 0.5rem;
}
</style>

<script>
// Biến toàn cục để quản lý trạng thái với comment tiếng Việt
let currentPage = 1; // Trang hiện tại
let currentFilters = {}; // Bộ lọc hiện tại
let categoriesData = []; // Dữ liệu danh mục từ CategoryApiController
let productsData = []; // Dữ liệu sản phẩm hiện tại từ ProductApiController
let totalPages = 0; // Tổng số trang
let totalProducts = 0; // Tổng số sản phẩm
let savedFilters = []; // Bộ lọc đã lưu
let currentViewMode = 'grid'; // Chế độ hiển thị hiện tại
let searchTimeout; // Timeout cho search debounce
let priceTimeout; // Timeout cho price filter debounce

// Khởi tạo khi tài liệu được tải xong
$(document).ready(function() {
    console.log('🚀 Bắt đầu khởi tạo trang danh sách sản phẩm với API tích hợp');
    console.log(`👤 Current user: ${<?= json_encode($_SESSION['username'] ?? 'MHoang287') ?>}`);
    console.log(`📅 Current time: ${new Date().toLocaleString()}`);
    
    // Tải dữ liệu ban đầu theo thứ tự ưu tiên
    initializePage();
});

/**
 * Khởi tạo trang - Load dữ liệu theo thứ tự từ các API Controller
 */
async function initializePage() {
    try {
        console.log('📚 Bắt đầu tải dữ liệu từ các API Controller');
        
        // Hiển thị loading progress
        showLoadingProgress(0);
        
        // Bước 1: Load danh mục trước từ CategoryApiController (quan trọng cho bộ lọc)
        console.log('🏷️ Tải danh mục từ CategoryApiController...');
        showLoadingProgress(20);
        await loadCategories();
        
        // Bước 2: Load sản phẩm từ ProductApiController
        console.log('📦 Tải sản phẩm từ ProductApiController...');
        showLoadingProgress(50);
        await loadProducts();
        
        // Bước 3: Thiết lập các event listener
        console.log('🎧 Thiết lập event listeners...');
        showLoadingProgress(70);
        setupEventListeners();
        
        // Bước 4: Khởi tạo các thành phần UI
        console.log('🎨 Khởi tạo UI components...');
        showLoadingProgress(90);
        initializeUIComponents();
        
        // Hoàn thành loading
        showLoadingProgress(100);
        setTimeout(() => {
            hideLoading();
        }, 500);
        
        console.log('✅ Khởi tạo trang hoàn tất');
        
    } catch (error) {
        console.error('❌ Lỗi khởi tạo trang:', error);
        hideLoading();
        showError('Có lỗi xảy ra khi tải trang. Vui lòng thử lại sau.');
    }
}

/**
 * Hiển thị progress loading
 */
function showLoadingProgress(percent) {
    const progressBar = document.getElementById('loadingProgress');
    if (progressBar) {
        progressBar.style.width = percent + '%';
        progressBar.textContent = Math.round(percent) + '%';
    }
}

/**
 * Tải danh sách danh mục từ CategoryApiController
 */
async function loadCategories() {
    console.log('🏷️ Gọi CategoryApiController để lấy danh sách danh mục');
    
    const categorySelect = document.getElementById('category');
    const categoryLoading = document.getElementById('categoryLoading');
    const categoryError = document.getElementById('categoryError');
    
    try {
        // Hiển thị loading cho danh mục
        categoryLoading.style.display = 'block';
        categoryError.style.display = 'none';
        
        // Gọi CategoryApiController
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
        console.log('📝 Dữ liệu danh mục từ CategoryApiController:', categories);
        
        if (Array.isArray(categories) && categories.length > 0) {
            // Lưu dữ liệu danh mục vào biến global
            categoriesData = categories;
            
            // Cập nhật dropdown danh mục
            updateCategoryDropdown(categories);
            
            // Tạo quick category filters
            createQuickCategoryFilters(categories);
            
            // Cập nhật counter tổng số danh mục
            updateCategoriesCounter(categories.length);
            
            console.log(`✅ Đã load thành công ${categories.length} danh mục từ CategoryApiController`);
        } else {
            console.log('⚠️ CategoryApiController không trả về danh mục nào');
            showCategoryEmptyState();
        }
        
    } catch (error) {
        console.error('❌ Lỗi khi gọi CategoryApiController:', error);
        
        // Hiển thị thông báo lỗi
        categoryError.style.display = 'block';
        categoryError.innerHTML = `
            <small>
                <i class="fas fa-exclamation-triangle me-1"></i>
                Lỗi CategoryApiController: ${error.message}
            </small>
        `;
        
        // Fallback: tạo option mặc định
        categorySelect.innerHTML = '<option value="">Tất cả danh mục (Lỗi API)</option>';
        
    } finally {
        // Ẩn loading indicator
        categoryLoading.style.display = 'none';
    }
}

/**
 * Cập nhật dropdown danh mục với dữ liệu từ CategoryApiController
 */
function updateCategoryDropdown(categories) {
    console.log('🔄 Cập nhật dropdown danh mục từ CategoryApiController');
    
    const categorySelect = document.getElementById('category');
    
    // Xóa các option cũ (trừ option "Tất cả danh mục")
    categorySelect.innerHTML = '<option value="">Tất cả danh mục</option>';
    
    // Thêm option cho mỗi danh mục
    categories.forEach((category, index) => {
        const option = document.createElement('option');
        option.value = category.id;
        option.textContent = category.name;
        option.title = category.description || category.name; // Tooltip hiển thị mô tả
        option.setAttribute('data-image', category.image || ''); // Lưu thông tin hình ảnh
        
        categorySelect.appendChild(option);
        
        console.log(`➕ Đã thêm danh mục: ${category.name} (ID: ${category.id})`);
        
        // Animation delay cho từng option (chỉ cho 5 option đầu)
        if (index < 5) {
            setTimeout(() => {
                option.classList.add('category-loaded');
            }, index * 100);
        }
    });
    
    console.log(`✅ Đã cập nhật dropdown với ${categories.length} danh mục từ CategoryApiController`);
}

/**
 * Tạo các nút lọc nhanh theo danh mục phổ biến từ CategoryApiController
 */
function createQuickCategoryFilters(categories) {
    console.log('⚡ Tạo quick category filters từ CategoryApiController');
    
    const container = document.getElementById('quickCategoryFilters');
    
    // Xóa placeholder
    container.innerHTML = '';
    
    // Lấy top 6 danh mục đầu tiên làm danh mục phổ biến
    const popularCategories = categories.slice(0, 6);
    
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
        
        // Thêm icon nếu có hình ảnh hoặc dùng icon mặc định
        const icon = category.image ? 
            `<img src="${getImageUrl(category.image)}" alt="${category.name}" style="width: 16px; height: 16px; margin-right: 4px;">` :
            `<i class="fas fa-tag me-1"></i>`;
        
        btn.innerHTML = `${icon}${category.name}`;
        btn.onclick = () => selectQuickCategory(category.id, btn);
        btn.title = category.description || `Xem sản phẩm trong danh mục ${category.name}`;
        
        // Animation delay
        setTimeout(() => {
            container.appendChild(btn);
            btn.style.opacity = '0';
            btn.style.transform = 'translateY(20px)';
            setTimeout(() => {
                btn.style.transition = 'all 0.3s ease';
                btn.style.opacity = '1';
                btn.style.transform = 'translateY(0)';
            }, 50);
        }, index * 150);
        
        console.log(`🏷️ Đã tạo quick filter cho: ${category.name}`);
    });
    
    console.log(`✅ Đã tạo ${popularCategories.length + 1} quick category filters từ CategoryApiController`);
}

/**
 * Xử lý khi chọn quick category filter
 */
function selectQuickCategory(categoryId, buttonElement) {
    console.log('🎯 Chọn quick category từ CategoryApiController:', categoryId || 'Tất cả');
    
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
        
        console.log('🔍 Bộ lọc gửi đến ProductApiController:', filters);
        
        // Tạo query string từ bộ lọc
        const queryString = buildQueryString(filters);
        console.log('🔗 Query string cho ProductApiController:', queryString);
        
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
        
        const responseData = await response.json();
        console.log('📦 Dữ liệu từ ProductApiController:', responseData);
        
        let products = [];
        let pagination = null;
        
        // Xử lý response data (có thể là array hoặc object với pagination)
        if (Array.isArray(responseData)) {
            products = responseData;
            totalProducts = products.length;
        } else if (responseData.data && Array.isArray(responseData.data)) {
            products = responseData.data;
            pagination = responseData.pagination || {};
            totalProducts = pagination.total || products.length;
            totalPages = pagination.pages || Math.ceil(totalProducts / (filters.limit || 12));
        } else {
            products = [];
        }
        
        if (products.length > 0) {
            // Lưu dữ liệu sản phẩm
            productsData = products;
            
            // Hiển thị sản phẩm
            displayProducts(products);
            
            // Cập nhật pagination nếu có
            if (pagination) {
                updatePagination(pagination);
            }
            
            // Cập nhật thông tin kết quả
            updateResultsInfo(products.length, totalProducts);
            
            // Cập nhật counter
            updateProductsCounter(totalProducts);
            
            // Cập nhật counter sản phẩm có hình ảnh
            const productsWithImages = products.filter(p => p.image && p.image.trim() !== '').length;
            updateImagesProductCounter(productsWithImages);
            
            // Cập nhật active filters
            updateActiveFilters(filters);
            
            console.log(`✅ Đã hiển thị ${products.length}/${totalProducts} sản phẩm từ ProductApiController`);
        } else {
            console.log('📭 ProductApiController không trả về sản phẩm nào');
            showEmptyState();
            updateProductsCounter(0);
            updateImagesProductCounter(0);
        }
        
    } catch (error) {
        console.error('❌ Lỗi khi gọi ProductApiController:', error);
        showError(`Có lỗi xảy ra khi tải sản phẩm từ ProductApiController: ${error.message}`);
        showEmptyState();
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
        has_image: document.getElementById('has_image').checked,
        high_quality_image: document.getElementById('high_quality_image').checked,
        page: currentPage,
        limit: parseInt(document.getElementById('itemsPerPage').value) || 12
    };
    
    console.log('📋 Giá trị bộ lọc cho ProductApiController:', filters);
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
        if (value !== '' && value !== null && value !== undefined && value !== false) {
            params.append(key, value);
        }
    });
    
    return params.toString();
}

/**
 * Hiển thị danh sách sản phẩm trên giao diện với hình ảnh từ API
 */
function displayProducts(products) {
    console.log(`🎨 Hiển thị ${products.length} sản phẩm từ ProductApiController`);
    
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
    
    // Áp dụng view mode class
    container.className = `row view-mode-${currentViewMode}`;
    
    // Tạo card cho từng sản phẩm
    products.forEach((product, index) => {
        const productCard = createProductCard(product, index);
        container.appendChild(productCard);
        
        // Animation delay cho từng card
        setTimeout(() => {
            productCard.style.opacity = '1';
            productCard.style.transform = 'translateY(0)';
        }, index * 50);
    });
    
    console.log('✅ Đã hiển thị xong tất cả sản phẩm với hình ảnh từ ProductApiController');
}

/**
 * Tạo card sản phẩm với xử lý hình ảnh từ API thông minh
 */
function createProductCard(product, index) {
    console.log(`🎴 Tạo card cho sản phẩm từ ProductApiController: ${product.name}`);
    
    // Xác định class column dựa trên view mode
    let colClass = 'col-xl-3 col-lg-4 col-md-6 mb-4'; // Grid view
    if (currentViewMode === 'list') {
        colClass = 'col-12 mb-3';
    } else if (currentViewMode === 'compact') {
        colClass = 'col-xl-2 col-lg-3 col-md-4 col-6 mb-2';
    }
    
    const col = document.createElement('div');
    col.className = colClass;
    col.setAttribute('data-aos', 'fade-up');
    col.setAttribute('data-aos-delay', index * 25);
    col.style.opacity = '0';
    col.style.transform = 'translateY(20px)';
    col.style.transition = 'all 0.5s ease';
    
    // Tìm tên danh mục từ dữ liệu CategoryApiController
    const categoryName = findCategoryName(product.category_id);
    
    // Xử lý hình ảnh với fallback và API integration
    const imageHtml = createImageHtml(product);
    
    // Tạo badge cho sản phẩm
    const badges = createProductBadges(product);
    
    col.innerHTML = `
        <div class="card product-card h-100 shadow-sm">
            <div class="product-image-container">
                ${imageHtml}
                
                <!-- Badges sản phẩm -->
                <div class="product-badge">
                    ${badges}
                </div>
                
                <!-- Badge danh mục -->
                <div class="position-absolute top-0 end-0 m-2">
                    <span class="badge bg-primary rounded-pill" title="Danh mục: ${categoryName}">
                        <i class="fas fa-tag me-1"></i>${categoryName}
                    </span>
                </div>
                
                <!-- Overlay hiện khi hover -->
                <div class="product-overlay">
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
                        ${product.image ? `
                        <button class="btn btn-info btn-sm rounded-circle" 
                                onclick="previewImage('${getImageUrl(product.image)}', '${escapeHtml(product.name)}')" 
                                title="Xem hình ảnh">
                            <i class="fas fa-image"></i>
                        </button>
                        ` : ''}
                    </div>
                </div>
            </div>
            
            <!-- Nội dung card -->
            <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-bold mb-2" style="min-height: ${currentViewMode === 'compact' ? '40px' : '48px'};">
                    <a href="/product/show/${product.id}" class="text-decoration-none text-dark">
                        ${escapeHtml(product.name)}
                    </a>
                </h5>
                
                ${currentViewMode !== 'compact' ? `
                <p class="card-text text-muted small flex-grow-1" style="min-height: 60px;">
                    ${product.description ? escapeHtml(product.description.substring(0, 100)) + '...' : 'Không có mô tả'}
                </p>
                ` : ''}
                
                <!-- Giá sản phẩm -->
                <div class="price mb-3">
                    <span class="price-display">
                        ${formatPrice(product.price)} đ
                    </span>
                    <!-- Giá gốc (giả lập) -->
                    <span class="price-original">
                        ${formatPrice(Math.round(product.price * 1.2))} đ
                    </span>
                </div>
                
                <!-- Rating giả lập -->
                ${currentViewMode !== 'compact' ? `
                <div class="rating mb-3">
                    <div class="rating-stars">
                        ${generateStarRating(4.5)}
                    </div>
                    <span class="rating-count">(${Math.floor(Math.random() * 50) + 10})</span>
                </div>
                ` : ''}
                
                <!-- Nút hành động -->
                <div class="mt-auto">
                    ${currentViewMode === 'list' ? `
                    <div class="row g-2">
                        <div class="col-3">
                            <a href="/product/show/${product.id}" 
                               class="btn btn-outline-primary btn-sm w-100" 
                               title="Xem chi tiết">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                        <div class="col-6">
                            <button onclick="addToCartQuick(${product.id})" 
                                    class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-cart-plus me-1"></i>Thêm vào giỏ
                            </button>
                        </div>
                        <div class="col-3">
                            <button onclick="showProductModal(${product.id})" 
                                    class="btn btn-outline-info btn-sm w-100"
                                    title="Xem nhanh">
                                <i class="fas fa-search-plus"></i>
                            </button>
                        </div>
                    </div>
                    ` : currentViewMode === 'compact' ? `
                    <div class="d-grid">
                        <button onclick="addToCartQuick(${product.id})" 
                                class="btn btn-primary btn-sm">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                    ` : `
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
                    `}
                    
                    <!-- Nút admin (chỉ hiện với user MHoang287) -->
                                        <div class="row g-2 mt-1 admin-actions" ${<?= json_encode($_SESSION['username'] ?? 'MHoang287') ?> !== 'MHoang287' ? 'style="display: none;"' : ''}>
                        <div class="col-6">
                            <a href="/product/edit/${product.id}" 
                               class="btn btn-outline-warning btn-sm w-100">
                                <i class="fas fa-edit"></i> ${currentViewMode === 'compact' ? '' : 'Sửa'}
                            </a>
                        </div>
                        <div class="col-6">
                            <button onclick="deleteProduct(${product.id})" 
                                    class="btn btn-outline-danger btn-sm w-100">
                                <i class="fas fa-trash"></i> ${currentViewMode === 'compact' ? '' : 'Xóa'}
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
 * Tạo HTML cho hình ảnh với xử lý lỗi từ ProductApiController
 */
function createImageHtml(product) {
    if (product.image && product.image.trim() !== '') {
        const imageUrl = getImageUrl(product.image);
        return `
            <img src="${imageUrl}" 
                 class="product-image" 
                 alt="${escapeHtml(product.name)}"
                 onclick="previewImage('${imageUrl}', '${escapeHtml(product.name)}')"
                 onload="handleImageLoad(this)"
                 onerror="handleImageError(this, '${escapeHtml(product.name)}')">
            <div class="image-status-badge badge bg-success">
                <i class="fas fa-check-circle me-1"></i>Có ảnh
            </div>
        `;
    } else {
        return `
            <div class="no-image-placeholder">
                <div class="text-center">
                    <i class="fas fa-image fa-3x mb-2"></i>
                    <div>Chưa có hình ảnh</div>
                    <small class="text-muted">Sản phẩm từ ProductApiController</small>
                </div>
            </div>
            <div class="image-status-badge badge bg-secondary">
                <i class="fas fa-image me-1"></i>Chưa có ảnh
            </div>
        `;
    }
}

/**
 * Tạo badges cho sản phẩm
 */
function createProductBadges(product) {
    let badges = '';
    
    // Badge mới (sản phẩm tạo trong 7 ngày qua)
    const isNew = isNewProduct(product);
    if (isNew) {
        badges += '<span class="badge badge-new text-white me-1 mb-1">Mới</span>';
    }
    
    // Badge giảm giá (giả lập)
    if (Math.random() > 0.7) {
        badges += '<span class="badge badge-sale text-white me-1 mb-1">-20%</span>';
    }
    
    // Badge hot (sản phẩm có giá cao)
    if (product.price > 5000000) {
        badges += '<span class="badge badge-hot text-white me-1 mb-1">Hot</span>';
    }
    
    return badges;
}

/**
 * Kiểm tra sản phẩm mới
 */
function isNewProduct(product) {
    // Giả lập logic kiểm tra sản phẩm mới
    // Trong thực tế sẽ so sánh với created_at từ ProductApiController
    return Math.random() > 0.8;
}

/**
 * Xử lý khi hình ảnh tải thành công
 */
function handleImageLoad(imgElement) {
    console.log('🖼️ Hình ảnh từ ProductApiController tải thành công');
    imgElement.style.opacity = '1';
    imgElement.classList.add('image-fade-in');
    
    // Cập nhật badge trạng thái
    const badge = imgElement.parentElement.querySelector('.image-status-badge');
    if (badge) {
        badge.innerHTML = '<i class="fas fa-check-circle me-1"></i>Đã tải';
        badge.className = 'image-status-badge badge bg-success';
    }
}

/**
 * Xử lý khi hình ảnh tải thất bại
 */
function handleImageError(imgElement, productName) {
    console.log('❌ Hình ảnh từ ProductApiController tải thất bại:', productName);
    
    const placeholder = document.createElement('div');
    placeholder.className = 'no-image-placeholder';
    placeholder.innerHTML = `
        <div class="text-center">
            <i class="fas fa-exclamation-triangle fa-3x mb-2 text-warning"></i>
            <div>Lỗi tải hình ảnh</div>
            <small class="text-muted">ProductApiController</small>
        </div>
    `;
    
    imgElement.parentNode.replaceChild(placeholder, imgElement);
    
    // Cập nhật badge trạng thái
    const badge = placeholder.parentElement.querySelector('.image-status-badge');
    if (badge) {
        badge.innerHTML = '<i class="fas fa-exclamation-triangle me-1"></i>Lỗi';
        badge.className = 'image-status-badge badge bg-danger';
    }
}

/**
 * Lấy URL hình ảnh với xử lý đường dẫn từ ProductApiController
 */
function getImageUrl(imagePath) {
    if (!imagePath) return null;
    
    // Nếu đã là URL đầy đủ
    if (imagePath.startsWith('http')) {
        return imagePath;
    }
    
    // Nếu bắt đầu với uploads/
    if (imagePath.startsWith('uploads/')) {
        return '/' + imagePath;
    }
    
    // Mặc định thêm đường dẫn uploads/products/
    return '/uploads/products/' + imagePath;
}

/**
 * Tìm tên danh mục từ ID sử dụng dữ liệu từ CategoryApiController
 */
function findCategoryName(categoryId) {
    if (!categoryId || !categoriesData.length) {
        return 'Chưa phân loại';
    }
    
    const category = categoriesData.find(cat => cat.id == categoryId);
    return category ? category.name : 'Chưa phân loại';
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
    console.log('🎧 Thiết lập event listeners cho tích hợp API');
    
    // Form lọc
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        console.log('🔍 Form lọc được submit, gọi ProductApiController');
        currentPage = 1;
        loadProducts();
    });
    
    // Nút xóa bộ lọc
    $('#clearFilters, #clearFiltersEmpty').on('click', function() {
        console.log('🗑️ Xóa tất cả bộ lọc');
        resetFilters();
    });
    
    // Nút xóa search
    $('#clearSearchBtn').on('click', function() {
        document.getElementById('search').value = '';
        currentPage = 1;
        loadProducts();
    });
    
    // Tự động lọc khi thay đổi dropdown
    $('#category, #sort, #itemsPerPage').on('change', function() {
        console.log('🔄 Thay đổi bộ lọc:', this.id, '=', this.value);
        currentPage = 1;
        loadProducts();
    });
    
    // Checkbox filters
    $('#has_image, #high_quality_image').on('change', function() {
        console.log('☑️ Thay đổi checkbox filter:', this.id, '=', this.checked);
        currentPage = 1;
        loadProducts();
    });
    
    // Tìm kiếm với debounce (trì hoãn 500ms)
    $('#search').on('input', function() {
        clearTimeout(searchTimeout);
        const searchValue = this.value;
        
        searchTimeout = setTimeout(() => {
            console.log('🔍 Tìm kiếm ProductApiController:', searchValue);
            currentPage = 1;
            loadProducts();
        }, 500);
    });
    
    // Lọc theo khoảng giá với debounce
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
    
    // Nút xuất kết quả
    $('#exportResults').on('click', function() {
        exportProductResults();
    });
    
    // Toggle filter collapse
    $('#filterCollapse').on('show.bs.collapse', function() {
        document.getElementById('filterToggleIcon').className = 'fas fa-chevron-up';
    }).on('hide.bs.collapse', function() {
        document.getElementById('filterToggleIcon').className = 'fas fa-chevron-down';
    });
}

/**
 * Set view mode (grid, list, compact)
 */
function setViewMode(mode) {
    console.log('👁️ Thay đổi view mode:', mode);
    
    currentViewMode = mode;
    
    // Cập nhật active button
    document.querySelectorAll('[id$="ViewBtn"]').forEach(btn => {
        btn.classList.remove('active');
    });
    document.getElementById(mode + 'ViewBtn').classList.add('active');
    
    // Re-render sản phẩm với view mode mới
    if (productsData.length > 0) {
        displayProducts(productsData);
    }
    
    // Lưu preference
    localStorage.setItem('productViewMode', mode);
}

/**
 * Preview hình ảnh trong modal
 */
function previewImage(imageUrl, productName) {
    console.log('🔍 Preview hình ảnh từ ProductApiController:', productName);
    
    document.getElementById('previewImage').src = imageUrl;
    document.getElementById('imagePreviewTitle').textContent = productName;
    
    // Lưu thông tin để download/share
    window.currentPreviewImage = {
        url: imageUrl,
        name: productName
    };
    
    $('#imagePreviewModal').modal('show');
}

/**
 * Download hình ảnh preview
 */
function downloadPreviewImage() {
    if (!window.currentPreviewImage) return;
    
    const { url, name } = window.currentPreviewImage;
    const filename = `${name.replace(/[^a-zA-Z0-9]/g, '_')}_image.jpg`;
    
    // Tạo link download
    const link = document.createElement('a');
    link.href = url;
    link.download = filename;
    link.target = '_blank';
    
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    console.log('💾 Download hình ảnh:', filename);
    
    Swal.fire({
        icon: 'success',
        title: 'Đang tải về!',
        text: 'Hình ảnh đang được tải về máy của bạn',
        timer: 2000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
}

/**
 * Share hình ảnh preview
 */
function sharePreviewImage() {
    if (!window.currentPreviewImage) return;
    
    const { url, name } = window.currentPreviewImage;
    const shareText = `Xem hình ảnh sản phẩm: ${name}`;
    
    if (navigator.share) {
        navigator.share({
            title: shareText,
            text: shareText,
            url: url
        }).then(() => {
            console.log('✅ Share thành công');
        }).catch(err => {
            console.log('❌ Lỗi share:', err);
            copyToClipboard(url);
        });
    } else {
        copyToClipboard(url);
    }
}

/**
 * Hiển thị modal sản phẩm từ ProductApiController
 */
function showProductModal(productId) {
    console.log('👁️ Hiển thị modal cho sản phẩm ID từ ProductApiController:', productId);
    
    const modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
    
    document.getElementById('quickViewContent').innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải từ ProductApiController...</span>
            </div>
            <div class="mt-2">Đang tải thông tin sản phẩm...</div>
        </div>
    `;
    
    modal.show();
    
    // Gọi ProductApiController để lấy chi tiết sản phẩm
    fetch(`/api/product/${productId}`)
        .then(response => response.json())
        .then(data => {
            console.log('📋 Dữ liệu sản phẩm cho modal từ ProductApiController:', data);
            
            let product = data;
            if (data.success && data.data) {
                product = data.data;
            }
            
            if (product && product.id) {
                document.getElementById('quickViewContent').innerHTML = generateQuickViewHtml(product);
                
                // Cập nhật nút view detail
                document.getElementById('viewDetailBtn').onclick = () => {
                    window.location.href = `/product/show/${product.id}`;
                };
            } else {
                throw new Error('Product not found in ProductApiController response');
            }
        })
        .catch(error => {
            console.error('❌ Lỗi khi tải thông tin sản phẩm từ ProductApiController:', error);
            document.getElementById('quickViewContent').innerHTML = `
                <div class="alert alert-danger text-center">
                    <i class="fas fa-exclamation-triangle"></i>
                    Có lỗi xảy ra khi tải thông tin sản phẩm từ ProductApiController.
                </div>
            `;
        });
}

/**
 * Tạo HTML cho modal xem nhanh với hình ảnh từ ProductApiController
 */
function generateQuickViewHtml(product) {
    const categoryName = findCategoryName(product.category_id);
    const imageUrl = product.image ? getImageUrl(product.image) : 'https://via.placeholder.com/600x400/f8f9fa/6c757d?text=No+Image+from+API';
    
    return `
        <div class="row">
            <div class="col-md-6">
                <div class="position-relative">
                    <img src="${imageUrl}" 
                         class="img-fluid rounded" 
                         alt="${escapeHtml(product.name)}"
                         style="width: 100%; height: 350px; object-fit: cover; cursor: pointer;"
                         onclick="previewImage('${imageUrl}', '${escapeHtml(product.name)}')"
                         onerror="this.src='https://via.placeholder.com/600x400/f8f9fa/6c757d?text=Image+Error+API'">
                    
                    ${product.image ? `
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>Có hình ảnh
                        </span>
                    </div>
                    ` : `
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-secondary">
                            <i class="fas fa-image me-1"></i>Chưa có hình ảnh
                        </span>
                    </div>
                    `}
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <span class="badge bg-primary fs-6">${categoryName}</span>
                </div>
                
                <h4 class="fw-bold mb-3">${escapeHtml(product.name)}</h4>
                
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
                    <span class="badge bg-success ms-2">Tiết kiệm 20%</span>
                </div>

                <div class="mb-4">
                    <h6>Mô tả:</h6>
                    <p class="text-muted">${product.description ? escapeHtml(product.description.substring(0, 200)) + '...' : 'Không có mô tả từ ProductApiController'}</p>
                </div>

                <div class="mb-3">
                    <h6>Thông tin từ API:</h6>
                    <ul class="list-unstyled small text-muted">
                        <li><i class="fas fa-database me-2"></i>Nguồn: ProductApiController</li>
                        <li><i class="fas fa-hashtag me-2"></i>ID: ${product.id}</li>
                        <li><i class="fas fa-calendar me-2"></i>Cập nhật: ${new Date().toLocaleString()}</li>
                    </ul>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary" onclick="addToCartQuick(${product.id})">
                        <i class="fas fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                    </button>
                    <a href="/product/show/${product.id}" class="btn btn-outline-primary">
                        <i class="fas fa-eye me-2"></i>Xem chi tiết đầy đủ
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
    console.log('🛒 Thêm vào giỏ hàng sản phẩm ID từ ProductApiController:', productId);
    
    const button = event.target.closest('button');
    const originalContent = button.innerHTML;
    
    // Hiển thị loading
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    button.disabled = true;

    // Giả lập API call thêm vào giỏ hàng (có thể tích hợp với CartApiController)
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
 * Xóa sản phẩm (chỉ admin MHoang287) thông qua ProductApiController
 */
function deleteProduct(id) {
    console.log('🗑️ User MHoang287 yêu cầu xóa sản phẩm ID:', id);
    
    Swal.fire({
        title: 'Xác nhận xóa sản phẩm',
        html: `
            <div class="text-start">
                <p><strong>⚠️ Cảnh báo:</strong></p>
                <p>Sản phẩm sẽ bị xóa vĩnh viễn từ ProductApiController!</p>
                <p>Hành động này không thể hoàn tác.</p>
                <hr>
                <p class="text-muted small">
                    <i class="fas fa-user me-1"></i>User: MHoang287<br>
                    <i class="fas fa-clock me-1"></i>Thời gian: ${new Date().toLocaleString()}<br>
                    <i class="fas fa-database me-1"></i>API: ProductApiController
                </p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash"></i> Xóa khỏi API',
        cancelButtonText: '<i class="fas fa-times"></i> Hủy',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            console.log('✅ User MHoang287 xác nhận xóa');
            
            // Hiển thị loading
            Swal.fire({
                title: 'Đang xóa từ ProductApiController...',
                html: 'Vui lòng đợi trong giây lát',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Gọi ProductApiController DELETE
            fetch(`/api/product/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('📋 Kết quả xóa từ ProductApiController:', data);
                
                if (data.success && data.message) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã xóa khỏi API!',
                        text: data.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    
                    // Reload danh sách sản phẩm
                    loadProducts();
                } else {
                    throw new Error(data.message || 'Delete failed');
                }
            })
            .catch(error => {
                console.error('❌ Lỗi khi xóa từ ProductApiController:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi API!',
                    text: 'Có lỗi xảy ra khi xóa sản phẩm từ ProductApiController'
                });
            });
        }
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
            currentPage = 1;
            loadProducts();
        });
        hasActiveFilters = true;
    }
    
    // Danh mục
    if (filters.category_id) {
        const categoryName = findCategoryName(filters.category_id);
        addFilterBadge(container, 'Danh mục', categoryName, () => {
            document.getElementById('category').value = '';
            selectQuickCategory('', document.querySelector('.quick-category-btn'));
            currentPage = 1;
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
            currentPage = 1;
            loadProducts();
        });
        hasActiveFilters = true;
    }
    
    // Lọc hình ảnh
    if (filters.has_image) {
        addFilterBadge(container, 'Hình ảnh', 'Có hình ảnh', () => {
            document.getElementById('has_image').checked = false;
            currentPage = 1;
            loadProducts();
        });
        hasActiveFilters = true;
    }
    
    if (filters.high_quality_image) {
        addFilterBadge(container, 'Chất lượng', 'Hình ảnh chất lượng cao', () => {
            document.getElementById('high_quality_image').checked = false;
            currentPage = 1;
            loadProducts();
        });
        hasActiveFilters = true;
    }
    
    // Sắp xếp (nếu không phải mặc định)
    if (filters.sort && filters.sort !== 'newest') {
        const sortText = getSortText(filters.sort);
        addFilterBadge(container, 'Sắp xếp', sortText, () => {
            document.getElementById('sort').value = 'newest';
            currentPage = 1;
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
        <button type="button" class="remove-filter" onclick="(${removeCallback.toString()})()">
            <i class="fas fa-times"></i>
        </button>
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
        'name_asc': 'Tên A-Z',
        'name_desc': 'Tên Z-A',
        'price_asc': 'Giá tăng dần',
        'price_desc': 'Giá giảm dần',
        'with_image': 'Có hình ảnh',
        'no_image': 'Chưa có hình ảnh'
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
            timestamp: new Date().toISOString(),
            user: 'MHoang287'
        };
        
        savedFilters.push(filter);
        localStorage.setItem('savedProductFilters', JSON.stringify(savedFilters));
        
        Swal.fire({
            icon: 'success',
            title: 'Đã lưu bộ lọc!',
            html: `
                <div class="text-start">
                    <p>Bộ lọc "<strong>${filterName}</strong>" đã được lưu</p>
                    <small class="text-muted">
                        <i class="fas fa-user me-1"></i>User: MHoang287<br>
                        <i class="fas fa-clock me-1"></i>Thời gian: ${new Date().toLocaleString()}
                    </small>
                </div>
            `,
            timer: 3000,
            showConfirmButton: false
        });
        
        console.log('💾 Đã lưu bộ lọc cho user MHoang287:', filter);
    }
}

/**
 * Xuất kết quả tìm kiếm
 */
function exportProductResults() {
    console.log('📥 Xuất kết quả sản phẩm từ ProductApiController');
    
    if (productsData.length === 0) {
        showError('Không có sản phẩm để xuất');
        return;
    }
    
    // Tạo CSV data
    const csvData = productsData.map(product => ({
        'ID': product.id,
        'Tên sản phẩm': product.name,
        'Giá': product.price,
        'Danh mục': findCategoryName(product.category_id),
        'Có hình ảnh': product.image ? 'Có' : 'Không',
        'Mô tả': product.description || '',
        'URL hình ảnh': product.image ? getImageUrl(product.image) : ''
    }));
    
    // Chuyển đổi thành CSV
    const csv = convertToCSV(csvData);
    
    // Download file
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', `san_pham_${new Date().toISOString().split('T')[0]}.csv`);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    Swal.fire({
        icon: 'success',
        title: 'Xuất file thành công!',
        text: `Đã xuất ${productsData.length} sản phẩm từ ProductApiController`,
        timer: 2000,
        showConfirmButton: false
    });
}

/**
 * Chuyển đổi dữ liệu thành CSV
 */
function convertToCSV(data) {
    if (data.length === 0) return '';
    
    const headers = Object.keys(data[0]);
    const csvContent = [
        headers.join(','),
        ...data.map(row => headers.map(header => {
            const value = row[header] || '';
            return `"${value.toString().replace(/"/g, '""')}"`;
        }).join(','))
    ].join('\n');
    
    return '\ufeff' + csvContent; // Add BOM for UTF-8
}

/**
 * Reset tất cả bộ lọc về mặc định
 */
function resetFilters() {
    console.log('🔄 Reset tất cả bộ lọc');
    
    document.getElementById('filterForm').reset();
    document.getElementById('sort').value = 'newest';
    document.getElementById('itemsPerPage').value = '12';
    
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
 * Cập nhật pagination
 */
function updatePagination(pagination) {
    console.log('📄 Cập nhật pagination:', pagination);
    
    const container = document.getElementById('paginationContainer');
    const paginationList = document.getElementById('paginationList');
    const paginationInfo = document.getElementById('paginationInfo');
    
    if (pagination.pages <= 1) {
        container.style.display = 'none';
        return;
    }
    
    container.style.display = 'block';
    
    // Tạo pagination items
    paginationList.innerHTML = '';
    
    // Previous button
    if (pagination.current > 1) {
        const prevLi = document.createElement('li');
        prevLi.className = 'page-item';
        prevLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${pagination.current - 1})">« Trước</a>`;
        paginationList.appendChild(prevLi);
    }
    
    // Page numbers
    const startPage = Math.max(1, pagination.current - 2);
    const endPage = Math.min(pagination.pages, pagination.current + 2);
    
    for (let i = startPage; i <= endPage; i++) {
        const li = document.createElement('li');
        li.className = `page-item ${i === pagination.current ? 'active' : ''}`;
        li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
        paginationList.appendChild(li);
    }
    
    // Next button
    if (pagination.current < pagination.pages) {
        const nextLi = document.createElement('li');
        nextLi.className = 'page-item';
        nextLi.innerHTML = `<a class="page-link" href="#" onclick="changePage(${pagination.current + 1})">Tiếp »</a>`;
        paginationList.appendChild(nextLi);
    }
    
    // Pagination info
    const start = (pagination.current - 1) * (currentFilters.limit || 12) + 1;
    const end = Math.min(start + (currentFilters.limit || 12) - 1, pagination.total);
    paginationInfo.textContent = `Hiển thị ${start}-${end} trong tổng số ${pagination.total} sản phẩm`;
}

/**
 * Chuyển trang
 */
function changePage(page) {
    console.log('📄 Chuyển đến trang:', page);
    currentPage = page;
    loadProducts();
    
    // Scroll to top
    document.getElementById('products').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

/**
 * Cập nhật thông tin kết quả tìm kiếm
 */
function updateResultsInfo(currentCount, totalCount) {
    const resultsInfo = document.getElementById('resultsInfo');
    const hasFilters = Object.values(currentFilters).some(value => 
        value && value !== 'newest' && value !== 1 && value !== 12 && value !== false
    );
    
    if (hasFilters) {
        resultsInfo.innerHTML = `
            <i class="fas fa-info-circle me-1"></i>
            Tìm thấy ${totalCount} sản phẩm từ ProductApiController
        `;
    } else {
        resultsInfo.innerHTML = `
            <i class="fas fa-info-circle me-1"></i>
            Hiển thị ${totalCount} sản phẩm từ ProductApiController
        `;
    }
}

/**
 * Cập nhật số lượng sản phẩm counter
 */
function updateProductsCounter(total) {
    const counter = document.getElementById('totalProducts');
    if (counter) {
        animateValue(counter, 0, total, 1000);
    }
}

/**
 * Cập nhật số lượng danh mục counter
 */
function updateCategoriesCounter(total) {
    const counter = document.getElementById('totalCategories');
    if (counter) {
        animateValue(counter, 0, total, 1200);
    }
}

/**
 * Cập nhật số lượng sản phẩm có hình ảnh counter
 */
function updateImagesProductCounter(total) {
    const counter = document.getElementById('totalImagesProduct');
    if (counter) {
        animateValue(counter, 0, total, 1400);
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
        cartCount.style.transform = 'scale(1.3)';
        cartCount.style.background = '#28a745';
        setTimeout(() => {
            cartCount.style.transform = 'scale(1)';
            cartCount.style.background = '';
        }, 300);
        
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
    
    // Animate loading progress
    const progressBar = document.getElementById('loadingProgress');
    progressBar.className = 'progress-bar progress-bar-striped progress-bar-animated loading-progress';
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
    categorySelect.innerHTML = '<option value="">Tất cả danh mục (CategoryApiController không có dữ liệu)</option>';
    
    // Ẩn quick category filters
    const quickFilters = document.getElementById('quickCategoryFilters');
    quickFilters.innerHTML = '<span class="text-muted"><i class="fas fa-info-circle me-1"></i>CategoryApiController chưa có danh mục nào</span>';
}

/**
 * Khởi tạo các thành phần UI
 */
function initializeUIComponents() {
    console.log('🎨 Khởi tạo các thành phần UI');
    
    // Khởi tạo Hero Swiper nếu có thư viện Swiper
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
        console.log('✅ Đã khởi tạo Hero Swiper');
    }
    
    // Animate các counter khi scroll đến
    animateCountersOnScroll();
    
    // Load saved filters nếu có
    loadSavedFilters();
    
    // Load saved view mode
    const savedViewMode = localStorage.getItem('productViewMode');
    if (savedViewMode && ['grid', 'list', 'compact'].includes(savedViewMode)) {
        setViewMode(savedViewMode);
    }
    
    // Thiết lập auto-refresh
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
 * Thiết lập auto-refresh từ API Controllers
 */
function setupAutoRefresh() {
    // Refresh data mỗi 5 phút (chỉ khi tab active)
    setInterval(() => {
        if (!document.hidden) {
            console.log('🔄 Auto-refresh dữ liệu từ API Controllers');
            // Refresh danh mục và sản phẩm
            loadCategories().then(() => {
                loadProducts();
            });
        }
    }, 300000); // 5 phút
    
    // Refresh khi tab được focus lại
    document.addEventListener('visibilitychange', () => {
        if (!document.hidden) {
            console.log('👁️ Tab được focus lại, refresh dữ liệu từ API');
            loadCategories().then(() => {
                loadProducts();
            });
        }
    });
}

// Utility functions

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
 * Copy to clipboard
 */
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        console.log('✅ Đã copy vào clipboard');
        Swal.fire({
            icon: 'success',
            title: 'Đã sao chép!',
            text: 'Nội dung đã được sao chép vào clipboard',
            timer: 1500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }).catch(err => {
        console.error('❌ Lỗi copy clipboard:', err);
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
    
    // Ctrl/Cmd + E để export
    if ((e.ctrlKey || e.metaKey) && e.key === 'e') {
        e.preventDefault();
        exportProductResults();
    }
});

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

// Debug helpers (chỉ trong development)
if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
    // Expose các function để debug
    window.debugProduct = {
        loadCategories,
        loadProducts,
        currentFilters,
        categoriesData,
        productsData,
        resetFilters,
        exportProductResults
    };
    
    console.log('🔧 Debug helpers available in window.debugProduct');
}

// Analytics tracking (nếu có Google Analytics)
function trackEvent(action, category = 'Product List', label = '') {
    if (typeof gtag !== 'undefined') {
        gtag('event', action, {
            event_category: category,
            event_label: label,
            custom_parameters: {
                user: 'MHoang287',
                api_source: 'ProductApiController'
            }
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

function trackFilterUse(filterType, filterValue) {
    trackEvent('filter_use', 'Product Filter', `${filterType}: ${filterValue}`);
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

console.log('🎉 Product List API Integration Script loaded successfully');
console.log(`👤 Current user: MHoang287`);
console.log(`📅 Current time: 2025-06-13 03:56:47`);
console.log(`🔗 API Endpoints: ProductApiController (/api/product), CategoryApiController (/api/category)`);
</script>

<?php include_once 'app/views/shares/footer.php'; ?>