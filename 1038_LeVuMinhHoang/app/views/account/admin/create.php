<?php
$pageTitle = "Thêm Người Dùng";
require_once 'app/views/shares/header.php';
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/account/admin" class="text-decoration-none">
                            <i class="fas fa-users me-1"></i>Quản Lý Người Dùng
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Thêm Người Dùng</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
                <div>
                    <h2 class="text-dark fw-bold mb-1">
                        <i class="fas fa-user-plus text-primary me-2"></i>Thêm Người Dùng Mới
                    </h2>
                    <p class="text-muted mb-0">Tạo tài khoản mới cho người dùng trong hệ thống</p>
                </div>
                <a href="/account/admin" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Quay Lại
                </a>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-lg" data-aos="fade-up">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>Thông Tin Người Dùng
                    </h5>
                </div>
                <div class="card-body p-4">
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

                    <form action="/account/store" method="POST" id="createUserForm" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-md-6">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-user me-2"></i>Thông Tin Cơ Bản
                                </h6>

                                <div class="mb-3">
                                    <label for="username" class="form-label fw-semibold">
                                        Tên đăng nhập <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>" 
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
                                    <div class="form-text">3-20 ký tự, chỉ chứa chữ cái, số và dấu gạch dưới</div>
                                </div>

                                <div class="mb-3">
                                    <label for="fullname" class="form-label fw-semibold">
                                        Họ và tên <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control <?= isset($errors['fullname']) ? 'is-invalid' : '' ?>" 
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

                                <div class="mb-3">
                                    <label for="role" class="form-label fw-semibold">
                                        Vai trò <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select <?= isset($errors['role']) ? 'is-invalid' : '' ?>" 
                                            id="role" name="role" required>
                                        <option value="">Chọn vai trò</option>
                                        <option value="user" <?= (isset($_POST['role']) && $_POST['role'] === 'user') ? 'selected' : '' ?>>
                                            Người dùng
                                        </option>
                                        <option value="admin" <?= (isset($_POST['role']) && $_POST['role'] === 'admin') ? 'selected' : '' ?>>
                                            Quản trị viên
                                        </option>
                                    </select>
                                    <?php if (isset($errors['role'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errors['role']) ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label for="avatar" class="form-label fw-semibold">Ảnh đại diện</label>
                                    <input type="file" 
                                           class="form-control <?= isset($errors['avatar']) ? 'is-invalid' : '' ?>" 
                                           id="avatar" 
                                           name="avatar" 
                                           accept="image/*">
                                    <?php if (isset($errors['avatar'])): ?>
                                        <div class="invalid-feedback">
                                            <?= htmlspecialchars($errors['avatar']) ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-text">Chọn file ảnh (JPG, PNG, GIF) không quá 2MB</div>
                                    
                                    <!-- Preview area -->
                                    <div id="avatarPreview" class="mt-3" style="display: none;">
                                        <img id="previewImage" src="" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                            <div class="col-md-6">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-address-book me-2"></i>Thông Tin Liên Hệ
                                </h6>

                                <div class="mb-3">
                                    <label for="phone" class="form-label fw-semibold">Số điện thoại</label>
                                    <input type="tel" 
                                           class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" 
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

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input type="email" 
                                           class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
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

                                <h6 class="text-primary fw-bold mb-3 mt-4">
                                    <i class="fas fa-lock me-2"></i>Mật Khẩu
                                </h6>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">
                                        Mật khẩu <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" 
                                               class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" 
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
                                    <div class="form-text">Mật khẩu phải có ít nhất 6 ký tự</div>
                                </div>

                                <div class="mb-3">
                                    <label for="confirmpassword" class="form-label fw-semibold">
                                        Xác nhận mật khẩu <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" 
                                               class="form-control <?= isset($errors['confirmPass']) ? 'is-invalid' : '' ?>" 
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
                        </div>

                        <hr class="my-4">

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="/account/admin" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-times me-2"></i>Hủy
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Tạo Tài Khoản
                            </button>
                        </div>
                    </form>
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

    // Initialize Choices.js for role select
    if (typeof Choices !== 'undefined') {
        const roleSelect = new Choices('#role', {
            searchEnabled: false,
            itemSelectText: 'Chọn vai trò'
        });
    }

    // Form validation
    $('#createUserForm').on('submit', function(e) {
        const password = $('#password').val();
        const confirmPassword = $('#confirmpassword').val();
        const username = $('#username').val().trim();
        const fullname = $('#fullname').val().trim();
        const role = $('#role').val();

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

        if (!role) {
            e.preventDefault();
            $('#role').addClass('is-invalid');
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng chọn vai trò!'
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
    $('#username, #fullname, #password, #phone, #email, #role').on('input change', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Auto-focus first input
    $('#username').focus();
});
</script>

<?php require_once 'app/views/shares/footer.php'; ?>