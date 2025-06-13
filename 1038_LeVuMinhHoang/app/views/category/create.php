<?php 
$pageTitle = "Thêm Danh Mục";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/category/list" class="text-decoration-none">Danh Mục</a></li>
                <li class="breadcrumb-item active">Thêm Danh Mục</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Main Form Card -->
                <div class="card shadow-lg border-0" data-aos="fade-up">
                    <div class="card-header bg-gradient text-white position-relative" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-folder-plus me-2"></i>Tạo Danh Mục Mới
                        </h4>
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-calendar me-1"></i><?= date('d/m/Y') ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Progress Steps -->
                        <div class="progress-steps mb-4">
                            <div class="d-flex justify-content-center">
                                <div class="step active">
                                    <div class="step-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <span>Thông Tin</span>
                                </div>
                                <div class="step-line"></div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <span>Xác Nhận</span>
                                </div>
                                <div class="step-line"></div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="fas fa-save"></i>
                                    </div>
                                    <span>Hoàn Tất</span>
                                </div>
                            </div>
                        </div>

                        <form action="/category/store" method="POST" id="categoryForm">
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
                                           value="<?= htmlspecialchars($_SESSION['old_data']['name'] ?? '') ?>"
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
                                          placeholder="Nhập mô tả chi tiết về danh mục này...&#10;&#10;Ví dụ:&#10;- Đặc điểm chính của danh mục&#10;- Loại sản phẩm sẽ có trong danh mục&#10;- Mục đích sử dụng..."
                                          maxlength="1000"><?= htmlspecialchars($_SESSION['old_data']['description'] ?? '') ?></textarea>
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

                            <!-- Category Icon Selection -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-icons text-warning me-2"></i>Biểu Tượng Danh Mục
                                </label>
                                <div class="icon-selection">
                                    <div class="row">
                                        <?php 
                                        $icons = [
                                            'fa-laptop' => 'Laptop',
                                            'fa-mobile-alt' => 'Điện Thoại', 
                                            'fa-tablet-alt' => 'Tablet',
                                            'fa-headphones' => 'Tai Nghe',
                                            'fa-camera' => 'Camera',
                                            'fa-gamepad' => 'Gaming',
                                            'fa-tv' => 'TV & Monitor',
                                            'fa-keyboard' => 'Phụ Kiện',
                                            'fa-mouse' => 'Chuột',
                                            'fa-usb' => 'USB & Lưu Trữ',
                                            'fa-wifi' => 'Mạng & Kết Nối',
                                            'fa-battery-full' => 'Pin & Sạc'
                                        ];
                                        
                                        foreach ($icons as $iconClass => $iconName): 
                                        ?>
                                            <div class="col-lg-3 col-md-4 col-6 mb-3">
                                                <div class="icon-option" data-icon="<?= $iconClass ?>">
                                                    <div class="icon-preview">
                                                        <i class="fas <?= $iconClass ?> fa-2x"></i>
                                                    </div>
                                                    <small class="icon-name"><?= $iconName ?></small>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <input type="hidden" name="icon" id="selectedIcon" value="">
                                </div>
                            </div>

                            <!-- Category Color -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-palette text-info me-2"></i>Màu Sắc Danh Mục
                                </label>
                                <div class="color-selection">
                                    <div class="row">
                                        <?php 
                                        $colors = [
                                            '#667eea' => 'Xanh Tím',
                                            '#764ba2' => 'Tím Đậm',
                                            '#f093fb' => 'Hồng Nhạt',
                                            '#f5576c' => 'Đỏ Coral',
                                            '#4facfe' => 'Xanh Dương',
                                            '#00f2fe' => 'Xanh Cyan',
                                            '#43e97b' => 'Xanh Lá',
                                            '#38f9d7' => 'Xanh Mint',
                                            '#ffecd2' => 'Vàng Nhạt',
                                            '#fcb69f' => 'Cam Nhạt',
                                            '#a8edea' => 'Xanh Pastel',
                                            '#fed6e3' => 'Hồng Pastel'
                                        ];
                                        
                                        foreach ($colors as $colorCode => $colorName): 
                                        ?>
                                            <div class="col-lg-2 col-md-3 col-4 mb-3">
                                                <div class="color-option" data-color="<?= $colorCode ?>" style="background: <?= $colorCode ?>;">
                                                    <div class="color-check">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                    <small class="color-name"><?= $colorName ?></small>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <input type="hidden" name="color" id="selectedColor" value="">
                                </div>
                            </div>

                            <!-- Preview Section -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-eye text-secondary me-2"></i>Xem Trước
                                </label>
                                <div class="category-preview">
                                    <div class="preview-card">
                                        <div class="preview-header" id="previewHeader">
                                            <i class="fas fa-folder preview-icon" id="previewIcon"></i>
                                            <span class="preview-name" id="previewName">Tên Danh Mục</span>
                                        </div>
                                        <div class="preview-body">
                                            <p class="preview-description" id="previewDescription">Mô tả danh mục sẽ hiển thị ở đây...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="col-md-6 d-grid mb-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Tạo Danh Mục
                                    </button>
                                </div>
                                <div class="col-md-6 d-grid mb-2">
                                    <a href="/category/list" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-arrow-left me-2"></i>Quay Lại
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Help Card -->
                <div class="card mt-4 border-0 bg-light" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fas fa-question-circle text-info me-2"></i>Hướng Dẫn Tạo Danh Mục
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="small fw-bold text-primary">Tên Danh Mục:</h6>
                                <ul class="list-unstyled small mb-3">
                                    <li><i class="fas fa-check text-success me-2"></i>Nên ngắn gọn (3-50 ký tự)</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Dễ hiểu và dễ nhớ</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Không trùng lặp</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="small fw-bold text-success">Mô Tả:</h6>
                                <ul class="list-unstyled small mb-3">
                                    <li><i class="fas fa-check text-success me-2"></i>Mô tả rõ ràng về danh mục</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Liệt kê loại sản phẩm</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Sử dụng ngôn ngữ thân thiện</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.progress-steps {
    max-width: 400px;
    margin: 0 auto;
}

.progress-steps .d-flex {
    align-items: center;
}

.step {
    text-align: center;
    position: relative;
}

.step-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #dee2e6;
    color: #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 8px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.step.active .step-icon {
    background: #0d6efd;
    color: white;
}

.step-line {
    flex: 1;
    height: 2px;
    background: #dee2e6;
    margin: 0 15px;
}

.icon-option {
    text-align: center;
    padding: 15px;
    border: 2px solid #dee2e6;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.icon-option:hover {
    border-color: #0d6efd;
    background-color: #f8f9ff;
}

.icon-option.selected {
    border-color: #0d6efd;
    background-color: #e7f1ff;
}

.icon-preview {
    margin-bottom: 8px;
    color: #6c757d;
}

.icon-option.selected .icon-preview {
    color: #0d6efd;
}

.color-option {
    height: 60px;
    border-radius: 10px;
    cursor: pointer;
    position: relative;
    border: 3px solid transparent;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.color-option:hover {
    transform: scale(1.1);
    border-color: #fff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.color-option.selected {
    border-color: #000;
    transform: scale(1.1);
}

.color-check {
    color: white;
    font-size: 1.2rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.color-option.selected .color-check {
    opacity: 1;
}

.color-name {
    position: absolute;
    bottom: -20px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 0.7rem;
    white-space: nowrap;
}

.category-preview {
    border: 2px dashed #dee2e6;
    border-radius: 10px;
    padding: 20px;
}

.preview-card {
    max-width: 300px;
    margin: 0 auto;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.preview-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px;
    text-align: center;
}

.preview-icon {
    font-size: 1.5rem;
    margin-bottom: 8px;
    display: block;
}

.preview-name {
    font-weight: bold;
    font-size: 1.1rem;
}

.preview-body {
    background: white;
    padding: 15px;
}

.preview-description {
    color: #6c757d;
    font-size: 0.9rem;
    margin: 0;
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
            counter.className = 'text-warning';
        } else if (length === maxLength) {
            counter.className = 'text-danger';
        } else {
            counter.className = 'text-muted';
        }
    }
    
    input.addEventListener('input', update);
    update();
}

updateCharCounter('name', 'nameCounter', 100);
updateCharCounter('description', 'descCounter', 1000);

// Real-time validation for category name
document.getElementById('name').addEventListener('input', function() {
    const name = this.value.trim();
    const nameError = document.getElementById('nameError');
    const nameSuccess = document.getElementById('nameSuccess');
    
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
    } else {
        // Check for duplicate name via AJAX
        checkCategoryName(name);
    }
    
    updatePreview();
});

function checkCategoryName(name) {
    const nameInput = document.getElementById('name');
    const nameError = document.getElementById('nameError');
    const nameSuccess = document.getElementById('nameSuccess');
    
    // Simulate AJAX call to check duplicate
    fetch('/category/checkName', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ name: name })
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

// Icon selection
document.querySelectorAll('.icon-option').forEach(option => {
    option.addEventListener('click', function() {
        document.querySelectorAll('.icon-option').forEach(opt => opt.classList.remove('selected'));
        this.classList.add('selected');
        document.getElementById('selectedIcon').value = this.dataset.icon;
        updatePreview();
    });
});

// Color selection
document.querySelectorAll('.color-option').forEach(option => {
    option.addEventListener('click', function() {
        document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove('selected'));
        this.classList.add('selected');
        document.getElementById('selectedColor').value = this.dataset.color;
        updatePreview();
    });
});

// Description change
document.getElementById('description').addEventListener('input', updatePreview);

// Update preview
function updatePreview() {
    const name = document.getElementById('name').value || 'Tên Danh Mục';
    const description = document.getElementById('description').value || 'Mô tả danh mục sẽ hiển thị ở đây...';
    const icon = document.getElementById('selectedIcon').value || 'fa-folder';
    const color = document.getElementById('selectedColor').value || '#667eea';
    
    document.getElementById('previewName').textContent = name;
    document.getElementById('previewDescription').textContent = description;
    document.getElementById('previewIcon').className = `fas ${icon} preview-icon`;
    
    const previewHeader = document.getElementById('previewHeader');
    previewHeader.style.background = `linear-gradient(135deg, ${color} 0%, ${adjustColor(color, -20)} 100%)`;
}

function adjustColor(color, amount) {
    const usePound = color[0] === "#";
    const col = usePound ? color.slice(1) : color;
    const num = parseInt(col, 16);
    let r = (num >> 16) + amount;
    let g = (num >> 8 & 0x00FF) + amount;
    let b = (num & 0x0000FF) + amount;
    r = r > 255 ? 255 : r < 0 ? 0 : r;
    g = g > 255 ? 255 : g < 0 ? 0 : g;
    b = b > 255 ? 255 : b < 0 ? 0 : b;
    return (usePound ? "#" : "") + (r << 16 | g << 8 | b).toString(16).padStart(6, '0');
}

// Form validation
document.getElementById('categoryForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    
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
    
    // Show loading
    Swal.fire({
        title: 'Đang tạo danh mục...',
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
});

// Initialize preview
updatePreview();

// Auto-save draft functionality
setInterval(() => {
    const formData = {
        name: document.getElementById('name').value,
        description: document.getElementById('description').value,
        icon: document.getElementById('selectedIcon').value,
        color: document.getElementById('selectedColor').value
    };
    
    localStorage.setItem('categoryDraft', JSON.stringify(formData));
}, 30000); // Save every 30 seconds

// Load draft on page load
window.addEventListener('load', () => {
    const draft = localStorage.getItem('categoryDraft');
    if (draft) {
        const data = JSON.parse(draft);
        
        if (confirm('Bạn có muốn khôi phục bản nháp đã lưu không?')) {
            document.getElementById('name').value = data.name || '';
            document.getElementById('description').value = data.description || '';
            
            if (data.icon) {
                document.querySelector(`[data-icon="${data.icon}"]`)?.click();
            }
            
            if (data.color) {
                document.querySelector(`[data-color="${data.color}"]`)?.click();
            }
            
            updatePreview();
        }
    }
});

// Clear draft on successful submit
document.getElementById('categoryForm').addEventListener('submit', () => {
    localStorage.removeItem('categoryDraft');
});

<?php if (isset($_SESSION['old_data'])): ?>
// Clear old data from session
<?php unset($_SESSION['old_data']); ?>
<?php endif; ?>
</script>

<?php include_once 'app/views/shares/footer.php'; ?>