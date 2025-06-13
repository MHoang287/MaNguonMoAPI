<?php 
$pageTitle = "Chỉnh Sửa Sản Phẩm";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb - Đường dẫn điều hướng -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản Phẩm</a></li>
                <li class="breadcrumb-item active">Chỉnh Sửa</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Loading State - Trạng thái đang tải -->
                <div id="loadingContainer" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Đang tải...</span>
                    </div>
                    <div class="mt-2">Đang tải thông tin sản phẩm...</div>
                </div>

                <!-- Edit Form - Form chỉnh sửa -->
                <div id="editContainer" style="display: none;">
                    <div class="card shadow-lg border-0" data-aos="fade-up">
                        <div class="card-header bg-warning text-dark">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-edit me-2"></i>Chỉnh Sửa Sản Phẩm
                            </h4>
                        </div>
                        
                        <div class="card-body p-4">
                            <!-- Error Container -->
                            <div id="errorContainer" class="alert alert-danger" style="display: none;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Có lỗi xảy ra:</strong>
                                <ul id="errorList" class="mb-0 mt-2"></ul>
                            </div>

                            <!-- Success Container -->
                            <div id="successContainer" class="alert alert-success" style="display: none;">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong id="successMessage"></strong>
                            </div>

                            <form id="editProductForm">
                                <!-- Hidden field để lưu ID sản phẩm -->
                                <input type="hidden" id="productId" name="id">

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
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- Mô tả -->
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
                                    <div class="col-md-4 d-grid mb-2">
                                        <button type="submit" class="btn btn-warning btn-lg" id="updateBtn">
                                            <i class="fas fa-save me-2"></i>Cập Nhật
                                        </button>
                                    </div>
                                    <div class="col-md-4 d-grid mb-2">
                                        <button type="button" id="viewBtn" class="btn btn-outline-info btn-lg">
                                            <i class="fas fa-eye me-2"></i>Xem
                                        </button>
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

                    <!-- Product Info Card - Thông tin sản phẩm -->
                    <div class="card mt-4 border-0 bg-light" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body">
                            <h6 class="card-title">
                                <i class="fas fa-info-circle text-info me-2"></i>Thông Tin Sản Phẩm
                            </h6>
                            <div class="row" id="productInfo">
                                <!-- Thông tin sản phẩm sẽ được điền vào đây -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Error State - Trạng thái lỗi -->
                <div id="errorState" class="text-center py-5" style="display: none;">
                    <i class="fas fa-exclamation-triangle fa-5x text-danger mb-4"></i>
                    <h3 class="text-danger">Không tìm thấy sản phẩm</h3>
                    <p class="text-muted mb-4">Sản phẩm không tồn tại hoặc đã bị xóa.</p>
                    <a href="/Product" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Về danh sách sản phẩm
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Lấy ID sản phẩm từ URL
const urlParts = window.location.pathname.split('/');
const productId = urlParts[urlParts.length - 1];

console.log('ID sản phẩm từ URL:', productId);

// Khởi tạo khi tài liệu được tải xong
$(document).ready(function() {
    console.log('Khởi tạo trang chỉnh sửa sản phẩm');
    
    // Tải dữ liệu sản phẩm và danh mục song song
    Promise.all([
        loadProductData(productId),
        loadCategories()
    ]).then(() => {
        console.log('Đã tải xong dữ liệu, hiển thị form');
        showEditForm();
    }).catch(error => {
        console.error('Lỗi khi tải dữ liệu:', error);
        showErrorState();
    });

    // Thiết lập event listeners
    setupEventListeners();
    
    // Khởi tạo character counter
    initializeCharacterCounter();
});

/**
 * Thiết lập các event listener
 */
function setupEventListeners() {
    console.log('Thiết lập event listeners');
    
    // Xử lý submit form
    $('#editProductForm').on('submit', function(e) {
        e.preventDefault();
        console.log('Form chỉnh sửa được submit');
        updateProduct();
    });

    // Nút xem sản phẩm
    $('#viewBtn').on('click', function() {
        console.log('Chuyển đến trang xem sản phẩm');
        window.location.href = `/product/show/${productId}`;
    });
    
    // Validate realtime
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
 * Khởi tạo bộ đếm ký tự
 */
function initializeCharacterCounter() {
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
}

/**
 * Tải dữ liệu sản phẩm từ API
 */
function loadProductData(id) {
    console.log('Tải dữ liệu sản phẩm ID:', id);
    
    return fetch(`/api/product/${id}`)
        .then(response => {
            console.log('Response tải sản phẩm:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Dữ liệu sản phẩm:', data);
            
            if (data) {
                populateForm(data); // Điền dữ liệu vào form
                updateProductInfo(data); // Cập nhật thông tin sản phẩm
                return data;
            } else {
                throw new Error('Product not found');
            }
        });
}

/**
 * Tải danh sách danh mục từ API
 */
function loadCategories() {
    console.log('Tải danh sách danh mục');
    
    return fetch('/api/category')
        .then(response => {
            console.log('Response tải danh mục:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Dữ liệu danh mục:', data);
            
            const categorySelect = document.getElementById('category_id');
            categorySelect.innerHTML = '<option value="">Chọn danh mục...</option>';
            
            if (data && Array.isArray(data)) {
                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    categorySelect.appendChild(option);
                });
            }
            return data;
        });
}

/**
 * Điền dữ liệu sản phẩm vào form
 */
function populateForm(product) {
    console.log('Điền dữ liệu vào form:', product.name);
    
    // Điền các field cơ bản
    document.getElementById('productId').value = product.id;
    document.getElementById('name').value = product.name;
    document.getElementById('price').value = product.price;
    document.getElementById('description').value = product.description;
    
    // Set danh mục (phải đợi danh mục được load xong)
    setTimeout(() => {
        if (product.category_id) {
            document.getElementById('category_id').value = product.category_id;
            console.log('Đã set danh mục:', product.category_id);
        }
    }, 100);
    
    // Cập nhật character count
    const event = new Event('input');
    document.getElementById('description').dispatchEvent(event);
}

/**
 * Cập nhật thông tin sản phẩm hiển thị
 */
function updateProductInfo(product) {
    console.log('Cập nhật thông tin hiển thị');
    
    const productInfo = document.getElementById('productInfo');
    productInfo.innerHTML = `
        <div class="col-md-6">
            <p class="mb-1"><strong>ID:</strong> #${product.id}</p>
            <p class="mb-1"><strong>Danh Mục:</strong> ${product.category_name || 'Chưa phân loại'}</p>
        </div>
        <div class="col-md-6">
            <p class="mb-1"><strong>Giá Hiện Tại:</strong> ${formatPrice(product.price)} VNĐ</p>
            <p class="mb-0"><strong>Hình Ảnh:</strong> ${product.image ? 'Có' : 'Chưa có'}</p>
        </div>
    `;
}

/**
 * Cập nhật sản phẩm sử dụng API
 */
function updateProduct() {
    console.log('Bắt đầu cập nhật sản phẩm');
    
    const updateBtn = document.getElementById('updateBtn');
    const originalContent = updateBtn.innerHTML;
    
    // Hiển thị trạng thái loading
    updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang cập nhật...';
    updateBtn.disabled = true;
    
    // Xóa các thông báo trước đó
    clearErrors();
    clearSuccess();
    
    // Lấy dữ liệu từ form
    const formData = {
        name: document.getElementById('name').value.trim(),
        description: document.getElementById('description').value.trim(),
        price: document.getElementById('price').value,
        category_id: document.getElementById('category_id').value || null
    };
    
    console.log('Dữ liệu cập nhật:', formData);
    
    // Validate dữ liệu
    if (!validateFormData(formData)) {
        console.log('Validation thất bại');
        updateBtn.innerHTML = originalContent;
        updateBtn.disabled = false;
        return;
    }
    
    // Gửi request PUT đến API
    fetch(`/api/product/${productId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(formData)
    })
    .then(response => {
        console.log('Response cập nhật:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Kết quả cập nhật:', data);
        
        if (data.message === 'Product updated successfully') {
            // Thành công
            console.log('Cập nhật thành công');
            showSuccess('Sản phẩm đã được cập nhật thành công!');
            
            // Hiển thị modal xác nhận
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: 'Sản phẩm đã được cập nhật thành công',
                showCancelButton: true,
                confirmButtonText: 'Xem sản phẩm',
                cancelButtonText: 'Tiếp tục chỉnh sửa'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/product/show/${productId}`;
                }
            });
        } else if (data.errors) {
            // Có lỗi validation
            console.log('Có lỗi validation:', data.errors);
            displayErrors(data.errors);
        } else {
            throw new Error('Update failed');
        }
    })
    .catch(error => {
        console.error('Lỗi khi cập nhật sản phẩm:', error);
        showError('Có lỗi xảy ra khi cập nhật sản phẩm. Vui lòng thử lại sau.');
    })
    .finally(() => {
        // Khôi phục nút
        updateBtn.innerHTML = originalContent;
        updateBtn.disabled = false;
    });
}

/**
 * Validate dữ liệu form
 */
function validateFormData(data) {
    console.log('Validate dữ liệu:', data);
    let isValid = true;
    
    if (!data.name) {
        showFieldError('name', 'Tên sản phẩm không được để trống');
        isValid = false;
    } else if (data.name.length < 3) {
        showFieldError('name', 'Tên sản phẩm phải có ít nhất 3 ký tự');
        isValid = false;
    }
    
    if (!data.description) {
        showFieldError('description', 'Mô tả không được để trống');
        isValid = false;
    } else if (data.description.length < 10) {
        showFieldError('description', 'Mô tả phải có ít nhất 10 ký tự');
        isValid = false;
    }
    
    if (!data.price || data.price < 0) {
        showFieldError('price', 'Giá sản phẩm không hợp lệ');
        isValid = false;
    }
    
    return isValid;
}

/**
 * Validate field cụ thể
 */
function validateField(fieldName, condition, errorMessage) {
    const field = document.getElementById(fieldName);
    
    if (condition) {
        field.classList.remove('is-invalid');
        const feedback = field.nextElementSibling;
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = '';
        }
    } else {
        showFieldError(fieldName, errorMessage);
    }
}

/**
 * Hiển thị lỗi cho field cụ thể
 */
function showFieldError(fieldName, message) {
    console.log('Lỗi field:', fieldName, '-', message);
    
    const field = document.getElementById(fieldName);
    if (field) {
        field.classList.add('is-invalid');
        
        let feedback = field.nextElementSibling;
        if (feedback && feedback.classList.contains('input-group')) {
            feedback = feedback.nextElementSibling;
        }
        
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = message;
        }
    }
}

/**
 * Hiển thị danh sách lỗi từ server
 */
function displayErrors(errors) {
    console.log('Hiển thị lỗi từ server:', errors);
    
    const errorContainer = document.getElementById('errorContainer');
    const errorList = document.getElementById('errorList');
    
    errorList.innerHTML = '';
    
    for (const [field, message] of Object.entries(errors)) {
        const li = document.createElement('li');
        li.textContent = message;
        errorList.appendChild(li);
        
        showFieldError(field, message);
    }
    
    errorContainer.style.display = 'block';
    errorContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

/**
 * Xóa tất cả lỗi
 */
function clearErrors() {
    document.getElementById('errorContainer').style.display = 'none';
    
    const invalidFields = document.querySelectorAll('.is-invalid');
    invalidFields.forEach(field => {
        field.classList.remove('is-invalid');
    });
    
    const feedbacks = document.querySelectorAll('.invalid-feedback');
    feedbacks.forEach(feedback => {
        feedback.textContent = '';
    });
}

/**
 * Hiển thị thông báo thành công
 */
function showSuccess(message) {
    const successContainer = document.getElementById('successContainer');
    const successMessage = document.getElementById('successMessage');
    
    successMessage.textContent = message;
    successContainer.style.display = 'block';
    successContainer.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

/**
 * Xóa thông báo thành công
 */
function clearSuccess() {
    document.getElementById('successContainer').style.display = 'none';
}

/**
 * Hiển thị form chỉnh sửa
 */
function showEditForm() {
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('editContainer').style.display = 'block';
}

/**
 * Hiển thị trạng thái lỗi
 */
function showErrorState() {
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('errorState').style.display = 'block';
}

/**
 * Định dạng giá tiền
 */
function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price);
}

/**
 * Hiển thị thông báo lỗi chung
 */
function showError(message) {
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