<?php 
$pageTitle = "Sản Phẩm Khuyến Mại";
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

<!-- Sale Hero Section -->
<section class="hero-section position-relative overflow-hidden" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="badge bg-warning text-dark mb-3 fs-6 px-3 py-2 pulse">
                    <i class="fas fa-fire me-2"></i>HOT SALE
                </div>
                <h1 class="display-4 fw-bold mb-4 text-white">
                    Siêu Khuyến Mại <span class="text-warning">Flash Sale</span>
                </h1>
                <p class="lead mb-4 text-white">
                    Cơ hội vàng để sở hữu những sản phẩm công nghệ hàng đầu với mức giá không thể tin được. 
                    Ưu đãi có thời hạn - Nhanh tay kẻo lỡ!
                </p>
                
                <!-- Sale Timer -->
                <div class="sale-timer mb-4">
                    <div class="row g-2">
                        <div class="col-3">
                            <div class="timer-box">
                                <div class="timer-number" id="days">12</div>
                                <div class="timer-label">Ngày</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="timer-box">
                                <div class="timer-number" id="hours">05</div>
                                <div class="timer-label">Giờ</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="timer-box">
                                <div class="timer-number" id="minutes">42</div>
                                <div class="timer-label">Phút</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="timer-box">
                                <div class="timer-number" id="seconds">18</div>
                                <div class="timer-label">Giây</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex gap-3">
                    <a href="#sale-products" class="btn btn-warning btn-lg pulse">
                        <i class="fas fa-bolt me-2"></i>Mua Ngay
                    </a>
                    <a href="/product" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-list me-2"></i>Tất Cả Sản Phẩm
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="sale-showcase">
                    <div class="floating-discount">
                        <div class="discount-circle">
                            <span class="discount-text">UP TO</span>
                            <span class="discount-percent">70%</span>
                            <span class="discount-off">OFF</span>
                        </div>
                    </div>
                    <div class="sale-products-preview">
                        <?php if (!empty($products)): ?>
                            <?php foreach (array_slice($products, 0, 3) as $index => $product): ?>
                                <div class="sale-product-item" style="animation-delay: <?= $index * 0.2 ?>s">
                                    <img src="<?= getImageUrl($product->image) ?>" 
                                         alt="<?= htmlspecialchars($product->name) ?>" 
                                         class="img-fluid rounded shadow"
                                         onerror="this.src='https://via.placeholder.com/200x150/f8f9fa/6c757d?text=<?= urlencode($product->name) ?>'">
                                    <div class="sale-badge">-<?= rand(20, 50) ?>%</div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Animated background -->
    <div class="sale-bg-animation">
        <div class="sale-shape shape-1">💥</div>
        <div class="sale-shape shape-2">🔥</div>
        <div class="sale-shape shape-3">⚡</div>
        <div class="sale-shape shape-4">💯</div>
    </div>
</section>

<!-- Sale Categories -->
<section class="py-5" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center" data-aos="fade-up">
                <h2 class="display-6 fw-bold text-dark mb-3">Danh Mục Khuyến Mại</h2>
                <p class="lead text-dark">Tất cả danh mục đều có ưu đãi đặc biệt</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="sale-category-card">
                    <div class="category-icon">
                        <i class="fas fa-laptop fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Laptop</h5>
                    <div class="discount-tag">Giảm đến 40%</div>
                    <a href="/product?category=1" class="btn btn-danger btn-sm">Mua Ngay</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="sale-category-card">
                    <div class="category-icon">
                        <i class="fas fa-mobile-alt fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Điện Thoại</h5>
                    <div class="discount-tag">Giảm đến 35%</div>
                    <a href="/product?category=2" class="btn btn-danger btn-sm">Mua Ngay</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="sale-category-card">
                    <div class="category-icon">
                        <i class="fas fa-tablet-alt fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Tablet</h5>
                    <div class="discount-tag">Giảm đến 30%</div>
                    <a href="/product?category=3" class="btn btn-danger btn-sm">Mua Ngay</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="sale-category-card">
                    <div class="category-icon">
                        <i class="fas fa-headphones fa-3x"></i>
                    </div>
                    <h5 class="fw-bold">Phụ Kiện</h5>
                    <div class="discount-tag">Giảm đến 50%</div>
                    <a href="/product?category=8" class="btn btn-danger btn-sm">Mua Ngay</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Flash Sale Banner -->
<section class="py-3 bg-warning">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8" data-aos="fade-right">
                <div class="d-flex align-items-center">
                    <i class="fas fa-bolt fa-2x text-danger me-3 flash-icon"></i>
                    <div>
                        <h5 class="fw-bold mb-0 text-dark">⚡ FLASH SALE - Chỉ còn vài giờ!</h5>
                        <p class="mb-0 text-dark">Giảm giá cực sốc, số lượng có hạn. Đặt hàng ngay!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end" data-aos="fade-left">
                <div class="flash-timer">
                    <span id="flashHours" class="timer-digit">03</span>:
                    <span id="flashMinutes" class="timer-digit">24</span>:
                    <span id="flashSeconds" class="timer-digit">15</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sale Products -->
<section id="sale-products" class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <h2 class="display-5 fw-bold mb-4">
                    <i class="fas fa-fire text-danger me-3 pulse"></i>Sản Phẩm Khuyến Mại
                </h2>
                <p class="lead text-muted">
                    Hàng ngàn sản phẩm công nghệ hàng đầu với mức giá ưu đãi không thể bỏ lỡ
                </p>
            </div>
        </div>

        <!-- Sale Filter Bar -->
        <div class="row mb-4">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="d-flex align-items-center">
                    <h5 class="fw-bold mb-0 me-3 text-danger">
                        🔥 <?= count($products) ?> Sản Phẩm Giảm Giá
                    </h5>
                    <div class="sale-badges">
                        <span class="badge bg-danger me-2">HOT</span>
                        <span class="badge bg-warning text-dark">LIMITED</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="d-flex justify-content-end align-items-center gap-3">
                    <select class="form-select w-auto" id="saleSort" onchange="updateSaleSort()">
                        <option value="discount">Giảm giá nhiều nhất</option>
                        <option value="price_asc">Giá thấp đến cao</option>
                        <option value="price_desc">Giá cao đến thấp</option>
                        <option value="newest">Mới nhất</option>
                        <option value="popular">Phổ biến nhất</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Discount Filter Tags -->
        <div class="row mb-4">
            <div class="col-12" data-aos="fade-up">
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <span class="fw-semibold text-muted me-2">Lọc theo mức giảm:</span>
                    <button class="btn btn-outline-danger btn-sm filter-tag active" data-discount="all">
                        Tất cả
                    </button>
                    <button class="btn btn-outline-danger btn-sm filter-tag" data-discount="20">
                        Giảm 20%+
                    </button>
                    <button class="btn btn-outline-danger btn-sm filter-tag" data-discount="30">
                        Giảm 30%+
                    </button>
                    <button class="btn btn-outline-danger btn-sm filter-tag" data-discount="40">
                        Giảm 40%+
                    </button>
                    <button class="btn btn-outline-danger btn-sm filter-tag" data-discount="50">
                        Giảm 50%+
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row" id="saleProductsGrid">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $index => $product): ?>
                    <?php 
                    // Random discount percentage for demo
                    $discountPercent = rand(20, 60);
                    $originalPrice = $product->price * (1 + $discountPercent/100);
                    $savedAmount = $originalPrice - $product->price;
                    ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>" data-discount="<?= $discountPercent ?>">
                        <div class="card sale-product-card h-100 border-0 shadow">
                            <!-- Sale Badge -->
                            <div class="sale-badge-large">
                                <div class="discount-percent">-<?= $discountPercent ?>%</div>
                                <div class="sale-text">SALE</div>
                            </div>
                            
                            <!-- Flash Sale Badge for high discounts -->
                            <?php if ($discountPercent >= 40): ?>
                                <div class="flash-sale-badge">
                                    <i class="fas fa-bolt"></i> FLASH
                                </div>
                            <?php endif; ?>
                            
                            <div class="position-relative overflow-hidden">
                                <img src="<?= getImageUrl($product->image) ?>" 
                                     class="card-img-top sale-product-image" 
                                     alt="<?= htmlspecialchars($product->name) ?>"
                                     style="height: 250px; object-fit: cover;"
                                     onerror="this.src='https://via.placeholder.com/300x250/f8f9fa/6c757d?text=<?= urlencode($product->name) ?>'">
                                
                                <!-- Category Badge -->
                                <div class="position-absolute top-0 end-0 m-3" style="margin-top: 60px !important;">
                                    <span class="badge bg-dark rounded-pill opacity-75">
                                        <?= htmlspecialchars($product->category_name ?? 'Chưa phân loại') ?>
                                    </span>
                                </div>
                                
                                <!-- Quick Buy Overlay -->
                                <div class="sale-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                    <button class="btn btn-warning btn-lg pulse quick-buy-btn" 
                                            onclick="quickBuySale(<?= $product->id ?>)">
                                        <i class="fas fa-bolt me-2"></i>MUA NGAY
                                    </button>
                                </div>
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <!-- Product Title -->
                                <h5 class="card-title fw-bold mb-2" style="min-height: 48px;">
                                    <a href="/product/show/<?= $product->id ?>" class="text-decoration-none text-dark">
                                        <?= htmlspecialchars($product->name) ?>
                                    </a>
                                </h5>
                                
                                <!-- Product Description -->
                                <p class="card-text text-muted small flex-grow-1" style="min-height: 60px;">
                                    <?= htmlspecialchars(substr($product->description, 0, 100)) ?>...
                                </p>
                                
                                <!-- Price Section -->
                                <div class="price-section mb-3">
                                    <div class="sale-price mb-1">
                                        <span class="current-price h4 text-danger fw-bold me-2">
                                            <?= number_format($product->price) ?> đ
                                        </span>
                                        <span class="original-price text-muted text-decoration-line-through">
                                            <?= number_format($originalPrice) ?> đ
                                        </span>
                                    </div>
                                    <div class="savings">
                                        <small class="text-success fw-bold">
                                            <i class="fas fa-arrow-down me-1"></i>
                                            Tiết kiệm: <?= number_format($savedAmount) ?> đ
                                        </small>
                                    </div>
                                </div>
                                
                                <!-- Stock Indicator -->
                                <div class="stock-indicator mb-3">
                                    <?php $stock = rand(1, 20); ?>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-danger" style="width: <?= ($stock/20) * 100 ?>%"></div>
                                    </div>
                                    <small class="text-danger fw-bold mt-1 d-block">
                                        <i class="fas fa-fire me-1"></i>
                                        Chỉ còn <?= $stock ?> sản phẩm!
                                    </small>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="mt-auto">
                                    <div class="d-grid gap-2">
                                        <button onclick="quickBuySale(<?= $product->id ?>)" 
                                                class="btn btn-danger fw-bold">
                                            <i class="fas fa-shopping-cart me-2"></i>THÊM VÀO GIỎ HÀNG
                                        </button>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <a href="/product/show/<?= $product->id ?>" 
                                                   class="btn btn-outline-dark btn-sm w-100">
                                                    <i class="fas fa-info-circle me-1"></i>Chi Tiết
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <button onclick="addToCompare(<?= $product->id ?>)" 
                                                        class="btn btn-outline-warning btn-sm w-100">
                                                    <i class="fas fa-balance-scale me-1"></i>So Sánh
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
                <!-- No Sale Products -->
                <div class="col-12">
                    <div class="text-center py-5" data-aos="fade-up">
                        <i class="fas fa-percent fa-5x text-muted mb-4"></i>
                        <h3 class="text-muted mb-3">Hiện tại chưa có sản phẩm khuyến mại</h3>
                        <p class="text-muted mb-4">
                            Các chương trình khuyến mại hấp dẫn sẽ sớm được cập nhật. 
                            Hãy theo dõi để không bỏ lỡ cơ hội!
                        </p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="/product" class="btn btn-primary">
                                <i class="fas fa-list me-2"></i>Xem Tất Cả Sản Phẩm
                            </a>
                            <button class="btn btn-outline-warning" onclick="subscribeNotification()">
                                <i class="fas fa-bell me-2"></i>Đăng Ký Nhận Thông Báo
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Special Offers Section -->
<section class="py-5 bg-dark text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h3 class="fw-bold mb-3">
                    <i class="fas fa-gift text-warning me-3"></i>
                    Ưu Đãi Đặc Biệt Cho Khách Hàng VIP
                </h3>
                <p class="lead mb-4">
                    Đăng ký thành viên VIP để nhận thêm 10% giảm giá và miễn phí vận chuyển toàn quốc
                </p>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="vip-benefit">
                            <i class="fas fa-crown text-warning me-2"></i>
                            <span>Giảm thêm 10%</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="vip-benefit">
                            <i class="fas fa-shipping-fast text-success me-2"></i>
                            <span>Miễn phí ship</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="vip-benefit">
                            <i class="fas fa-clock text-info me-2"></i>
                            <span>Ưu tiên giao hàng</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center" data-aos="fade-left">
                <button class="btn btn-warning btn-lg px-5" onclick="registerVIP()">
                    <i class="fas fa-crown me-2"></i>ĐĂNG KÝ VIP NGAY
                </button>
                <p class="mt-2 small text-muted">Hoàn toàn miễn phí</p>
            </div>
        </div>
    </div>
</section>

<style>
.pulse {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.timer-box {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    padding: 1rem 0.5rem;
    text-align: center;
    backdrop-filter: blur(10px);
}

.timer-number {
    font-size: 2rem;
    font-weight: bold;
    color: #fff;
}

.timer-label {
    font-size: 0.8rem;
    color: rgba(255, 255, 255, 0.8);
}

.sale-showcase {
    position: relative;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.floating-discount {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 10;
}

.discount-circle {
    width: 120px;
    height: 120px;
    background: linear-gradient(45deg, #ffc107, #fd7e14);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    animation: bounce 2s infinite;
    box-shadow: 0 10px 30px rgba(255, 193, 7, 0.4);
}

.discount-text {
    font-size: 0.7rem;
    font-weight: bold;
    color: #333;
}

.discount-percent {
    font-size: 1.8rem;
    font-weight: bold;
    color: #333;
    line-height: 1;
}

.discount-off {
    font-size: 0.8rem;
    font-weight: bold;
    color: #333;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-20px); }
    60% { transform: translateY(-10px); }
}

.sale-products-preview {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    justify-content: center;
}

.sale-product-item {
    position: relative;
    animation: fadeInUp 1s ease-out forwards;
    opacity: 0;
    transform: translateY(30px);
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.sale-badge {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #e74c3c;
    color: white;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: bold;
    box-shadow: 0 4px 12px rgba(231, 76, 60, 0.4);
}

.sale-bg-animation {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    pointer-events: none;
}

.sale-shape {
    position: absolute;
    font-size: 2rem;
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.shape-3 {
    bottom: 30%;
    left: 20%;
    animation-delay: 4s;
}

.shape-4 {
    top: 40%;
    right: 30%;
    animation-delay: 1s;
}

@keyframes float {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    33% { transform: translate(30px, -30px) rotate(120deg); }
    66% { transform: translate(-20px, 20px) rotate(240deg); }
}

.sale-category-card {
    background: white;
    border-radius: 20px;
    padding: 2rem 1rem;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.sale-category-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: left 0.5s;
}

.sale-category-card:hover::before {
    left: 100%;
}

.sale-category-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.category-icon {
    color: #e74c3c;
    margin-bottom: 1rem;
}

.discount-tag {
    background: linear-gradient(45deg, #e74c3c, #c0392b);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: bold;
    margin: 1rem 0;
    display: inline-block;
}

.flash-icon {
    animation: flash 1s infinite;
}

@keyframes flash {
    0%, 50%, 100% { opacity: 1; }
    25%, 75% { opacity: 0.5; }
}

.flash-timer {
    background: rgba(0,0,0,0.8);
    color: #ffc107;
    padding: 0.5rem 1rem;
    border-radius: 10px;
    font-weight: bold;
    font-size: 1.2rem;
}

.timer-digit {
    background: #dc3545;
    color: white;
    padding: 0.2rem 0.5rem;
    border-radius: 5px;
    margin: 0 0.1rem;
}

.sale-product-card {
    transition: all 0.3s ease;
    position: relative;
}

.sale-product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2) !important;
}

.sale-badge-large {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 10;
    background: linear-gradient(45deg, #e74c3c, #c0392b);
    color: white;
    border-radius: 10px;
    padding: 0.5rem;
    text-align: center;
    box-shadow: 0 4px 12px rgba(231, 76, 60, 0.4);
}

.discount-percent {
    font-size: 1rem;
    font-weight: bold;
    line-height: 1;
}

.sale-text {
    font-size: 0.7rem;
    font-weight: bold;
}

.flash-sale-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 10;
    background: linear-gradient(45deg, #ffc107, #fd7e14);
    color: #333;
    border-radius: 15px;
    padding: 0.3rem 0.8rem;
    font-size: 0.8rem;
    font-weight: bold;
    animation: flash-badge 1.5s infinite;
}

@keyframes flash-badge {
    0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.7); }
    50% { transform: scale(1.05); box-shadow: 0 0 0 10px rgba(255, 193, 7, 0); }
}

.sale-overlay {
    background: rgba(0,0,0,0.8);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.sale-product-card:hover .sale-overlay {
    opacity: 1;
}

.quick-buy-btn {
    transform: scale(0.8);
    transition: transform 0.3s ease;
}

.sale-product-card:hover .quick-buy-btn {
    transform: scale(1);
}

.sale-product-image {
    transition: transform 0.3s ease;
    background: #f8f9fa;
    object-fit: cover;
}

.sale-product-card:hover .sale-product-image {
    transform: scale(1.1);
}

.filter-tag {
    transition: all 0.3s ease;
}

.filter-tag.active {
    background: #dc3545 !important;
    color: white !important;
    border-color: #dc3545 !important;
}

.filter-tag:hover {
    background: #dc3545 !important;
    color: white !important;
    border-color: #dc3545 !important;
}

.stock-indicator .progress {
    background: rgba(220, 53, 69, 0.2);
}

.vip-benefit {
    background: rgba(255, 255, 255, 0.1);
    padding: 1rem;
    border-radius: 10px;
    text-align: center;
}

/* Image loading states */
.sale-product-image {
    position: relative;
}

.sale-product-image::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, #f8f9fa 25%, transparent 25%, transparent 75%, #f8f9fa 75%, #f8f9fa), 
                linear-gradient(45deg, #f8f9fa 25%, transparent 25%, transparent 75%, #f8f9fa 75%, #f8f9fa);
    background-size: 20px 20px;
    background-position: 0 0, 10px 10px;
    opacity: 0.1;
    z-index: -1;
}

/* Lazy loading for images */
.sale-product-image[data-src] {
    opacity: 0.5;
    transition: opacity 0.3s;
}

.sale-product-image[data-src].loaded {
    opacity: 1;
}

@media (max-width: 768px) {
    .sale-product-card {
        margin-bottom: 2rem;
    }
    
    .timer-box {
        padding: 0.5rem 0.25rem;
    }
    
    .timer-number {
        font-size: 1.5rem;
    }
    
    .discount-circle {
        width: 80px;
        height: 80px;
    }
    
    .discount-percent {
        font-size: 1.2rem;
    }
    
    .sale-category-card {
        padding: 1.5rem 1rem;
        margin-bottom: 1.5rem;
    }
}
</style>

<script>
$(document).ready(function() {
    // Initialize countdown timers
    startCountdown();
    startFlashSaleTimer();
    
    // Filter functionality
    $('.filter-tag').click(function() {
        $('.filter-tag').removeClass('active');
        $(this).addClass('active');
        
        const discount = $(this).data('discount');
        filterByDiscount(discount);
    });

    // Lazy loading for images
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            }
        });
    });

    // Observe all images with data-src
    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
});

// Countdown timer
function startCountdown() {
    const endDate = new Date();
    endDate.setDate(endDate.getDate() + 12);
    endDate.setHours(endDate.getHours() + 5);
    endDate.setMinutes(endDate.getMinutes() + 42);
    endDate.setSeconds(endDate.getSeconds() + 18);
    
    const timer = setInterval(function() {
        const now = new Date().getTime();
        const distance = endDate.getTime() - now;
        
        if (distance < 0) {
            clearInterval(timer);
            return;
        }
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        document.getElementById('days').textContent = days.toString().padStart(2, '0');
        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
    }, 1000);
}

// Flash sale timer
function startFlashSaleTimer() {
    let hours = 3;
    let minutes = 24;
    let seconds = 15;
    
    const flashTimer = setInterval(function() {
        seconds--;
        
        if (seconds < 0) {
            seconds = 59;
            minutes--;
        }
        
        if (minutes < 0) {
            minutes = 59;
            hours--;
        }
        
        if (hours < 0) {
            clearInterval(flashTimer);
            return;
        }
        
        document.getElementById('flashHours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('flashMinutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('flashSeconds').textContent = seconds.toString().padStart(2, '0');
    }, 1000);
}

// Quick buy function for sale products
function quickBuySale(productId) {
    const button = event.target.closest('button');
    const originalContent = button.innerHTML;
    
    // Special sale loading animation
    button.innerHTML = '<i class="fas fa-fire fa-spin me-2"></i>Đang thêm...';
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
            
            // Special sale success animation
            Swal.fire({
                icon: 'success',
                title: '🔥 THÀNH CÔNG!',
                html: `
                    <div class="text-center">
                        <div class="sale-success-animation mb-3">
                            <i class="fas fa-fire text-danger fa-3x"></i>
                        </div>
                        <p class="mb-2 fw-bold">${data.message}</p>
                        <p class="mb-0 text-success">🎉 Bạn đã tiết kiệm được một khoản lớn!</p>
                    </div>
                `,
                timer: 2500,
                showConfirmButton: false,
                background: 'linear-gradient(45deg, #fff3cd, #f8d7da)',
                customClass: {
                    popup: 'sale-success-popup'
                }
            });

            // Add special effect
            createFireworks(button);
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

// Filter by discount percentage
function filterByDiscount(discount) {
    const products = document.querySelectorAll('[data-discount]');
    
    products.forEach(product => {
        const productDiscount = parseInt(product.getAttribute('data-discount'));
        
        if (discount === 'all' || productDiscount >= discount) {
            product.style.display = 'block';
            product.style.animation = 'fadeInUp 0.5s ease-out';
        } else {
            product.style.display = 'none';
        }
    });
}

// Update sale sort
function updateSaleSort() {
    const sortValue = document.getElementById('saleSort').value;
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('sort', sortValue);
    window.location.href = window.location.pathname + '?' + urlParams.toString();
}

// Add to compare function
function addToCompare(productId) {
    Swal.fire({
        icon: 'info',
        title: 'Tính năng sắp ra mắt',
        text: 'Tính năng so sánh sản phẩm sẽ được cập nhật trong phiên bản tiếp theo.',
        confirmButtonText: 'Đã hiểu'
    });
}

// Register VIP function
function registerVIP() {
    Swal.fire({
        title: 'Đăng Ký Thành Viên VIP',
        html: `
            <div class="text-start">
                <p>Lợi ích thành viên VIP:</p>
                <ul>
                    <li>🎉 Giảm thêm 10% cho tất cả sản phẩm</li>
                    <li>🚚 Miễn phí vận chuyển toàn quốc</li>
                    <li>⚡ Ưu tiên giao hàng nhanh</li>
                    <li>🎁 Quà tặng đặc biệt hàng tháng</li>
                    <li>📞 Hotline hỗ trợ VIP 24/7</li>
                </ul>
                <p class="text-center"><strong>Hoàn toàn MIỄN PHÍ!</strong></p>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Đăng Ký Ngay',
        cancelButtonText: 'Để Sau',
        confirmButtonColor: '#ffc107'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: 'Chúc Mừng!',
                text: 'Bạn đã đăng ký thành viên VIP thành công. Hãy kiểm tra email để kích hoạt tài khoản.',
                confirmButtonColor: '#28a745'
            });
        }
    });
}

// Subscribe notification function
function subscribeNotification() {
    Swal.fire({
        title: 'Đăng Ký Nhận Thông Báo',
        input: 'email',
        inputPlaceholder: 'Nhập email của bạn',
        showCancelButton: true,
        confirmButtonText: 'Đăng Ký',
        cancelButtonText: 'Hủy',
        inputValidator: (value) => {
            if (!value) {
                return 'Vui lòng nhập email!'
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                return 'Email không đúng định dạng!'
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: 'Đăng ký thành công!',
                text: `Chúng tôi sẽ gửi thông báo về các chương trình khuyến mại đến ${result.value}`,
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
}

// Create fireworks effect
function createFireworks(element) {
    const rect = element.getBoundingClientRect();
    const fireworks = document.createElement('div');
    fireworks.className = 'fireworks-container';
    fireworks.style.position = 'fixed';
    fireworks.style.left = rect.left + rect.width / 2 + 'px';
    fireworks.style.top = rect.top + rect.height / 2 + 'px';
    fireworks.style.pointerEvents = 'none';
    fireworks.style.zIndex = '9999';
    
    for (let i = 0; i < 12; i++) {
        const spark = document.createElement('div');
        spark.innerHTML = ['🎉', '✨', '💥', '🎊'][Math.floor(Math.random() * 4)];
        spark.style.position = 'absolute';
        spark.style.fontSize = '1.5rem';
        spark.style.animation = `firework 1.5s ease-out forwards`;
        spark.style.animationDelay = Math.random() * 0.3 + 's';
        
        const angle = (360 / 12) * i;
        const distance = 100 + Math.random() * 50;
        spark.style.setProperty('--end-x', Math.cos(angle * Math.PI / 180) * distance + 'px');
        spark.style.setProperty('--end-y', Math.sin(angle * Math.PI / 180) * distance + 'px');
        
        fireworks.appendChild(spark);
    }
    
    document.body.appendChild(fireworks);
    
    setTimeout(() => {
        document.body.removeChild(fireworks);
    }, 2000);
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

// Add firework animation CSS
const fireworkStyle = document.createElement('style');
fireworkStyle.textContent = `
    @keyframes firework {
        0% {
            transform: translate(0, 0) scale(0);
            opacity: 1;
        }
        100% {
            transform: translate(var(--end-x), var(--end-y)) scale(1);
            opacity: 0;
        }
    }
    
    .sale-success-popup {
        border: 3px solid #dc3545 !important;
    }
    
    .sale-success-animation {
        animation: fireGlow 1s ease-in-out infinite alternate;
    }
    
    @keyframes fireGlow {
        from { text-shadow: 0 0 10px #dc3545; }
        to { text-shadow: 0 0 20px #dc3545, 0 0 30px #ff6b6b; }
    }
`;
document.head.appendChild(fireworkStyle);
</script>

<?php include_once 'app/views/shares/footer.php'; ?>