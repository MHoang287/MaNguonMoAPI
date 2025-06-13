<?php
$pageTitle = "Đăng Ký Tài Khoản";
require_once 'app/views/shares/header.php';
?>

<div class="min-vh-100 d-flex align-items-center py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0" data-aos="fade-up">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="feature-icon mx-auto mb-3">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <h2 class="fw-bold text-dark">Đăng Ký Tài Khoản</h2>
                            <p class="text-muted">Tạo tài khoản để trải nghiệm mua sắm tuyệt vời</p>
                        </div>

                        <?php if (isset($errors) && count($errors) > 0): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Có lỗi xảy ra:</strong>
                                <ul class="mb-0 mt-2">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="/account/save" method="POST" id="registerForm" novalidate enctype="multipart/form-data">
                            <!-- Hidden role field - default to user -->
                            <input type="hidden" name="role" value="user">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label fw-semibold">
                                        <i class="fas fa-user me-2 text-primary"></i>Tên đăng nhập <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg <?= isset($errors['username']) ? 'is-invalid' : '' ?>" 
                                           id="username" 
                                           name="username" 
                                           value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                                           placeholder="Nhập tên đăng nhập" 
                                           required>
                                    <?php if (isset($errors['username'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errors['username']) ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-text">
                                        <small class="text-muted">3-20 ký tự, chỉ chứa chữ cái, số và dấu gạch dưới</small>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="fullname" class="form-label fw-semibold">
                                        <i class="fas fa-id-card me-2 text-primary"></i>Họ và tên <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg <?= isset($errors['fullname']) ? 'is-invalid' : '' ?>" 
                                           id="fullname" 
                                           name="fullname" 
                                           value="<?= isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : '' ?>"
                                           placeholder="Nhập họ và tên đầy đủ" 
                                           required>
                                    <?php if (isset($errors['fullname'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errors['fullname']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-semibold">
                                        <i class="fas fa-phone me-2 text-primary"></i>Số điện thoại
                                    </label>
                                    <input type="tel" 
                                           class="form-control form-control-lg <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" 
                                           id="phone" 
                                           name="phone" 
                                           value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>"
                                           placeholder="Nhập số điện thoại">
                                    <?php if (isset($errors['phone'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errors['phone']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-semibold">
                                        <i class="fas fa-envelope me-2 text-primary"></i>Email
                                    </label>
                                    <input type="email" 
                                           class="form-control form-control-lg <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                                           id="email" 
                                           name="email" 
                                           value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"
                                           placeholder="Nhập địa chỉ email">
                                    <?php if (isset($errors['email'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errors['email']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="avatar" class="form-label fw-semibold">
                                    <i class="fas fa-camera me-2 text-primary"></i>Ảnh đại diện
                                </label>
                                <input type="file" 
                                       class="form-control form-control-lg <?= isset($errors['avatar']) ? 'is-invalid' : '' ?>" 
                                       id="avatar" 
                                       name="avatar" 
                                       accept="image/*">
                                <?php if (isset($errors['avatar'])): ?>
                                    <div class="invalid-feedback">
                                        <?= htmlspecialchars($errors['avatar']) ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-text">
                                    <small class="text-muted">Chọn file ảnh (JPG, PNG, GIF) không quá 2MB</small>
                                </div>
                                <!-- Preview area -->
                                <div id="avatarPreview" class="mt-2" style="display: none;">
                                    <img id="previewImage" src="" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold">
                                        <i class="fas fa-lock me-2 text-primary"></i>Mật khẩu <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" 
                                               class="form-control form-control-lg <?= isset($errors['password']) ? 'is-invalid' : '' ?>" 
                                               id="password" 
                                               name="password" 
                                               placeholder="Nhập mật khẩu" 
                                               required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <?php if (isset($errors['password'])): ?>
                                            <div class="invalid-feedback">
                                                <?= htmlspecialchars($errors['password']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-text">
                                        <small class="text-muted">Mật khẩu phải có ít nhất 6 ký tự</small>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="confirmpassword" class="form-label fw-semibold">
                                        <i class="fas fa-lock me-2 text-primary"></i>Xác nhận mật khẩu <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" 
                                               class="form-control form-control-lg <?= isset($errors['confirmPass']) ? 'is-invalid' : '' ?>" 
                                               id="confirmpassword" 
                                               name="confirmpassword" 
                                               placeholder="Nhập lại mật khẩu" 
                                               required>
                                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <?php if (isset($errors['confirmPass'])): ?>
                                            <div class="invalid-feedback">
                                                <?= htmlspecialchars($errors['confirmPass']) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                    <label class="form-check-label" for="agreeTerms">
                                        Tôi đồng ý với <a href="#" class="text-primary">Điều khoản dịch vụ</a> 
                                        và <a href="#" class="text-primary">Chính sách bảo mật</a>
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-user-plus me-2"></i>Đăng Ký Tài Khoản
                                </button>
                            </div>

                            <div class="text-center">
                                <p class="text-muted">
                                    Đã có tài khoản? 
                                    <a href="/account/login" class="text-primary text-decoration-none fw-semibold">
                                        Đăng nhập ngay
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Additional Info Cards -->
                <div class="row mt-4">
                    <div class="col-md-4 mb-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="card bg-transparent border-0 text-white text-center">
                            <div class="card-body">
                                <i class="fas fa-shield-alt fa-2x mb-2 text-warning"></i>
                                <h6>Bảo mật cao</h6>
                                <small>Thông tin được mã hóa an toàn</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3" data-aos="fade-up" data-aos-delay="200">
                        <div class="card bg-transparent border-0 text-white text-center">
                            <div class="card-body">
                                <i class="fas fa-gift fa-2x mb-2 text-success"></i>
                                <h6>Ưu đãi đặc biệt</h6>
                                <small>Nhận ngay voucher 100K</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3" data-aos="fade-up" data-aos-delay="300">
                        <div class="card bg-transparent border-0 text-white text-center">
                            <div class="card-body">
                                <i class="fas fa-headset fa-2x mb-2 text-info"></i>
                                <h6>Hỗ trợ 24/7</h6>
                                <small>Luôn sẵn sàng hỗ trợ bạn</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

    $('#toggleConfirmPassword').click(function() {
        const passwordField = $('#confirmpassword');
        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        
        const icon = $(this).find('i');
        icon.toggleClass('fa-eye fa-eye-slash');
    });

    // Avatar preview
    $('#avatar').on('change', function() {
        const file = this.files[0];
        if (file) {
            // Check file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Kích thước file không được vượt quá 2MB!'
                });
                $(this).val('');
                $('#avatarPreview').hide();
                return;
            }

            // Check file type
            if (!file.type.match('image.*')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Chỉ cho phép upload file ảnh!'
                });
                $(this).val('');
                $('#avatarPreview').hide();
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
                $('#avatarPreview').show();
            };
            reader.readAsDataURL(file);
        } else {
            $('#avatarPreview').hide();
        }
    });

    // Form validation
    $('#registerForm').on('submit', function(e) {
        const password = $('#password').val();
        const confirmPassword = $('#confirmpassword').val();
        const agreeTerms = $('#agreeTerms').is(':checked');
        const username = $('#username').val().trim();
        const fullname = $('#fullname').val().trim();

        // Validate required fields
        if (!username) {
            e.preventDefault();
            $('#username').addClass('is-invalid');
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng nhập tên đăng nhập!'
            });
            return;
        }

        if (!fullname) {
            e.preventDefault();
            $('#fullname').addClass('is-invalid');
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng nhập họ và tên!'
            });
            return;
        }

        if (!agreeTerms) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Thông báo',
                text: 'Bạn cần đồng ý với điều khoản dịch vụ để tiếp tục!'
            });
            return;
        }

        if (password !== confirmPassword) {
            e.preventDefault();
            $('#confirmpassword').addClass('is-invalid');
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Mật khẩu xác nhận không khớp!'
            });
            return;
        }

        if (password.length < 6) {
            e.preventDefault();
            $('#password').addClass('is-invalid');
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Mật khẩu phải có ít nhất 6 ký tự!'
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

    // Real-time password confirmation validation
    $('#confirmpassword').on('input', function() {
        const password = $('#password').val();
        const confirmPassword = $(this).val();
        
        if (confirmPassword && password !== confirmPassword) {
            $(this).addClass('is-invalid').removeClass('is-valid');
        } else if (confirmPassword && password === confirmPassword) {
            $(this).addClass('is-valid').removeClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid is-valid');
        }
    });

    // Remove validation classes on input
    $('#username, #fullname, #password, #phone, #email').on('input', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Auto-focus first input
    $('#username').focus();
});
</script>

<?php require_once 'app/views/shares/footer.php'; ?>