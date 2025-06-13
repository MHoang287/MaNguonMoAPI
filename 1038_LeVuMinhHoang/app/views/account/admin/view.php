<?php
$pageTitle = "Chi Tiết Người Dùng";
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
                    <li class="breadcrumb-item active">Chi Tiết Người Dùng</li>
                </ol>
            </nav>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
                <div>
                    <h2 class="text-dark fw-bold mb-1">
                        <i class="fas fa-user-circle text-info me-2"></i>Chi Tiết Người Dùng
                    </h2>
                    <p class="text-muted mb-0">Thông tin chi tiết của: <strong><?= htmlspecialchars($account->username) ?></strong></p>
                </div>
                <div>
                    <a href="/account/edit?id=<?= $account->id ?>" class="btn btn-warning me-2">
                        <i class="fas fa-edit me-2"></i>Sửa Thông Tin
                    </a>
                    <a href="/account/admin" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Quay Lại
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- User Profile Card -->
                <div class="col-lg-4 mb-4" data-aos="fade-up">
                    <div class="card border-0 shadow-lg">
                        <div class="card-body text-center p-4">
                            <!-- Avatar -->
                            <div class="mb-4">
                                <?php if ($account->avatar && file_exists($account->avatar)): ?>
                                    <img src="/<?= htmlspecialchars($account->avatar) ?>" 
                                         class="rounded-circle border border-3 border-light shadow" 
                                         style="width: 150px; height: 150px; object-fit: cover;" 
                                         alt="Avatar">
                                <?php else: ?>
                                    <div class="user-avatar mx-auto border border-3 border-light shadow" 
                                         style="width: 150px; height: 150px; font-size: 4rem;">
                                        <?= strtoupper(substr($account->username, 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- User Name & Role -->
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

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 mt-4">
                                <button class="btn btn-outline-warning" onclick="changePassword(<?= $account->id ?>)">
                                    <i class="fas fa-key me-2"></i>Đổi Mật Khẩu
                                </button>
                                <?php if ($account->username !== $_SESSION['username']): ?>
                                    <button class="btn btn-outline-danger" 
                                            onclick="deleteUser(<?= $account->id ?>, '<?= htmlspecialchars($account->username) ?>')">
                                        <i class="fas fa-trash me-2"></i>Xóa Tài Khoản
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Details -->
                <div class="col-lg-8">
                    <!-- Basic Information -->
                    <div class="card border-0 shadow-sm mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-info-circle me-2"></i>Thông Tin Cơ Bản
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-muted">ID Người Dùng</label>
                                    <div class="form-control-plaintext fw-bold"><?= $account->id ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-muted">Tên Đăng Nhập</label>
                                    <div class="form-control-plaintext fw-bold"><?= htmlspecialchars($account->username) ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-muted">Họ và Tên</label>
                                    <div class="form-control-plaintext fw-bold"><?= htmlspecialchars($account->fullname) ?></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-muted">Vai Trò</label>
                                    <div class="form-control-plaintext">
                                        <?php if ($account->role === 'admin'): ?>
                                            <span class="badge bg-danger">
                                                <i class="fas fa-shield-alt me-1"></i>Quản Trị Viên
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-primary">
                                                <i class="fas fa-user me-1"></i>Người Dùng
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="card border-0 shadow-sm mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-address-book me-2"></i>Thông Tin Liên Hệ
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-muted">
                                        <i class="fas fa-phone text-success me-2"></i>Số Điện Thoại
                                    </label>
                                    <div class="form-control-plaintext fw-bold">
                                        <?= $account->phone ? htmlspecialchars($account->phone) : '<span class="text-muted">Chưa cập nhật</span>' ?>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-muted">
                                        <i class="fas fa-envelope text-primary me-2"></i>Email
                                    </label>
                                    <div class="form-control-plaintext fw-bold">
                                        <?= $account->email ? htmlspecialchars($account->email) : '<span class="text-muted">Chưa cập nhật</span>' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Information -->
                    <div class="card border-0 shadow-sm mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-cog me-2"></i>Thông Tin Hệ Thống
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-muted">
                                        <i class="fas fa-calendar-plus text-info me-2"></i>Ngày Tạo
                                    </label>
                                    <div class="form-control-plaintext fw-bold">
                                        <?= isset($account->created_at) ? date('d/m/Y H:i:s', strtotime($account->created_at)) : 'N/A' ?>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-muted">
                                        <i class="fas fa-clock text-warning me-2"></i>Cập Nhật Cuối
                                    </label>
                                    <div class="form-control-plaintext fw-bold">
                                        <?= isset($account->updated_at) ? date('d/m/Y H:i:s', strtotime($account->updated_at)) : 'N/A' ?>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-muted">
                                        <i class="fas fa-image text-secondary me-2"></i>Ảnh Đại Diện
                                    </label>
                                    <div class="form-control-plaintext fw-bold">
                                        <?= $account->avatar ? 'Đã cập nhật' : '<span class="text-muted">Chưa cập nhật</span>' ?>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold text-muted">
                                        <i class="fas fa-shield-check text-success me-2"></i>Trạng Thái
                                    </label>
                                    <div class="form-control-plaintext">
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Hoạt Động
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="400">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-bar me-2"></i>Thống Kê Hoạt Động
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3 mb-3">
                                    <div class="stats-card" style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); padding: 20px;">
                                        <i class="fas fa-shopping-bag fa-2x mb-2"></i>
                                        <h4 class="mb-0">0</h4>
                                        <small>Đơn Hàng</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="stats-card" style="background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%); padding: 20px;">
                                        <i class="fas fa-heart fa-2x mb-2"></i>
                                        <h4 class="mb-0">0</h4>
                                        <small>Yêu Thích</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="stats-card" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); padding: 20px;">
                                        <i class="fas fa-comments fa-2x mb-2"></i>
                                        <h4 class="mb-0">0</h4>
                                        <small>Bình Luận</small>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="stats-card" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); padding: 20px;">
                                        <i class="fas fa-star fa-2x mb-2"></i>
                                        <h4 class="mb-0">0</h4>
                                        <small>Đánh Giá</small>
                                    </div>
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
            <form id="changePasswordForm" action="/account/changePassword" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="userId" name="id">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Đổi mật khẩu cho người dùng: <strong><?= htmlspecialchars($account->username) ?></strong>
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

<script>
$(document).ready(function() {
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

    // Animate stats on scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statsCards = entry.target.querySelectorAll('.stats-card h4');
                statsCards.forEach((stat, index) => {
                    setTimeout(() => {
                        if (typeof anime !== 'undefined') {
                            anime({
                                targets: stat,
                                innerHTML: [0, parseInt(stat.textContent) || 0],
                                easing: 'easeInOutQuad',
                                duration: 1000,
                                round: 1
                            });
                        }
                    }, index * 200);
                });
                observer.unobserve(entry.target);
            }
        });
    });

    const statsSection = document.querySelector('.card:last-child .card-body');
    if (statsSection) {
        observer.observe(statsSection);
    }
});

function changePassword(userId) {
    $('#userId').val(userId);
    $('#newPassword').val('');
    $('#confirmNewPassword').val('');
    $('#changePasswordModal').modal('show');
}

function deleteUser(userId, username) {
    Swal.fire({
        title: 'Xác nhận xóa',
        text: `Bạn có chắc chắn muốn xóa người dùng "${username}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#95a5a6',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/account/delete?id=${userId}`;
        }
    });
}
</script>

<?php require_once 'app/views/shares/footer.php'; ?>