<?php 
$pageTitle = "Chỉnh Sửa Danh Mục";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/category/list" class="text-decoration-none">Danh Mục</a></li>
                <li class="breadcrumb-item active">Chỉnh Sửa</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Main Form Card -->
                <div class="card shadow-lg border-0" data-aos="fade-up">
                    <div class="card-header bg-gradient text-white position-relative" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-edit me-2"></i>Chỉnh Sửa Danh Mục
                        </h4>
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-light text-dark">
                                ID: <?= $category->id ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Category Info Banner -->
                        <div class="alert alert-info border-0 mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x me-3"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Thông Tin Danh Mục Hiện Tại</h6>
                                    <p class="mb-0">Bạn đang chỉnh sửa danh mục "<strong><?= htmlspecialchars($category->name) ?></strong>"</p>
                                </div>
                            </div>
                        </div>

                        <form action="/category/update/<?= $category->id ?>" method="POST" id="editCategoryForm">
                            <!-- Category Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">
                                    <i class="fas fa-tag text-primary me-2"></i>Tên Danh Mục *
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text">
                                        <i class="fas fa-folder"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control" 
                                           id="name" 
                                           name="name" 
                                           value="<?= htmlspecialchars($_SESSION['old_data']['name'] ?? $category->name) ?>"
                                           placeholder="Nhập tên danh mục..."
                                           required
                                           maxlength="100">
                                    <div class="input-group-text">
                                        <span id="nameCounter" class="small text-muted">0/100</span>
                                    </div>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Tên danh mục nên ngắn gọn, dễ hiểu và không trùng lặp.
                                </div>
                                <div class="invalid-feedback" id="nameError"></div>
                                <div class="valid-feedback" id="nameSuccess">
                                    <i class="fas fa-check-circle me-1"></i>Tên danh mục hợp lệ!
                                </div>
                            </div>

                            <!-- Category Description -->
                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-align-left text-success me-2"></i>Mô Tả Danh Mục
                                </label>
                                <textarea class="form-control form-control-lg" 
                                          id="description" 
                                          name="description" 
                                          rows="6" 
                                          placeholder="Nhập mô tả chi tiết về danh mục này..."
                                          maxlength="1000"><?= htmlspecialchars($_SESSION['old_data']['description'] ?? $category->description) ?></textarea>
                                <div class="d-flex justify-content-between">
                                    <div class="form-text">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        Mô tả giúp khách hàng hiểu rõ hơn về danh mục này.
                                    </div>
                                    <small class="text-muted">
                                        <span id="descCounter">0</span>/1000 ký tự
                                    </small>
                                </div>
                            </div>

                            <!-- Comparison Section -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-balance-scale text-info me-2"></i>So Sánh Thay Đổi
                                </label>
                                <div class="comparison-container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="comparison-card before">
                                                <h6 class="comparison-title">
                                                    <i class="fas fa-history me-2"></i>Trước Đây
                                                </h6>
                                                <div class="comparison-content">
                                                    <div class="comparison-field">
                                                        <strong>Tên:</strong>
                                                        <span><?= htmlspecialchars($category->name) ?></span>
                                                    </div>
                                                    <div class="comparison-field">
                                                        <strong>Mô tả:</strong>
                                                        <span><?= !empty($category->description) ? htmlspecialchars(substr($category->description, 0, 100)) . '...' : 'Chưa có mô tả' ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="comparison-card after">
                                                <h6 class="comparison-title">
                                                    <i class="fas fa-edit me-2"></i>Sau Khi Sửa
                                                </h6>
                                                <div class="comparison-content">
                                                    <div class="comparison-field">
                                                        <strong>Tên:</strong>
                                                        <span id="newName"><?= htmlspecialchars($category->name) ?></span>
                                                    </div>
                                                    <div class="comparison-field">
                                                        <strong>Mô tả:</strong>
                                                        <span id="newDescription"><?= !empty($category->description) ? htmlspecialchars(substr($category->description, 0, 100)) . '...' : 'Chưa có mô tả' ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Change Log -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-clipboard-list text-secondary me-2"></i>Lịch Sử Thay Đổi
                                </label>
                                <div class="change-log">
                                    <div class="timeline">
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-primary"></div>
                                            <div class="timeline-content">
                                                <h6 class="timeline-title">Tạo Danh Mục</h6>
                                                <p class="timeline-description">Danh mục được tạo lần đầu</p>
                                                <small class="timeline-time">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Ngày tạo (giả định)
                                                </small>
                                            </div>
                                        </div>
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-warning"></div>
                                            <div class="timeline-content">
                                                <h6 class="timeline-title">Đang Chỉnh Sửa</h6>
                                                <p class="timeline-description">Cập nhật thông tin danh mục</p>
                                                <small class="timeline-time">
                                                    <i class="fas fa-clock me-1"></i>
                                                    <?= date('d/m/Y H:i') ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="col-md-4 d-grid mb-2">
                                    <button type="submit" class="btn btn-warning btn-lg">
                                        <i class="fas fa-save me-2"></i>Cập Nhật
                                    </button>
                                </div>
                                <div class="col-md-4 d-grid mb-2">
                                    <a href="/category/show/<?= $category->id ?>" class="btn btn-outline-info btn-lg">
                                        <i class="fas fa-eye me-2"></i>Xem Chi Tiết
                                    </a>
                                </div>
                                <div class="col-md-4 d-grid mb-2">
                                    <a href="/category/list" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-arrow-left me-2"></i>Quay Lại
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Additional Information Card -->
                <div class="card mt-4 border-0 bg-light" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fas fa-chart-bar text-primary me-2"></i>Thống Kê Danh Mục
                        </h6>
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <div class="stat-item">
                                    <i class="fas fa-box fa-2x text-primary mb-2"></i>
                                    <h5 class="mb-1"><?= rand(5, 50) ?></h5>
                                    <small class="text-muted">Sản Phẩm</small>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="stat-item">
                                    <i class="fas fa-eye fa-2x text-success mb-2"></i>
                                    <h5 class="mb-1"><?= rand(100, 1000) ?></h5>
                                    <small class="text-muted">Lượt Xem</small>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="stat-item">
                                    <i class="fas fa-shopping-cart fa-2x text-warning mb-2"></i>
                                    <h5 class="mb-1"><?= rand(10, 100) ?></h5>
                                    <small class="text-muted">Đơn Hàng</small>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="stat-item">
                                    <i class="fas fa-star fa-2x text-info mb-2"></i>
                                    <h5 class="mb-1">4.<?= rand(5, 9) ?></h5>
                                    <small class="text-muted">Đánh Giá</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Warning Card -->
                <div class="card mt-4 border-warning" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-body">
                        <h6 class="card-title text-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>Lưu Ý Quan Trọng
                        </h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="fas fa-info-circle text-info me-2"></i>
                                Việc thay đổi tên danh mục có thể ảnh hưởng đến SEO
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-link text-primary me-2"></i>
                                URL của danh mục sẽ được cập nhật tự động
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-history text-secondary me-2"></i>
                                Tất cả thay đổi sẽ được lưu vào lịch sử
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.comparison-container {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
}

.comparison-card {
    background: white;
    border-radius: 8px;
    padding: 15px;
    height: 100%;
}

.comparison-card.before {
    border-left: 4px solid #6c757d;
}

.comparison-card.after {
    border-left: 4px solid #0d6efd;
}

.comparison-title {
    color: #495057;
    font-size: 0.9rem;
    margin-bottom: 15px;
}

.comparison-field {
    margin-bottom: 10px;
    font-size: 0.85rem;
}

.comparison-field strong {
    display: inline-block;
    width: 60px;
    color: #495057;
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 10px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 25px;
}

.timeline-marker {
    position: absolute;
    left: -25px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
}

.timeline-content {
    background: white;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.timeline-title {
    font-size: 0.9rem;
    margin-bottom: 5px;
    color: #495057;
}

.timeline-description {
    font-size: 0.8rem;
    color: #6c757d;
    margin-bottom: 8px;
}

.timeline-time {
    font-size: 0.75rem;
    color: #adb5bd;
}

.stat-item {
    padding: 15px;
    border-radius: 8px;
    background: white;
    margin-bottom: 10px;
}
</style>

<script>
// Character counters
function updateCharCounter(inputId, counterId, maxLength) {
    const input = document.getElementById(inputId);
    const counter = document.getElementById(counterId);
    
    function update() {
        const length = input.value.length;
        counter.textContent = length;
        
        if (length > maxLength * 0.8) {
            counter.className = 'small text-warning';
        } else if (length === maxLength) {
            counter.className = 'small text-danger';
        } else {
            counter.className = 'small text-muted';
        }
        
        updateComparison();
    }
    
    input.addEventListener('input', update);
    update();
}

updateCharCounter('name', 'nameCounter', 100);
updateCharCounter('description', 'descCounter', 1000);

// Update comparison section
function updateComparison() {
    const newName = document.getElementById('name').value || 'Chưa có tên';
    const newDescription = document.getElementById('description').value || 'Chưa có mô tả';
    
    document.getElementById('newName').textContent = newName;
    document.getElementById('newDescription').textContent = 
        newDescription.length > 100 ? newDescription.substring(0, 100) + '...' : newDescription;
}

// Real-time validation for category name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value.trim();
    const nameError = document.getElementById('nameError');
    const nameSuccess = document.getElementById('nameSuccess');
    const originalName = '<?= htmlspecialchars($category->name) ?>';
    
    if (name.length === 0) {
        this.classList.remove('is-invalid', 'is-valid');
        nameError.textContent = '';
        nameSuccess.style.display = 'none';
        return;
    }
    
    if (name.length < 3) {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        nameError.textContent = 'Tên danh mục phải có ít nhất 3 ký tự';
        nameSuccess.style.display = 'none';
    } else if (name !== originalName) {
        // Check for duplicate name via AJAX (excluding current category)
        checkCategoryName(name, <?= $category->id ?>);
    } else {
        // Same as original name
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
        nameError.textContent = '';
        nameSuccess.style.display = 'block';
    }
});

function checkCategoryName(name, excludeId) {
    const nameInput = document.getElementById('name');
    const nameError = document.getElementById('nameError');
    const nameSuccess = document.getElementById('nameSuccess');
    
    fetch('/category/checkName', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ 
            name: name,
            exclude_id: excludeId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.exists) {
            nameInput.classList.add('is-invalid');
            nameInput.classList.remove('is-valid');
            nameError.textContent = 'Tên danh mục đã tồn tại';
            nameSuccess.style.display = 'none';
        } else {
            nameInput.classList.remove('is-invalid');
            nameInput.classList.add('is-valid');
            nameError.textContent = '';
            nameSuccess.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Form validation
document.getElementById('editCategoryForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const originalName = '<?= htmlspecialchars($category->name) ?>';
    const originalDesc = '<?= htmlspecialchars($category->description) ?>';
    const currentDesc = document.getElementById('description').value.trim();
    
    if (!name) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: 'Vui lòng nhập tên danh mục.',
        });
        return;
    }
    
    if (name.length < 3) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: 'Tên danh mục phải có ít nhất 3 ký tự.',
        });
        return;
    }
    
    // Check if there are any changes
    if (name === originalName && currentDesc === originalDesc) {
        e.preventDefault();
        Swal.fire({
            icon: 'info',
            title: 'Không có thay đổi!',
            text: 'Bạn chưa thực hiện thay đổi nào.',
        });
        return;
    }
    
    // Confirm update
    e.preventDefault();
    Swal.fire({
        title: 'Xác nhận cập nhật?',
        text: "Bạn có chắc chắn muốn lưu những thay đổi này?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#f39c12',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Cập nhật',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Đang cập nhật...',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit form
            this.submit();
        }
    });
});

// Auto-save functionality
let autoSaveTimeout;
function autoSave() {
    clearTimeout(autoSaveTimeout);
    autoSaveTimeout = setTimeout(() => {
        const formData = {
            id: <?= $category->id ?>,
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
            timestamp: new Date().toISOString()
        };
        
        localStorage.setItem('categoryEditDraft_<?= $category->id ?>', JSON.stringify(formData));
        
        // Show auto-save indicator
        const indicator = document.createElement('div');
        indicator.className = 'toast-container position-fixed bottom-0 end-0 p-3';
        indicator.innerHTML = `
            <div class="toast show" role="alert">
                <div class="toast-body">
                    <i class="fas fa-save text-success me-2"></i>
                    Đã tự động lưu bản nháp
                </div>
            </div>
        `;
        document.body.appendChild(indicator);
        
        setTimeout(() => {
            indicator.remove();
        }, 3000);
    }, 5000);
}

document.getElementById('name').addEventListener('input', autoSave);
document.getElementById('description').addEventListener('input', autoSave);

// Load auto-saved draft
window.addEventListener('load', () => {
    const draft = localStorage.getItem('categoryEditDraft_<?= $category->id ?>');
    if (draft) {
        const data = JSON.parse(draft);
        const draftTime = new Date(data.timestamp);
        const timeDiff = new Date() - draftTime;
        
        // If draft is less than 1 hour old
        if (timeDiff < 3600000 && confirm('Tìm thấy bản nháp được lưu lúc ' + draftTime.toLocaleString() + '. Bạn có muốn khôi phục không?')) {
            document.getElementById('name').value = data.name || '';
            document.getElementById('description').value = data.description || '';
            updateComparison();
        }
    }
});

// Clear draft on successful submit
document.getElementById('editCategoryForm').addEventListener('submit', () => {
    localStorage.removeItem('categoryEditDraft_<?= $category->id ?>');
});

// Initialize comparison
updateComparison();

// Animate timeline items
anime({
    targets: '.timeline-item',
    translateX: [-50, 0],
    opacity: [0, 1],
    delay: function(el, i) { return i * 200; },
    duration: 800,
    easing: 'easeOutQuad'
});

<?php if (isset($_SESSION['old_data'])): ?>
// Clear old data from session
<?php unset($_SESSION['old_data']); ?>
<?php endif; ?>
</script>

<?php include_once 'app/views/shares/footer.php'; ?>