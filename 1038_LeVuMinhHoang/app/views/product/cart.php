<?php 
$pageTitle = "Giỏ Hàng";
include_once 'app/views/shares/header.php'; 

// Sử dụng thông tin từ session
$currentUser = $_SESSION['user_login'] ?? 'Guest';
$currentDate = date('d/m/Y H:i');

// Helper function để xử lý đường dẫn hình ảnh
function getImageUrl($imagePath) {
    if (empty($imagePath)) {
        return 'https://via.placeholder.com/100x80/f8f9fa/6c757d?text=No+Image';
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
    
    // Nếu không tìm thấy, trả về placeholder với tên sản phẩm
    return 'https://via.placeholder.com/100x80/e9ecef/6c757d?text=' . urlencode('No Image');
}
?>

<section class="py-5">
    <div class="container">
        <!-- User Info & Breadcrumb -->
        <div class="row mb-4">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                        <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản Phẩm</a></li>
                        <li class="breadcrumb-item active">Giỏ Hàng</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="user-info">
                    <small class="text-muted">
                        <i class="fas fa-user me-1"></i><?= htmlspecialchars($currentUser) ?>
                        <span class="ms-2">
                            <i class="fas fa-clock me-1"></i><?= $currentDate ?>
                        </span>
                    </small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0" data-aos="fade-right">
                        <i class="fas fa-shopping-cart text-primary me-2"></i>Giỏ Hàng Của Bạn
                        <?php if (!empty($cart)): ?>
                            <small class="text-muted fs-6">
                                (<?= array_sum(array_column($cart, 'quantity')) ?> sản phẩm)
                            </small>
                        <?php endif; ?>
                    </h2>
                    <a href="/Product" class="btn btn-outline-primary" data-aos="fade-left">
                        <i class="fas fa-arrow-left me-2"></i>Tiếp Tục Mua Sắm
                    </a>
                </div>
            </div>
        </div>

        <?php if (!empty($cart)): ?>
            <!-- Cart Summary Info -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-info border-0" data-aos="fade-up">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h6 class="alert-heading mb-2">
                                    <i class="fas fa-info-circle me-2"></i>Thông Tin Giỏ Hàng
                                </h6>
                                <p class="mb-0">
                                    Bạn có <strong><?= count($cart) ?></strong> loại sản phẩm với tổng 
                                    <strong><?= array_sum(array_column($cart, 'quantity')) ?></strong> món hàng
                                </p>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <div class="text-primary">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    <small>Mua sắm an toàn & bảo mật</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0" data-aos="fade-up">
                        <div class="card-header bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-list me-2"></i>Sản Phẩm Trong Giỏ
                                    <span class="badge bg-primary ms-2" id="cart-items-count"><?= count($cart) ?></span>
                                </h5>
                                <small class="text-muted">
                                    Cập nhật: <?= $currentDate ?>
                                </small>
                            </div>
                        </div>
                        <div class="card-body p-0" id="cart-items-container">
                            <?php 
                            $total = 0;
                            $itemIndex = 0;
                            foreach ($cart as $id => $item): 
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                                $itemIndex++;
                            ?>
                                <div class="cart-item border-bottom p-4" id="cart-item-<?= $id ?>" data-aos="fade-up" data-aos-delay="<?= $itemIndex * 100 ?>">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <div class="position-relative">
                                                <div class="image-container">
                                                    <img src="<?= getImageUrl($item['image']) ?>" 
                                                         class="img-fluid rounded shadow-sm cart-product-image" 
                                                         alt="<?= htmlspecialchars($item['name']) ?>"
                                                         style="max-height: 80px; width: 100%; object-fit: cover;"
                                                         onerror="this.src='https://via.placeholder.com/100x80/f8f9fa/6c757d?text=<?= urlencode($item['name']) ?>'">
                                                    <div class="image-overlay">
                                                        <i class="fas fa-image text-white"></i>
                                                    </div>
                                                </div>
                                                <span class="position-absolute top-0 start-0 badge bg-secondary rounded-pill" style="font-size: 0.7rem;">
                                                    #<?= $itemIndex ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="mb-1 fw-bold"><?= htmlspecialchars($item['name']) ?></h6>
                                            <p class="text-muted mb-1 small">
                                                <i class="fas fa-tag me-1"></i>Mã SP: #<?= $id ?>
                                            </p>
                                            <div class="product-meta">
                                                <small class="text-success">
                                                    <i class="fas fa-check-circle me-1"></i>Còn hàng
                                                </small>
                                                <small class="text-muted ms-2">
                                                    <i class="fas fa-truck me-1"></i>Giao hàng nhanh
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="text-center">
                                                <p class="mb-0 fw-bold text-primary"><?= number_format($item['price']) ?> ₫</p>
                                                <small class="text-muted">Đơn giá</small>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="quantity-control">
                                                <label class="form-label small text-muted">Số lượng</label>
                                                <div class="input-group input-group-sm">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(<?= $id ?>, 'decrease')" title="Giảm số lượng">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="text" 
                                                           class="form-control text-center fw-bold" 
                                                           value="<?= $item['quantity'] ?>" 
                                                           data-product-id="<?= $id ?>" 
                                                           id="quantity-<?= $id ?>"
                                                           readonly>
                                                    <button class="btn btn-outline-secondary" type="button" onclick="updateQuantity(<?= $id ?>, 'increase')" title="Tăng số lượng">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <div class="item-actions">
                                                <p class="mb-2 fw-bold text-dark" id="item-total-<?= $id ?>">
                                                    <?= number_format($subtotal) ?> ₫
                                                </p>
                                                <small class="text-muted d-block mb-2">Thành tiền</small>
                                                <button class="btn btn-outline-danger btn-sm" onclick="removeFromCart(<?= $id ?>)" title="Xóa sản phẩm">
                                                    <i class="fas fa-trash me-1"></i>Xóa
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <!-- Cart Actions -->
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i>Khách hàng: <strong><?= htmlspecialchars($currentUser) ?></strong>
                                    </small>
                                </div>
                                <div>
                                    <button class="btn btn-outline-warning btn-sm me-2" onclick="saveCartForLater()">
                                        <i class="fas fa-bookmark me-1"></i>Lưu tạm
                                    </button>
                                    <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                                        <i class="fas fa-print me-1"></i>In
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 sticky-top" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-calculator me-2"></i>Tổng Kết Đơn Hàng
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Order Details -->
                            <div class="order-summary">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Tạm tính:</span>
                                    <span class="fw-bold" id="cart-subtotal"><?= number_format($total) ?> ₫</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Phí vận chuyển:</span>
                                    <span class="text-success fw-bold">
                                        <?php if ($total >= 1000000): ?>
                                            Miễn phí
                                        <?php else: ?>
                                            30,000 ₫
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Thuế VAT (10%):</span>
                                    <span class="fw-bold"><?= number_format($total * 0.1) ?> ₫</span>
                                </div>
                                
                                <?php if (isset($_SESSION['applied_coupon'])): ?>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Giảm giá (<?= $_SESSION['applied_coupon']['code'] ?>):</span>
                                    <span class="text-danger fw-bold" id="discount-amount">
                                        - <?= number_format($_SESSION['applied_coupon']['discount_amount']) ?> ₫
                                    </span>
                                </div>
                                <?php else: ?>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Giảm giá:</span>
                                    <span class="text-muted" id="discount-amount">- 0 ₫</span>
                                </div>
                                <?php endif; ?>
                                
                                <hr class="my-3">
                                
                                <div class="d-flex justify-content-between mb-4">
                                    <span class="h5 fw-bold">Tổng cộng:</span>
                                    <span class="h5 text-primary fw-bold" id="cart-total">
                                        <?php 
                                        $shippingFee = ($total >= 1000000) ? 0 : 30000;
                                        $taxAmount = $total * 0.1;
                                        $discountAmount = isset($_SESSION['applied_coupon']) ? $_SESSION['applied_coupon']['discount_amount'] : 0;
                                        $finalTotal = $total + $shippingFee + $taxAmount - $discountAmount;
                                        echo number_format($finalTotal);
                                        ?> ₫
                                    </span>
                                </div>

                                <!-- Savings Info -->
                                <?php if ($total >= 1000000): ?>
                                <div class="alert alert-success py-2 mb-3">
                                    <small>
                                        <i class="fas fa-gift me-1"></i>
                                        Bạn đã tiết kiệm 30,000₫ phí vận chuyển!
                                    </small>
                                </div>
                                <?php else: ?>
                                <div class="alert alert-warning py-2 mb-3">
                                    <small>
                                        <i class="fas fa-info-circle me-1"></i>
                                        Mua thêm <?= number_format(1000000 - $total) ?>₫ để được miễn phí vận chuyển!
                                    </small>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- Coupon Code -->
                            <div class="coupon-section mb-4">
                                <label for="couponCode" class="form-label small fw-bold">
                                    <i class="fas fa-tag me-1"></i>Mã giảm giá
                                </label>
                                
                                <?php if (isset($_SESSION['applied_coupon'])): ?>
                                <div class="alert alert-success py-2 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>
                                            <i class="fas fa-check-circle me-1"></i>
                                            Đã áp dụng: <strong><?= $_SESSION['applied_coupon']['code'] ?></strong>
                                        </span>
                                        <button class="btn btn-sm btn-outline-danger" onclick="removeCoupon()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php else: ?>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="couponCode" placeholder="Nhập mã giảm giá...">
                                    <button class="btn btn-outline-success" type="button" onclick="applyCoupon()">
                                        <i class="fas fa-check me-1"></i>Áp dụng
                                    </button>
                                </div>
                                <small class="text-muted">
                                    Thử: TECHTAFU10, SAVE50K, NEWUSER
                                </small>
                                <?php endif; ?>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <a href="/Product/checkout" class="btn btn-primary btn-lg">
                                    <i class="fas fa-credit-card me-2"></i>Thanh Toán Ngay
                                </a>
                                <button class="btn btn-outline-danger" onclick="clearCart()">
                                    <i class="fas fa-trash me-2"></i>Xóa Tất Cả
                                </button>
                            </div>

                            <!-- Customer Info -->
                            <div class="customer-info mt-3 p-3 bg-light rounded">
                                <h6 class="mb-2">
                                    <i class="fas fa-user-circle me-1"></i>Thông tin phiên
                                </h6>
                                <p class="mb-1 small">
                                    <strong>Người dùng:</strong> <?= htmlspecialchars($currentUser) ?>
                                </p>
                                <p class="mb-1 small">
                                    <strong>Thời gian:</strong> <?= $currentDate ?>
                                </p>
                                <p class="mb-0 small">
                                    <strong>Session:</strong> 
                                    <span class="badge bg-success">Hoạt động</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="card shadow-sm border-0 mt-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-body text-center">
                            <h6 class="mb-3">
                                <i class="fas fa-credit-card me-1"></i>Phương Thức Thanh Toán
                            </h6>
                            <div class="payment-methods">
                                <img src="https://via.placeholder.com/60x40/007bff/ffffff?text=VISA" alt="Visa" class="me-2 mb-2 rounded">
                                <img src="https://via.placeholder.com/60x40/ff6b6b/ffffff?text=MC" alt="Mastercard" class="me-2 mb-2 rounded">
                                <img src="https://via.placeholder.com/60x40/4ecdc4/ffffff?text=PP" alt="PayPal" class="me-2 mb-2 rounded">
                                <img src="https://via.placeholder.com/60x40/f39c12/ffffff?text=COD" alt="COD" class="mb-2 rounded">
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-shield-alt me-1"></i>
                                Thanh toán được bảo mật 100%
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommended Products -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0" data-aos="fade-up">
                            <i class="fas fa-heart text-danger me-2"></i>Có Thể Bạn Quan Tâm
                        </h4>
                        <a href="/Product" class="btn btn-outline-primary btn-sm" data-aos="fade-up">
                            <i class="fas fa-eye me-1"></i>Xem tất cả
                        </a>
                    </div>
                    <div class="row">
                        <?php for ($i = 0; $i < 4; $i++): ?>
                            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= $i * 100 ?>">
                                <div class="card product-card h-100 border-0 shadow-sm">
                                    <div class="position-relative">
                                        <img src="https://via.placeholder.com/250x200/<?= ['3498db', 'e74c3c', '27ae60', 'f39c12'][$i] ?>/ffffff?text=Product+<?= $i + 1 ?>" 
                                             class="card-img-top" alt="Product <?= $i + 1 ?>">
                                        <span class="position-absolute top-0 end-0 badge bg-warning m-2">Mới</span>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">Sản Phẩm Đề Xuất <?= $i + 1 ?></h6>
                                        <p class="price text-primary fw-bold"><?= number_format(rand(500000, 2000000)) ?> ₫</p>
                                        <div class="d-grid">
                                            <button class="btn btn-outline-primary btn-sm" onclick="addToCart(<?= $i + 100 ?>)">
                                                <i class="fas fa-cart-plus me-1"></i>Thêm Vào Giỏ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- Empty Cart -->
            <div class="row">
                <div class="col-12">
                    <div class="text-center py-5" data-aos="fade-up">
                        <div class="empty-cart-icon mb-4">
                            <i class="fas fa-shopping-cart fa-5x text-muted"></i>
                        </div>
                        <h3 class="text-muted mb-3">Giỏ Hàng Trống</h3>
                        <p class="text-muted mb-4">
                            Chào <strong><?= htmlspecialchars($currentUser) ?></strong>! <br>
                            Hãy thêm những sản phẩm yêu thích vào giỏ hàng của bạn!
                        </p>
                        <a href="/Product" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-bag me-2"></i>Khám Phá Sản Phẩm
                        </a>
                        
                        <!-- Recently Viewed -->
                        <div class="mt-4">
                            <small class="text-muted">
                                <i class="fas fa-history me-1"></i>
                                Xem lại <a href="/Product/recent" class="text-decoration-none">sản phẩm đã xem</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
// Save cart for later
function saveCartForLater() {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Lưu giỏ hàng?',
            text: "Giỏ hàng sẽ được lưu để mua sau!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Lưu',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                localStorage.setItem('saved_cart', JSON.stringify({
                    cart: <?= json_encode($cart ?? []) ?>,
                    saved_date: new Date().toISOString(),
                    user: '<?= htmlspecialchars($currentUser) ?>'
                }));
                
                Swal.fire({
                    icon: 'success',
                    title: 'Đã lưu!',
                    text: 'Giỏ hàng đã được lưu thành công.',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    }
}

// Remove coupon
function removeCoupon() {
    fetch('/Product/removeCoupon', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: data.message
                });
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Cập nhật số lượng sản phẩm
function updateQuantity(productId, action) {
    const quantityInput = document.querySelector(`#quantity-${productId}`);
    if (!quantityInput) {
        console.error('Không tìm thấy input quantity cho product:', productId);
        return;
    }
    
    const currentQuantity = parseInt(quantityInput.value);
    let newQuantity;
    
    if (action === 'increase') {
        newQuantity = currentQuantity + 1;
    } else if (action === 'decrease') {
        newQuantity = currentQuantity - 1;
    } else {
        console.error('Action không hợp lệ:', action);
        return;
    }
    
    if (newQuantity < 1) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'warning',
                title: 'Số lượng không hợp lệ',
                text: 'Số lượng phải lớn hơn 0. Bạn có muốn xóa sản phẩm này?',
                showCancelButton: true,
                confirmButtonText: 'Xóa sản phẩm',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    removeFromCart(productId);
                }
            });
        } else {
            alert('Số lượng phải lớn hơn 0');
        }
        return;
    }
    
    quantityInput.disabled = true;
    updateCartQuantityAjax(productId, newQuantity);
}

// AJAX call để cập nhật số lượng
function updateCartQuantityAjax(productId, quantity) {
    fetch('/Product/updateCartQuantity', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `product_id=${productId}&quantity=${quantity}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Cập nhật UI
            const quantityInput = document.querySelector(`#quantity-${productId}`);
            const itemTotalElement = document.querySelector(`#item-total-${productId}`);
            const cartSubtotalElement = document.querySelector('#cart-subtotal');
            const cartTotalElement = document.querySelector('#cart-total');
            const cartCountElement = document.querySelector('#cartCount');
            
            if (quantityInput) quantityInput.value = quantity;
            if (itemTotalElement) itemTotalElement.textContent = data.data.item_total + ' ₫';
            if (cartSubtotalElement) cartSubtotalElement.textContent = data.data.cart_subtotal + ' ₫';
            if (cartTotalElement) cartTotalElement.textContent = data.data.cart_total + ' ₫';
            if (cartCountElement) cartCountElement.textContent = data.data.cart_count;
            
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                });
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
        console.error('Error:', error);
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Có lỗi xảy ra khi cập nhật giỏ hàng: ' + error.message
            });
        } else {
            alert('Có lỗi xảy ra khi cập nhật giỏ hàng');
        }
    })
    .finally(() => {
        const quantityInput = document.querySelector(`#quantity-${productId}`);
        if (quantityInput) quantityInput.disabled = false;
    });
}

// Xóa sản phẩm khỏi giỏ hàng
function removeFromCart(productId) {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Xóa sản phẩm?',
            text: "Sản phẩm sẽ bị xóa khỏi giỏ hàng!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                performRemoveFromCart(productId);
            }
        });
    } else {
        if (confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
            performRemoveFromCart(productId);
        }
    }
}

function performRemoveFromCart(productId) {
    fetch('/Product/removeFromCart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `product_id=${productId}`
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            const itemElement = document.querySelector(`#cart-item-${productId}`);
            if (itemElement) {
                itemElement.remove();
            }
            
            const cartSubtotalElement = document.querySelector('#cart-subtotal');
            const cartTotalElement = document.querySelector('#cart-total');
            const cartCountElement = document.querySelector('#cartCount');
            const cartItemsCountElement = document.querySelector('#cart-items-count');
            
            if (cartSubtotalElement) cartSubtotalElement.textContent = data.data.cart_subtotal + ' ₫';
            if (cartTotalElement) cartTotalElement.textContent = data.data.cart_total + ' ₫';
            if (cartCountElement) cartCountElement.textContent = data.data.cart_count;
            if (cartItemsCountElement) cartItemsCountElement.textContent = data.data.cart_count;
            
            if (data.data.is_empty) {
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }
            
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'Đã xóa!',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                });
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
        console.error('Error:', error);
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Có lỗi xảy ra khi xóa sản phẩm'
            });
        }
    });
}

// Xóa tất cả sản phẩm
function clearCart() {
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Xóa tất cả sản phẩm?',
            text: "Toàn bộ giỏ hàng sẽ bị xóa!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xóa tất cả',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                performClearCart();
            }
        });
    } else {
        if (confirm('Bạn có chắc muốn xóa tất cả sản phẩm?')) {
            performClearCart();
        }
    }
}

function performClearCart() {
    fetch('/Product/clearCart', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            window.location.reload();
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
        console.error('Error:', error);
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Có lỗi xảy ra khi xóa giỏ hàng'
            });
        }
    });
}

// Áp dụng mã giảm giá
function applyCoupon() {
    const couponCode = document.getElementById('couponCode').value.trim();
    
    if (!couponCode) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'warning',
                title: 'Thiếu mã giảm giá',
                text: 'Vui lòng nhập mã giảm giá'
            });
        } else {
            alert('Vui lòng nhập mã giảm giá');
        }
        return;
    }
    
    fetch('/Product/applyCoupon', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: `coupon_code=${encodeURIComponent(couponCode)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
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
        console.error('Error:', error);
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Có lỗi xảy ra khi áp dụng mã giảm giá'
            });
        }
    });
}

// Run debug on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('Cart page loaded - User: <?= htmlspecialchars($currentUser) ?>');
});
</script>

<style>
.quantity-control .form-label {
    margin-bottom: 0.25rem;
}

.item-actions {
    min-height: 80px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: end;
}

.customer-info {
    border-left: 4px solid var(--bs-primary);
}

.order-summary {
    font-size: 0.95rem;
}

.coupon-section {
    border: 1px dashed #dee2e6;
    border-radius: 8px;
    padding: 1rem;
    background: #f8f9fa;
}

/* Image styling for cart items */
.image-container {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    background: #f8f9fa;
    min-height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cart-product-image {
    transition: transform 0.3s ease;
    max-width: 100%;
    height: auto;
    display: block;
}

.cart-product-image:hover {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.image-container:hover .image-overlay {
    opacity: 1;
}

.product-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

/* Loading state for images */
.cart-product-image[src*="placeholder"] {
    background: linear-gradient(45deg, #f8f9fa 25%, transparent 25%, transparent 75%, #f8f9fa 75%, #f8f9fa), 
                linear-gradient(45deg, #f8f9fa 25%, transparent 25%, transparent 75%, #f8f9fa 75%, #f8f9fa);
    background-size: 20px 20px;
    background-position: 0 0, 10px 10px;
    border: 1px solid #dee2e6;
}

/* Cart item animations */
.cart-item {
    transition: all 0.3s ease;
}

.cart-item:hover {
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

/* Responsive adjustments */
@media print {
    .btn, .coupon-section, .card:last-child, nav {
        display: none !important;
    }
    
    .order-summary {
        border: 1px solid #000 !important;
    }
}

@media (max-width: 768px) {
    .item-actions {
        text-align: center !important;
        align-items: center;
        margin-top: 1rem;
    }
    
    .cart-item .row > div {
        margin-bottom: 0.5rem;
    }
    
    .image-container {
        min-height: 60px;
    }
    
    .cart-product-image {
        max-height: 60px !important;
    }
}

/* Enhanced visual feedback */
.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

/* Success/Error states */
.alert {
    border-radius: 10px;
    border: none;
}

.alert-success {
    background: linear-gradient(45deg, #d4edda, #c3e6cb);
}

.alert-warning {
    background: linear-gradient(45deg, #fff3cd, #ffeaa7);
}

.alert-info {
    background: linear-gradient(45deg, #d1ecf1, #bee5eb);
}
</style>

<?php include_once 'app/views/shares/footer.php'; ?>