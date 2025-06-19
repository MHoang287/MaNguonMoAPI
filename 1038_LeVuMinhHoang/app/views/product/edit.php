<?php 
$pageTitle = "Chỉnh Sửa Sản Phẩm";
include_once 'app/views/shares/header.php'; 

// Hàm xử lý đường dẫn hình ảnh
function getImageUrl($imagePath) {
    if (empty($imagePath)) {
        return '';
    }
    
    // Nếu đường dẫn bắt đầu bằng http hoặc https
    if (strpos($imagePath, 'http') === 0) {
        return $imagePath;
    }
    
    // Nếu đường dẫn bắt đầu bằng uploads/
    if (strpos($imagePath, 'uploads/') === 0) {
        return '/' . $imagePath;
    }
    
    // Nếu chỉ có tên file
    return '/uploads/products/' . $imagePath;
}

$currentImageUrl = getImageUrl($product->image);
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản Phẩm</a></li>
                <li class="breadcrumb-item active">Chỉnh Sửa</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0" data-aos="fade-up">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-edit me-2"></i>Chỉnh Sửa Sản Phẩm
                        </h4>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Alert container cho thông báo từ API -->
                        <div id="alertContainer"></div>

                        <!-- Form sử dụng API -->
                        <form id="editProductForm" enctype="multipart/form-data">
                            <!-- Hidden field để API biết đây là PUT request -->
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" id="productId" value="<?= $product->id ?>">

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
                                           value="<?= htmlspecialchars($product->name) ?>"
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
                                               value="<?= $product->price ?>"
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
                                            <option value="<?= $category->id ?>" 
                                                    <?= ($product->category_id == $category->id) ? 'selected' : '' ?>>
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
                                          placeholder="Nhập mô tả chi tiết về sản phẩm (ít nhất 10 ký tự thực)..."
                                          required><?= htmlspecialchars($product->description) ?></textarea>
                                <div class="invalid-feedback"></div>
                                <div class="form-text">
                                    <span id="charCount">0</span>/500 ký tự
                                    <span class="text-danger ms-2" id="charWarning" style="display: none;">
                                        <i class="fas fa-exclamation-circle"></i> Cần ít nhất 10 ký tự thực (không tính dấu cách)
                                    </span>
                                </div>
                            </div>

                            <!-- Current Image -->
                            <?php if (!empty($product->image)): ?>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-image me-1"></i>Hình Ảnh Hiện Tại
                                    </label>
                                    <div class="current-image-container">
                                        <img src="<?= $currentImageUrl ?>" 
                                             class="img-fluid rounded border current-image" 
                                             style="max-height: 200px;"
                                             alt="Current product image"
                                             onerror="this.onerror=null; this.src='https://via.placeholder.com/300x200/f8f9fa/6c757d?text=No+Image';">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- New Image Upload -->
                            <div class="mb-4">
                                <label for="image" class="form-label fw-bold">
                                    <i class="fas fa-camera me-1"></i>Thay Đổi Hình Ảnh
                                </label>
                                <div class="upload-area border-2 border-dashed border-warning rounded p-4 text-center">
                                    <input type="file" 
                                           class="form-control d-none" 
                                           id="image" 
                                           name="image" 
                                           accept="image/*">
                                    <div id="uploadPlaceholder">
                                        <i class="fas fa-cloud-upload-alt fa-2x text-warning mb-2"></i>
                                        <h6>Chọn hình ảnh mới (tùy chọn)</h6>
                                        <p class="text-muted small">Hỗ trợ: JPG, JPEG, PNG, GIF, WEBP (Tối đa 10MB)</p>
                                        <button type="button" class="btn btn-warning btn-sm" onclick="document.getElementById('image').click()">
                                            <i class="fas fa-folder-open me-2"></i>Chọn Tệp
                                        </button>
                                    </div>
                                    <div id="imagePreview" class="d-none">
                                        <img id="previewImg" src="" class="img-fluid rounded mb-3" style="max-height: 200px;">
                                        <div>
                                            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="removeImage()">
                                                <i class="fas fa-trash me-1"></i>Xóa
                                            </button>
                                            <button type="button" class="btn btn-outline-warning btn-sm" onclick="document.getElementById('image').click()">
                                                <i class="fas fa-edit me-1"></i>Thay Đổi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="col-md-4 d-grid mb-2">
                                    <button type="submit" class="btn btn-warning btn-lg" id="updateBtn">
                                        <i class="fas fa-save me-2"></i>Cập Nhật
                                    </button>
                                </div>
                                <div class="col-md-4 d-grid mb-2">
                                    <a href="/Product/show/<?= $product->id ?>" class="btn btn-outline-info btn-lg">
                                        <i class="fas fa-eye me-2"></i>Xem
                                    </a>
                                </div>
                                <div class="col-md-4 d-grid mb-2">
                                    <a href="/Product" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-arrow-left me-2"></i>Quay Lại
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Product Info Card -->
                <div class="card mt-4 border-0 bg-light" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fas fa-info-circle text-info me-2"></i>Thông Tin Sản Phẩm
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>ID:</strong> #<?= $product->id ?></p>
                                <p class="mb-1"><strong>Danh Mục:</strong> <?= htmlspecialchars($product->category_name ?? 'Chưa phân loại') ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Giá Hiện Tại:</strong> <?= number_format($product->price) ?> VNĐ</p>
                                <p class="mb-0"><strong>Hình Ảnh:</strong> <?= !empty($product->image) ? 'Có' : 'Chưa có' ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Form validation styles */
.is-invalid {
    border-color: #dc3545 !important;
}

.invalid-feedback {
    display: none;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}

.is-invalid ~ .invalid-feedback {
    display: block;
}

textarea.is-invalid:focus {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

#charWarning {
    font-size: 0.875em;
    font-weight: 500;
}
</style>

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
const charWarning = document.getElementById('charWarning');

function updateCharCount() {
    const length = descriptionTextarea.value.length;
    charCount.textContent = length;
    
    // Kiểm tra độ dài thực (loại bỏ ký tự đặc biệt)
    const realContent = descriptionTextarea.value.replace(/[\s\.\,\!\?\-\_\(\)\[\]\{\}\:\;\'\"\`\/\\]/g, '');
    const realLength = realContent.length;
    
    // Hiển thị cảnh báo nếu không đủ 10 ký tự thực
    if (realLength < 10) {
        charWarning.style.display = 'inline';
        descriptionTextarea.classList.add('is-invalid');
    } else {
        charWarning.style.display = 'none';
        descriptionTextarea.classList.remove('is-invalid');
    }
    
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
        // Kiểm tra kích thước file
        if (file.size > 10 * 1024 * 1024) {
            showAlert('error', 'Kích thước file quá lớn. Vui lòng chọn file nhỏ hơn 10MB.');
            this.value = '';
            return;
        }

        // Kiểm tra loại file
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        if (!allowedTypes.includes(file.type)) {
            showAlert('error', 'Chỉ chấp nhận file hình ảnh (JPG, JPEG, PNG, GIF, WEBP).');
            this.value = '';
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

// Hiển thị thông báo
function showAlert(type, message) {
    const alertContainer = document.getElementById('alertContainer');
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const icon = type === 'success' ? 'check-circle' : 'exclamation-triangle';
    
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <i class="fas fa-${icon} me-2"></i>
            <span>${message}</span>
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
                feedback.style.display = 'block';
            }
        }
    }
    
    // Hiển thị thông báo tổng quát
    let errorMessages = Object.values(errors).join('<br>');
    showAlert('error', `<strong>Lỗi validation:</strong><br>${errorMessages}`);
}

// Xử lý submit form với API
document.getElementById('editProductForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    // Clear previous errors
    clearValidationErrors();
    
    // Kiểm tra mô tả có đủ 10 ký tự thực không
    const descriptionValue = document.getElementById('description').value;
    const realContent = descriptionValue.replace(/[\s\.\,\!\?\-\_\(\)\[\]\{\}\:\;\'\"\`\/\\]/g, '');
    if (realContent.length < 10) {
        showValidationErrors({
            description: 'Mô tả phải có ít nhất 10 ký tự thực sự (không tính ký tự đặc biệt/dấu cách)'
        });
        descriptionTextarea.scrollIntoView({ behavior: 'smooth', block: 'center' });
        descriptionTextarea.focus();
        return;
    }
    
    // Lấy nút submit và hiển thị loading
    const updateBtn = document.getElementById('updateBtn');
    const originalBtnText = updateBtn.innerHTML;
    updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang cập nhật...';
    updateBtn.disabled = true;
    
    // Lấy product ID
    const productId = document.getElementById('productId').value;
    
    // Tạo FormData object
    const formData = new FormData(this);
    
    try {
        // Gọi API để cập nhật sản phẩm
        // Sử dụng POST với _method=PUT vì browser không hỗ trợ PUT với FormData
        const response = await fetch(`/api/product/${productId}`, {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Thành công
            showAlert('success', data.message);
            
            // Cập nhật hình ảnh hiện tại nếu có hình mới
            if (data.image_path && imageInput.files.length > 0) {
                const currentImage = document.querySelector('.current-image');
                if (currentImage) {
                    // Cập nhật src với timestamp để force reload
                    currentImage.src = '/uploads/products/' + data.image_path + '?t=' + new Date().getTime();
                }
            }
            
            // Reset preview hình ảnh mới
            removeImage();
            
            // Redirect sau 2 giây
            setTimeout(() => {
                window.location.href = `/product/show/${productId}`;
            }, 2000);
        } else {
            // Có lỗi
            if (data.errors && typeof data.errors === 'object') {
                // Hiển thị lỗi validation
                showValidationErrors(data.errors);
                
                // Nếu có lỗi mô tả, scroll đến trường mô tả
                if (data.errors.description) {
                    descriptionTextarea.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    descriptionTextarea.focus();
                }
            }
            
            // Hiển thị message cụ thể nếu có
            const errorMessage = data.message || 'Có lỗi xảy ra khi cập nhật sản phẩm';
            showAlert('error', errorMessage);
        }
    } catch (error) {
        console.error('Error:', error);
        showAlert('error', 'Có lỗi xảy ra khi kết nối với server');
    } finally {
        // Khôi phục nút submit
        updateBtn.innerHTML = originalBtnText;
        updateBtn.disabled = false;
    }
});

// Xử lý lỗi load hình ảnh hiện tại
document.addEventListener('DOMContentLoaded', function() {
    const currentImage = document.querySelector('.current-image');
    if (currentImage) {
        // Nếu hình ảnh không load được, sẽ hiển thị placeholder
        // Event onerror đã được set trong HTML
    }
    
    // Kiểm tra mô tả ban đầu
    updateCharCount();
});
</script>

<?php include_once 'app/views/shares/footer.php'; ?>