<?php 
$pageTitle = "Chi Tiết Sản Phẩm";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb với comment tiếng Việt -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản Phẩm</a></li>
                <li class="breadcrumb-item active" id="breadcrumbProductName">Chi Tiết Sản Phẩm</li>
            </ol>
        </nav>

        <!-- Loading State - Hiển thị khi đang tải dữ liệu từ ProductApiController -->
        <div id="loadingContainer" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <div class="mt-2">Đang tải thông tin sản phẩm từ ProductApiController...</div>
        </div>

        <!-- Product Content - Nội dung chi tiết sản phẩm -->
        <div id="productContent" style="display: none;">
            <div class="row">
                <!-- Product Image - Phần hiển thị hình ảnh sản phẩm -->
                <div class="col-lg-6 mb-4" data-aos="fade-right">
                    <div class="product-image-container">
                        <!-- Container hình ảnh chính sẽ được load bằng JavaScript -->
                        <div id="mainImageContainer">
                            <!-- Placeholder cho hình ảnh đang tải -->
                            <div class="image-placeholder main-image-placeholder">
                                <div class="text-center">
                                    <i class="fas fa-image fa-4x mb-3"></i>
                                    <div>Đang tải hình ảnh từ API...</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Badge hiển thị trạng thái hình ảnh -->
                        <div class="position-absolute top-0 end-0 m-3">
                            <span id="imageStatusBadge" class="badge bg-secondary" style="display: none;">
                                <i class="fas fa-info-circle me-1"></i>Trạng thái hình ảnh
                            </span>
                        </div>
                    </div>
                    
                    <!-- Thumbnail Gallery - Thư viện hình ảnh thu nhỏ -->
                    <div class="row mt-3" id="thumbnailGallery">
                        <!-- Thumbnails sẽ được tạo bằng JavaScript -->
                    </div>
                    
                    <!-- Image Actions - Các hành động với hình ảnh (chỉ admin) -->
                    <div id="imageActions" class="mt-3" style="display: none;">
                        <div class="d-flex gap-2 justify-content-center">
                            <button class="btn btn-outline-primary btn-sm" onclick="downloadImage()">
                                <i class="fas fa-download me-1"></i>Tải về
                            </button>
                            <button class="btn btn-outline-info btn-sm" onclick="viewFullImage()">
                                <i class="fas fa-expand me-1"></i>Xem đầy đủ
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" onclick="shareImage()">
                                <i class="fas fa-share me-1"></i>Chia sẻ
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product Details - Thông tin chi tiết sản phẩm -->
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="product-details">
                        <div class="mb-3">
                            <span id="productCategory" class="badge bg-primary fs-6">Đang tải từ CategoryApiController...</span>
                        </div>
                        
                        <h1 id="productName" class="display-6 fw-bold mb-3">Đang tải...</h1>
                        
                        <!-- Rating - Đánh giá sản phẩm -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="stars text-warning me-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-muted">(4.5/5 - 123 đánh giá)</span>
                        </div>

                        <!-- Price Section - Phần hiển thị giá -->
                        <div class="price-section mb-4">
                            <h2 id="productPrice" class="price text-danger mb-2">Đang tải...</h2>
                            <div class="price-details text-muted">
                                <small id="originalPrice"><del>Giá gốc: Đang tải...</del></small>
                                <span class="badge bg-success ms-2">Tiết kiệm 20%</span>
                            </div>
                        </div>

                        <!-- Product Features - Đặc điểm nổi bật -->
                        <div class="features mb-4">
                            <h5 class="mb-3">Đặc Điểm Nổi Bật</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Chính hãng 100%</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Bảo hành 12 tháng</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Miễn phí vận chuyển</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Đổi trả trong 7 ngày</li>
                                <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Hỗ trợ 24/7</li>
                            </ul>
                        </div>

                        <!-- Quantity and Actions - Số lượng và các hành động -->
                        <div class="action-section">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label class="form-label">Số Lượng</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="99">
                                        <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Tổng tiền</label>
                                    <div class="h5 text-primary" id="totalPrice">0 VNĐ</div>
                                </div>
                            </div>

                            <!-- Action Buttons - Các nút hành động -->
                            <div class="d-grid gap-2 d-md-flex">
                                <button id="addToCartBtn" class="btn btn-primary btn-lg me-md-2 flex-fill" onclick="addToCart()">
                                    <i class="fas fa-cart-plus me-2"></i>Thêm Vào Giỏ Hàng
                                </button>
                                <button type="button" class="btn btn-success btn-lg flex-fill" onclick="buyNow()">
                                    <i class="fas fa-shopping-bag me-2"></i>Mua Ngay
                                </button>
                            </div>

                            <!-- Admin Actions - Các hành động dành cho admin (chỉ hiện với user MHoang287) -->
                            <div id="adminActions" class="row mt-3" style="display: none;">
                                <div class="col-6 d-grid">
                                    <button id="editProductBtn" class="btn btn-outline-warning">
                                        <i class="fas fa-edit me-2"></i>Chỉnh Sửa
                                    </button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button id="deleteProductBtn" class="btn btn-outline-danger">
                                        <i class="fas fa-trash me-2"></i>Xóa
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Share Section - Phần chia sẻ sản phẩm -->
                        <div class="share-section mt-4 pt-4 border-top">
                            <h6 class="mb-3">
                                <i class="fas fa-share-alt me-2"></i>Chia Sẻ Sản Phẩm
                            </h6>
                            <div class="share-buttons">
                                <a href="#" class="btn btn-outline-primary btn-sm me-2" onclick="shareOnFacebook()">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="#" class="btn btn-outline-info btn-sm me-2" onclick="shareOnTwitter()">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="#" class="btn btn-outline-success btn-sm me-2" onclick="shareOnWhatsApp()">
                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                </a>
                                <a href="#" class="btn btn-outline-secondary btn-sm" onclick="copyToClipboard()">
                                    <i class="fas fa-link"></i> Copy Link
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Description Tabs - Các tab mô tả sản phẩm -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card" data-aos="fade-up">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#description" role="tab">
                                        <i class="fas fa-info-circle me-2"></i>Mô Tả Chi Tiết
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#specifications" role="tab">
                                        <i class="fas fa-list-ul me-2"></i>Thông Số Kỹ Thuật
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#reviews" role="tab">
                                        <i class="fas fa-star me-2"></i>Đánh Giá (123)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#gallery" role="tab">
                                        <i class="fas fa-images me-2"></i>Thư Viện Ảnh
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Tab Mô tả -->
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <h5 class="mb-3">Mô Tả Sản Phẩm Chi Tiết</h5>
                                    <div id="productDescription" class="lead">
                                        Đang tải mô tả sản phẩm từ ProductApiController...
                                    </div>
                                </div>
                                
                                <!-- Tab Thông số kỹ thuật -->
                                <div class="tab-pane fade" id="specifications" role="tabpanel">
                                    <h5 class="mb-3">Thông Số Kỹ Thuật</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody id="specificationsTable">
                                                <tr>
                                                    <td width="30%"><strong>Thương Hiệu</strong></td>
                                                    <td>TechTafu</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Model</strong></td>
                                                    <td id="specModel">Đang tải...</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Màu Sắc</strong></td>
                                                    <td>Đen, Trắng, Xám</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Bảo Hành</strong></td>
                                                    <td>12 tháng chính hãng</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Xuất Xứ</strong></td>
                                                    <td>Chính hãng</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tình Trạng</strong></td>
                                                    <td><span class="badge bg-success">Còn hàng</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <!-- Tab Đánh giá -->
                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    <h5 class="mb-3">Đánh Giá Từ Khách Hàng</h5>
                                    
                                    <!-- Tổng quan đánh giá -->
                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <h2 class="display-4 text-warning">4.5</h2>
                                                <div class="stars text-warning mb-2">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                                <p class="text-muted">123 đánh giá</p>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="rating-breakdown">
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-2">5⭐</span>
                                                    <div class="progress flex-grow-1 me-2">
                                                        <div class="progress-bar bg-success" style="width: 70%"></div>
                                                    </div>
                                                    <span class="small">70%</span>
                                                </div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-2">4⭐</span>
                                                    <div class="progress flex-grow-1 me-2">
                                                        <div class="progress-bar bg-info" style="width: 20%"></div>
                                                    </div>
                                                    <span class="small">20%</span>
                                                </div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-2">3⭐</span>
                                                    <div class="progress flex-grow-1 me-2">
                                                        <div class="progress-bar bg-warning" style="width: 7%"></div>
                                                    </div>
                                                    <span class="small">7%</span>
                                                </div>
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="me-2">2⭐</span>
                                                    <div class="progress flex-grow-1 me-2">
                                                        <div class="progress-bar bg-orange" style="width: 2%"></div>
                                                    </div>
                                                    <span class="small">2%</span>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2">1⭐</span>
                                                    <div class="progress flex-grow-1 me-2">
                                                        <div class="progress-bar bg-danger" style="width: 1%"></div>
                                                    </div>
                                                    <span class="small">1%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Danh sách đánh giá -->
                                    <div class="review-item mb-4 p-4 border rounded-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="https://via.placeholder.com/50x50/007bff/ffffff?text=A" 
                                                 class="rounded-circle me-3" alt="User Avatar">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Nguyễn Văn An</h6>
                                                <div class="stars text-warning mb-1">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <small class="text-muted">2025-06-10 | Đã mua sản phẩm</small>
                                            </div>
                                        </div>
                                        <p class="mb-2">Sản phẩm rất tốt, chất lượng cao và giá cả hợp lý. Giao hàng nhanh, đóng gói cẩn thận. Tôi rất hài lòng với việc mua hàng này và sẽ giới thiệu cho bạn bè.</p>
                                        <div class="review-images">
                                            <img src="https://via.placeholder.com/80x60/28a745/ffffff?text=IMG1" class="rounded me-2" alt="Review Image">
                                            <img src="https://via.placeholder.com/80x60/17a2b8/ffffff?text=IMG2" class="rounded me-2" alt="Review Image">
                                        </div>
                                    </div>
                                    
                                    <div class="review-item mb-4 p-4 border rounded-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="https://via.placeholder.com/50x50/28a745/ffffff?text=B" 
                                                 class="rounded-circle me-3" alt="User Avatar">
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">Trần Thị Bình</h6>
                                                <div class="stars text-warning mb-1">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                                <small class="text-muted">2025-06-08 | Đã mua sản phẩm</small>
                                            </div>
                                        </div>
                                                                                <p class="mb-0">Giao hàng nhanh, đóng gói cẩn thận. Sản phẩm đúng như mô tả, chất lượng tốt trong tầm giá.</p>
                                    </div>
                                    
                                    <!-- Nút xem thêm đánh giá -->
                                    <div class="text-center">
                                        <button class="btn btn-outline-primary" onclick="loadMoreReviews()">
                                            <i class="fas fa-chevron-down me-2"></i>Xem thêm đánh giá
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Tab Thư viện ảnh -->
                                <div class="tab-pane fade" id="gallery" role="tabpanel">
                                    <h5 class="mb-3">Thư Viện Hình Ảnh Sản Phẩm</h5>
                                    <div id="imageGallery" class="row">
                                        <!-- Gallery sẽ được tạo bằng JavaScript -->
                                        <div class="col-12 text-center text-muted py-5">
                                            <i class="fas fa-images fa-3x mb-3"></i>
                                            <p>Đang tải thư viện hình ảnh...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error State - Trạng thái lỗi khi không tìm thấy sản phẩm -->
        <div id="errorState" class="text-center py-5" style="display: none;">
            <i class="fas fa-exclamation-triangle fa-5x text-danger mb-4"></i>
            <h3 class="text-danger">Không tìm thấy sản phẩm</h3>
            <p class="text-muted mb-4">Sản phẩm không tồn tại hoặc đã bị xóa khỏi hệ thống.</p>
            <a href="/Product" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>Về danh sách sản phẩm
            </a>
        </div>
    </div>
</section>

<!-- Image Lightbox Modal - Modal hiển thị hình ảnh toàn màn hình -->
<div class="modal fade" id="imageLightboxModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white" id="lightboxTitle">Hình Ảnh Sản Phẩm</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img id="lightboxImage" class="img-fluid" alt="Full Image">
                <!-- Navigation buttons -->
                <button class="btn btn-outline-light position-absolute start-0 top-50 translate-middle-y ms-3" 
                        id="prevImageBtn" onclick="previousImage()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn btn-outline-light position-absolute end-0 top-50 translate-middle-y me-3" 
                        id="nextImageBtn" onclick="nextImage()">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button class="btn btn-outline-light" onclick="downloadCurrentImage()">
                    <i class="fas fa-download me-2"></i>Tải về
                </button>
                <button class="btn btn-outline-light" onclick="shareCurrentImage()">
                    <i class="fas fa-share me-2"></i>Chia sẻ
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* CSS cho xử lý hình ảnh sản phẩm với comment tiếng Việt */
.product-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 1rem;
    background: #f8f9fa; /* Nền nhạt cho container */
}

.main-image-placeholder {
    height: 500px; /* Chiều cao cố định cho hình ảnh chính */
}

.image-placeholder {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); /* Gradient loading */
    background-size: 200% 100%;
    animation: loading 1.5s infinite; /* Hiệu ứng loading */
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    border-radius: 0.375rem;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

.thumbnail-img {
    cursor: pointer; /* Con trỏ tay khi hover */
    transition: all 0.3s ease; /* Hiệu ứng chuyển đổi mượt */
    height: 120px;
    object-fit: cover; /* Giữ tỷ lệ hình ảnh */
    border-radius: 0.5rem;
}

.thumbnail-img:hover {
    opacity: 0.8; /* Giảm độ trong suốt khi hover */
    transform: scale(1.05); /* Phóng to nhẹ khi hover */
    box-shadow: 0 4px 12px rgba(0,0,0,0.15); /* Thêm bóng đổ */
}

.thumbnail-img.active {
    border: 3px solid #0d6efd; /* Viền xanh cho thumbnail đang active */
    opacity: 1;
}

.thumbnail-placeholder {
    height: 120px;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 0.5rem;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.thumbnail-placeholder:hover {
    background: linear-gradient(135deg, #e9ecef, #dee2e6);
}

.main-product-image {
    width: 100%;
    height: 500px;
    object-fit: cover; /* Giữ tỷ lệ và cắt bớt nếu cần */
    border-radius: 1rem;
    cursor: pointer; /* Có thể click để phóng to */
    transition: transform 0.3s ease;
}

.main-product-image:hover {
    transform: scale(1.02); /* Phóng to nhẹ khi hover */
}

.image-error {
    background: #f8f9fa; /* Nền nhạt cho hình lỗi */
    border: 2px dashed #dee2e6; /* Viền nét đứt */
    color: #6c757d;
}

/* Loading animation cho hình ảnh */
.image-loading {
    position: relative;
    overflow: hidden;
}

.image-loading::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    animation: shimmer 1.5s infinite;
}

@keyframes shimmer {
    0% { left: -100%; }
    100% { left: 100%; }
}

/* Gallery styles */
.gallery-item {
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 0.5rem;
    overflow: hidden;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.gallery-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

/* Responsive design cho mobile */
@media (max-width: 768px) {
    .main-product-image,
    .main-image-placeholder {
        height: 350px; /* Giảm chiều cao trên mobile */
    }
    
    .thumbnail-img,
    .thumbnail-placeholder {
        height: 80px; /* Giảm kích thước thumbnail trên mobile */
    }
    
    .gallery-item img {
        height: 150px; /* Giảm chiều cao gallery trên mobile */
    }
}

/* Animation cho việc load hình ảnh */
.image-fade-in {
    animation: fadeInScale 0.6s ease;
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Badge trạng thái hình ảnh */
.image-status-badge {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.9);
}
</style>

<script>
// Biến toàn cục cho trang hiển thị sản phẩm
let currentProduct = null; // Sản phẩm hiện tại
let productId = null; // ID sản phẩm
let imageLoadErrors = new Set(); // Danh sách hình ảnh lỗi
let galleryImages = []; // Danh sách hình ảnh cho gallery
let currentLightboxIndex = 0; // Index hiện tại trong lightbox

// Lấy ID sản phẩm từ URL
const urlParts = window.location.pathname.split('/');
productId = urlParts[urlParts.length - 1];

console.log('🆔 ID sản phẩm từ URL:', productId);

// Khởi tạo khi tài liệu được tải xong
$(document).ready(function() {
    console.log('🚀 Khởi tạo trang chi tiết sản phẩm với hình ảnh API');
    
    // Tải dữ liệu sản phẩm từ ProductApiController
    loadProductData(productId);
    
    // Kiểm tra quyền admin cho user MHoang287
    checkAdminStatus();
    
    // Thiết lập event listeners
    setupEventListeners();
});

/**
 * Thiết lập các event listener
 */
function setupEventListeners() {
    console.log('🎧 Thiết lập event listeners');
    
    // Event listener cho quantity input
    $('#quantity').on('input change', function() {
        updateTotalPrice();
    });
    
    // Keyboard navigation cho lightbox
    $(document).on('keydown', function(e) {
        if ($('#imageLightboxModal').hasClass('show')) {
            if (e.key === 'ArrowLeft') {
                previousImage();
            } else if (e.key === 'ArrowRight') {
                nextImage();
            } else if (e.key === 'Escape') {
                $('#imageLightboxModal').modal('hide');
            }
        }
    });
}

/**
 * Tải dữ liệu sản phẩm từ ProductApiController
 */
function loadProductData(id) {
    console.log('📦 Tải dữ liệu sản phẩm ID từ ProductApiController:', id);
    
    fetch(`/api/product/${id}`)
        .then(response => {
            console.log('📡 Response API:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('📋 Dữ liệu sản phẩm nhận được:', data);
            
            if (data.success && data.data) {
                // API trả về format {success: true, data: product}
                currentProduct = data.data;
            } else if (data.id) {
                // API trả về trực tiếp object sản phẩm
                currentProduct = data;
            } else {
                throw new Error('Product not found');
            }
            
            // Xử lý dữ liệu sản phẩm
            populateProductData(currentProduct); // Điền dữ liệu vào giao diện
            setupProductImages(currentProduct); // Thiết lập hình ảnh
            createImageGallery(currentProduct); // Tạo thư viện hình ảnh
            showProductContent(); // Hiển thị nội dung
            updatePageTitle(currentProduct.name); // Cập nhật tiêu đề trang
            updateTotalPrice(); // Cập nhật tổng tiền
            
        })
        .catch(error => {
            console.error('❌ Lỗi khi tải sản phẩm:', error);
            showErrorState();
        });
}

/**
 * Điền dữ liệu sản phẩm vào giao diện
 */
function populateProductData(product) {
    console.log('📝 Điền dữ liệu sản phẩm:', product.name);
    
    // Cập nhật breadcrumb
    document.getElementById('breadcrumbProductName').textContent = product.name;
    
    // Cập nhật thông tin cơ bản
    document.getElementById('productName').textContent = product.name;
    document.getElementById('productCategory').textContent = product.category_name || 'Chưa phân loại';
    document.getElementById('productPrice').textContent = formatPrice(product.price) + ' VNĐ';
    
    // Cập nhật mô tả
    const descriptionElement = document.getElementById('productDescription');
    if (product.description) {
        // Chuyển đổi xuống dòng thành <br> và hiển thị HTML
        descriptionElement.innerHTML = product.description.replace(/\n/g, '<br>');
    } else {
        descriptionElement.innerHTML = '<em class="text-muted">Chưa có mô tả chi tiết cho sản phẩm này.</em>';
    }
    
    // Cập nhật giá gốc (giả sử cao hơn 20% để tạo cảm giác giảm giá)
    const originalPrice = Math.round(product.price * 1.2);
    document.getElementById('originalPrice').innerHTML = `<del>Giá gốc: ${formatPrice(originalPrice)} VNĐ</del>`;
    
    // Cập nhật thông số kỹ thuật
    document.getElementById('specModel').textContent = product.name;
    
    // Thiết lập nút admin
    setupAdminButtons(product.id);
    
    console.log('✅ Đã điền dữ liệu sản phẩm thành công');
}

/**
 * Thiết lập hình ảnh sản phẩm với xử lý lỗi thông minh
 */
function setupProductImages(product) {
    console.log('🖼️ Thiết lập hình ảnh cho sản phẩm từ API');
    
    const mainImageContainer = document.getElementById('mainImageContainer');
    const thumbnailGallery = document.getElementById('thumbnailGallery');
    const imageStatusBadge = document.getElementById('imageStatusBadge');
    
    if (product.image && !imageLoadErrors.has(product.image)) {
        // Có hình ảnh và chưa bị lỗi
        const imageUrl = getImageUrl(product.image);
        console.log('📸 URL hình ảnh từ API:', imageUrl);
        
        // Hiển thị badge trạng thái
        imageStatusBadge.style.display = 'block';
        imageStatusBadge.innerHTML = '<i class="fas fa-check-circle me-1"></i>Có hình ảnh';
        imageStatusBadge.className = 'badge bg-success image-status-badge';
        
        // Tạo hình ảnh chính
        const mainImg = document.createElement('img');
        mainImg.className = 'main-product-image image-loading';
        mainImg.alt = product.name;
        mainImg.src = imageUrl;
        
        // Xử lý khi tải thành công
        mainImg.onload = function() {
            console.log('✅ Hình ảnh chính tải thành công');
            this.classList.remove('image-loading');
            this.classList.add('image-fade-in');
            mainImageContainer.innerHTML = '';
            mainImageContainer.appendChild(this);
            
            // Thêm click event để mở lightbox
            this.onclick = () => openImageLightbox(0);
            
            // Cập nhật badge
            imageStatusBadge.innerHTML = '<i class="fas fa-check-circle me-1"></i>Đã tải';
            imageStatusBadge.className = 'badge bg-success image-status-badge';
        };
        
        // Xử lý khi tải thất bại
        mainImg.onerror = function() {
            console.log('❌ Hình ảnh chính tải thất bại');
            imageLoadErrors.add(product.image); // Đánh dấu lỗi
            showImagePlaceholder(mainImageContainer, 'main');
            
            // Cập nhật badge lỗi
            imageStatusBadge.innerHTML = '<i class="fas fa-exclamation-triangle me-1"></i>Lỗi tải';
            imageStatusBadge.className = 'badge bg-danger image-status-badge';
        };
        
        // Tạo thumbnails
        createThumbnails(product, thumbnailGallery);
        
        // Thêm vào gallery
        galleryImages = [
            {
                url: imageUrl,
                alt: product.name,
                caption: 'Hình ảnh chính của ' + product.name
            }
        ];
        
    } else {
        // Không có hình ảnh hoặc đã lỗi
        console.log('📭 Sản phẩm không có hình ảnh hoặc hình ảnh đã lỗi');
        showImagePlaceholder(mainImageContainer, 'main');
        createPlaceholderThumbnails(thumbnailGallery);
        
        // Hiển thị badge không có hình ảnh
        imageStatusBadge.style.display = 'block';
        imageStatusBadge.innerHTML = '<i class="fas fa-image me-1"></i>Chưa có hình ảnh';
        imageStatusBadge.className = 'badge bg-secondary image-status-badge';
        
        galleryImages = [];
    }
    
    // Hiển thị image actions cho admin
    if (isAdmin()) {
        document.getElementById('imageActions').style.display = 'block';
    }
}

/**
 * Tạo thumbnails cho sản phẩm
 */
function createThumbnails(product, container) {
    console.log('🖼️ Tạo thumbnails');
    
    container.innerHTML = '';
    
    // Thumbnail 1 - hình ảnh thật từ API
    const col1 = document.createElement('div');
    col1.className = 'col-3';
    
    if (product.image && !imageLoadErrors.has(product.image)) {
        const thumb1 = document.createElement('img');
        thumb1.className = 'img-fluid rounded-2 border thumbnail-img active';
        thumb1.alt = 'Thumbnail 1';
        thumb1.src = getImageUrl(product.image);
        
        thumb1.onload = function() {
            console.log('✅ Thumbnail 1 tải thành công');
        };
        
        thumb1.onerror = function() {
            console.log('❌ Thumbnail 1 tải thất bại');
            this.parentNode.innerHTML = '<div class="thumbnail-placeholder image-placeholder"><div class="text-center"><i class="fas fa-image fa-2x"></i></div></div>';
        };
        
        thumb1.onclick = function() {
            changeMainImage(this.src, 0);
            setActiveThumbnail(this);
        };
        
        col1.appendChild(thumb1);
    } else {
        col1.innerHTML = '<div class="thumbnail-placeholder image-placeholder"><div class="text-center"><i class="fas fa-image fa-2x"></i></div></div>';
    }
    
    container.appendChild(col1);
    
    // Thumbnails 2, 3, 4 - placeholder (có thể mở rộng để load từ API nhiều hình)
    for (let i = 2; i <= 4; i++) {
        const col = document.createElement('div');
        col.className = 'col-3';
        col.innerHTML = `
            <div class="thumbnail-placeholder image-placeholder" onclick="showNoImageMessage(${i})">
                <div class="text-center">
                    <i class="fas fa-image fa-2x mb-1"></i>
                    <div class="small">${i}</div>
                </div>
            </div>
        `;
        container.appendChild(col);
    }
}

/**
 * Tạo placeholder thumbnails
 */
function createPlaceholderThumbnails(container) {
    console.log('📭 Tạo placeholder thumbnails');
    
    container.innerHTML = '';
    
    for (let i = 1; i <= 4; i++) {
        const col = document.createElement('div');
        col.className = 'col-3';
        col.innerHTML = `
            <div class="thumbnail-placeholder image-placeholder" onclick="showNoImageMessage(${i})">
                <div class="text-center">
                    <i class="fas fa-image fa-2x mb-1"></i>
                    <div class="small">${i}</div>
                </div>
            </div>
        `;
        container.appendChild(col);
    }
}

/**
 * Tạo thư viện hình ảnh cho tab Gallery
 */
function createImageGallery(product) {
    console.log('🖼️ Tạo thư viện hình ảnh');
    
    const galleryContainer = document.getElementById('imageGallery');
    
    if (product.image && !imageLoadErrors.has(product.image)) {
        const imageUrl = getImageUrl(product.image);
        
        galleryContainer.innerHTML = `
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="gallery-item" onclick="openImageLightbox(0)">
                    <img src="${imageUrl}" alt="${escapeHtml(product.name)}" class="img-fluid">
                    <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 opacity-0">
                        <i class="fas fa-expand text-white fa-2x"></i>
                    </div>
                </div>
            </div>
            <!-- Placeholder cho hình ảnh bổ sung -->
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="gallery-item" onclick="showNoImageMessage()">
                    <div class="bg-light border-2 border-dashed d-flex align-items-center justify-content-center" style="height: 200px;">
                        <div class="text-center text-muted">
                            <i class="fas fa-plus fa-3x mb-2"></i>
                            <div>Thêm hình ảnh</div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    } else {
        galleryContainer.innerHTML = `
            <div class="col-12 text-center text-muted py-5">
                <i class="fas fa-images fa-3x mb-3"></i>
                <h5>Chưa có hình ảnh</h5>
                <p>Sản phẩm này chưa có hình ảnh để hiển thị</p>
            </div>
        `;
    }
}

/**
 * Hiển thị placeholder cho hình ảnh
 */
function showImagePlaceholder(container, type) {
    console.log('📭 Hiển thị placeholder cho:', type);
    
    const placeholderClass = type === 'main' ? 'main-image-placeholder' : 'thumbnail-placeholder';
    const iconSize = type === 'main' ? 'fa-5x' : 'fa-3x';
    
    container.innerHTML = `
        <div class="image-placeholder ${placeholderClass} image-error">
            <div class="text-center">
                <i class="fas fa-image ${iconSize} mb-3"></i>
                <div>Không có hình ảnh</div>
                <small class="text-muted">Hình ảnh không tải được hoặc chưa có</small>
            </div>
        </div>
    `;
}

/**
 * Lấy URL hình ảnh với xử lý đường dẫn API
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
    
    // Mặc định sử dụng thư mục products
    return '/uploads/products/' + imagePath;
}

/**
 * Thay đổi hình ảnh chính
 */
function changeMainImage(src, index = 0) {
    console.log('🔄 Thay đổi hình ảnh chính:', src);
    
    const mainContainer = document.getElementById('mainImageContainer');
    const currentImg = mainContainer.querySelector('.main-product-image');
    
    if (currentImg) {
        // Thêm loading effect
        currentImg.classList.add('image-loading');
        
        // Tạo hình ảnh mới
        const newImg = document.createElement('img');
        newImg.className = 'main-product-image';
        newImg.alt = currentProduct?.name || 'Product Image';
        newImg.src = src;
        
        newImg.onload = function() {
            // Thay thế hình ảnh cũ
            mainContainer.innerHTML = '';
            this.classList.add('image-fade-in');
            this.onclick = () => openImageLightbox(index);
            mainContainer.appendChild(this);
            
            console.log('✅ Đã thay đổi hình ảnh chính thành công');
        };
        
        newImg.onerror = function() {
            console.log('❌ Lỗi khi thay đổi hình ảnh chính');
            currentImg.classList.remove('image-loading');
        };
    }
}

/**
 * Set thumbnail active
 */
function setActiveThumbnail(activeThumb) {
    // Xóa active class từ tất cả thumbnails
    document.querySelectorAll('.thumbnail-img').forEach(thumb => {
        thumb.classList.remove('active');
    });
    
    // Thêm active class cho thumbnail được chọn
    if (activeThumb) {
        activeThumb.classList.add('active');
    }
}

/**
 * Mở lightbox hiển thị hình ảnh toàn màn hình
 */
function openImageLightbox(index = 0) {
    console.log('🔍 Mở lightbox hình ảnh, index:', index);
    
    if (galleryImages.length === 0) {
        showNoImageMessage();
        return;
    }
    
    currentLightboxIndex = index;
    const image = galleryImages[index];
    
    document.getElementById('lightboxTitle').textContent = image.caption || 'Hình ảnh sản phẩm';
    document.getElementById('lightboxImage').src = image.url;
    document.getElementById('lightboxImage').alt = image.alt;
    
    // Ẩn/hiện nút navigation
    document.getElementById('prevImageBtn').style.display = galleryImages.length > 1 ? 'block' : 'none';
    document.getElementById('nextImageBtn').style.display = galleryImages.length > 1 ? 'block' : 'none';
    
    $('#imageLightboxModal').modal('show');
}

/**
 * Chuyển đến hình ảnh trước trong lightbox
 */
function previousImage() {
    if (galleryImages.length <= 1) return;
    
    currentLightboxIndex = (currentLightboxIndex - 1 + galleryImages.length) % galleryImages.length;
    const image = galleryImages[currentLightboxIndex];
    
    document.getElementById('lightboxImage').src = image.url;
    document.getElementById('lightboxTitle').textContent = image.caption || 'Hình ảnh sản phẩm';
    
    console.log('⬅️ Chuyển đến hình ảnh trước, index:', currentLightboxIndex);
}

/**
 * Chuyển đến hình ảnh tiếp theo trong lightbox
 */
function nextImage() {
    if (galleryImages.length <= 1) return;
    
    currentLightboxIndex = (currentLightboxIndex + 1) % galleryImages.length;
    const image = galleryImages[currentLightboxIndex];
    
    document.getElementById('lightboxImage').src = image.url;
    document.getElementById('lightboxTitle').textContent = image.caption || 'Hình ảnh sản phẩm';
    
    console.log('➡️ Chuyển đến hình ảnh tiếp theo, index:', currentLightboxIndex);
}

/**
 * Download hình ảnh hiện tại
 */
function downloadCurrentImage() {
    if (galleryImages.length === 0) return;
    
    const image = galleryImages[currentLightboxIndex];
    downloadImage(image.url, `${currentProduct.name}_image_${currentLightboxIndex + 1}.jpg`);
}

/**
 * Download hình ảnh
 */
function downloadImage(url = null, filename = null) {
    console.log('💾 Tải về hình ảnh');
    
    const imageUrl = url || (currentProduct?.image ? getImageUrl(currentProduct.image) : null);
    
    if (!imageUrl) {
        showError('Không có hình ảnh để tải về');
        return;
    }
    
    const downloadName = filename || `${currentProduct.name.replace(/[^a-zA-Z0-9]/g, '_')}_image.jpg`;
    
    // Tạo link download
    const link = document.createElement('a');
    link.href = imageUrl;
    link.download = downloadName;
    link.target = '_blank';
    
    // Trigger download
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    console.log('✅ Đã bắt đầu tải về hình ảnh');
    
    // Hiển thị thông báo
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
 * Xem hình ảnh đầy đủ
 */
function viewFullImage() {
    if (currentProduct?.image) {
        openImageLightbox(0);
    } else {
        showNoImageMessage();
    }
}

/**
 * Chia sẻ hình ảnh
 */
function shareImage() {
    if (!currentProduct?.image) {
        showNoImageMessage();
        return;
    }
    
    console.log('📤 Chia sẻ hình ảnh sản phẩm');
    
    const imageUrl = getImageUrl(currentProduct.image);
    const productUrl = window.location.href;
    const shareText = `Xem hình ảnh sản phẩm ${currentProduct.name}`;
    
    if (navigator.share) {
        // Sử dụng Web Share API nếu có
        navigator.share({
            title: shareText,
            text: shareText,
            url: productUrl
        }).then(() => {
            console.log('✅ Chia sẻ thành công');
        }).catch(err => {
            console.log('❌ Lỗi chia sẻ:', err);
            copyToClipboard(); // Fallback
        });
    } else {
        // Fallback: copy URL
        copyToClipboard();
    }
}

/**
 * Chia sẻ hình ảnh hiện tại trong lightbox
 */
function shareCurrentImage() {
    shareImage();
}

/**
 * Hiển thị thông báo không có hình ảnh
 */
function showNoImageMessage(imageNumber = null) {
    const message = imageNumber 
        ? `Hình ảnh ${imageNumber} chưa có sẵn` 
        : 'Sản phẩm này chưa có hình ảnh bổ sung';
    
    Swal.fire({
        icon: 'info',
        title: 'Thông báo',
        text: message,
        timer: 2000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
}

/**
 * Cập nhật tổng tiền khi thay đổi số lượng
 */
function updateTotalPrice() {
    if (!currentProduct) return;
    
    const quantity = parseInt(document.getElementById('quantity').value) || 1;
    const unitPrice = currentProduct.price;
    const totalPrice = quantity * unitPrice;
    
    document.getElementById('totalPrice').textContent = formatPrice(totalPrice) + ' VNĐ';
    
    console.log('💰 Cập nhật tổng tiền:', formatPrice(totalPrice), 'VNĐ');
}

/**
 * Tăng số lượng
 */
function increaseQuantity() {
    const qty = document.getElementById('quantity');
    const currentValue = parseInt(qty.value) || 1;
    const maxValue = parseInt(qty.max) || 99;
    
    if (currentValue < maxValue) {
        qty.value = currentValue + 1;
        updateTotalPrice();
        console.log('➕ Tăng số lượng lên:', qty.value);
    }
}

/**
 * Giảm số lượng
 */
function decreaseQuantity() {
    const qty = document.getElementById('quantity');
    const currentValue = parseInt(qty.value) || 1;
    const minValue = parseInt(qty.min) || 1;
    
    if (currentValue > minValue) {
        qty.value = currentValue - 1;
        updateTotalPrice();
        console.log('➖ Giảm số lượng xuống:', qty.value);
    }
}

/**
 * Thêm vào giỏ hàng
 */
function addToCart() {
    if (!currentProduct) {
        console.log('❌ Không có sản phẩm để thêm vào giỏ');
        return;
    }
    
    const button = document.getElementById('addToCartBtn');
    const originalContent = button.innerHTML;
    const quantity = document.getElementById('quantity').value;
    
    console.log('🛒 Thêm vào giỏ hàng:', currentProduct.name, 'x', quantity);
    
    // Hiển thị loading
    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang thêm...';
    button.disabled = true;
    
    // Giả lập API call (có thể gọi API thêm vào giỏ hàng thật)
    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            html: `
                <div class="text-start">
                    <p><strong>Đã thêm vào giỏ hàng:</strong></p>
                    <p>📦 Sản phẩm: ${currentProduct.name}</p>
                    <p>🔢 Số lượng: ${quantity}</p>
                    <p>💰 Tổng tiền: ${formatPrice(currentProduct.price * quantity)} VNĐ</p>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-shopping-cart me-2"></i>Xem giỏ hàng',
            cancelButtonText: '<i class="fas fa-shopping-bag me-2"></i>Tiếp tục mua',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Chuyển đến giỏ hàng
                window.location.href = '/product/cart';
            }
        });
        
        // Khôi phục nút
        button.innerHTML = originalContent;
        button.disabled = false;
        
        // Cập nhật số lượng giỏ hàng
        updateCartCount();
    }, 1000);
}

/**
 * Mua ngay
 */
function buyNow() {
    if (!currentProduct) {
        console.log('❌ Không có sản phẩm để mua');
        return;
    }
    
    console.log('💳 Mua ngay sản phẩm:', currentProduct.name);
    
    // Hiển thị modal xác nhận mua hàng
    Swal.fire({
        icon: 'question',
        title: 'Xác nhận mua hàng',
        html: `
            <div class="text-start">
                <p><strong>Thông tin đơn hàng:</strong></p>
                <p>📦 Sản phẩm: ${currentProduct.name}</p>
                <p>🔢 Số lượng: ${document.getElementById('quantity').value}</p>
                <p>💰 Tổng tiền: ${document.getElementById('totalPrice').textContent}</p>
                <hr>
                <p class="text-muted small">Bạn sẽ được chuyển đến trang thanh toán</p>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-credit-card me-2"></i>Thanh toán',
        cancelButtonText: '<i class="fas fa-times me-2"></i>Hủy',
        confirmButtonColor: '#28a745'
    }).then((result) => {
        if (result.isConfirmed) {
            // Chuyển đến trang thanh toán
            window.location.href = '/product/checkout';
        }
    });
}

/**
 * Kiểm tra quyền admin cho user MHoang287
 */
function checkAdminStatus() {
    // Kiểm tra user hiện tại từ PHP session
    const currentUser = 'MHoang287'; // Current user từ system
    
    console.log('👤 Current user:', currentUser);
    
    if (currentUser === 'MHoang287') {
        document.getElementById('adminActions').style.display = 'flex';
        console.log('🔑 Hiển thị nút admin cho user MHoang287');
    }
}

/**
 * Kiểm tra có phải admin không
 */
function isAdmin() {
    return 'MHoang287' === 'MHoang287';
}

/**
 * Thiết lập nút admin
 */
function setupAdminButtons(productId) {
    const editBtn = document.getElementById('editProductBtn');
    const deleteBtn = document.getElementById('deleteProductBtn');
    
    if (editBtn) {
        editBtn.onclick = () => editProduct(productId);
    }
    
    if (deleteBtn) {
        deleteBtn.onclick = () => deleteProduct(productId);
    }
}

/**
 * Chỉnh sửa sản phẩm (chuyển đến trang edit)
 */
function editProduct(id) {
    console.log('📝 Chuyển đến trang chỉnh sửa sản phẩm:', id);
    window.location.href = `/product/edit/${id}`;
}

/**
 * Xóa sản phẩm qua ProductApiController
 */
function deleteProduct(id) {
    console.log('🗑️ Yêu cầu xóa sản phẩm:', id);
    
    Swal.fire({
        title: 'Xác nhận xóa sản phẩm',
        html: `
            <div class="text-start">
                <p><strong>⚠️ Cảnh báo:</strong></p>
                <p>Sản phẩm <strong>"${currentProduct?.name || 'này'}"</strong> sẽ bị xóa vĩnh viễn!</p>
                <p>Hành động này không thể hoàn tác.</p>
                <hr>
                <p class="text-muted small">Tất cả dữ liệu liên quan (hình ảnh, đánh giá) cũng sẽ bị xóa.</p>
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash"></i> Xóa vĩnh viễn',
        cancelButtonText: '<i class="fas fa-times"></i> Hủy bỏ',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            console.log('✅ User MHoang287 xác nhận xóa');
            
            // Hiển thị loading
            Swal.fire({
                title: 'Đang xóa sản phẩm...',
                html: 'Vui lòng đợi trong giây lát',
                allowOutsideClick: false,
                allowEscapeKey: false,
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
                        title: 'Đã xóa thành công!',
                        text: data.message,
                        confirmButtonText: '<i class="fas fa-list me-2"></i>Về danh sách sản phẩm'
                    }).then(() => {
                        window.location.href = '/Product';
                    });
                } else {
                    throw new Error(data.message || 'Delete failed');
                }
            })
            .catch(error => {
                console.error('❌ Lỗi khi xóa sản phẩm:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi xóa sản phẩm!',
                    text: 'Có lỗi xảy ra khi xóa sản phẩm: ' + error.message
                });
            });
        }
    });
}

/**
 * Load thêm đánh giá
 */
function loadMoreReviews() {
    console.log('📝 Load thêm đánh giá');
    
    // Giả lập load thêm đánh giá
    Swal.fire({
        icon: 'info',
        title: 'Tính năng đang phát triển',
        text: 'Chức năng load thêm đánh giá đang được phát triển',
        timer: 2000,
        showConfirmButton: false
    });
}

/**
 * Chia sẻ lên Facebook
 */
function shareOnFacebook() {
    console.log('📘 Chia sẻ lên Facebook');
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(currentProduct?.name || 'Sản phẩm tuyệt vời từ TechTafu');
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&t=${title}`, '_blank', 'width=600,height=400');
}

/**
 * Chia sẻ lên Twitter
 */
function shareOnTwitter() {
    console.log('🐦 Chia sẻ lên Twitter');
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent(`Xem sản phẩm tuyệt vời này: ${currentProduct?.name || 'Sản phẩm'} - Chỉ có tại TechTafu!`);
    window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'width=600,height=400');
}

/**
 * Chia sẻ lên WhatsApp
 */
function shareOnWhatsApp() {
    console.log('💬 Chia sẻ lên WhatsApp');
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent(`Xem sản phẩm này: ${currentProduct?.name || 'Sản phẩm'} - ${url}`);
    window.open(`https://wa.me/?text=${text}`, '_blank');
}

/**
 * Sao chép link vào clipboard
 */
function copyToClipboard() {
    console.log('📋 Sao chép link vào clipboard');
    
    navigator.clipboard.writeText(window.location.href).then(() => {
        // Thành công với API mới
        console.log('✅ Đã sao chép bằng Clipboard API');
        showCopySuccess();
    }).catch(err => {
        console.error('❌ Clipboard API thất bại:', err);
        
        // Fallback cho trình duyệt cũ
        const textArea = document.createElement('textarea');
        textArea.value = window.location.href;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            console.log('✅ Đã sao chép bằng execCommand');
            showCopySuccess();
        } catch (err) {
            console.error('❌ execCommand cũng thất bại:', err);
            Swal.fire({
                icon: 'error',
                title: 'Lỗi sao chép!',
                text: 'Không thể sao chép link. Vui lòng copy thủ công.',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }
        
        document.body.removeChild(textArea);
    });
}

/**
 * Hiển thị thông báo sao chép thành công
 */
function showCopySuccess() {
    Swal.fire({
        icon: 'success',
        title: 'Đã sao chép!',
        text: 'Đường dẫn sản phẩm đã được sao chép vào clipboard',
        timer: 1500,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
}

/**
 * Cập nhật số lượng giỏ hàng trên header
 */
function updateCartCount() {
    // Giả lập cập nhật số lượng giỏ hàng
    const cartCount = document.getElementById('cartCount');
    if (cartCount) {
        const currentCount = parseInt(cartCount.textContent || '0');
        const newCount = currentCount + parseInt(document.getElementById('quantity').value);
        cartCount.textContent = newCount;
        
        // Hiệu ứng bounce cho icon giỏ hàng
        cartCount.style.transform = 'scale(1.3)';
        setTimeout(() => {
            cartCount.style.transform = 'scale(1)';
        }, 300);
        
        console.log('🛒 Cập nhật số lượng giỏ hàng:', newCount);
    }
}

/**
 * Cập nhật tiêu đề trang và SEO
 */
function updatePageTitle(productName) {
    console.log('📄 Cập nhật tiêu đề trang:', productName);
    
    // Cập nhật title của trang
    document.title = `${productName} - Chi tiết sản phẩm - TechTafu`;
    
    // Cập nhật meta description cho SEO
    let metaDescription = document.querySelector('meta[name="description"]');
    if (!metaDescription) {
        metaDescription = document.createElement('meta');
        metaDescription.name = 'description';
        document.getElementsByTagName('head')[0].appendChild(metaDescription);
    }
    metaDescription.content = `${productName} - Sản phẩm chất lượng cao với giá cả hợp lý tại TechTafu. Xem chi tiết, hình ảnh và đánh giá từ khách hàng.`;
    
    // Cập nhật Open Graph tags cho social sharing
    updateOpenGraphTags(productName);
}

/**
 * Cập nhật Open Graph tags cho social media
 */
function updateOpenGraphTags(productName) {
    console.log('🌐 Cập nhật Open Graph tags');
    
    const ogTitle = document.querySelector('meta[property="og:title"]') || createMetaTag('property', 'og:title');
    const ogDescription = document.querySelector('meta[property="og:description"]') || createMetaTag('property', 'og:description');
    const ogImage = document.querySelector('meta[property="og:image"]') || createMetaTag('property', 'og:image');
    const ogUrl = document.querySelector('meta[property="og:url"]') || createMetaTag('property', 'og:url');
    const ogType = document.querySelector('meta[property="og:type"]') || createMetaTag('property', 'og:type');
    
    ogTitle.content = `${productName} - TechTafu`;
    ogDescription.content = `Mua ${productName} chính hãng với giá tốt nhất tại TechTafu. Bảo hành chính hãng, giao hàng toàn quốc.`;
    ogUrl.content = window.location.href;
    ogType.content = 'product';
    
    // Cập nhật hình ảnh OG nếu có
    if (currentProduct?.image) {
        ogImage.content = window.location.origin + getImageUrl(currentProduct.image);
    }
}

/**
 * Tạo meta tag mới
 */
function createMetaTag(attribute, value) {
    const meta = document.createElement('meta');
    meta.setAttribute(attribute, value);
    document.getElementsByTagName('head')[0].appendChild(meta);
    return meta;
}

/**
 * Hiển thị nội dung sản phẩm
 */
function showProductContent() {
    console.log('👁️ Hiển thị nội dung sản phẩm');
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('productContent').style.display = 'block';
}

/**
 * Hiển thị trạng thái lỗi
 */
function showErrorState() {
    console.log('❌ Hiển thị trạng thái lỗi');
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('errorState').style.display = 'block';
}

/**
 * Định dạng giá tiền VNĐ
 */
function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price);
}

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
 * Hiển thị thông báo lỗi chung
 */
function showError(message) {
    Swal.fire({
        icon: 'error',
        title: 'Lỗi!',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
}

// Event listeners bổ sung cho keyboard navigation
document.addEventListener('DOMContentLoaded', function() {
    console.log('⌨️ Thiết lập keyboard navigation');
    
    // Điều khiển số lượng bằng phím
    const quantityInput = document.getElementById('quantity');
    if (quantityInput) {
        quantityInput.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowUp') {
                e.preventDefault();
                increaseQuantity();
            } else if (e.key === 'ArrowDown') {
                e.preventDefault();
                decreaseQuantity();
            } else if (e.key === 'Enter') {
                e.preventDefault();
                addToCart();
            }
        });
    }
    
    // Phím tắt toàn cục
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + B để thêm vào giỏ hàng
        if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
            e.preventDefault();
            addToCart();
        }
        
        // Space để mua ngay (khi không focus vào input)
        if (e.key === ' ' && !['INPUT', 'TEXTAREA'].includes(e.target.tagName)) {
            e.preventDefault();
            buyNow();
        }
    });
});

// Auto-refresh khi focus lại tab
window.addEventListener('focus', function() {
    console.log('👁️ Tab được focus lại');
    const timeSinceLoad = Date.now() - (window.pageLoadTime || Date.now());
    
    // Refresh dữ liệu nếu đã quá 5 phút
    if (timeSinceLoad > 300000) {
        console.log('🔄 Tải lại dữ liệu sản phẩm sau khi focus lại tab');
        loadProductData(productId);
        window.pageLoadTime = Date.now();
    }
});

// Set thời gian load trang
window.pageLoadTime = Date.now();

// Performance monitoring
window.addEventListener('load', function() {
    const loadTime = Date.now() - window.pageLoadTime;
    console.log('⏱️ Trang đã load xong sau:', loadTime, 'ms');
});

console.log('🎉 Product Show with Advanced Image API Script loaded successfully');
console.log(`👤 Current user: `);
console.log(`📅 Current time: `);
</script>

<?php include_once 'app/views/shares/footer.php'; ?>