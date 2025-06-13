<?php
$pageTitle = "Đăng Nhập";
require_once 'app/views/shares/header.php';
?>

<div class="min-vh-100 d-flex align-items-center py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card shadow-lg border-0" data-aos="fade-up">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="feature-icon mx-auto mb-3">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <h2 class="fw-bold text-dark">Đăng Nhập</h2>
                            <p class="text-muted">Chào mừng bạn quay trở lại TechTafu</p>
                        </div>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <?= htmlspecialchars($error) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="/account/checkLogin" method="POST" id="loginForm" novalidate>
                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">
                                    <i class="fas fa-user me-2 text-primary"></i>Tên đăng nhập
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="username" 
                                       name="username" 
                                       value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                                       placeholder="Nhập tên đăng nhập" 
                                       required
                                       autocomplete="username">
                                <div class="invalid-feedback">
                                    Vui lòng nhập tên đăng nhập
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">
                                    <i class="fas fa-lock me-2 text-primary"></i>Mật khẩu
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control form-control-lg" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Nhập mật khẩu" 
                                           required
                                           autocomplete="current-password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">
                                        Vui lòng nhập mật khẩu
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label text-muted" for="rememberMe">
                                        Ghi nhớ đăng nhập
                                    </label>
                                </div>
                                <a href="#" class="text-primary text-decoration-none" id="forgotPasswordLink">
                                    Quên mật khẩu?
                                </a>
                            </div>

                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sign-in-alt me-2"></i>Đăng Nhập
                                </button>
                            </div>

                            <div class="text-center mb-4">
                                <p class="text-muted">
                                    Chưa có tài khoản? 
                                    <a href="/account/register" class="text-primary text-decoration-none fw-semibold">
                                        Đăng ký ngay
                                    </a>
                                </p>
                            </div>

                            <hr class="my-4">

                            <!-- Social Login Options -->
                            <div class="text-center">
                                <p class="text-muted mb-3">Hoặc đăng nhập với</p>
                                <div class="d-flex justify-content-center gap-3">
                                    <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-4 social-btn" data-platform="Facebook">
                                        <i class="fab fa-facebook-f me-2"></i>Facebook
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-4 social-btn" data-platform="Google">
                                        <i class="fab fa-google me-2"></i>Google
                                    </button>
                                    <button type="button" class="btn btn-outline-info btn-sm rounded-pill px-4 social-btn" data-platform="Zalo">
                                        <i class="fas fa-phone me-2"></i>Zalo
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Demo Accounts -->
                        <div class="mt-4">
                            <div class="card bg-light border-0">
                                <div class="card-body p-3">
                                    <h6 class="text-muted mb-2">
                                        <i class="fas fa-info-circle me-2"></i>Tài khoản demo
                                    </h6>
                                    <div class="row">
                                        <div class="col-6">
                                            <button class="btn btn-outline-secondary btn-sm w-100 demo-btn" 
                                                    data-username="admin" data-password="123456">
                                                <i class="fas fa-shield-alt me-1"></i>Admin
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-outline-primary btn-sm w-100 demo-btn" 
                                                    data-username="user" data-password="123456">
                                                <i class="fas fa-user me-1"></i>User
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Access Cards -->
                <div class="row mt-4">
                    <div class="col-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card bg-transparent border-0 text-white text-center">
                            <div class="card-body p-2">
                                <i class="fas fa-shipping-fast fa-2x mb-2 text-warning"></i>
                                <small>Giao hàng nhanh</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card bg-transparent border-0 text-white text-center">
                            <div class="card-body p-2">
                                <i class="fas fa-medal fa-2x mb-2 text-success"></i>
                                <small>Chất lượng cao</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card bg-transparent border-0 text-white text-center">
                            <div class="card-body p-2">
                                <i class="fas fa-undo fa-2x mb-2 text-info"></i>
                                <small>Đổi trả dễ dàng</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.social-btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.social-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.social-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.social-btn:hover::before {
    left: 100%;
}

.demo-btn {
    transition: all 0.3s ease;
}

.demo-btn:hover {
    transform: scale(1.05);
}

.feature-icon {
    position: relative;
}

.feature-icon::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(52,152,219,0.1) 0%, transparent 70%);
    transform: translate(-50%, -50%);
    animation: pulse-ring 2s infinite;
}

@keyframes pulse-ring {
    0% {
        transform: translate(-50%, -50%) scale(0.8);
        opacity: 1;
    }
    100% {
        transform: translate(-50%, -50%) scale(1.2);
        opacity: 0;
    }
}
</style>

<script>
$(document).ready(function() {
    // Toggle password visibility
    $('#togglePassword').click(function() {
        const passwordField = $('#password');
        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        
        const icon = $(this).find('i');
        icon.toggleClass('fa-eye fa-eye-slash');
    });

    // Demo account buttons
    $('.demo-btn').click(function() {
        const username = $(this).data('username');
        const password = $(this).data('password');
        
        $('#username').val(username);
        $('#password').val(password);
        
        // Add highlight effect
        $(this).addClass('btn-success').removeClass('btn-outline-secondary btn-outline-primary');
        setTimeout(() => {
            $(this).removeClass('btn-success').addClass(
                username === 'admin' ? 'btn-outline-secondary' : 'btn-outline-primary'
            );
        }, 1000);
        
        Swal.fire({
            icon: 'info',
            title: 'Tài khoản demo',
            text: `Đã điền thông tin đăng nhập cho ${username === 'admin' ? 'Quản trị viên' : 'Người dùng'}`,
            timer: 1500,
            showConfirmButton: false
        });
    });

    // Form validation
    $('#loginForm').on('submit', function(e) {
        let isValid = true;
        
        // Validate username
        const username = $('#username').val().trim();
        if (!username) {
            $('#username').addClass('is-invalid');
            isValid = false;
        } else {
            $('#username').removeClass('is-invalid').addClass('is-valid');
        }

        // Validate password
        const password = $('#password').val().trim();
        if (!password) {
            $('#password').addClass('is-invalid');
            isValid = false;
        } else {
            $('#password').removeClass('is-invalid').addClass('is-valid');
        }

        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng điền đầy đủ thông tin đăng nhập!',
                confirmButtonColor: '#e74c3c'
            });
            return;
        }

        // Show loading
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...');
        submitBtn.prop('disabled', true);

        // Re-enable button after 3 seconds (in case of errors)
        setTimeout(() => {
            submitBtn.html(originalText);
            submitBtn.prop('disabled', false);
        }, 3000);
    });

    // Remove validation classes on input
    $('#username, #password').on('input', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Handle forgot password
    $('#forgotPasswordLink').click(function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Quên mật khẩu?',
            html: `
                <div class="text-start">
                    <p>Để khôi phục mật khẩu, vui lòng liên hệ với chúng tôi qua:</p>
                    <p><i class="fas fa-phone text-success me-2"></i>Hotline: <a href="tel:+84123456789">0123 456 789</a></p>
                    <p><i class="fas fa-envelope text-primary me-2"></i>Email: <a href="mailto:support@techtafu.com">support@techtafu.com</a></p>
                    <p><i class="fab fa-facebook text-info me-2"></i>Facebook: TechTafu Official</p>
                </div>
            `,
            icon: 'info',
            confirmButtonText: 'Đã hiểu',
            confirmButtonColor: '#3498db'
        });
    });

    // Handle social login (demo)
    $('.social-btn').click(function() {
        const platform = $(this).data('platform');
        Swal.fire({
            title: 'Tính năng đang phát triển',
            text: `Đăng nhập với ${platform} sẽ sớm được cập nhật!`,
            icon: 'info',
            confirmButtonText: 'Đã hiểu',
            confirmButtonColor: '#3498db'
        });
    });

    // Remember me functionality
    $('#rememberMe').change(function() {
        if ($(this).is(':checked')) {
            Swal.fire({
                icon: 'info',
                title: 'Ghi nhớ đăng nhập',
                text: 'Thông tin đăng nhập sẽ được lưu để lần đăng nhập tiếp theo thuận tiện hơn.',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });

    // Auto-focus first input
    $('#username').focus();

    // Enter key navigation
    $('#username').keypress(function(e) {
        if (e.which === 13) {
            $('#password').focus();
        }
    });

    $('#password').keypress(function(e) {
        if (e.which === 13) {
            $('#loginForm').submit();
        }
    });

    // Add animation to cards on hover
    $('.card:not(.bg-transparent)').hover(
        function() {
            $(this).addClass('shadow-lg').css('transform', 'translateY(-5px)');
        },
        function() {
            $(this).removeClass('shadow-lg').css('transform', 'translateY(0)');
        }
    );
});
</script>

<?php require_once 'app/views/shares/footer.php'; ?>    