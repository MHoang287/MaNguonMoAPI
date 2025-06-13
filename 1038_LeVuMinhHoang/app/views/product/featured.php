<?php 
$pageTitle = "Sản Phẩm Nổi Bật";
include_once 'app/views/shares/header.php'; 

// Helper function để xử lý đường dẫn hình ảnh
function getImageUrl($imagePath) {
    if (empty($imagePath)) {
        return 'https://via.placeholder.com/300x250/f8f9fa/6c757d?text=No+Image';
    }
    
    // Kiểm tra nếu là URL đầy đủ
    if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
        return $imagePath;
    }
    
    // Xử lý đường dẫn tương đối
    $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'];
    
    // Loại bỏ dấu / ở đầu nếu có
    $imagePath = ltrim($imagePath, '/');
    
    // Kiểm tra file có tồn tại không
    $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $imagePath;
    if (file_exists($fullPath)) {
        return $baseUrl . '/' . $imagePath;
    }
    
    // Nếu không tìm thấy, trả về placeholder
    return 'https://via.placeholder.com/300x250/f8f9fa/6c757d?text=Image+Not+Found';
}
?>

<!-- Featured Hero Section -->
<section class="hero-section position-relative overflow-hidden">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="badge bg-warning text-dark mb-3 fs-6 px-3 py-2">
                    <i class="fas fa-star me-2"></i>FEATURED PRODUCTS
                </div>
                <h1 class="display-4 fw-bold mb-4">
                    Sản Phẩm <span class="text-warning">Nổi Bật</span>
                </h1>
                <p class="lead mb-4">
                    Khám phá những sản phẩm công nghệ hàng đầu được lựa chọn kỹ lưỡng bởi đội ngũ chuyên gia của TechTafu. 
                    Chất lượng cao, hiệu năng vượt trội, được đánh giá cao bởi người dùng.
                </p>
                <div class="row g-3 mb-4">
                    <div class="col-auto">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-sm bg-warning text-dark me-3">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Chính Hãng 100%</h6>
                                <small class="text-light">Bảo hành toàn cầu</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon-sm bg-success text-white me-3">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">Giao Hàng Nhanh</h6>
                                <small class="text-light">2-4h nội thành</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <a href="#featured-products" class="btn btn-warning btn-lg">
                        <i class="fas fa-arrow-down me-2"></i>Khám Phá Ngay
                    </a>
                    <a href="/product" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-list me-2"></i>Tất Cả Sản Phẩm
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <!-- Featured product showcase -->
                    <div class="swiper featured-swiper">
                        <div class="swiper-wrapper">
                            <?php if (!empty($products)): ?>
                                <?php foreach (array_slice($products, 0, 3) as $product): ?>
                                    <div class="swiper-slide">
                                        <div class="featured-product-card">
                                            <img src="<?= getImageUrl($product->image) ?>" 
                                                 alt="<?= htmlspecialchars($product->name) ?>" 
                                                 class="img-fluid rounded-3 shadow-lg"
                                                 onerror="this.src='https://via.placeholder.com/400x300/f8f9fa/6c757d?text=<?= urlencode($product->name) ?>'">
                                            <div class="featured-overlay">
                                                <h5 class="text-white fw-bold"><?= htmlspecialchars($product->name) ?></h5>
                                                <p class="text-warning fs-4 fw-bold"><?= number_format($product->price) ?> đ</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Animated background elements -->
    <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden" style="z-index: -1;">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>
        <div class="floating-shape shape-3"></div>
    </div>
</section>

<!-- Featured Categories -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center" data-aos="fade-up">
                <h2 class="display-6 fw-bold mb-3">Danh Mục Nổi Bật</h2>
                <p class="lead text-muted">Các danh mục sản phẩm được yêu thích nhất</p>
            </div>
        </div>
        <div class="row">
            <?php if (!empty($categories)): ?>
                <?php foreach (array_slice($categories, 0, 4) as $index => $category): ?>
                    <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                        <div class="category-card text-center h-100">
                            <div class="category-icon mb-3">
                                <?php
                                $icons = [
                                    'fas fa-laptop',
                                    'fas fa-mobile-alt', 
                                    'fas fa-tablet-alt',
                                    'fas fa-headphones'
                                ];
                                $icon = $icons[$index % count($icons)];
                                ?>
                                <i class="<?= $icon ?> fa-3x"></i>
                            </div>
                            <h5 class="fw-bold mb-3"><?= htmlspecialchars($category->name) ?></h5>
                            <p class="text-muted mb-4"><?= htmlspecialchars($category->description) ?></p>
                            <a href="/product?category=<?= $category->id ?>" class="btn btn-outline-primary">
                                Khám Phá <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Featured Products Grid -->
<section id="featured-products" class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-4">
                    <i class="fas fa-star text-warning me-3"></i>Sản Phẩm Nổi Bật
                </h2>
                <p class="lead text-muted">
                    Những sản phẩm được đánh giá cao nhất, bán chạy nhất và được khuyên dùng bởi chuyên gia
                </p>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="row mb-4">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="d-flex align-items-center">
                    <h5 class="fw-bold mb-0 me-3">
                        <i class="fas fa-fire text-danger me-2"></i>
                        <?= count($products) ?> Sản Phẩm Nổi Bật
                    </h5>
                    <span class="badge bg-warning text-dark">HOT</span>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="d-flex justify-content-end">
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="viewMode" id="gridView" checked>
                        <label class="btn btn-outline-primary" for="gridView">
                            <i class="fas fa-th"></i>
                        </label>
                        
                        <input type="radio" class="btn-check" name="viewMode" id="listView">
                        <label class="btn btn-outline-primary" for="listView">
                            <i class="fas fa-list"></i>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row" id="productsGrid">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $index => $product): ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                        <div class="card product-card-featured h-100 border-0 shadow">
                            <!-- Featured Badge -->
                            <div class="featured-badge">
                                <span class="badge bg-gradient bg-warning text-dark">
                                    <i class="fas fa-star me-1"></i>FEATURED
                                </span>
                            </div>
                            
                            <div class="position-relative overflow-hidden">
                                <img src="<?= getImageUrl($product->image) ?>" 
                                     class="card-img-top product-image" 
                                     alt="<?= htmlspecialchars($product->name) ?>"
                                     style="height: 250px; object-fit: cover;"
                                     onerror="this.src='https://via.placeholder.com/300x250/f8f9fa/6c757d?text=<?= urlencode($product->name) ?>'">
                                
                                <!-- Category Badge -->
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-primary rounded-pill">
                                        <?= htmlspecialchars($product->category_name ?? 'Chưa phân loại') ?>
                                    </span>
                                </div>
                                
                                <!-- Quick Actions Overlay -->
                                <div class="product-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-light btn-sm rounded-circle quick-action" 
                                                onclick="quickView(<?= $product->id ?>)" 
                                                title="Xem nhanh">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-warning btn-sm rounded-circle quick-action" 
                                                onclick="addToCartFeatured(<?= $product->id ?>)" 
                                                title="Thêm vào giỏ">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm rounded-circle quick-action" 
                                                onclick="addToWishlist(<?= $product->id ?>)" 
                                                title="Yêu thích">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <div class="mb-2">
                                    <!-- Rating stars -->
                                    <div class="rating mb-2">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star <?= $i <= 4 ? 'text-warning' : 'text-muted' ?>"></i>
                                        <?php endfor; ?>
                                        <span class="text-muted ms-2">(4.0)</span>
                                    </div>
                                </div>
                                
                                <h5 class="card-title fw-bold mb-2" style="min-height: 48px;">
                                    <a href="/product/show/<?= $product->id ?>" class="text-decoration-none text-dark">
                                        <?= htmlspecialchars($product->name) ?>
                                    </a>
                                </h5>
                                
                                <p class="card-text text-muted small flex-grow-1" style="min-height: 60px;">
                                    <?= htmlspecialchars(substr($product->description, 0, 100)) ?>...
                                </p>
                                
                                <!-- Price -->
                                <div class="price-section mb-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="h5 text-danger fw-bold">
                                                <?= number_format($product->price) ?> đ
                                            </span>
                                            <br>
                                            <small class="text-muted text-decoration-line-through">
                                                <?= number_format($product->price * 1.2) ?> đ
                                            </small>
                                        </div>
                                        <div class="discount-badge">
                                            <span class="badge bg-danger">-20%</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="mt-auto">
                                    <div class="d-grid gap-2">
                                        <button onclick="addToCartFeatured(<?= $product->id ?>)" 
                                                class="btn btn-warning fw-bold">
                                            <i class="fas fa-cart-plus me-2"></i>Thêm Vào Giỏ Hàng
                                        </button>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <a href="/product/show/<?= $product->id ?>" 
                                                   class="btn btn-outline-primary btn-sm w-100">
                                                    <i class="fas fa-info-circle me-1"></i>Chi Tiết
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <button onclick="addToWishlist(<?= $product->id ?>)" 
                                                        class="btn btn-outline-danger btn-sm w-100">
                                                    <i class="fas fa-heart me-1"></i>Yêu Thích
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- No Featured Products -->
                <div class="col-12">
                    <div class="text-center py-5" data-aos="fade-up">
                        <i class="fas fa-star fa-5x text-muted mb-4"></i>
                        <h3 class="text-muted mb-3">Chưa có sản phẩm nổi bật</h3>
                        <p class="text-muted mb-4">
                            Hiện tại chưa có sản phẩm nào được đánh dấu là nổi bật. 
                            Hãy quay lại sau để khám phá những sản phẩm tuyệt vời nhất!
                        </p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="/product" class="btn btn-primary">
                                <i class="fas fa-list me-2"></i>Xem Tất Cả Sản Phẩm
                            </a>
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
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                <div class="text-center">
                    <div class="feature-icon-lg mb-3">
                        <i class="fas fa-award fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Chất Lượng Hàng Đầu</h5>
                    <p>Được lựa chọn kỹ lưỡng từ các thương hiệu uy tín</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="feature-icon-lg mb-3">
                        <i class="fas fa-shield-alt fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Bảo Hành Toàn Diện</h5>
                    <p>Chế độ bảo hành và hỗ trợ tốt nhất thị trường</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <div class="feature-icon-lg mb-3">
                        <i class="fas fa-rocket fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Hiệu Năng Vượt Trội</h5>
                    <p>Được kiểm tra và đánh giá hiệu năng thực tế</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <div class="feature-icon-lg mb-3">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Được Tin Dùng</h5>
                    <p>Hàng nghìn khách hàng đã tin tưởng và lựa chọn</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.feature-icon-sm {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.feature-icon-lg {
    color: rgba(255, 255, 255, 0.8);
}

.featured-product-card {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
}

.featured-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    padding: 2rem;
    text-align: center;
}

.product-card-featured {
    transition: all 0.3s ease;
    position: relative;
}

.product-card-featured:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2) !important;
}

.featured-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    z-index: 10;
}

.product-overlay {
    background: rgba(0,0,0,0.7);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card-featured:hover .product-overlay {
    opacity: 1;
}

.quick-action {
    width: 40px;
    height: 40px;
    transition: all 0.3s ease;
}

.quick-action:hover {
    transform: scale(1.1);
}

.product-image {
    transition: transform 0.3s ease;
}

.product-card-featured:hover .product-image {
    transform: scale(1.05);
}

.category-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.category-icon {
    color: var(--bs-primary);
}

.floating-shape {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 100px;
    height: 100px;
    top: 20%;
    right: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 150px;
    height: 150px;
    top: 60%;
    right: 20%;
    animation-delay: 2s;
}

.shape-3 {
    width: 80px;
    height: 80px;
    top: 40%;
    right: 5%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.rating .fa-star {
    font-size: 0.8rem;
}

.discount-badge {
    text-align: right;
}

/* Image loading states */
.product-image {
    background: #f8f9fa;
    display: block;
}

.product-image::before {
    content: "";
    display: block;
    padding-top: 75%; /* 4:3 aspect ratio */
}

/* Lazy loading */
.product-image[data-src] {
    opacity: 0.3;
    transition: opacity 0.3s;
}

.product-image[data-src].loaded {
    opacity: 1;
}

@media (max-width: 768px) {
    .product-card-featured {
        margin-bottom: 2rem;
    }
    
    .featured-overlay {
        padding: 1rem;
    }
    
    .category-card {
        padding: 1.5rem;
    }
}
</style>

<script>
$(document).ready(function() {
    // Initialize Featured Swiper
    if (typeof Swiper !== 'undefined') {
        const featuredSwiper = new Swiper('.featured-swiper', {
            loop: true,
            autoplay: {
                delay: 5000,
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

    // View mode toggle
    $('input[name="viewMode"]').change(function() {
        const isListView = $('#listView').is(':checked');
        const productsGrid = $('#productsGrid');
        
        if (isListView) {
            productsGrid.find('.col-xl-3').removeClass('col-xl-3 col-lg-4 col-md-6').addClass('col-12');
            productsGrid.find('.product-card-featured').addClass('list-view');
        } else {
            productsGrid.find('.col-12').removeClass('col-12').addClass('col-xl-3 col-lg-4 col-md-6');
            productsGrid.find('.product-card-featured').removeClass('list-view');
        }
    });

    // Lazy loading for images
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.add('loaded');
                imageObserver.unobserve(img);
            }
        });
    });

    // Observe all images with data-src
    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
});

// Add to cart for featured products
function addToCartFeatured(productId) {
    const button = event.target.closest('button');
    const originalContent = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang thêm...';
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
            updateCartCount();
            
            // Special animation for featured products
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                html: `
                    <div class="text-center">
                        <i class="fas fa-star text-warning fa-2x mb-3"></i>
                        <p class="mb-0">${data.message}</p>
                        <small class="text-muted">Sản phẩm nổi bật đã được thêm vào giỏ hàng</small>
                    </div>
                `,
                timer: 2000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                customClass: {
                    popup: 'colored-toast'
                }
            });

            // Add sparkle effect
            createSparkleEffect(button);
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
        button.innerHTML = originalContent;
        button.disabled = false;
    });
}

// Quick view function
function quickView(productId) {
    Swal.fire({
        title: 'Xem nhanh sản phẩm',
        html: '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x"></i></div>',
        showConfirmButton: false,
        allowOutsideClick: false
    });
    
    // Simulate loading quick view content
    setTimeout(() => {
        Swal.fire({
            title: 'Sản phẩm nổi bật',
            html: '<p>Tính năng xem nhanh sẽ được cập nhật trong phiên bản sau.</p>',
            confirmButtonText: 'Xem chi tiết',
            confirmButtonColor: '#007bff'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/product/show/${productId}`;
            }
        });
    }, 1000);
}

// Add to wishlist function
function addToWishlist(productId) {
    Swal.fire({
        icon: 'info',
        title: 'Tính năng sắp ra mắt',
        text: 'Tính năng yêu thích sẽ được cập nhật trong phiên bản tiếp theo.',
        confirmButtonText: 'Đã hiểu'
    });
}

// Sparkle effect
function createSparkleEffect(element) {
    const rect = element.getBoundingClientRect();
    const sparkles = document.createElement('div');
    sparkles.className = 'sparkle-container';
    sparkles.style.position = 'fixed';
    sparkles.style.left = rect.left + rect.width / 2 + 'px';
    sparkles.style.top = rect.top + rect.height / 2 + 'px';
    sparkles.style.pointerEvents = 'none';
    sparkles.style.zIndex = '9999';
    
    for (let i = 0; i < 8; i++) {
        const sparkle = document.createElement('div');
        sparkle.innerHTML = '✨';
        sparkle.style.position = 'absolute';
        sparkle.style.animation = `sparkle 1s ease-out forwards`;
        sparkle.style.animationDelay = Math.random() * 0.5 + 's';
        sparkle.style.transform = `rotate(${Math.random() * 360}deg)`;
        sparkles.appendChild(sparkle);
    }
    
    document.body.appendChild(sparkles);
    
    setTimeout(() => {
        document.body.removeChild(sparkles);
    }, 1500);
}

// Update cart count
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

// Add sparkle animation CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes sparkle {
        0% {
            transform: translate(0, 0) scale(0);
            opacity: 1;
        }
        100% {
            transform: translate(${Math.random() * 100 - 50}px, ${Math.random() * 100 - 50}px) scale(1);
            opacity: 0;
        }
    }
    
    .colored-toast {
        background: linear-gradient(45deg, #ffc107, #fd7e14) !important;
        color: white !important;
    }
    
    .list-view {
        flex-direction: row !important;
    }
    
    .list-view .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
`;
document.head.appendChild(style);
</script>

<?php include_once 'app/views/shares/footer.php'; ?>