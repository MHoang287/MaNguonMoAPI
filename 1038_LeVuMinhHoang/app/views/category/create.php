<?php 
$pageTitle = "Thêm Danh Mục";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb - Đường dẫn điều hướng -->
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
                            <i class="fas fa-folder-plus me-2"></i>Tạo Danh Mục Mới với API
                        </h4>
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-calendar me-1"></i><?= date('d/m/Y') ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- API Status Indicator -->
                        <div class="alert alert-info border-0 mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle fa-2x me-3"></i>
                                <div>
                                    <h6 class="alert-heading mb-1">Sử dụng CategoryApiController</h6>
                                    <p class="mb-0">Dữ liệu sẽ được gửi đến <code>POST /api/category</code></p>
                                </div>
                            </div>
                        </div>

                        <!-- Error Container - Hiển thị lỗi từ API -->
                        <div id="errorContainer" class="alert alert-danger" style="display: none;">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Có lỗi xảy ra:</strong>
                            <div id="errorMessage" class="mt-2"></div>
                        </div>

                        <!-- Success Container - Hiển thị thành công -->
                        <div id="successContainer" class="alert alert-success" style="display: none;">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong id="successMessage"></strong>
                        </div>

                        <!-- Form tạo danh mục -->
                        <form id="categoryForm">
                            <!-- Tên danh mục -->
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

                            <!-- Mô tả danh mục -->
                            <div class="mb-4">
                                <label for="description" class="form-label fw-bold">
                                    <i class="fas fa-align-left text-success me-2"></i>Mô Tả Danh Mục
                                </label>
                                <textarea class="form-control form-control-lg" 
                                          id="description" 
                                          name="description" 
                                          rows="6" 
                                          placeholder="Nhập mô tả chi tiết về danh mục này...&#10;&#10;Ví dụ:&#10;- Đặc điểm chính của danh mục&#10;- Loại sản phẩm sẽ có trong danh mục&#10;- Thông tin hữu ích cho khách hàng"
                                          maxlength="1000"></textarea>
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

                            <!-- Preview Section - Xem trước -->
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
                                    <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
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

                <!-- Help Card - Thẻ hướng dẫn -->
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
// Khởi tạo khi tài liệu được tải xong
$(document).ready(function() {
    console.log('🚀 Khởi tạo trang tạo danh mục với CategoryApiController');
    
    // Thiết lập character counters
    setupCharacterCounters();
    
    // Thiết lập event listeners
    setupEventListeners();
    
    // Khởi tạo preview
    updatePreview();
});

/**
 * Thiết lập các bộ đếm ký tự
 */
function setupCharacterCounters() {
    console.log('🔢 Thiết lập character counters');
    
    // Counter cho tên danh mục
    updateCharCounter('name', 'nameCounter', 100);
    
    // Counter cho mô tả
    updateCharCounter('description', 'descCounter', 1000);
}

/**
 * Cập nhật bộ đếm ký tự
 * @param {string} inputId - ID của input
 * @param {string} counterId - ID của counter
 * @param {number} maxLength - Độ dài tối đa
 */
function updateCharCounter(inputId, counterId, maxLength) {
    const input = document.getElementById(inputId);
    const counter = document.getElementById(counterId);
    
    function update() {
        const length = input.value.length;
        counter.textContent = length;
        
        // Đổi màu theo độ dài
        if (length > maxLength * 0.8) {
            counter.className = 'small text-warning';
        } else if (length === maxLength) {
            counter.className = 'small text-danger';
        } else {
            counter.className = 'small text-muted';
        }
        
        // Cập nhật preview
        updatePreview();
    }
    
    // Lắng nghe sự kiện input
    input.addEventListener('input', update);
    update(); // Cập nhật lần đầu
}

/**
 * Thiết lập các event listener
 */
function setupEventListeners() {
    console.log('🎧 Thiết lập event listeners');
    
    // Xử lý submit form
    $('#categoryForm').on('submit', function(e) {
        e.preventDefault();
        console.log('📝 Form được submit');
        submitCategory();
    });
    
    // Validation realtime cho tên danh mục
    $('#name').on('input', function() {
        validateCategoryName(this.value.trim());
    });
    
    // Cập nhật preview khi thay đổi mô tả
    $('#description').on('input', function() {
        updatePreview();
    });
}

/**
 * Validate tên danh mục realtime
 * @param {string} name - Tên danh mục
 */
function validateCategoryName(name) {
    const nameInput = document.getElementById('name');
    const nameError = document.getElementById('nameError');
    const nameSuccess = document.getElementById('nameSuccess');
    
    // Reset trạng thái
    nameInput.classList.remove('is-invalid', 'is-valid');
    nameError.textContent = '';
    nameSuccess.style.display = 'none';
    
    if (name.length === 0) {
        return; // Không validate khi rỗng
    }
    
    if (name.length < 3) {
        // Tên quá ngắn
        nameInput.classList.add('is-invalid');
        nameError.textContent = 'Tên danh mục phải có ít nhất 3 ký tự';
        return;
    }
    
    if (name.length > 100) {
        // Tên quá dài
        nameInput.classList.add('is-invalid');
        nameError.textContent = 'Tên danh mục không được vượt quá 100 ký tự';
        return;
    }
    
    // Validation thành công
    nameInput.classList.add('is-valid');
    nameSuccess.style.display = 'block';
    
    console.log('✅ Tên danh mục hợp lệ:', name);
}

/**
 * Cập nhật preview
 */
function updatePreview() {
    const name = document.getElementById('name').value || 'Tên Danh Mục';
    const description = document.getElementById('description').value || 'Mô tả danh mục sẽ hiển thị ở đây...';
    
    document.getElementById('previewName').textContent = name;
    document.getElementById('previewDescription').textContent = description.length > 100 ? 
        description.substring(0, 100) + '...' : description;
}

/**
 * Submit form tạo danh mục đến CategoryApiController
 * Sử dụng endpoint: POST /api/category
 */
async function submitCategory() {
    console.log('📤 Bắt đầu submit danh mục đến CategoryApiController');
    
    const submitBtn = document.getElementById('submitBtn');
    const originalContent = submitBtn.innerHTML;
    
    try {
        // Hiển thị trạng thái loading
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang tạo...';
        submitBtn.disabled = true;
        
        // Xóa các thông báo trước đó
        clearMessages();
        
        // Lấy dữ liệu từ form
        const formData = {
            name: document.getElementById('name').value.trim(),
            description: document.getElementById('description').value.trim()
        };
        
        console.log('📋 Dữ liệu gửi đến API:', formData);
        
        // Validate dữ liệu phía client
        if (!validateFormData(formData)) {
            throw new Error('Dữ liệu không hợp lệ');
        }
        
        // Gửi request đến CategoryApiController - method store()
        const response = await fetch('/api/category', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(formData)
        });
        
        console.log('📡 Response từ CategoryApiController:', response.status);
        
        // Xử lý response
        const data = await response.json();
        console.log('📋 Response data:', data);
        
        if (response.ok && data.message) {
            // Thành công
            console.log('✅ Tạo danh mục thành công');
            
            showSuccess(data.message);
            
            // Hiển thị modal xác nhận
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: 'Danh mục đã được tạo thành công',
                showCancelButton: true,
                confirmButtonText: 'Về danh sách',
                cancelButtonText: 'Tạo danh mục khác',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Chuyển về danh sách
                    window.location.href = '/category/list';
                } else {
                    // Reset form để tạo danh mục mới
                    resetForm();
                }
            });
            
        } else {
            // Có lỗi từ API
            throw new Error(data.message || 'Không thể tạo danh mục');
        }
        
    } catch (error) {
        console.error('❌ Lỗi khi tạo danh mục:', error);
        showError(error.message);
        
    } finally {
        // Khôi phục nút submit
        submitBtn.innerHTML = originalContent;
        submitBtn.disabled = false;
    }
}

/**
 * Validate dữ liệu form phía client
 * @param {Object} data - Dữ liệu form
 * @returns {boolean} - True nếu hợp lệ
 */
function validateFormData(data) {
    console.log('🔍 Validate dữ liệu form:', data);
    
    if (!data.name || data.name.length < 3) {
        showFieldError('name', 'Tên danh mục phải có ít nhất 3 ký tự');
        return false;
    }
    
    if (data.name.length > 100) {
        showFieldError('name', 'Tên danh mục không được vượt quá 100 ký tự');
        return false;
    }
    
    if (data.description && data.description.length > 1000) {
        showFieldError('description', 'Mô tả không được vượt quá 1000 ký tự');
        return false;
    }
    
    console.log('✅ Dữ liệu form hợp lệ');
    return true;
}

/**
 * Hiển thị lỗi cho field cụ thể
 * @param {string} fieldName - Tên field
 * @param {string} message - Thông báo lỗi
 */
function showFieldError(fieldName, message) {
    const field = document.getElementById(fieldName);
    if (field) {
        field.classList.add('is-invalid');
        
        const errorElement = document.getElementById(fieldName + 'Error');
        if (errorElement) {
            errorElement.textContent = message;
        }
    }
}

/**
 * Hiển thị thông báo thành công
 * @param {string} message - Thông báo
 */
function showSuccess(message) {
    const container = document.getElementById('successContainer');
    const messageElement = document.getElementById('successMessage');
    
    messageElement.textContent = message;
    container.style.display = 'block';
    
    // Scroll đến thông báo
    container.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

/**
 * Hiển thị thông báo lỗi
 * @param {string} message - Thông báo lỗi
 */
function showError(message) {
    const container = document.getElementById('errorContainer');
    const messageElement = document.getElementById('errorMessage');
    
    messageElement.textContent = message;
    container.style.display = 'block';
    
    // Scroll đến thông báo lỗi
    container.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

/**
 * Xóa tất cả thông báo
 */
function clearMessages() {
    document.getElementById('errorContainer').style.display = 'none';
    document.getElementById('successContainer').style.display = 'none';
    
    // Xóa lỗi validation
    document.querySelectorAll('.is-invalid').forEach(field => {
        field.classList.remove('is-invalid');
    });
    
    document.querySelectorAll('.invalid-feedback').forEach(feedback => {
        feedback.textContent = '';
    });
}

/**
 * Reset form về trạng thái ban đầu
 */
function resetForm() {
    console.log('🔄 Reset form');
    
    document.getElementById('categoryForm').reset();
    clearMessages();
    updatePreview();
    
    // Focus vào field đầu tiên
    document.getElementById('name').focus();
}

console.log('🎉 Category Create API Script loaded successfully');
console.log(`👤 Current user: MHoang287`);
console.log(`📅 Current time: 2025-06-13 03:15:13`);
</script>

<?php include_once 'app/views/shares/footer.php'; ?>