<?php 
$pageTitle = "Thêm Sản Phẩm";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb - Đường dẫn điều hướng -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản Phẩm</a></li>
                <li class="breadcrumb-item active">Thêm Sản Phẩm</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Form Card -->
                <div class="card shadow-lg border-0" data-aos="fade-up">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Thêm Sản Phẩm Mới
                        </h4>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Error Container - Hiển thị lỗi -->
                        <div id="errorContainer" class="alert alert-danger" style="display: none;">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Có lỗi xảy ra:</strong>
                            <ul id="errorList" class="mb-0 mt-2"></ul>
                        </div>

                        <!-- Success Container - Hiển thị thành công -->
                        <div id="successContainer" class="alert alert-success" style="display: none;">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong id="successMessage"></strong>
                        </div>

                        <!-- Product Form -->
                        <form id="productForm">
                            <div class="row">
                                <!-- Tên sản phẩm -->
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

                                <!-- Giá sản phẩm -->
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

                            <!-- Danh mục -->
                            <div class="mb-3">
                                <label for="category_id" class="form-label fw-bold">
                                    <i class="fas fa-list me-1"></i>Danh Mục
                                </label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="">Chọn danh mục...</option>
                                    <!-- Danh mục sẽ được load từ API -->
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Mô tả sản phẩm -->
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

                            <!-- Nút hành động -->
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

                <!-- Tips Card - Gợi ý -->
                <div class="card mt-4 border-0 bg-light" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fas fa-lightbulb text-warning me-2"></i>Mẹo để tạo sản phẩm hiệu quả
                        </h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Sử dụng tên sản phẩm rõ ràng và dễ tìm kiếm</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Viết mô tả chi tiết và chính xác</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Đặt giá hợp lý và cạnh tranh</li>
                            <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Chọn danh mục phù hợp</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Khởi tạo khi tài liệu được tải xong
$(document).ready(function() {
    console.log('Khởi tạo trang thêm sản phẩm');
    
    // Tải danh sách danh mục từ API
    loadCategories();
    
    // Thiết lập các event listener
    setupEventListeners();
    
    // Khởi tạo character counter cho mô tả
    initializeCharacterCounter();
});

/**
 * Thiết lập các event listener
 */
function setupEventListeners() {
    console.log('Thiết lập event listeners');
    
    // Xử lý submit form
    $('#productForm').on('submit', function(e) {
        e.preventDefault(); // Ngăn form submit theo cách thông thường
        console.log('Form được submit');
        submitForm();
    });
    
    // Validate realtime khi người dùng nhập
    $('#name').on('input', function() {
        validateField('name', this.value.trim(), 'Tên sản phẩm không được để trống');
    });
    
    $('#price').on('input', function() {
        const price = parseFloat(this.value);
        validateField('price', price >= 0, 'Giá sản phẩm phải lớn hơn hoặc bằng 0');
    });
    
    $('#description').on('input', function() {
        validateField('description', this.value.trim(), 'Mô tả không được để trống');
    });
}

/**
 * Khởi tạo bộ đếm ký tự cho mô tả
 */
function initializeCharacterCounter() {
    const descriptionTextarea = document.getElementById('description');
    const charCount = document.getElementById('charCount');

    function updateCharCount() {
        const length = descriptionTextarea.value.length;
        charCount.textContent = length;
        
        // Thay đổi màu sắc theo độ dài
        if (length > 450) {
            charCount.className = 'text-warning';
        } else if (length > 500) {
            charCount.className = 'text-danger';
        } else {
            charCount.className = 'text-muted';
        }
        
        console.log('Số ký tự mô tả:', length);
    }

    // Lắng nghe sự kiện nhập liệu
    descriptionTextarea.addEventListener('input', updateCharCount);
    
    // Cập nhật lần đầu
    updateCharCount();
}

/**
 * Tải danh sách danh mục từ API
 */
function loadCategories() {
    console.log('Bắt đầu tải danh sách danh mục từ API');
    
    // Gọi API để lấy danh mục (giả sử có CategoryApiController)
    fetch('/api/category')
        .then(response => {
            console.log('Response từ API danh mục:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Dữ liệu danh mục nhận được:', data);
            
            const categorySelect = document.getElementById('category_id');
            categorySelect.innerHTML = '<option value="">Chọn danh mục...</option>';
            
            if (data && Array.isArray(data)) {
                // Tạo option cho mỗi danh mục
                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    categorySelect.appendChild(option);
                    console.log('Đã thêm danh mục:', category.name);
                });
            }
        })
        .catch(error => {
            console.error('Lỗi khi tải danh mục:', error);
            showError('Không thể tải danh sách danh mục. Vui lòng thử lại sau.');
        });
}

/**
 * Submit form và gửi dữ liệu đến API
 */
function submitForm() {
    console.log('Bắt đầu submit form');
    
    const submitBtn = document.getElementById('submitBtn');
    const originalContent = submitBtn.innerHTML;
    
    // Hiển thị trạng thái loading
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang lưu...';
    submitBtn.disabled = true;
    
    // Xóa các lỗi trước đó
    clearErrors();
    clearSuccess();
    
    // Lấy dữ liệu từ form
    const formData = {
        name: document.getElementById('name').value.trim(),
        description: document.getElementById('description').value.trim(),
        price: document.getElementById('price').value,
        category_id: document.getElementById('category_id').value || null
    };
    
    console.log('Dữ liệu form:', formData);
    
    // Validate dữ liệu phía client
    if (!validateFormData(formData)) {
        console.log('Validation failed');
        // Khôi phục nút
        submitBtn.innerHTML = originalContent;
        submitBtn.disabled = false;
        return;
    }
    
    // Gửi dữ liệu đến API
    fetch('/api/product', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(formData)
    })
    .then(response => {
        console.log('Response từ API:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Dữ liệu response:', data);
        
        if (data.message === 'Product created successfully') {
            // Thành công
            console.log('Tạo sản phẩm thành công');
            showSuccess('Sản phẩm đã được tạo thành công!');
            
            // Hiển thị modal xác nhận
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: 'Sản phẩm đã được tạo thành công',
                showCancelButton: true,
                confirmButtonText: 'Về danh sách',
                cancelButtonText: 'Thêm sản phẩm khác'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Chuyển hướng về danh sách
                    window.location.href = '/Product';
                } else {
                    // Reset form để thêm sản phẩm mới
                    resetForm();
                }
            });
        } else if (data.errors) {
            // Có lỗi validation từ server
            console.log('Có lỗi validation:', data.errors);
            displayErrors(data.errors);
        } else {
            throw new Error('Unknown response format');
        }
    })
    .catch(error => {
        console.error('Lỗi khi tạo sản phẩm:', error);
        showError('Có lỗi xảy ra khi tạo sản phẩm. Vui lòng thử lại sau.');
    })
    .finally(() => {
        // Khôi phục nút submit
        submitBtn.innerHTML = originalContent;
        submitBtn.disabled = false;
    });
}

/**
 * Validate dữ liệu form phía client
 */
function validateFormData(data) {
    console.log('Validate dữ liệu form:', data);
    let isValid = true;
    
    // Validate tên sản phẩm
    if (!data.name) {
        showFieldError('name', 'Tên sản phẩm không được để trống');
        isValid = false;
    } else if (data.name.length < 3) {
        showFieldError('name', 'Tên sản phẩm phải có ít nhất 3 ký tự');
        isValid = false;
    }
    
    // Validate mô tả
    if (!data.description) {
        showFieldError('description', 'Mô tả không được để trống');
        isValid = false;
    } else if (data.description.length < 10) {
        showFieldError('description', 'Mô tả phải có ít nhất 10 ký tự');
        isValid = false;
    }
    
    // Validate giá
    if (!data.price || data.price < 0) {
        showFieldError('price', 'Giá sản phẩm không hợp lệ');
        isValid = false;
    } else if (data.price > 999999999) {
        showFieldError('price', 'Giá sản phẩm quá lớn');
        isValid = false;
    }
    
    console.log('Kết quả validation:', isValid);
    return isValid;
}

/**
 * Validate một field cụ thể
 */
function validateField(fieldName, condition, errorMessage) {
    const field = document.getElementById(fieldName);
    
    if (condition) {
        // Valid - xóa lỗi
        field.classList.remove('is-invalid');
        const feedback = field.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = '';
        }
    } else {
        // Invalid - hiển thị lỗi
        showFieldError(fieldName, errorMessage);
    }
}

/**
 * Hiển thị lỗi cho field cụ thể
 */
function showFieldError(fieldName, message) {
    console.log('Hiển thị lỗi cho field:', fieldName, '-', message);
    
    const field = document.getElementById(fieldName);
    if (field) {
        field.classList.add('is-invalid');
        
        // Tìm element hiển thị lỗi
        let feedback = field.nextElementSibling;
        if (feedback && feedback.classList.contains('input-group')) {
            // Trường hợp input-group (như price)
            feedback = feedback.nextElementSibling;
        }
        
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = message;
        }
    }
}

/**
 * Hiển thị danh sách lỗi từ API response
 */
function displayErrors(errors) {
    console.log('Hiển thị danh sách lỗi:', errors);
    
    const errorContainer = document.getElementById('errorContainer');
    const errorList = document.getElementById('errorList');
    
    // Xóa danh sách lỗi cũ
    errorList.innerHTML = '';
    
    // Thêm từng lỗi vào danh sách
    for (const [field, message] of Object.entries(errors)) {
        const li = document.createElement('li');
        li.textContent = message;
        errorList.appendChild(li);
        
        // Hiển thị lỗi cho field cụ thể
        showFieldError(field, message);
    }
    
    // Hiển thị container lỗi
    errorContainer.style.display = 'block';
    
    // Scroll đến vị trí lỗi
    errorContainer.scrollIntoView({ 
        behavior: 'smooth', 
        block: 'center' 
    });
}

/**
 * Xóa tất cả thông báo lỗi
 */
function clearErrors() {
    console.log('Xóa tất cả lỗi');
    
    // Ẩn container lỗi
    document.getElementById('errorContainer').style.display = 'none';
    
    // Xóa lỗi từ các field
    const invalidFields = document.querySelectorAll('.is-invalid');
    invalidFields.forEach(field => {
        field.classList.remove('is-invalid');
    });
    
    // Xóa nội dung feedback
    const feedbacks = document.querySelectorAll('.invalid-feedback');
    feedbacks.forEach(feedback => {
        feedback.textContent = '';
    });
}

/**
 * Hiển thị thông báo thành công
 */
function showSuccess(message) {
    console.log('Hiển thị thông báo thành công:', message);
    
    const successContainer = document.getElementById('successContainer');
    const successMessage = document.getElementById('successMessage');
    
    successMessage.textContent = message;
    successContainer.style.display = 'block';
    
    // Scroll đến thông báo
    successContainer.scrollIntoView({ 
        behavior: 'smooth', 
        block: 'center' 
    });
}

/**
 * Xóa thông báo thành công
 */
function clearSuccess() {
    document.getElementById('successContainer').style.display = 'none';
}

/**
 * Reset form về trạng thái ban đầu
 */
function resetForm() {
    console.log('Reset form');
    
    // Reset tất cả input
    document.getElementById('productForm').reset();
    
    // Xóa lỗi và thông báo
    clearErrors();
    clearSuccess();
    
    // Reset character counter
    document.getElementById('charCount').textContent = '0';
    document.getElementById('charCount').className = 'text-muted';
    
    // Focus vào field đầu tiên
    document.getElementById('name').focus();
}

/**
 * Hiển thị thông báo lỗi chung
 */
function showError(message) {
    console.error('Lỗi:', message);
    
    Swal.fire({
        icon: 'error',
        title: 'Lỗi!',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });
}
</script>

<?php include_once 'app/views/shares/footer.php'; ?>