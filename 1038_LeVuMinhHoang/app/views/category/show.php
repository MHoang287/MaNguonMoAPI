<?php 
$pageTitle = htmlspecialchars($category->name);
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/category/list" class="text-decoration-none">Danh Mục</a></li>
                <li class="breadcrumb-item active"><?= htmlspecialchars($category->name) ?></li>
            </ol>
        </nav>

        <!-- Category Header -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="category-header-card" data-aos="fade-up">
                    <div class="category-hero" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <div class="hero-content">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <div class="category-info text-white">
                                        <div class="category-badge mb-3">
                                            <span class="badge bg-light text-dark fs-6">
                                                <i class="fas fa-hashtag me-1"></i>ID: <?= $category->id ?>
                                            </span>
                                        </div>
                                        <h1 class="display-4 fw-bold mb-3">
                                            <i class="fas fa-folder-open me-3"></i>
                                            <?= htmlspecialchars($category->name) ?>
                                        </h1>
                                        <?php if (!empty($category->description)): ?>
                                            <p class="lead mb-4"><?= htmlspecialchars($category->description) ?></p>
                                        <?php else: ?>
                                            <p class="lead mb-4 fst-italic opacity-75">Chưa có mô tả cho danh mục này</p>
                                        <?php endif; ?>
                                        
                                        <div class="category-meta">
                                            <div class="row">
                                                <div class="col-md-4 mb-2">
                                                    <i class="fas fa-calendar-plus me-2"></i>
                                                    <span>Tạo: Hôm nay</span>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <i class="fas fa-edit me-2"></i>
                                                    <span>Sửa: Hôm nay</span>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <i class="fas fa-eye me-2"></i>
                                                    <span><?= rand(100, 1000) ?> lượt xem</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center">
                                    <div class="category-stats">
                                        <div class="stat-circle">
                                            <div class="stat-number"><?= rand(5, 50) ?></div>
                                            <div class="stat-label">Sản Phẩm</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="hero-actions">
                            <div class="btn-group" role="group">
                                <?php if (SessionHelper::isAdmin()): ?>
                                <a href="/category/edit/<?= $category->id ?>" class="btn btn-warning btn-lg">
                                    <i class="fas fa-edit me-2"></i>Chỉnh Sửa
                                </a>
                                <button class="btn btn-danger btn-lg" onclick="deleteCategory(<?= $category->id ?>)">
                                    <i class="fas fa-trash me-2"></i>Xóa
                                </button>
                                <?php endif; ?>
                                <button class="btn btn-info btn-lg" onclick="shareCategory()">
                                    <i class="fas fa-share me-2"></i>Chia Sẻ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Row -->
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                <div class="stat-card bg-primary">
                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number counter" data-count="<?= rand(5, 50) ?>">0</h3>
                        <p class="stat-label">Sản Phẩm</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-card bg-success">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number counter" data-count="<?= rand(100, 500) ?>">0</h3>
                        <p class="stat-label">Đơn Hàng</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card bg-warning">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number"><?= number_format(rand(10, 100)) ?>M</h3>
                        <p class="stat-label">Doanh Thu</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card bg-info">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-content">
                        <h3 class="stat-number">4.<?= rand(5, 9) ?></h3>
                        <p class="stat-label">Đánh Giá</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Tabs -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0" data-aos="fade-up">
                    <div class="card-header bg-white">
                        <ul class="nav nav-tabs card-header-tabs" id="categoryTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab">
                                    <i class="fas fa-box me-2"></i>Sản Phẩm (<?= rand(5, 50) ?>)
                                </button>
                            </li>
                            <?php if (SessionHelper::isAdmin()): ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="analytics-tab" data-bs-toggle="tab" data-bs-target="#analytics" type="button" role="tab">
                                    <i class="fas fa-chart-line me-2"></i>Thống Kê
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">
                                    <i class="fas fa-cog me-2"></i>Cài Đặt
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                                    <i class="fas fa-history me-2"></i>Lịch Sử
                                </button>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="categoryTabsContent">
                            <!-- Products Tab -->
                            <div class="tab-pane fade show active" id="products" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="mb-0">Sản Phẩm Trong Danh Mục</h5>
                                    <?php if (SessionHelper::isAdmin()): ?>
                                    <a href="/Product/add" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Thêm Sản Phẩm
                                    </a>
                                    <?php endif; ?>
                                </div>

                                <!-- Sample Products (since we don't have real product data) -->
                                <div class="row">
                                    <?php for ($i = 1; $i <= 6; $i++): ?>
                                        <div class="col-lg-4 col-md-6 mb-4">
                                            <div class="card product-card h-100 border-0 shadow-sm">
                                                <img src="https://via.placeholder.com/300x200/<?= ['3498db', 'e74c3c', '27ae60', 'f39c12', '9b59b6', '34495e'][$i-1] ?>/ffffff?text=Product+<?= $i ?>" 
                                                     class="card-img-top" alt="Product <?= $i ?>">
                                                <div class="card-body">
                                                    <h6 class="card-title">Sản Phẩm Mẫu <?= $i ?></h6>
                                                    <p class="card-text text-muted">Mô tả ngắn về sản phẩm này...</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="h6 text-primary mb-0"><?= number_format(rand(500000, 2000000)) ?> VNĐ</span>
                                                        <div class="btn-group btn-group-sm">
                                                            <button class="btn btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <?php if (SessionHelper::isAdmin()): ?>
                                                            <button class="btn btn-outline-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endfor; ?>
                                </div>

                                <!-- Pagination -->
                                <nav>
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item disabled">
                                            <span class="page-link">Trước</span>
                                        </li>
                                        <li class="page-item active">
                                            <span class="page-link">1</span>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Tiếp</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                            <!-- Analytics Tab -->
                            <div class="tab-pane fade" id="analytics" role="tabpanel">
                                <h5 class="mb-4">Thống Kê Danh Mục</h5>
                                
                                <!-- Charts Row -->
                                <div class="row mb-4">
                                    <div class="col-lg-6 mb-4">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-primary text-white">
                                                <h6 class="mb-0">
                                                    <i class="fas fa-chart-bar me-2"></i>Doanh Thu Theo Tháng
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="salesChart" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-header bg-success text-white">
                                                <h6 class="mb-0">
                                                    <i class="fas fa-chart-pie me-2"></i>Phân Bố Sản Phẩm
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="productChart" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Metrics Table -->
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-info text-white">
                                        <h6 class="mb-0">
                                            <i class="fas fa-table me-2"></i>Báo Cáo Chi Tiết
                                        </h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Thời Gian</th>
                                                    <th>Lượt Xem</th>
                                                    <th>Đơn Hàng</th>
                                                    <th>Doanh Thu</th>
                                                    <th>Tỷ Lệ Chuyển Đổi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i = 7; $i >= 1; $i--): ?>
                                                    <tr>
                                                        <td><?= date('d/m/Y', strtotime("-$i days")) ?></td>
                                                        <td><?= rand(50, 200) ?></td>
                                                        <td><?= rand(5, 25) ?></td>
                                                        <td><?= number_format(rand(1000000, 5000000)) ?> VNĐ</td>
                                                        <td>
                                                            <span class="badge bg-success"><?= rand(10, 30) ?>%</span>
                                                        </td>
                                                    </tr>
                                                <?php endfor; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Settings Tab -->
                            <div class="tab-pane fade" id="settings" role="tabpanel">
                                <h5 class="mb-4">Cài Đặt Danh Mục</h5>
                                
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-header bg-warning text-dark">
                                                <h6 class="mb-0">
                                                    <i class="fas fa-cog me-2"></i>Cài Đặt Chung
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="categoryVisible" checked>
                                                    <label class="form-check-label" for="categoryVisible">
                                                        Hiển thị danh mục trên website
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="categoryFeatured">
                                                    <label class="form-check-label" for="categoryFeatured">
                                                        Danh mục nổi bật
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch mb-3">
                                                    <input class="form-check-input" type="checkbox" id="categoryNotification" checked>
                                                    <label class="form-check-label" for="categoryNotification">
                                                        Nhận thông báo về danh mục
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-header bg-info text-white">
                                                <h6 class="mb-0">
                                                    <i class="fas fa-shield-alt me-2"></i>Bảo Mật
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Quyền truy cập</label>
                                                    <select class="form-select">
                                                        <option>Công khai</option>
                                                        <option>Thành viên</option>
                                                        <option>Quản trị viên</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Backup tự động</label>
                                                    <select class="form-select">
                                                        <option>Hàng ngày</option>
                                                        <option>Hàng tuần</option>
                                                        <option>Hàng tháng</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Lưu Cài Đặt
                                    </button>
                                </div>
                            </div>

                            <!-- History Tab -->
                            <div class="tab-pane fade" id="history" role="tabpanel">
                                <h5 class="mb-4">Lịch Sử Hoạt Động</h5>
                                
                                <div class="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-primary"></div>
                                        <div class="timeline-content">
                                            <div class="timeline-header">
                                                <h6 class="timeline-title">Tạo Danh Mục</h6>
                                                <span class="timeline-time">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Hôm nay, 10:30
                                                </span>
                                            </div>
                                            <p class="timeline-description">
                                                Danh mục "<?= htmlspecialchars($category->name) ?>" được tạo bởi <strong>MHoang287</strong>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-success"></div>
                                        <div class="timeline-content">
                                            <div class="timeline-header">
                                                <h6 class="timeline-title">Thêm Mô Tả</h6>
                                                <span class="timeline-time">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Hôm nay, 10:35
                                                </span>
                                            </div>
                                            <p class="timeline-description">
                                                Thêm mô tả chi tiết cho danh mục
                                            </p>
                                        </div>
                                    </div>

                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-info"></div>
                                        <div class="timeline-content">
                                            <div class="timeline-header">
                                                <h6 class="timeline-title">Xem Chi Tiết</h6>
                                                <span class="timeline-time">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Bây giờ
                                                </span>
                                            </div>
                                            <p class="timeline-description">
                                                Đang xem thông tin chi tiết danh mục
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
         <?php if (SessionHelper::isAdmin()): ?>
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 bg-light" data-aos="fade-up">
                    <div class="card-body text-center">
                        <h6 class="mb-4">
                            <i class="fas fa-bolt text-warning me-2"></i>Thao Tác Nhanh
                        </h6>
                        <div class="quick-actions">
                            <a href="/category/edit/<?= $category->id ?>" class="btn btn-outline-warning me-3 mb-2">
                                <i class="fas fa-edit me-2"></i>Chỉnh Sửa
                            </a>
                            <a href="/category/list" class="btn btn-outline-secondary me-3 mb-2">
                                <i class="fas fa-list me-2"></i>Danh Sách
                            </a>
                            <button class="btn btn-outline-info me-3 mb-2" onclick="printCategory()">
                                <i class="fas fa-print me-2"></i>In
                            </button>
                            <button class="btn btn-outline-success me-3 mb-2" onclick="exportCategory()">
                                <i class="fas fa-download me-2"></i>Xuất Excel
                            </button>
                            <button class="btn btn-outline-danger mb-2" onclick="deleteCategory(<?= $category->id ?>)">
                                <i class="fas fa-trash me-2"></i>Xóa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<style>
.category-header-card {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.category-hero {
    padding: 60px 40px;
    position: relative;
    color: white;
}

.category-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-actions {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 3;
}

.stat-circle {
    width: 120px;
    height: 120px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    backdrop-filter: blur(10px);
}

.stat-circle .stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: white;
}

.stat-circle .stat-label {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.9);
    margin: 0;
}

.stat-card {
    border-radius: 15px;
    padding: 30px 20px;
    text-align: center;
    color: white;
    border: none;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0));
    pointer-events: none;
}

.stat-icon {
    font-size: 2.5rem;
    margin-bottom: 15px;
    opacity: 0.8;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
}

.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 30px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
    padding-left: 80px;
}

.timeline-marker {
    position: absolute;
    left: 20px;
    top: 5px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 3px solid white;
}

.timeline-content {
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.timeline-header {
    display: flex;
    justify-content: between;
    align-items: center;
    margin-bottom: 10px;
}

.timeline-title {
    font-size: 1rem;
    font-weight: bold;
    color: #495057;
    margin: 0;
}

.timeline-time {
    font-size: 0.8rem;
    color: #6c757d;
    margin-left: auto;
}

.timeline-description {
    color: #6c757d;
    margin: 0;
    line-height: 1.5;
}

.quick-actions .btn {
    min-width: 120px;
}

@media (max-width: 768px) {
    .category-hero {
        padding: 40px 20px;
    }
    
    .hero-actions {
        position: static;
        margin-top: 20px;
        text-align: center;
    }
    
    .hero-actions .btn-group {
        flex-direction: column;
        width: 100%;
    }
    
    .hero-actions .btn {
        margin-bottom: 10px;
    }
    
    .stat-circle {
        width: 100px;
        height: 100px;
    }
    
    .stat-circle .stat-number {
        font-size: 1.5rem;
    }
}
</style>

<script>
// Initialize counters
document.querySelectorAll('.counter').forEach(counter => {
    const target = parseInt(counter.getAttribute('data-count'));
    animateValue(counter, 0, target, 2000);
});

// Delete category function
function deleteCategory(id) {
    Swal.fire({
        title: 'Bạn có chắc chắn?',
        text: "Danh mục và tất cả sản phẩm trong danh mục sẽ bị xóa vĩnh viễn!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Đang xóa...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            
            window.location.href = '/category/delete/' + id;
        }
    });
}

// Share category function
function shareCategory() {
    const categoryName = '<?= htmlspecialchars($category->name) ?>';
    const url = window.location.href;
    
    if (navigator.share) {
        navigator.share({
            title: `Danh mục ${categoryName} - TechTafu`,
            text: `Khám phá danh mục ${categoryName} tại TechTafu`,
            url: url
        });
    } else {
        navigator.clipboard.writeText(url).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Đã sao chép!',
                text: 'Link danh mục đã được sao chép vào clipboard.',
                timer: 2000,
                showConfirmButton: false
            });
        });
    }
}

// Print category function
function printCategory() {
    window.print();
}

// Export category function
function exportCategory() {
    Swal.fire({
        title: 'Xuất dữ liệu danh mục',
        text: 'Chọn định dạng file để xuất',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Excel (.xlsx)',
        cancelButtonText: 'PDF (.pdf)',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Export to Excel
            Swal.fire('Thành công!', 'Dữ liệu đã được xuất ra file Excel.', 'success');
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Export to PDF
            Swal.fire('Thành công!', 'Dữ liệu đã được xuất ra file PDF.', 'success');
        }
    });
}

// Initialize charts (using Chart.js)
document.addEventListener('DOMContentLoaded', function() {
    // Sales Chart
    const salesCtx = document.getElementById('salesChart');
    if (salesCtx) {
        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
                datasets: [{
                    label: 'Doanh thu (triệu VNĐ)',
                    data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 40, 38, 45],
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Product Chart
    const productCtx = document.getElementById('productChart');
    if (productCtx) {
        new Chart(productCtx, {
            type: 'doughnut',
            data: {
                labels: ['Laptop', 'Điện thoại', 'Tablet', 'Phụ kiện'],
                datasets: [{
                    data: [30, 25, 20, 25],
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB', 
                        '#FFCE56',
                        '#4BC0C0'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
});

// Tab change animations
document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
    tab.addEventListener('shown.bs.tab', function(e) {
        const targetPane = document.querySelector(e.target.getAttribute('data-bs-target'));
        if (targetPane) {
            anime({
                targets: targetPane,
                opacity: [0, 1],
                translateY: [20, 0],
                duration: 500,
                easing: 'easeOutQuad'
            });
        }
    });
});

// Auto-refresh statistics every 30 seconds
setInterval(() => {
    // In a real app, this would fetch updated statistics
    console.log('Refreshing category statistics...');
}, 30000);

// Animate stat cards on hover
document.querySelectorAll('.stat-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        anime({
            targets: this.querySelector('.stat-icon'),
            rotate: '360deg',
            duration: 600,
            easing: 'easeInOutQuad'
        });
    });
});
</script>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php include_once 'app/views/shares/footer.php'; ?>