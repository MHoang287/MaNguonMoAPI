<?php
$pageTitle = "Sửa Thông Tin Người Dùng";
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
                    <li class="breadcrumb-item active">Sửa Thông Tin</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
                <div>
                    <h2 class="text-dark fw-bold mb-1">
                        <i class="fas fa-user-edit text-warning me-2"></i>Sửa Thông Tin Người Dùng
                    </h2>
                    <p class="text-muted mb-0">Cập nhật thông tin cho: <strong><?= htmlspecialchars($account->username) ?></strong></p>
                </div>
                <div>
                    <a href="/account/view?id=<?= $account->id ?>" class="btn btn-outline-info me-2">
                        <i class="fas fa-eye me-2"></i>Xem Chi Tiết
                    </a>
                    <a href="/account/admin" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Quay Lại
                    </a>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card border-0 shadow-lg" data-aos="fade-up">
                <div class="card-header bg-warning text-dark">
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

                    <form action="/account/update" method="POST" id="editUserForm" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $account->id ?>">
                        
                        <div class="row">
                            <!-- Current Avatar Display -->
                            <div class="col-md-3 mb-4">
                                <div class="text-center">
                                    <h6 class="text-primary fw-bold mb-3">Ảnh Đại Diện Hiện Tại</h6>
                                    <div class="current-avatar-container mb-3">
                                        <?php if ($account->avatar && file_exists($account->avatar)): ?>
                                            <img src="/<?= htmlspecialchars($account->avatar) ?>" 
                                                 class="img-thumbnail rounded-circle" 
                                                 style="width: 150px; height: 150px; object-fit: cover;" 
                                                 alt="Avatar hiện tại">
                                        <?php else: ?>
                                            <div class="user-avatar mx-auto" style="width: 150px; height: 150px; font-size: 3rem;">
                                                <?= strtoupper(substr($account->username, 0, 1)) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="avatar" class="form-label fw-semibold">Đổi Ảnh Đại Diện</label>
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
                                    <div id="avatarPreview" class="mt-3" style="display: none;">
                                        <h6 class="text-success">Ảnh Mới:</h6>
                                        <img id="previewImage" src="" class="img-thumbnail rounded-circle" 
                                             style="width: 120px; height: 120px; object-fit: cover;">
                                    </div>
                                </div>
                            </div>

                            <!-- Form Fields -->
                            <div class="col-md-9">
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
                                                   value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : htmlspecialchars($account->username) ?>"
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
                                                   value="<?= isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : htmlspecialchars($account->fullname) ?>"
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
                                                <option value="user" <?= (isset($_POST['role']) ? ($_POST['role'] === 'user' ? 'selected' : '') : ($account->role === 'user' ? 'selected' : '')) ?>>
                                                    Người dùng
                                                </option>
                                                <option value="admin" <?= (isset($_POST['role']) ? ($_POST['role'] === 'admin' ? 'selected' : '') : ($account->role === 'admin' ? 'selected' : '')) ?>>
                                                    Quản trị viên
                                                </option>
                                            </select>
                                            <?php if (isset($errors['role'])): ?>
                                                <div class="invalid-feedback">
                                                    <?= htmlspecialchars($errors['role']) ?>
                                                </div>
                                            <?php endif; ?>
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

                                        <!-- Additional Info -->
                                        <div class="card bg-light border-0 mt-4">
                                            <div class="card-body p-3">
                                                <h6 class="text-muted mb-2">
                                                    <i class="fas fa-info-circle me-2"></i>Thông Tin Bổ Sung
                                                </h6>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <small class="text-muted">ID:</small><br>
                                                        <strong><?= $account->id ?></strong>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted">Ngày tạo:</small><br>
                                                        <strong><?= isset($account->created_at) ? date('d/m/Y H:i', strtotime($account->created_at)) : 'N/A' ?></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="/account/admin" class="btn btn-outline-secondary btn-lg me-2">
                                    <i class="fas fa-times me-2"></i>Hủy
                                </a>
                                <button type="button" class="btn btn-outline-warning btn-lg" onclick="changePassword(<?= $account->id ?>)">
                                    <i class="fas fa-key me-2"></i>Đổi Mật Khẩu
                                </button>
                            </div>
                            <button type="submit" class="btn btn-warning btn-lg">
                                <i class="fas fa-save me-2"></i>Cập Nhật
                            </button>
                        </div>
                    </form>
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
            <form id="changePasswordForm" action="/account/changePassword" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="userId" name="id">
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

    // Toggle password visibility in modal
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

    // Initialize Choices.js for role select
    if (typeof Choices !== 'undefined') {
        const roleSelect = new Choices('#role', {
            searchEnabled: false,
            itemSelectText: 'Chọn vai trò'
        });
    }

    // Form validation
    $('#editUserForm').on('submit', function(e) {
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
        const newPassword = $('#newPassword').val();
        const confirmPassword = $('#confirmNewPassword').val();

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

        // Show loading
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...');
        submitBtn.prop('disabled', true);
    });

    // Remove validation classes on input
    $('#username, #fullname, #phone, #email, #role').on('input change', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Auto-focus first input
    $('#username').focus();
});

function changePassword(userId) {
    $('#userId').val(userId);
    $('#newPassword').val('');
    $('#confirmNewPassword').val('');
    $('#changePasswordModal').modal('show');
}
</script>

<?php require_once 'app/views/shares/footer.php'; ?>