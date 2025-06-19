<?php 
$pageTitle = "Thêm Sản Phẩm";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản Phẩm</a></li>
                <li class="breadcrumb-item active">Thêm Sản Phẩm</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0" data-aos="fade-up">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Thêm Sản Phẩm Mới
                        </h4>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Alert container cho thông báo từ API -->
                        <div id="alertContainer"></div>

                        <!-- Form sử dụng API thay vì submit truyền thống -->
                        <form id="productForm" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Product Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label fw-bold">
                                        <i class="fas fa-tag me-1"></i>Tên Sản Phẩm *
                                    </label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="name" 
                                           name="name" 
                                           placeholder="Nhập tên sản phẩm..."
                                           required>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- Price -->
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label fw-bold">
                                        <i class="fas fa-dollar-sign me-1"></i>Giá *
                                    </label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control" 
                                               id="price" 
                                               name="price" 
                                               placeholder="0"
                                               min="0"
                                               step="1000"
                                               required>
                                        <span class="input-group-text">VNĐ</span>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Category -->
                            <div class="mb-3">
                                <label for="category_id" class="form-label fw-bold">
                                    <i class="fas fa-list me-1"></i>Danh Mục
                                </label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="">Chọn danh mục...</option>
                                    <?php if (isset($categories)): ?>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category->id ?>">
                                                <?= htmlspecialchars($category->name) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-align-left me-1"></i>Mô Tả *
                                </label>
                                <textarea class="form-control" 
                                          id="description" 
                                          name="description" 
                                          rows="5" 
                                          placeholder="Nhập mô tả chi tiết về sản phẩm..."
                                          required></textarea>
                                <div class="invalid-feedback"></div>
                                <div class="form-text">
                                    <span id="charCount">0</span>/500 ký tự
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div class="mb-4">
                                <label for="image" class="form-label fw-bold">
                                    <i class="fas fa-image me-1"></i>Hình Ảnh Sản Phẩm
                                </label>
                                <div class="upload-area border-2 border-dashed border-primary rounded p-4 text-center">
                                    <input type="file" 
                                           class="form-control d-none" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*">
                                    <div id="uploadPlaceholder">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                        <h5>Kéo thả hình ảnh hoặc nhấp để chọn</h5>
                                        <p class="text-muted">Hỗ trợ: JPG, JPEG, PNG, GIF (Tối đa 10MB)</p>
                                        <button type="button" class="btn btn-primary" onclick="document.getElementById('image').click()">
                                            <i class="fas fa-folder-open me-2"></i>Chọn Tệp
                                        </button>
                                    </div>
                                    <div id="imagePreview" class="d-none">
                                        <img id="previewImg" src="" class="img-fluid rounded mb-3" style="max-height: 200px;">
                                        <div>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="removeImage()">
                                                <i class="fas fa-trash me-1"></i>Xóa
                                            </button>
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('image').click()">
                                                <i class="fas fa-edit me-1"></i>Thay Đổi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="col-md-6 d-grid mb-2">
                                    <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                        <i class="fas fa-save me-2"></i>Lưu Sản Phẩm
                                    </button>
                                </div>
                                <div class="col-md-6 d-grid mb-2">
                                    <a href="/Product" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-times me-2"></i>Hủy Bỏ
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tips Card -->
                <div class="card mt-4 border-0 bg-light" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fas fa-lightbulb text-warning me-2"></i>Mẹo để tạo sản phẩm hiệu quả
                        </h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Sử dụng tên sản phẩm rõ ràng và dễ tìm kiếm</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Viết mô tả chi tiết và chính xác</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Đặt giá hợp lý và cạnh tranh</li>
                            <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Chọn hình ảnh chất lượng cao</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Initialize Choices.js cho dropdown danh mục
const categorySelect = new Choices('#category_id', {
    searchEnabled: true,
    placeholder: true,
    placeholderValue: 'Chọn danh mục...',
    noResultsText: 'Không tìm thấy danh mục',
    itemSelectText: 'Nhấn để chọn',
});

// Đếm ký tự cho mô tả
const descriptionTextarea = document.getElementById('description');
const charCount = document.getElementById('charCount');

function updateCharCount() {
    const length = descriptionTextarea.value.length;
    charCount.textContent = length;
    
    if (length > 450) {
        charCount.className = 'text-warning';
    } else if (length > 500) {
        charCount.className = 'text-danger';
    } else {
        charCount.className = 'text-muted';
    }
}

descriptionTextarea.addEventListener('input', updateCharCount);
updateCharCount();

// Xử lý upload hình ảnh
const imageInput = document.getElementById('image');
const uploadPlaceholder = document.getElementById('uploadPlaceholder');
const imagePreview = document.getElementById('imagePreview');
const previewImg = document.getElementById('previewImg');

imageInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Kiểm tra kích thước file (10MB)
        if (file.size > 10 * 1024 * 1024) {
            showAlert('error', 'Kích thước file quá lớn. Vui lòng chọn file nhỏ hơn 10MB.');
            return;
        }

        // Kiểm tra loại file
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            showAlert('error', 'Chỉ chấp nhận file hình ảnh (JPG, JPEG, PNG, GIF, WEBP).');
            return;
        }

        // Hiển thị preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            uploadPlaceholder.classList.add('d-none');
            imagePreview.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
});

// Xóa hình ảnh đã chọn
function removeImage() {
    imageInput.value = '';
    uploadPlaceholder.classList.remove('d-none');
    imagePreview.classList.add('d-none');
}

// Drag and drop functionality
const uploadArea = document.querySelector('.upload-area');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    uploadArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    uploadArea.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    uploadArea.classList.add('border-success');
}

function unhighlight(e) {
    uploadArea.classList.remove('border-success');
}

uploadArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    imageInput.files = files;
    imageInput.dispatchEvent(new Event('change'));
}

// Hiển thị thông báo
function showAlert(type, message) {
    const alertContainer = document.getElementById('alertContainer');
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const icon = type === 'success' ? 'check-circle' : 'exclamation-triangle';
    
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <i class="fas fa-${icon} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    alertContainer.innerHTML = alertHtml;
    
    // Tự động ẩn sau 5 giây
    setTimeout(() => {
        const alert = alertContainer.querySelector('.alert');
        if (alert) {
            bootstrap.Alert.getOrCreateInstance(alert).close();
        }
    }, 5000);
}

// Xóa các lỗi validation cũ
function clearValidationErrors() {
    document.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove('is-invalid');
    });
    document.querySelectorAll('.invalid-feedback').forEach(el => {
        el.textContent = '';
    });
}

// Hiển thị lỗi validation từ API
function showValidationErrors(errors) {
    clearValidationErrors();
    
    for (const [field, error] of Object.entries(errors)) {
        const input = document.getElementById(field);
        if (input) {
            input.classList.add('is-invalid');
            const feedback = input.parentElement.querySelector('.invalid-feedback') || 
                           input.closest('.input-group')?.nextElementSibling;
            if (feedback) {
                feedback.textContent = error;
            }
        }
    }
}

// Xử lý submit form với API
document.getElementById('productForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Clear previous errors
    clearValidationErrors();
    
    // Lấy nút submit và hiển thị loading
    const submitBtn = document.getElementById('submitBtn');
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang xử lý...';
    submitBtn.disabled = true;
    
    // Tạo FormData object
    const formData = new FormData(this);
    
    try {
        // Gọi API để tạo sản phẩm
        const response = await fetch('/api/product', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Thành công
            showAlert('success', data.message);
            
            // Reset form
            this.reset();
            removeImage();
            updateCharCount();
            categorySelect.setChoiceByValue('');
            
            // Redirect sau 2 giây
            setTimeout(() => {
                window.location.href = '/product';
            }, 2000);
        } else {
            // Có lỗi
            if (data.errors && typeof data.errors === 'object') {
                // Hiển thị lỗi validation
                showValidationErrors(data.errors);
            }
            showAlert('error', data.message || 'Có lỗi xảy ra khi tạo sản phẩm');
        }
    } catch (error) {
        console.error('Error:', error);
        showAlert('error', 'Có lỗi xảy ra khi kết nối với server');
    } finally {
        // Khôi phục nút submit
        submitBtn.innerHTML = originalBtnText;
        submitBtn.disabled = false;
    }
});
</script>

<?php include_once 'app/views/shares/footer.php'; ?>