<?php 
$pageTitle = "Chỉnh Sửa Danh Mục";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb - Đường dẫn điều hướng -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/category/list" class="text-decoration-none">Danh Mục</a></li>
                <li class="breadcrumb-item active">Chỉnh Sửa</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Loading State - Trạng thái đang tải dữ liệu từ API -->
                <div id="loadingContainer" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Đang tải...</span>
                    </div>
                    <div class="mt-2">Đang tải thông tin danh mục từ CategoryApiController...</div>
                </div>

                <!-- Edit Form Container - Chứa form chỉnh sửa -->
                <div id="editContainer" style="display: none;">
                    <!-- Main Form Card -->
                    <div class="card shadow-lg border-0" data-aos="fade-up">
                        <div class="card-header bg-gradient text-white position-relative" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-edit me-2"></i>Chỉnh Sửa Danh Mục với API
                            </h4>
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-light text-dark" id="categoryIdBadge">
                                    ID: Đang tải...
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
                                        <p class="mb-0">Dữ liệu được load từ <code>GET /api/category/{id}</code> và cập nhật qua <code>PUT /api/category/{id}</code></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Error Container -->
                            <div id="errorContainer" class="alert alert-danger" style="display: none;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Có lỗi xảy ra:</strong>
                                <div id="errorMessage" class="mt-2"></div>
                            </div>

                            <!-- Success Container -->
                            <div id="successContainer" class="alert alert-success" style="display: none;">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong id="successMessage"></strong>
                            </div>

                            <!-- Form chỉnh sửa danh mục -->
                            <form id="editCategoryForm">
                                <!-- Hidden field chứa ID danh mục -->
                                <input type="hidden" id="categoryId" name="id">

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
                                              placeholder="Nhập mô tả chi tiết về danh mục này..."
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

                                <!-- Comparison Section - So sánh thay đổi -->
                                <div class="mb-4">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-balance-scale text-info me-2"></i>So Sánh Thay Đổi
                                    </label>
                                    <div class="comparison-container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="comparison-card before">
                                                    <h6 class="comparison-title">
                                                        <i class="fas fa-history me-2"></i>Dữ Liệu Gốc
                                                    </h6>
                                                    <div class="comparison-content">
                                                        <div class="comparison-field">
                                                            <strong>Tên:</strong>
                                                            <span id="originalName">Đang tải...</span>
                                                        </div>
                                                        <div class="comparison-field">
                                                            <strong>Mô tả:</strong>
                                                            <span id="originalDescription">Đang tải...</span>
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
                                                            <span id="newName">Chưa có thay đổi</span>
                                                        </div>
                                                        <div class="comparison-field">
                                                            <strong>Mô tả:</strong>
                                                            <span id="newDescription">Chưa có thay đổi</span>
                                                        </div>
                                                    </div>
                                                </div>
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
                                        <button type="button" id="viewBtn" class="btn btn-outline-info btn-lg">
                                            <i class="fas fa-eye me-2"></i>Xem Chi Tiết
                                        </button>
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
                                <i class="fas fa-chart-bar text-primary me-2"></i>Thông Tin Danh Mục
                            </h6>
                            <div class="row" id="categoryStats">
                                <!-- Thống kê sẽ được load bằng JavaScript -->
                                <div class="col-md-3 text-center">
                                    <div class="stat-item">
                                        <i class="fas fa-box fa-2x text-primary mb-2"></i>
                                        <h5 class="mb-1" id="statProducts">0</h5>
                                        <small class="text-muted">Sản Phẩm</small>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="stat-item">
                                        <i class="fas fa-eye fa-2x text-success mb-2"></i>
                                        <h5 class="mb-1" id="statViews">0</h5>
                                        <small class="text-muted">Lượt Xem</small>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="stat-item">
                                        <i class="fas fa-shopping-cart fa-2x text-warning mb-2"></i>
                                        <h5 class="mb-1" id="statOrders">0</h5>
                                        <small class="text-muted">Đơn Hàng</small>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="stat-item">
                                        <i class="fas fa-star fa-2x text-info mb-2"></i>
                                        <h5 class="mb-1" id="statRating">0</h5>
                                        <small class="text-muted">Đánh Giá</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Error State - Trạng thái lỗi khi không tải được dữ liệu -->
                <div id="errorState" class="text-center py-5" style="display: none;">
                    <i class="fas fa-exclamation-triangle fa-5x text-danger mb-4"></i>
                    <h3 class="text-danger">Không tìm thấy danh mục</h3>
                    <p class="text-muted mb-4" id="errorStateMessage">Danh mục không tồn tại hoặc đã bị xóa.</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button class="btn btn-primary" onclick="loadCategoryData()">
                            <i class="fas fa-retry me-2"></i>Thử Lại
                        </button>
                        <a href="/category/list" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Về danh sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* CSS cho comparison section */
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

.stat-item {
    padding: 15px;
    border-radius: 8px;
    background: white;
    margin-bottom: 10px;
}
</style>

<script>
// Lấy ID danh mục từ URL
const urlParts = window.location.pathname.split('/');
const categoryId = urlParts[urlParts.length - 1];

console.log('🆔 ID danh mục từ URL:', categoryId);

// Biến lưu trữ dữ liệu gốc
let originalCategoryData = null;

// Khởi tạo khi tài liệu được tải xong
$(document).ready(function() {
    console.log('🚀 Khởi tạo trang chỉnh sửa danh mục với CategoryApiController');
    
    // Tải dữ liệu danh mục từ API
    loadCategoryData();
    
    // Thiết lập event listeners
    setupEventListeners();
    
    // Thiết lập character counters
    setupCharacterCounters();
});

/**
 * Tải dữ liệu danh mục từ CategoryApiController
 * Sử dụng endpoint: GET /api/category/{id}
 */
async function loadCategoryData() {
    console.log('📚 Tải dữ liệu danh mục từ CategoryApiController');
    
    try {
        // Hiển thị loading
        showLoading();
        
        // Gọi CategoryApiController - method show()
        const response = await fetch(`/api/category/${categoryId}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        console.log('📡 Response từ CategoryApiController:', response.status);
        
        if (!response.ok) {
            if (response.status === 404) {
                throw new Error('Danh mục không tồn tại');
            }
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        // Chuyển đổi response thành JSON
        const data = await response.json();
        console.log('📋 Dữ liệu danh mục nhận được:', data);
        
        if (data && data.id) {
            // Lưu dữ liệu gốc
            originalCategoryData = {...data};
            
            // Điền dữ liệu vào form
            populateForm(data);
            
            // Hiển thị form
            showEditForm();
            
            console.log('✅ Đã tải thành công dữ liệu danh mục');
            
        } else {
            throw new Error('Dữ liệu danh mục không hợp lệ');
        }
        
    } catch (error) {
        console.error('❌ Lỗi khi tải dữ liệu danh mục:', error);
        showErrorState(error.message);
    } finally {
        hideLoading();
    }
}

/**
 * Điền dữ liệu vào form
 * @param {Object} category - Dữ liệu danh mục từ API
 */
function populateForm(category) {
    console.log('📝 Điền dữ liệu vào form:', category.name);
    
    // Điền các field cơ bản
    document.getElementById('categoryId').value = category.id;
    document.getElementById('name').value = category.name;
    document.getElementById('description').value = category.description || '';
    
    // Cập nhật badge ID
    document.getElementById('categoryIdBadge').textContent = `ID: ${category.id}`;
    
    // Cập nhật comparison - phần dữ liệu gốc
    document.getElementById('originalName').textContent = category.name;
    document.getElementById('originalDescription').textContent = 
        category.description || 'Chưa có mô tả';
    
    // Cập nhật comparison - phần mới (ban đầu giống gốc)
    updateComparison();
    
    // Cập nhật character counters
    updateCharCounter('name', 'nameCounter', 100);
    updateCharCounter('description', 'descCounter', 1000);
    
    // Cập nhật thống kê (giả lập)
    updateStatistics();
}

/**
 * Thiết lập character counters
 */
function setupCharacterCounters() {
    // Counter sẽ được setup sau khi load dữ liệu
}

/**
 * Cập nhật character counter
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
        
        // Cập nhật comparison
        updateComparison();
    }
    
    // Lắng nghe sự kiện input
    input.addEventListener('input', update);
    update(); // Cập nhật lần đầu
}

/**
 * Thiết lập event listeners
 */
function setupEventListeners() {
    console.log('🎧 Thiết lập event listeners');
    
    // Xử lý submit form
    $('#editCategoryForm').on('submit', function(e) {
        e.preventDefault();
        console.log('📝 Form chỉnh sửa được submit');
        updateCategory();
    });
    
    // Nút xem chi tiết
    $('#viewBtn').on('click', function() {
        console.log('👁️ Chuyển đến trang xem chi tiết');
        window.location.href = `/category/show/${categoryId}`;
    });
    
    // Validation realtime cho tên danh mục
    $('#name').on('input', function() {
        validateCategoryName(this.value.trim());
    });
    
    // Cập nhật comparison khi thay đổi mô tả
    $('#description').on('input', function() {
        updateComparison();
    });
}

/**
 * Cập nhật comparison section
 */
function updateComparison() {
    const newName = document.getElementById('name').value || 'Chưa có tên';
    const newDescription = document.getElementById('description').value || 'Chưa có mô tả';
    
    document.getElementById('newName').textContent = newName;
    document.getElementById('newDescription').textContent = 
        newDescription.length > 100 ? newDescription.substring(0, 100) + '...' : newDescription;
}

/**
 * Validate tên danh mục
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
        return;
    }
    
    if (name.length < 3) {
        nameInput.classList.add('is-invalid');
        nameError.textContent = 'Tên danh mục phải có ít nhất 3 ký tự';
        return;
    }
    
    if (name === originalCategoryData?.name) {
        // Tên giống như ban đầu
        nameInput.classList.add('is-valid');
        nameSuccess.style.display = 'block';
        return;
    }
    
    // Tên đã thay đổi và hợp lệ
    nameInput.classList.add('is-valid');
    nameSuccess.style.display = 'block';
    
    console.log('✅ Tên danh mục hợp lệ:', name);
}

/**
 * Cập nhật danh mục sử dụng CategoryApiController
 * Sử dụng endpoint: PUT /api/category/{id}
 */
async function updateCategory() {
    console.log('📤 Cập nhật danh mục qua CategoryApiController');
    
    const updateBtn = document.getElementById('updateBtn');
    const originalContent = updateBtn.innerHTML;
    
    try {
        // Hiển thị trạng thái loading
        updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang cập nhật...';
        updateBtn.disabled = true;
        
        // Xóa các thông báo trước đó
        clearMessages();
        
        // Lấy dữ liệu từ form
        const formData = {
            name: document.getElementById('name').value.trim(),
            description: document.getElementById('description').value.trim()
        };
        
        console.log('📋 Dữ liệu gửi đến API:', formData);
        
        // Kiểm tra có thay đổi không
        if (!hasChanges(formData)) {
            showError('Không có thay đổi nào để cập nhật');
            return;
        }
        
        // Validate dữ liệu
        if (!validateFormData(formData)) {
            throw new Error('Dữ liệu không hợp lệ');
        }
        
        // Gửi request đến CategoryApiController - method update()
        const response = await fetch(`/api/category/${categoryId}`, {
            method: 'PUT',
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
            // Cập nhật thành công
            console.log('✅ Cập nhật danh mục thành công');
            
            showSuccess(data.message);
            
            // Cập nhật dữ liệu gốc
            originalCategoryData = {...formData, id: categoryId};
            
            // Hiển thị modal xác nhận
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: 'Danh mục đã được cập nhật thành công',
                showCancelButton: true,
                confirmButtonText: 'Xem chi tiết',
                cancelButtonText: 'Tiếp tục chỉnh sửa',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/category/show/${categoryId}`;
                }
            });
            
        } else {
            // Có lỗi từ API
            throw new Error(data.message || 'Không thể cập nhật danh mục');
        }
        
    } catch (error) {
        console.error('❌ Lỗi khi cập nhật danh mục:', error);
        showError(error.message);
        
    } finally {
        // Khôi phục nút submit
        updateBtn.innerHTML = originalContent;
        updateBtn.disabled = false;
    }
}

/**
 * Kiểm tra có thay đổi so với dữ liệu gốc
 * @param {Object} formData - Dữ liệu từ form
 * @returns {boolean}
 */
function hasChanges(formData) {
    if (!originalCategoryData) return true;
    
    return formData.name !== originalCategoryData.name ||
           formData.description !== (originalCategoryData.description || '');
}

/**
 * Validate dữ liệu form
 * @param {Object} data - Dữ liệu form
 * @returns {boolean}
 */
function validateFormData(data) {
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
    
    return true;
}

/**
 * Cập nhật thống kê (giả lập)
 */
function updateStatistics() {
    // Tạo số liệu giả lập
    const stats = {
        products: Math.floor(Math.random() * 45) + 5,
        views: Math.floor(Math.random() * 900) + 100,
        orders: Math.floor(Math.random() * 90) + 10,
        rating: (Math.random() * 1 + 4).toFixed(1)
    };
    
    // Animate numbers
    animateValue(document.getElementById('statProducts'), 0, stats.products, 1000);
    animateValue(document.getElementById('statViews'), 0, stats.views, 1200);
    animateValue(document.getElementById('statOrders'), 0, stats.orders, 800);
    
    setTimeout(() => {
        document.getElementById('statRating').textContent = stats.rating;
    }, 500);
}

// Các hàm utility tương tự như trong create...

/**
 * Hiển thị thông báo lỗi cho field
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
 */
function showSuccess(message) {
    const container = document.getElementById('successContainer');
    const messageElement = document.getElementById('successMessage');
    
    messageElement.textContent = message;
    container.style.display = 'block';
    container.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

/**
 * Hiển thị thông báo lỗi
 */
function showError(message) {
    const container = document.getElementById('errorContainer');
    const messageElement = document.getElementById('errorMessage');
    
    messageElement.textContent = message;
    container.style.display = 'block';
    container.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

/**
 * Xóa tất cả thông báo
 */
function clearMessages() {
    document.getElementById('errorContainer').style.display = 'none';
    document.getElementById('successContainer').style.display = 'none';
    
    document.querySelectorAll('.is-invalid').forEach(field => {
        field.classList.remove('is-invalid');
    });
    
    document.querySelectorAll('.invalid-feedback').forEach(feedback => {
        feedback.textContent = '';
    });
}

/**
 * Animate giá trị số
 */
function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.textContent = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

/**
 * Hiển thị loading
 */
function showLoading() {
    document.getElementById('loadingContainer').style.display = 'block';
    document.getElementById('editContainer').style.display = 'none';
    document.getElementById('errorState').style.display = 'none';
}

/**
 * Ẩn loading
 */
function hideLoading() {
    document.getElementById('loadingContainer').style.display = 'none';
}

/**
 * Hiển thị form chỉnh sửa
 */
function showEditForm() {
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('editContainer').style.display = 'block';
    document.getElementById('errorState').style.display = 'none';
}

/**
 * Hiển thị trạng thái lỗi
 */
function showErrorState(message) {
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('editContainer').style.display = 'none';
    document.getElementById('errorState').style.display = 'block';
    document.getElementById('errorStateMessage').textContent = message;
}

console.log('🎉 Category Edit API Script loaded successfully');
console.log(`👤 Current user:`);
console.log(`📅 Current time: 2025-06-13 03:15:13`);
</script>

<?php include_once 'app/views/shares/footer.php'; ?>