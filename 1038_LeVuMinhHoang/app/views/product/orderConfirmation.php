<?php 
$pageTitle = "Xác Nhận Đơn Hàng";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Success Animation -->
                <div class="text-center mb-5" data-aos="zoom-in">
                    <div class="success-animation">
                        <div class="checkmark-circle">
                            <div class="background"></div>
                            <div class="checkmark draw"></div>
                        </div>
                    </div>
                    <h1 class="text-success mt-4 mb-3">Đặt Hàng Thành Công!</h1>
                    <p class="lead text-muted">Cảm ơn bạn đã tin tưởng và mua sắm tại TechTafu</p>
                </div>

                <!-- Order Details Card -->
                <div class="card shadow-lg border-0" data-aos="fade-up">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-receipt me-2"></i>Chi Tiết Đơn Hàng
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Mã Đơn Hàng</h6>
                                <p class="h5 text-primary">#TF<?= date('Ymd') . rand(1000, 9999) ?></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted mb-2">Ngày Đặt Hàng</h6>
                                <p class="h6"><?= date('d/m/Y H:i') ?></p>
                            </div>
                        </div>

                        <div class="order-status mb-4">
                            <h6 class="mb-3">Trạng Thái Đơn Hàng</h6>
                            <div class="progress-steps">
                                <div class="step completed">
                                    <div class="step-icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span>Đã Đặt Hàng</span>
                                </div>
                                <div class="step-line"></div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <span>Đang Chuẩn Bị</span>
                                </div>
                                <div class="step-line"></div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <span>Đang Giao</span>
                                </div>
                                <div class="step-line"></div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <span>Đã Giao</span>
                                </div>
                            </div>
                        </div>

                        <div class="estimated-delivery p-3 bg-light rounded mb-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h6 class="mb-1">
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>Dự Kiến Giao Hàng
                                    </h6>
                                    <p class="mb-0 text-muted">
                                        <?= date('d/m/Y', strtotime('+3 days')) ?> - <?= date('d/m/Y', strtotime('+5 days')) ?>
                                    </p>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <span class="badge bg-warning fs-6">3-5 ngày làm việc</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="payment-info p-3 bg-light rounded">
                            <h6 class="mb-2">
                                <i class="fas fa-credit-card text-success me-2"></i>Phương Thức Thanh Toán
                            </h6>
                            <p class="mb-0">Thanh toán khi nhận hàng (COD)</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="/Product" class="btn btn-primary btn-lg">
                            <i class="fas fa-shopping-bag me-2"></i>Tiếp Tục Mua Sắm
                        </a>
                        <button class="btn btn-outline-secondary btn-lg" onclick="window.print()">
                            <i class="fas fa-print me-2"></i>In Đơn Hàng
                        </button>
                        <button class="btn btn-outline-info btn-lg" onclick="shareOrder()">
                            <i class="fas fa-share me-2"></i>Chia Sẻ
                        </button>
                    </div>
                </div>

                <!-- Customer Support -->
                <div class="card mt-4 border-0 bg-light" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-body text-center">
                        <h6 class="mb-3">
                            <i class="fas fa-headset text-primary me-2"></i>Cần Hỗ Trợ?
                        </h6>
                        <p class="text-muted mb-3">
                            Đội ngũ chăm sóc khách hàng của chúng tôi luôn sẵn sàng hỗ trợ bạn 24/7
                        </p>
                        <div class="contact-options">
                            <a href="tel:0123456789" class="btn btn-outline-primary me-2">
                                <i class="fas fa-phone me-1"></i>Gọi Ngay
                            </a>
                            <a href="mailto:support@techtafu.com" class="btn btn-outline-success me-2">
                                <i class="fas fa-envelope me-1"></i>Email
                            </a>
                            <a href="#" class="btn btn-outline-info">
                                <i class="fab fa-facebook-messenger me-1"></i>Chat
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Special Offers -->
                <div class="card mt-4 border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-body text-white text-center">
                        <h5 class="mb-3">
                            <i class="fas fa-gift me-2"></i>Ưu Đãi Đặc Biệt Cho Bạn!
                        </h5>
                        <p class="mb-3">Nhận ngay mã giảm giá 10% cho lần mua tiếp theo</p>
                        <div class="coupon-code bg-white text-dark p-3 rounded d-inline-block">
                            <code class="h5 mb-0">TECHTAFU10</code>
                        </div>
                        <p class="mt-3 mb-0 small">Mã có hiệu lực đến <?= date('d/m/Y', strtotime('+30 days')) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.success-animation {
    margin: 0 auto;
}

.checkmark-circle {
    width: 150px;
    height: 150px;
    position: relative;
    display: inline-block;
    vertical-align: top;
    margin: 0 auto;
}

.checkmark-circle .background {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: #28a745;
    position: absolute;
    animation: scale-in 0.3s ease-in-out 0.9s both;
}

.checkmark-circle .checkmark {
    border-radius: 5px;
    position: absolute;
    width: 60px;
    height: 30px;
    border-bottom: 6px solid #fff;
    border-left: 6px solid #fff;
    top: 50px;
    left: 45px;
    transform: rotate(-45deg);
    animation: checkmark-draw 0.5s ease-in-out 1.2s both;
}

@keyframes scale-in {
    0% { transform: scale(0); opacity: 0; }
    100% { transform: scale(1); opacity: 1; }
}

@keyframes checkmark-draw {
    0% { width: 0; height: 0; }
    25% { width: 0; height: 30px; }
    50% { width: 60px; height: 30px; }
    100% { width: 60px; height: 30px; }
}

.progress-steps {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: wrap;
}

.progress-steps .step {
    text-align: center;
    position: relative;
    flex: 1;
    max-width: 150px;
}

.progress-steps .step-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #dee2e6;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.progress-steps .step.completed .step-icon {
    background: #28a745;
    color: white;
}

.progress-steps .step-line {
    height: 2px;
    background: #dee2e6;
    flex: 1;
    margin: 0 10px;
    align-self: flex-start;
    margin-top: 20px;
}

.coupon-code {
    border: 2px dashed #6c757d;
    position: relative;
}

.coupon-code::before,
.coupon-code::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background: #667eea;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
}

.coupon-code::before {
    left: -10px;
}

.coupon-code::after {
    right: -10px;
}

@media print {
    .btn, .card:last-child, nav {
        display: none !important;
    }
}

@media (max-width: 768px) {
    .progress-steps {
        flex-direction: column;
        gap: 10px;
    }
    
    .progress-steps .step-line {
        display: none;
    }
    
    .d-flex.gap-3 {
        flex-direction: column;
        align-items: stretch;
    }
    
    .btn-lg {
        width: 100%;
        margin-bottom: 10px;
    }
}
</style>

<script>
// Animate progress steps
setTimeout(() => {
    anime({
        targets: '.progress-steps .step.completed .step-icon',
        scale: [1, 1.3, 1],
        duration: 800,
        easing: 'easeInOutQuad'
    });
}, 1500);

// Share order function
function shareOrder() {
    const orderCode = document.querySelector('.text-primary').textContent;
    const shareText = `🎉 Đã đặt hàng thành công tại TechTafu!\n📦 Mã đơn: ${orderCode}\n🚚 Dự kiến giao hàng: 3-5 ngày\n\n${window.location.href}`;
    
    if (navigator.share) {
        navigator.share({
            title: 'Đơn hàng TechTafu',
            text: shareText,
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(shareText).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Đã sao chép!',
                text: 'Thông tin đơn hàng đã được sao chép vào clipboard.',
                timer: 2000,
                showConfirmButton: false
            });
        });
    }
}

// Auto-refresh order status (simulation)
setInterval(() => {
    console.log('Checking order status...');
}, 30000);

// Animate elements on scroll
window.addEventListener('scroll', () => {
    const elements = document.querySelectorAll('[data-aos]');
    elements.forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            el.classList.add('aos-animate');
        }
    });
});

// Confetti effect
function createConfetti() {
    for (let i = 0; i < 50; i++) {
        const confetti = document.createElement('div');
        confetti.className = 'confetti';
        confetti.style.left = Math.random() * 100 + '%';
        confetti.style.animationDelay = Math.random() * 3 + 's';
        confetti.style.backgroundColor = ['#28a745', '#007bff', '#ffc107', '#dc3545', '#6f42c1'][Math.floor(Math.random() * 5)];
        document.body.appendChild(confetti);
        
        setTimeout(() => {
            confetti.remove();
        }, 3000);
    }
}

// Trigger confetti on page load
window.addEventListener('load', () => {
    setTimeout(createConfetti, 1000);
});

// Add celebration sound effect (optional)
function playCelebrationSound() {
    // You can add audio file here
    // const audio = new Audio('/assets/sounds/success.mp3');
    // audio.play().catch(e => console.log('Audio play failed:', e));
}

// Auto-hide success message after some time
setTimeout(() => {
    const successTitle = document.querySelector('h1.text-success');
    if (successTitle) {
        anime({
            targets: successTitle,
            scale: [1, 1.1, 1],
            duration: 1000,
            easing: 'easeInOutQuad'
        });
    }
}, 2000);
</script>

<style>
.confetti {
    position: fixed;
    top: -10px;
    width: 8px;
    height: 8px;
    background: #28a745;
    animation: confetti-fall 3s linear infinite;
    z-index: 1000;
}

@keyframes confetti-fall {
    0% {
        transform: translateY(-100vh) rotate(0deg);
        opacity: 1;
    }
    100% {
        transform: translateY(100vh) rotate(720deg);
        opacity: 0;
    }
}

/* Enhanced success animation */
.success-animation:hover .checkmark-circle {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

/* Smooth card animations */
.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

/* Progress steps responsive animation */
@media (max-width: 768px) {
    .progress-steps .step {
        margin-bottom: 15px;
        flex: none;
        width: 100%;
    }
    
    .progress-steps .step-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
}
</style>

<?php include_once 'app/views/shares/footer.php'; ?>