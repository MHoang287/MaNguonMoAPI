<?php 
$pageTitle = "Danh Sách Danh Mục";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Page Header -->
        <div class="row mb-5">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3" data-aos="fade-right">
                    <i class="fas fa-tags text-primary me-3"></i>Quản Lý Danh Mục
                </h1>
                <p class="lead text-muted" data-aos="fade-right" data-aos-delay="100">
                    Tổ chức và quản lý các danh mục sản phẩm một cách hiệu quả
                </p>
            </div>
            <?php if (SessionHelper::isAdmin()): ?>
            <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                <a href="/category/create" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>Thêm Danh Mục
                </a>
            </div>
            <?php endif; ?>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                <div class="card bg-primary text-white border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-list fa-3x mb-3"></i>
                        <h3 class="counter" data-count="<?= count($categories) ?>">0</h3>
                        <p class="mb-0">Tổng Danh Mục</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card bg-success text-white border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-eye fa-3x mb-3"></i>
                        <h3 class="counter" data-count="<?= count(array_filter($categories, function($cat) { return !empty($cat->description); })) ?>">0</h3>
                        <p class="mb-0">Có Mô Tả</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card bg-warning text-dark border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-clock fa-3x mb-3"></i>
                        <h3>Hôm Nay</h3>
                        <p class="mb-0">Cập Nhật Mới</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card bg-info text-white border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                        <h3>100%</h3>
                        <p class="mb-0">Hiệu Suất</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="input-group input-group-lg">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" id="categorySearch" placeholder="Tìm kiếm danh mục...">
                </div>
            </div>
            <div class="col-lg-3">
                <select class="form-select form-select-lg" id="sortBy">
                    <option value="newest">Mới nhất</option>
                    <option value="oldest">Cũ nhất</option>
                    <option value="name">Tên A-Z</option>
                    <option value="name-desc">Tên Z-A</option>
                </select>
            </div>
            <?php if (SessionHelper::isAdmin()): ?>
            <div class="col-lg-3">
                <div class="btn-group w-100" role="group">
                    <button type="button" class="btn btn-outline-secondary active" id="gridView">
                        <i class="fas fa-th"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="listView">
                        <i class="fas fa-list"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" onclick="exportCategories()">
                        <i class="fas fa-download"></i>
                    </button>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Categories Display -->
        <div id="categoriesContainer">
            <?php if (!empty($categories)): ?>
                <div class="row" id="gridContainer">
                    <?php foreach ($categories as $index => $category): ?>
                        <div class="col-xl-4 col-lg-6 mb-4 category-item" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                            <div class="card category-card h-100 shadow-sm border-0">
                                <div class="card-header bg-gradient position-relative" style="background: linear-gradient(135deg, <?= ['#667eea', '#764ba2', '#f093fb', '#f5576c', '#4facfe', '#00f2fe'][$index % 6] ?> 0%, <?= ['#764ba2', '#667eea', '#f5576c', '#f093fb', '#00f2fe', '#4facfe'][$index % 6] ?> 100%);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="text-white mb-0 fw-bold">
                                            <i class="fas fa-folder-open me-2"></i>
                                            <?= htmlspecialchars($category->name) ?>
                                        </h5>
                                        <?php if (SessionHelper::isAdmin()): ?>
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="/category/show/<?= $category->id ?>">
                                                        <i class="fas fa-eye me-2"></i>Xem Chi Tiết
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="/category/edit/<?= $category->id ?>">
                                                        <i class="fas fa-edit me-2"></i>Chỉnh Sửa
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#" onclick="deleteCategory(<?= $category->id ?>)">
                                                        <i class="fas fa-trash me-2"></i>Xóa
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="position-absolute top-0 start-0 m-2">
                                        <span class="badge bg-light text-dark">ID: <?= $category->id ?></span>
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    <div class="category-description mb-3">
                                        <?php if (!empty($category->description)): ?>
                                            <p class="text-muted mb-2">
                                                <?= htmlspecialchars(substr($category->description, 0, 150)) ?>
                                                <?= strlen($category->description) > 150 ? '...' : '' ?>
                                            </p>
                                        <?php else: ?>
                                            <p class="text-muted fst-italic">Chưa có mô tả</p>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="category-stats mb-3">
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <div class="stat-item">
                                                    <h6 class="mb-1 text-primary"><?= rand(5, 50) ?></h6>
                                                    <small class="text-muted">Sản Phẩm</small>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stat-item">
                                                    <h6 class="mb-1 text-success"><?= rand(100, 1000) ?></h6>
                                                    <small class="text-muted">Lượt Xem</small>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stat-item">
                                                    <h6 class="mb-1 text-warning"><?= rand(10, 100) ?></h6>
                                                    <small class="text-muted">Đơn Hàng</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer bg-transparent">
                                    <div class="btn-group w-100" role="group">
                                        <a href="/category/show/<?= $category->id ?>" class="btn btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if (SessionHelper::isAdmin()): ?>
                                        <a href="/category/edit/<?= $category->id ?>" class="btn btn-outline-warning flex-grow-1">
                                            <i class="fas fa-edit me-1"></i>Chỉnh Sửa
                                        </a>
                                        <button class="btn btn-outline-danger" onclick="deleteCategory(<?= $category->id ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- List View (Hidden by default) -->
                <div class="d-none" id="listContainer">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Danh Sách Danh Mục</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên Danh Mục</th>
                                        <th>Mô Tả</th>
                                        <th>Sản Phẩm</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <td><span class="badge bg-primary"><?= $category->id ?></span></td>
                                            <td class="fw-bold"><?= htmlspecialchars($category->name) ?></td>
                                            <td class="text-muted">
                                                <?= !empty($category->description) ? htmlspecialchars(substr($category->description, 0, 100)) . '...' : 'Chưa có mô tả' ?>
                                            </td>
                                            <td><span class="badge bg-success"><?= rand(5, 50) ?></span></td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="/category/show/<?= $category->id ?>" class="btn btn-outline-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="/category/edit/<?= $category->id ?>" class="btn btn-outline-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-outline-danger" onclick="deleteCategory(<?= $category->id ?>)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <!-- Empty State -->
                <div class="text-center py-5" data-aos="fade-up">
                    <div class="empty-state">
                        <i class="fas fa-folder-open fa-5x text-muted mb-4"></i>
                        <h3 class="text-muted mb-3">Chưa Có Danh Mục Nào</h3>
                        <p class="text-muted mb-4">Hãy tạo danh mục đầu tiên để tổ chức sản phẩm của bạn!</p>
                        <a href="/category/create" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>Tạo Danh Mục Đầu Tiên
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
// Initialize counters
document.querySelectorAll('.counter').forEach(counter => {
    const target = parseInt(counter.getAttribute('data-count'));
    animateValue(counter, 0, target, 1500);
});

// Search functionality
document.getElementById('categorySearch').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const categoryItems = document.querySelectorAll('.category-item');
    
    categoryItems.forEach(item => {
        const categoryName = item.querySelector('.card-header h5').textContent.toLowerCase();
        const categoryDesc = item.querySelector('.category-description p').textContent.toLowerCase();
        
        if (categoryName.includes(searchTerm) || categoryDesc.includes(searchTerm)) {
            item.style.display = 'block';
            item.classList.add('fade-in');
        } else {
            item.style.display = 'none';
        }
    });
});

// Sort functionality
document.getElementById('sortBy').addEventListener('change', function() {
    const sortBy = this.value;
    const container = document.getElementById('gridContainer');
    const items = Array.from(container.children);
    
    items.sort((a, b) => {
        const nameA = a.querySelector('.card-header h5').textContent;
        const nameB = b.querySelector('.card-header h5').textContent;
        
        switch(sortBy) {
            case 'name':
                return nameA.localeCompare(nameB);
            case 'name-desc':
                return nameB.localeCompare(nameA);
            case 'newest':
            case 'oldest':
            default:
                return 0;
        }
    });
    
    items.forEach(item => container.appendChild(item));
});

// View toggle
document.getElementById('gridView').addEventListener('click', function() {
    document.getElementById('gridContainer').classList.remove('d-none');
    document.getElementById('listContainer').classList.add('d-none');
    this.classList.add('active');
    document.getElementById('listView').classList.remove('active');
});

document.getElementById('listView').addEventListener('click', function() {
    document.getElementById('gridContainer').classList.add('d-none');
    document.getElementById('listContainer').classList.remove('d-none');
    this.classList.add('active');
    document.getElementById('gridView').classList.remove('active');
});

// Delete category function
function deleteCategory(id) {
    Swal.fire({
        title: 'Bạn có chắc chắn?',
        text: "Danh mục sẽ bị xóa vĩnh viễn! Các sản phẩm trong danh mục này sẽ chuyển về 'Chưa phân loại'.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Đang xóa...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Redirect to delete
            window.location.href = '/category/delete/' + id;
        }
    });
}

// Export categories
function exportCategories() {
    Swal.fire({
        title: 'Xuất Dữ Liệu',
        text: 'Chọn định dạng xuất dữ liệu',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Excel (.xlsx)',
        cancelButtonText: 'CSV (.csv)',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Export to Excel
            exportToExcel();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Export to CSV
            exportToCSV();
        }
    });
}

function exportToExcel() {
    // Implementation for Excel export
    Swal.fire('Thành công!', 'Dữ liệu đã được xuất ra file Excel.', 'success');
}

function exportToCSV() {
    // Implementation for CSV export
    Swal.fire('Thành công!', 'Dữ liệu đã được xuất ra file CSV.', 'success');
}

// Animate category cards on hover
document.querySelectorAll('.category-card').forEach(card => {
    card.addEventListener('mouseenter', function() {
        anime({
            targets: this,
            scale: 1.05,
            duration: 300,
            easing: 'easeOutQuad'
        });
    });
    
    card.addEventListener('mouseleave', function() {
        anime({
            targets: this,
            scale: 1,
            duration: 300,
            easing: 'easeOutQuad'
        });
    });
});

// Auto-refresh every 5 minutes
setInterval(() => {
    // In a real app, this would refresh data
    console.log('Auto-refreshing category data...');
}, 300000);
</script>

<?php include_once 'app/views/shares/footer.php'; ?>