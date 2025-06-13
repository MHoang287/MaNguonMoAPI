<?php 
$pageTitle = "Thanh Toán";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản Phẩm</a></li>
                <li class="breadcrumb-item"><a href="/Product/cart" class="text-decoration-none">Giỏ Hàng</a></li>
                <li class="breadcrumb-item active">Thanh Toán</li>
            </ol>
        </nav>

        <!-- Checkout Steps -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="checkout-steps" data-aos="fade-up">
                    <div class="d-flex justify-content-center">
                        <div class="step completed">
                            <div class="step-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <span>Giỏ Hàng</span>
                        </div>
                        <div class="step-line completed"></div>
                        <div class="step active">
                            <div class="step-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <span>Thông Tin</span>
                        </div>
                        <div class="step-line"></div>
                        <div class="step">
                            <div class="step-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <span>Thanh Toán</span>
                        </div>
                        <div class="step-line"></div>
                        <div class="step">
                            <div class="step-icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <span>Hoàn Tất</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="/Product/processCheckout" method="POST" id="checkoutForm">
            <div class="row">
                <!-- Billing Information -->
                <div class="col-lg-7">
                    <div class="card shadow-sm border-0 mb-4" data-aos="fade-right">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-user me-2"></i>Thông Tin Giao Hàng
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label fw-bold">
                                        <i class="fas fa-user me-1"></i>Họ và Tên *
                                    </label>
                                    <input type="text" class="form-control" id="name" name="name" required 
                                           placeholder="Nhập họ và tên đầy đủ...">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-bold">
                                        <i class="fas fa-phone me-1"></i>Số Điện Thoại *
                                    </label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required 
                                           placeholder="0123 456 789">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">
                                    <i class="fas fa-envelope me-1"></i>Email
                                </label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="example@email.com">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label fw-bold">
                                    <i class="fas fa-map-marker-alt me-1"></i>Địa Chỉ Giao Hàng *
                                </label>
                                <textarea class="form-control" id="address" name="address" rows="3" required 
                                          placeholder="Nhập địa chỉ chi tiết (số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố)..."></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="city" class="form-label fw-bold">Tỉnh/Thành Phố</label>
                                    <select class="form-select" id="city" name="city">
                                        <option value="">Chọn tỉnh/thành...</option>
                                        <option value="ho-chi-minh">TP. Hồ Chí Minh</option>
                                        <option value="ha-noi">Hà Nội</option>
                                        <option value="da-nang">Đà Nẵng</option>
                                        <option value="can-tho">Cần Thơ</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="district" class="form-label fw-bold">Quận/Huyện</label>
                                    <select class="form-select" id="district" name="district">
                                        <option value="">Chọn quận/huyện...</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="ward" class="form-label fw-bold">Phường/Xã</label>
                                    <select class="form-select" id="ward" name="ward">
                                        <option value="">Chọn phường/xã...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label fw-bold">
                                    <i class="fas fa-sticky-note me-1"></i>Ghi Chú Đơn Hàng
                                </label>
                                <textarea class="form-control" id="notes" name="notes" rows="2" 
                                          placeholder="Ghi chú đặc biệt cho đơn hàng (tùy chọn)..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card shadow-sm border-0" data-aos="fade-right" data-aos-delay="200">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-credit-card me-2"></i>Phương Thức Thanh Toán
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="payment-methods">
                                <div class="form-check payment-option mb-3 p-3 border rounded">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                                    <label class="form-check-label w-100" for="cod">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-money-bill-wave text-success me-2"></i>
                                                <strong>Thanh toán khi nhận hàng (COD)</strong>
                                                <p class="text-muted mb-0 small">Thanh toán bằng tiền mặt khi nhận hàng</p>
                                            </div>
                                            <img src="https://via.placeholder.com/50x30/28a745/ffffff?text=COD" alt="COD">
                                        </div>
                                    </label>
                                </div>

                                <div class="form-check payment-option mb-3 p-3 border rounded">
                                    <input class="form-check-input" type="radio" name="payment_method" id="bank_transfer" value="bank_transfer">
                                    <label class="form-check-label w-100" for="bank_transfer">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-university text-primary me-2"></i>
                                                <strong>Chuyển khoản ngân hàng</strong>
                                                <p class="text-muted mb-0 small">Chuyển khoản qua ATM hoặc Internet Banking</p>
                                            </div>
                                            <img src="https://via.placeholder.com/50x30/007bff/ffffff?text=BANK" alt="Bank">
                                        </div>
                                    </label>
                                </div>

                                <div class="form-check payment-option mb-3 p-3 border rounded">
                                    <input class="form-check-input" type="radio" name="payment_method" id="credit_card" value="credit_card">
                                    <label class="form-check-label w-100" for="credit_card">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-credit-card text-warning me-2"></i>
                                                <strong>Thẻ tín dụng/ghi nợ</strong>
                                                <p class="text-muted mb-0 small">Visa, Mastercard, JCB</p>
                                            </div>
                                            <div>
                                                <img src="https://via.placeholder.com/30x20/007bff/ffffff?text=V" alt="Visa" class="me-1">
                                                <img src="https://via.placeholder.com/30x20/ff6b6b/ffffff?text=M" alt="MC">
                                            </div>
                                        </div>
                                    </label>
                                </div>

                                <!-- Credit Card Details (Hidden by default) -->
                                <div id="creditCardDetails" class="credit-card-form d-none mt-3 p-3 bg-light rounded">
                                    <div class="row">
                                        <div class="col-md-8 mb-3">
                                            <label class="form-label">Số thẻ</label>
                                            <input type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">CVV</label>
                                            <input type="text" class="form-control" placeholder="123" maxlength="4">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tháng hết hạn</label>
                                            <select class="form-select">
                                                <option>01</option>
                                                <option>02</option>
                                                <!-- ... other months -->
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Năm hết hạn</label>
                                            <select class="form-select">
                                                <option>2024</option>
                                                <option>2025</option>
                                                <!-- ... other years -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="card shadow-sm border-0 sticky-top" data-aos="fade-left">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">
                                <i class="fas fa-receipt me-2"></i>Tóm Tắt Đơn Hàng
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Order Items -->
                            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                                <div class="order-items mb-4">
                                    <?php 
                                    $total = 0;
                                    foreach ($_SESSION['cart'] as $id => $item): 
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $total += $subtotal;
                                    ?>
                                        <div class="order-item d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                            <div class="d-flex align-items-center">
                                                <img src="<?= !empty($item['image']) ? $item['image'] : 'https://via.placeholder.com/60x50/f8f9fa/6c757d?text=No+Image' ?>" 
                                                     class="rounded me-3" style="width: 60px; height: 50px; object-fit: cover;" 
                                                     alt="<?= htmlspecialchars($item['name']) ?>">
                                                <div>
                                                    <h6 class="mb-1"><?= htmlspecialchars($item['name']) ?></h6>
                                                    <small class="text-muted">Số lượng: <?= $item['quantity'] ?></small>
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <p class="mb-0 fw-bold"><?= number_format($subtotal) ?> VNĐ</p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <!-- Order Totals -->
                                <div class="order-totals">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Tạm tính:</span>
                                        <span><?= number_format($total) ?> VNĐ</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Phí vận chuyển:</span>
                                        <span class="text-success">Miễn phí</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Thuế VAT (10%):</span>
                                        <span><?= number_format($total * 0.1) ?> VNĐ</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between mb-4">
                                        <span class="h5">Tổng cộng:</span>
                                        <span class="h5 text-primary fw-bold"><?= number_format($total * 1.1) ?> VNĐ</span>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Promo Code -->
                            <div class="promo-code mb-4">
                                <label class="form-label">Mã giảm giá</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Nhập mã giảm giá...">
                                    <button class="btn btn-outline-primary" type="button">
                                        <i class="fas fa-tag"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Terms and Conditions -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    Tôi đã đọc và đồng ý với 
                                    <a href="#" class="text-primary">Điều khoản sử dụng</a> và 
                                    <a href="#" class="text-primary">Chính sách bảo mật</a>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-lock me-2"></i>Xác Nhận Đặt Hàng
                                </button>
                                <a href="/Product/cart" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Quay Lại Giỏ Hàng
                                </a>
                            </div>

                            <!-- Security Info -->
                            <div class="security-info mt-4 p-3 bg-light rounded">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-shield-alt text-success me-2"></i>
                                    <small class="text-muted">
                                        Thông tin của bạn được bảo mật bằng SSL 256-bit
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<style>
.checkout-steps {
    max-width: 600px;
    margin: 0 auto;
}

.checkout-steps .d-flex {
    align-items: center;
}

.step {
    text-align: center;
    position: relative;
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #dee2e6;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.step.active .step-icon {
    background: #0d6efd;
    color: white;
}

.step.completed .step-icon {
    background: #198754;
    color: white;
}

.step-line {
    flex: 1;
    height: 2px;
    background: #dee2e6;
    margin: 0 20px;
    transition: all 0.3s ease;
}

.step-line.completed {
    background: #198754;
}

.payment-option {
    transition: all 0.3s ease;
    cursor: pointer;
}

.payment-option:hover {
    border-color: #0d6efd !important;
    background-color: #f8f9ff;
}

.payment-option .form-check-input:checked ~ .form-check-label {
    background-color: #f8f9ff;
}

.credit-card-form input {
    font-family: 'Courier New', monospace;
}
</style>

<script>
// Initialize Choices.js for select elements
const citySelect = new Choices('#city', {
    searchEnabled: true,
    placeholder: true,
    placeholderValue: 'Chọn tỉnh/thành...',
});

const districtSelect = new Choices('#district', {
    searchEnabled: true,
    placeholder: true,
    placeholderValue: 'Chọn quận/huyện...',
});

const wardSelect = new Choices('#ward', {
    searchEnabled: true,
    placeholder: true,
    placeholderValue: 'Chọn phường/xã...',
});

// Payment method change handler
document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const creditCardDetails = document.getElementById('creditCardDetails');
        if (this.value === 'credit_card') {
            creditCardDetails.classList.remove('d-none');
        } else {
            creditCardDetails.classList.add('d-none');
        }
    });
});

// Form validation
document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();
    const terms = document.getElementById('terms').checked;

    if (!name || !phone || !address) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Thiếu thông tin!',
            text: 'Vui lòng điền đầy đủ thông tin bắt buộc.',
        });
        return;
    }

    if (!terms) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Chưa đồng ý điều khoản!',
            text: 'Vui lòng đọc và đồng ý với điều khoản sử dụng.',
        });
        return;
    }

    // Show loading
    Swal.fire({
        title: 'Đang xử lý...',
        text: 'Vui lòng chờ trong giây lát',
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
});

// Phone number formatting
document.getElementById('phone').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 0) {
        if (value.length <= 4) {
            value = value;
        } else if (value.length <= 7) {
            value = value.slice(0, 4) + ' ' + value.slice(4);
        } else {
            value = value.slice(0, 4) + ' ' + value.slice(4, 7) + ' ' + value.slice(7, 10);
        }
    }
    e.target.value = value;
});

// Credit card number formatting
document.querySelector('input[placeholder="1234 5678 9012 3456"]')?.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
    e.target.value = value;
});

// Animate checkout steps
anime({
    targets: '.step.completed .step-icon',
    scale: [1, 1.2, 1],
    duration: 1000,
    easing: 'easeInOutQuad',
    delay: function(el, i) { return i * 200; }
});
</script>

<?php include_once 'app/views/shares/footer.php'; ?>