<?php
$pageTitle = "Thông Tin Cá Nhân";
require_once 'app/views/shares/header.php';
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="text-dark fw-bold mb-2">
                    <i class="fas fa-user-circle text-primary me-2"></i>Thông Tin Cá Nhân
                </h2>
                <p class="text-muted">Quản lý và cập nhật thông tin tài khoản của bạn</p>
            </div>

            <div class="row">
                <!-- Profile Card -->
                <div class="col-lg-4 mb-4" data-aos="fade-right">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body text-center p-4">
                            <!-- Avatar -->
                            <div class="mb-4">
                                <?php if ($account->avatar && file_exists($account->avatar)): ?>
                                    <img src="/<?= htmlspecialchars($account->avatar) ?>" 
                                         class="rounded-circle border border-3 border-primary shadow" 
                                         style="width: 150px; height: 150px; object-fit: cover;" 
                                         alt="Avatar">
                                <?php else: ?>
                                    <div class="user-avatar mx-auto border border-3 border-primary shadow" 
                                         style="width: 150px; height: 150px; font-size: 4rem;">
                                        <?= strtoupper(substr($account->username, 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- User Info -->
                            <h4 class="fw-bold text-dark mb-2"><?= htmlspecialchars($account->fullname) ?></h4>
                            <p class="text-muted mb-3">@<?= htmlspecialchars($account->username) ?></p>
                            
                            <?php if ($account->role === 'admin'): ?>
                                <span class="badge bg-danger fs-6 px-3 py-2 mb-3">
                                    <i class="fas fa-shield-alt me-2"></i>Quản Trị Viên
                                </span>
                            <?php else: ?>
                                <span class="badge bg-primary fs-6 px-3 py-2 mb-3">
                                    <i class="fas fa-user me-2"></i>Người Dùng
                                </span>
                            <?php endif; ?>

                            <!-- Quick Stats -->
                            <div class="row mt-4">
                                <div class="col-4">
                                    <div class="stats-mini">
                                        <h5 class="mb-0 text-primary">0</h5>
                                        <small class="text-muted">Đơn hàng</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stats-mini">
                                        <h5 class="mb-0 text-success">0</h5>
                                        <small class="text-muted">Yêu thích</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stats-mini">
                                        <h5 class="mb-0 text-warning">0</h5>
                                        <small class="text-muted">Điểm</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 mt-4">
                                <button class="btn btn-outline-warning" onclick="showChangePasswordModal()">
                                    <i class="fas fa-key me-2"></i>Đổi Mật Khẩu
                                </button>
                                <a href="/account/orders" class="btn btn-outline-primary">
                                    <i class="fas fa-shopping-bag me-2"></i>Đơn Hàng Của Tôi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Update Form -->
                <div class="col-lg-8" data-aos="fade-left">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-edit me-2"></i>Cập Nhật Thông Tin
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

                            <form action="/account/updateProfile" method="POST" id="profileForm" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- Basic Information -->
                                    <div class="col-md-6">
                                        <h6 class="text-primary fw-bold mb-3">
                                            <i class="fas fa-user me-2"></i>Thông Tin Cơ Bản
                                        </h6>

                                        <div class="mb-3">
                                            <label for="fullname" class="form-label fw-semibold">
                                                Họ và tên <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" 
                                                   class="form-control <?= isset($errors['fullname']) ? 'is-invalid' : '' ?>" 
                                                   id="fullname" 
                                                   name="fullname" 
                                                   value="<?= isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : htmlspecialchars($account->fullname) ?>"
                                                   required>
                                            <?php if (isset($errors['fullname'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($errors['fullname']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone" class="form-label fw-semibold">Số điện thoại</label>
                                            <input type="tel" 
                                                   class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" 
                                                   id="phone" 
                                                   name="phone" 
                                                   value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : htmlspecialchars($account->phone ?? '') ?>"
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
                                                   value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($account->email ?? '') ?>"
                                                   placeholder="Nhập địa chỉ email">
                                            <?php if (isset($errors['email'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($errors['email']) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Avatar & Additional Info -->
                                    <div class="col-md-6">
                                        <h6 class="text-primary fw-bold mb-3">
                                            <i class="fas fa-camera me-2"></i>Ảnh Đại Diện
                                        </h6>

                                        <div class="mb-3">
                                            <label for="avatar" class="form-label fw-semibold">Đổi ảnh đại diện</label>
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
                                            <div class="form-text">JPG, PNG, GIF tối đa 2MB</div>
                                        </div>

                                        <!-- Preview area -->
                                        <div id="avatarPreview" class="mb-3" style="display: none;">
                                            <h6 class="text-success">Ảnh mới:</h6>
                                            <img id="previewImage" src="" class="img-thumbnail rounded-circle" 
                                                 style="width: 100px; height: 100px; object-fit: cover;">
                                        </div>

                                        <!-- Account Info -->
                                        <div class="card bg-light border-0 mt-4">
                                            <div class="card-body p-3">
                                                <h6 class="text-muted mb-3">
                                                    <i class="fas fa-info-circle me-2"></i>Thông Tin Tài Khoản
                                                </h6>
                                                <div class="row">
                                                    <div class="col-12 mb-2">
                                                        <small class="text-muted">Tên đăng nhập:</small><br>
                                                        <strong><?= htmlspecialchars($account->username) ?></strong>
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <small class="text-muted">Ngày tham gia:</small><br>
                                                        <strong><?= isset($account->created_at) ? date('d/m/Y', strtotime($account->created_at)) : 'N/A' ?></strong>
                                                    </div>
                                                    <div class="col-12">
                                                        <small class="text-muted">ID:</small><br>
                                                        <strong><?= $account->id ?></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Action Buttons -->
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-outline-secondary me-2" onclick="resetForm()">
                                        <i class="fas fa-undo me-2"></i>Khôi Phục
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Cập Nhật
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Additional Options -->
                    <div class="card border-0 shadow-sm mt-4" data-aos="fade-up">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-cogs me-2"></i>Tùy Chọn Khác
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="/account/orders" class="text-decoration-none">
                                        <div class="text-center p-3 border rounded hover-shadow">
                                            <i class="fas fa-shopping-bag fa-2x text-primary mb-2"></i>
                                            <h6 class="mb-0">Đơn Hàng</h6>
                                            <small class="text-muted">Xem lịch sử mua hàng</small>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="/account/wishlist" class="text-decoration-none">
                                        <div class="text-center p-3 border rounded hover-shadow">
                                            <i class="fas fa-heart fa-2x text-danger mb-2"></i>
                                            <h6 class="mb-0">Yêu Thích</h6>
                                            <small class="text-muted">Sản phẩm đã lưu</small>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="/account/addresses" class="text-decoration-none">
                                        <div class="text-center p-3 border rounded hover-shadow">
                                            <i class="fas fa-map-marker-alt fa-2x text-success mb-2"></i>
                                            <h6 class="mb-0">Địa Chỉ</h6>
                                            <small class="text-muted">Quản lý địa chỉ giao hàng</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-key text-warning me-2"></i>Đổi Mật Khẩu
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="changePasswordForm" action="/account/changeMyPassword" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Mật khẩu mới</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="newPassword" name="new_password" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Xác nhận mật khẩu mới</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmNewPassword" name="confirm_password" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmNewPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key me-2"></i>Đổi Mật Khẩu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.hover-shadow {
    transition: all 0.3s ease;
    cursor: pointer;
}

.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.stats-mini {
    padding: 10px;
    border-radius: 10px;
    background: rgba(255,255,255,0.1);
}
</style>

<script>
    $(document).ready(function() {
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

    // Toggle password visibility
    $('#toggleCurrentPassword').click(function() {
        const passwordField = $('#currentPassword');
        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        
        const icon = $(this).find('i');
        icon.toggleClass('fa-eye fa-eye-slash');
    });

    $('#toggleNewPassword').click(function() {
        const passwordField = $('#newPassword');
        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        
        const icon = $(this).find('i');
        icon.toggleClass('fa-eye fa-eye-slash');
    });

    $('#toggleConfirmNewPassword').click(function() {
        const passwordField = $('#confirmNewPassword');
        const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        
        const icon = $(this).find('i');
        icon.toggleClass('fa-eye fa-eye-slash');
    });

    // Profile form validation
    $('#profileForm').on('submit', function(e) {
        const fullname = $('#fullname').val().trim();

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

        // Show loading
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Đang cập nhật...');
        submitBtn.prop('disabled', true);

        // Re-enable button after 3 seconds (in case of errors)
        setTimeout(() => {
            submitBtn.html(originalText);
            submitBtn.prop('disabled', false);
        }, 3000);
    });

    // Change password form validation
    $('#changePasswordForm').on('submit', function(e) {
        const currentPassword = $('#currentPassword').val();
        const newPassword = $('#newPassword').val();
        const confirmPassword = $('#confirmNewPassword').val();

        if (!currentPassword) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng nhập mật khẩu hiện tại!'
            });
            return;
        }

        if (newPassword !== confirmPassword) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Mật khẩu xác nhận không khớp!'
            });
            return;
        }

        if (newPassword.length < 6) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Mật khẩu phải có ít nhất 6 ký tự!'
            });
            return;
        }

        if (currentPassword === newPassword) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Thông báo',
                text: 'Mật khẩu mới phải khác mật khẩu hiện tại!'
            });
            return;
        }

        // Show loading
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...');
        submitBtn.prop('disabled', true);
    });

    // Remove validation classes on input
    $('#fullname, #phone, #email').on('input', function() {
        $(this).removeClass('is-invalid is-valid');
    });
});

function showChangePasswordModal() {
    $('#currentPassword').val('');
    $('#newPassword').val('');
    $('#confirmNewPassword').val('');
    $('#changePasswordModal').modal('show');
}

function resetForm() {
    Swal.fire({
        title: 'Xác nhận khôi phục',
        text: 'Bạn có chắc chắn muốn khôi phục về thông tin ban đầu?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3498db',
        cancelButtonColor: '#95a5a6',
        confirmButtonText: 'Khôi phục',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            location.reload();
        }
    });
}
</script>

<?php require_once 'app/views/shares/footer.php'; ?>