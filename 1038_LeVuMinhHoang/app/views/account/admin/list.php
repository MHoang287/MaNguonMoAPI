<?php
$pageTitle = "Quản Lý Người Dùng";
require_once 'app/views/shares/header.php';
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4" data-aos="fade-up">
                <div>
                    <h2 class="text-dark fw-bold mb-1">
                        <i class="fas fa-users text-primary me-2"></i>Quản Lý Người Dùng
                    </h2>
                    <p class="text-muted mb-0">Quản lý tất cả tài khoản người dùng trong hệ thống</p>
                </div>
                <div>
                    <a href="/account/create" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fas fa-plus me-2"></i>Thêm Người Dùng
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="stats-card">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h4 class="mb-0" id="totalUsers"><?= $totalAccounts ?></h4>
                                <small>Tổng Người Dùng</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="stats-card" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon me-3" style="width: 60px; height: 60px; font-size: 1.5rem; background: rgba(255,255,255,0.2);">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div>
                                <h4 class="mb-0" id="adminCount">
                                    <?= count(array_filter($accounts, function($acc) { return $acc->role === 'admin'; })) ?>
                                </h4>
                                <small>Quản Trị Viên</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="stats-card" style="background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon me-3" style="width: 60px; height: 60px; font-size: 1.5rem; background: rgba(255,255,255,0.2);">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <h4 class="mb-0" id="userCount">
                                    <?= count(array_filter($accounts, function($acc) { return $acc->role === 'user'; })) ?>
                                </h4>
                                <small>Người Dùng</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="stats-card" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">
                        <div class="d-flex align-items-center">
                            <div class="feature-icon me-3" style="width: 60px; height: 60px; font-size: 1.5rem; background: rgba(255,255,255,0.2);">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <div>
                                <h4 class="mb-0" id="newToday">2</h4>
                                <small>Mới Hôm Nay</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="card border-0 shadow-sm mb-4" data-aos="fade-up">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white border-0">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" class="form-control border-0" id="searchUsers" 
                                       placeholder="Tìm kiếm theo tên, username, email...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select border-0" id="roleFilter">
                                <option value="">Tất cả vai trò</option>
                                <option value="admin">Quản trị viên</option>
                                <option value="user">Người dùng</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-primary w-100" id="refreshData">
                                <i class="fas fa-sync-alt me-2"></i>Làm mới
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="card border-0 shadow-sm" data-aos="fade-up">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-table text-primary me-2"></i>Danh Sách Người Dùng
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="usersTable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 text-center">#</th>
                                    <th class="border-0">Avatar</th>
                                    <th class="border-0">Thông Tin</th>
                                    <th class="border-0">Liên Hệ</th>
                                    <th class="border-0">Vai Trò</th>
                                    <th class="border-0">Ngày Tạo</th>
                                    <th class="border-0 text-center">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = ($page - 1) * 10 + 1; ?>
                                <?php foreach ($accounts as $account): ?>
                                <tr>
                                    <td class="text-center fw-bold"><?= $index++ ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if ($account->avatar && file_exists($account->avatar)): ?>
                                                <img src="/<?= htmlspecialchars($account->avatar) ?>" 
                                                     class="rounded-circle" 
                                                     width="40" height="40" 
                                                     style="object-fit: cover;">
                                            <?php else: ?>
                                                <div class="user-avatar" style="width: 40px; height: 40px;">
                                                    <?= strtoupper(substr($account->username, 0, 1)) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="fw-bold text-dark"><?= htmlspecialchars($account->fullname) ?></div>
                                            <small class="text-muted">@<?= htmlspecialchars($account->username) ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <?php if ($account->email): ?>
                                                <div class="mb-1">
                                                    <i class="fas fa-envelope text-primary me-1"></i>
                                                    <small><?= htmlspecialchars($account->email) ?></small>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($account->phone): ?>
                                                <div>
                                                    <i class="fas fa-phone text-success me-1"></i>
                                                    <small><?= htmlspecialchars($account->phone) ?></small>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($account->role === 'admin'): ?>
                                            <span class="badge bg-danger">
                                                <i class="fas fa-shield-alt me-1"></i>Admin
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-primary">
                                                <i class="fas fa-user me-1"></i>User
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?= isset($account->created_at) ? date('d/m/Y H:i', strtotime($account->created_at)) : 'N/A' ?>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="/account/view?id=<?= $account->id ?>" 
                                               class="btn btn-sm btn-outline-info" title="Xem chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="/account/edit?id=<?= $account->id ?>" 
                                               class="btn btn-sm btn-outline-warning" title="Sửa">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-secondary" 
                                                    onclick="changePassword(<?= $account->id ?>)" title="Đổi mật khẩu">
                                                <i class="fas fa-key"></i>
                                            </button>
                                            <?php if ($account->username !== $_SESSION['username']): ?>
                                                <button class="btn btn-sm btn-outline-danger" 
                                                        onclick="deleteUser(<?= $account->id ?>, '<?= htmlspecialchars($account->username) ?>')" 
                                                        title="Xóa">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
            <nav aria-label="Page navigation" class="mt-4" data-aos="fade-up">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page - 1 ?>">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $page + 1 ?>">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
            <?php endif; ?>
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
                        <input type="password" class="form-control" id="newPassword" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Xác nhận mật khẩu mới</label>
                        <input type="password" class="form-control" id="confirmNewPassword" name="confirm_password" required>
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
    // Animate stats
    setTimeout(() => {
        animateValue(document.getElementById('totalUsers'), 0, <?= $totalAccounts ?>, 1000);
        animateValue(document.getElementById('adminCount'), 0, 
            <?= count(array_filter($accounts, function($acc) { return $acc->role === 'admin'; })) ?>, 1200);
        animateValue(document.getElementById('userCount'), 0, 
            <?= count(array_filter($accounts, function($acc) { return $acc->role === 'user'; })) ?>, 1400);
        animateValue(document.getElementById('newToday'), 0, 2, 1600);
    }, 500);

    // Search functionality
    $('#searchUsers').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        filterTable();
    });

    $('#roleFilter').on('change', function() {
        filterTable();
    });

    function filterTable() {
        const searchTerm = $('#searchUsers').val().toLowerCase();
        const roleFilter = $('#roleFilter').val();

        $('#usersTable tbody tr').each(function() {
            const row = $(this);
            const username = row.find('td:nth-child(3)').text().toLowerCase();
            const email = row.find('td:nth-child(4)').text().toLowerCase();
            const role = row.find('td:nth-child(5) .badge').text().toLowerCase();

            const matchesSearch = username.includes(searchTerm) || email.includes(searchTerm);
            const matchesRole = !roleFilter || role.includes(roleFilter);

            if (matchesSearch && matchesRole) {
                row.show();
            } else {
                row.hide();
            }
        });
    }

    // Refresh data
    $('#refreshData').click(function() {
        location.reload();
    });

    // Change password form
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
    });
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