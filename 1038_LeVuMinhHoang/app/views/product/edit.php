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
            <div class="col-lg-10">
                <!-- Loading State -->
                <div id="loadingContainer" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Đang tải...</span>
                    </div>
                    <div class="mt-2">Đang tải thông tin sản phẩm từ ProductApiController...</div>
                </div>

                <!-- Edit Form với khả năng chỉnh sửa hình ảnh -->
                <div id="editContainer" style="display: none;">
                    <div class="card shadow-lg border-0" data-aos="fade-up">
                        <div class="card-header bg-gradient-warning text-dark">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-edit me-2"></i>Chỉnh Sửa Sản Phẩm & Hình Ảnh
                                </h4>
                                <div class="mode-indicator">
                                    <span class="badge bg-dark" id="currentMode">Chế độ: JSON</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-body p-4">
                            <!-- Container hiển thị lỗi -->
                            <div id="errorContainer" class="alert alert-danger" style="display: none;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Có lỗi xảy ra:</strong>
                                <ul id="errorList" class="mb-0 mt-2"></ul>
                            </div>

                            <!-- Container hiển thị thành công -->
                            <div id="successContainer" class="alert alert-success" style="display: none;">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong id="successMessage"></strong>
                            </div>

                            <form id="editProductForm" enctype="multipart/form-data">
                                <!-- Hidden field để lưu ID sản phẩm -->
                                <input type="hidden" id="productId" name="id">

                                <div class="row">
                                    <!-- Cột trái: Thông tin cơ bản -->
                                    <div class="col-lg-7">
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
                                                </div>
                                                <div class="invalid-feedback"></div>
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
                                                      rows="4" 
                                                      placeholder="Nhập mô tả chi tiết về sản phẩm..."
                                                      required></textarea>
                                            <div class="invalid-feedback"></div>
                                            <div class="form-text">
                                                <span id="charCount">0</span>/1000 ký tự
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cột phải: Quản lý hình ảnh NÂNG CAO -->
                                    <div class="col-lg-5">
                                        <div class="image-management-section">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-camera me-1"></i>Quản Lý Hình Ảnh
                                            </label>
                                            
                                            <!-- Hiển thị hình ảnh hiện tại -->
                                            <div id="currentImageContainer" class="mb-3">
                                                <!-- Sẽ được load bằng JavaScript -->
                                            </div>
                                            
                                            <!-- Container preview hình ảnh mới -->
                                            <div id="imagePreviewContainer" class="mb-3" style="display: none;">
                                                <label class="small text-success mb-2">
                                                    <i class="fas fa-plus me-1"></i>Hình ảnh mới:
                                                </label>
                                                <div id="imagePreview" class="image-preview-placeholder">
                                                    <div class="text-center">
                                                        <i class="fas fa-cloud-upload-alt fa-2x mb-2 text-success"></i>
                                                        <div class="small">Preview hình ảnh mới</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Input file (hidden) -->
                                            <input type="file" 
                                                   class="d-none" 
                                                   id="imageFile" 
                                                   name="image" 
                                                   accept="image/*">
                                            
                                            <!-- Các nút điều khiển hình ảnh -->
                                            <div class="image-controls">
                                                <div class="d-grid gap-2">
                                                    <!-- Nút chọn hình ảnh mới -->
                                                    <button type="button" class="btn btn-outline-primary" id="selectImageBtn">
                                                        <i class="fas fa-camera me-2"></i>Chọn Hình Ảnh Mới
                                                    </button>
                                                    
                                                    <!-- Nút điều khiển khi đã chọn hình -->
                                                    <div id="imageActionButtons" style="display: none;">
                                                        <div class="row g-2">
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-success btn-sm w-100" id="keepNewImageBtn">
                                                                    <i class="fas fa-check me-1"></i>Sử dụng
                                                                </button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-outline-danger btn-sm w-100" id="cancelImageBtn">
                                                                    <i class="fas fa-times me-1"></i>Hủy
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Nút xóa hình ảnh hiện tại -->
                                                    <button type="button" class="btn btn-outline-warning btn-sm" id="removeCurrentImageBtn" style="display: none;">
                                                        <i class="fas fa-trash me-2"></i>Xóa Hình Hiện Tại
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Progress bar upload -->
                                            <div id="uploadProgress" class="mt-3" style="display: none;">
                                                <div class="progress mb-2">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
                                                         role="progressbar" 
                                                         style="width: 0%">
                                                    </div>
                                                </div>
                                                <small class="text-muted">
                                                    <i class="fas fa-cloud-upload-alt me-1"></i>Đang cập nhật hình ảnh...
                                                </small>
                                            </div>

                                            <!-- Thông tin hình ảnh mới -->
                                            <div id="imageInfo" class="mt-3" style="display: none;">
                                                <div class="card border-success">
                                                    <div class="card-body p-3">
                                                        <h6 class="card-title mb-2 text-success">
                                                            <i class="fas fa-info-circle me-1"></i>Thông Tin Hình Ảnh
                                                        </h6>
                                                        <div class="row text-center">
                                                            <div class="col-4">
                                                                <small class="text-muted">Kích thước</small>
                                                                <div id="imageDimensions" class="fw-bold small">-</div>
                                                            </div>
                                                            <div class="col-4">
                                                                <small class="text-muted">Dung lượng</small>
                                                                <div id="imageSize" class="fw-bold small">-</div>
                                                            </div>
                                                            <div class="col-4">
                                                                <small class="text-muted">Loại</small>
                                                                <div id="imageType" class="fw-bold small">-</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Chế độ cập nhật -->
                                            <div class="mt-3">
                                                <div class="card border-info">
                                                    <div class="card-body p-3">
                                                        <h6 class="card-title mb-2 text-info">
                                                            <i class="fas fa-cog me-1"></i>Chế Độ Cập Nhật
                                                        </h6>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="updateImageMode">
                                                            <label class="form-check-label" for="updateImageMode">
                                                                <span id="updateModeText">Chỉ cập nhật thông tin (JSON)</span>
                                                            </label>
                                                        </div>
                                                        <small class="text-muted" id="updateModeDescription">
                                                            Bật để cập nhật cả hình ảnh (FormData)
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nút hành động -->
                                <div class="row mt-4">
                                    <div class="col-md-4 d-grid mb-2">
                                        <button type="submit" class="btn btn-warning btn-lg" id="updateBtn">
                                            <i class="fas fa-save me-2"></i>Cập Nhật Sản Phẩm
                                        </button>
                                    </div>
                                    <div class="col-md-4 d-grid mb-2">
                                        <button type="button" id="viewBtn" class="btn btn-outline-info btn-lg">
                                            <i class="fas fa-eye me-2"></i>Xem Chi Tiết
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

                    <!-- Product Info Card -->
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

                <!-- Error State -->
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

<style>
/* CSS cho quản lý hình ảnh nâng cao */
.image-management-section {
    background: linear-gradient(135deg, #f8f9fa, #ffffff);
    border: 1px solid #e9ecef;
    border-radius: 1rem;
    padding: 1.5rem;
}

.current-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 0.5rem;
    border: 2px solid #dee2e6;
    cursor: pointer;
    transition: all 0.3s ease;
}

.current-image:hover {
    opacity: 0.8;
    transform: scale(1.02);
    border-color: #007bff;
}

.current-image-placeholder {
    width: 100%;
    height: 220px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 2px dashed #dee2e6;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    cursor: pointer;
    transition: all 0.3s ease;
}

.current-image-placeholder:hover {
    border-color: #007bff;
    background: linear-gradient(135deg, #e3f2fd, #f8f9fa);
}

.image-preview-placeholder {
    width: 100%;
    height: 160px;
    border: 2px dashed #28a745;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8fff9;
    cursor: pointer;
    transition: all 0.3s ease;
}

.image-preview-placeholder:hover {
    border-color: #198754;
    background-color: #e6f4ea;
}

.image-preview {
    width: 100%;
    height: 160px;
    border-radius: 0.5rem;
    object-fit: cover;
    border: 2px solid #28a745;
    cursor: pointer;
}

.image-fade-in {
    animation: fadeInScale 0.6s ease;
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.mode-indicator .badge {
    font-size: 0.75rem;
    padding: 0.5rem 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .current-image,
    .current-image-placeholder {
        height: 180px;
    }
    
    .image-preview-placeholder,
    .image-preview {
        height: 140px;
    }
    
    .image-management-section {
        padding: 1rem;
    }
}
</style>

<script>
// Biến toàn cục cho trang chỉnh sửa với hình ảnh
let currentProductData = null;
let selectedImageFile = null;
let isImageChanged = false;
let isUploading = false;
let updateMode = 'json'; // 'json' hoặc 'formdata'

// Lấy productId sạch từ URL
function getCleanProductId() {
    const urlPath = window.location.pathname;
    const urlParts = urlPath.split('/');
    const rawId = urlParts[urlParts.length - 1];
    const cleanId = rawId.replace(/[^0-9]/g, '');
    
    console.log('🔗 URL path:', urlPath);
    console.log('🆔 Raw ID:', rawId);
    console.log('🆔 Clean ID:', cleanId);
    
    return cleanId;
}

const productId = getCleanProductId();

// Khởi tạo trang
$(document).ready(function() {
    console.log('🚀 Khởi tạo trang chỉnh sửa sản phẩm với quản lý hình ảnh nâng cao');
    console.log('👤 Current user: MHoang287');
    console.log('📅 Current time: 2025-06-13 05:38:09');
    console.log('🆔 Product ID:', productId);
    
    if (!productId || productId === '') {
        console.error('❌ Không thể lấy product ID từ URL');
        showErrorState();
        return;
    }
    
    // Tải dữ liệu song song
    Promise.all([
        loadProductData(productId),
        loadCategories()
    ]).then(() => {
        console.log('✅ Đã tải xong dữ liệu, hiển thị form');
        showEditForm();
    }).catch(error => {
        console.error('❌ Lỗi khi tải dữ liệu:', error);
        showErrorState();
    });

    // Thiết lập event listeners
    setupEventListeners();
    initializeCharacterCounter();
    initializeImageManagement();
});

/**
 * Thiết lập các event listener
 */
function setupEventListeners() {
    console.log('🎧 Thiết lập event listeners cho quản lý hình ảnh');
    
    // Form submit
    $('#editProductForm').on('submit', function(e) {
        e.preventDefault();
        console.log('📝 Form được submit với mode:', updateMode);
        updateProduct();
    });

    // Nút xem chi tiết
    $('#viewBtn').on('click', function() {
        window.location.href = `/product/show/${productId}`;
    });
    
    // Nút chọn hình ảnh
    $('#selectImageBtn').on('click', function() {
        console.log('📷 Mở dialog chọn hình ảnh');
        document.getElementById('imageFile').click();
    });
    
    // Xử lý khi chọn file
    $('#imageFile').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            console.log('📸 File được chọn:', file.name);
            handleImageSelection(file);
        }
    });
    
    // Nút giữ hình ảnh mới
    $('#keepNewImageBtn').on('click', function() {
        console.log('✅ Xác nhận sử dụng hình ảnh mới');
        confirmImageSelection();
    });
    
    // Nút hủy hình ảnh mới
    $('#cancelImageBtn').on('click', function() {
        console.log('❌ Hủy chọn hình ảnh mới');
        cancelImageSelection();
    });
    
    // Nút xóa hình hiện tại
    $('#removeCurrentImageBtn').on('click', function() {
        console.log('🗑️ Xóa hình ảnh hiện tại');
        removeCurrentImage();
    });
    
    // Switch chế độ cập nhật
    $('#updateImageMode').on('change', function() {
        const isChecked = this.checked;
        updateMode = isChecked ? 'formdata' : 'json';
        updateModeDisplay();
        console.log('🔄 Chuyển đổi mode:', updateMode);
    });
    
    // Validate realtime
    $('#name').on('input', function() {
        validateField('name', this.value.trim().length >= 3, 'Tên sản phẩm phải có ít nhất 3 ký tự');
    });
    
    $('#price').on('input', function() {
        const price = parseFloat(this.value);
        validateField('price', price >= 0, 'Giá sản phẩm phải lớn hơn hoặc bằng 0');
    });
    
    $('#description').on('input', function() {
        validateField('description', this.value.trim().length >= 10, 'Mô tả phải có ít nhất 10 ký tự');
    });
}

/**
 * Khởi tạo quản lý hình ảnh
 */
function initializeImageManagement() {
    console.log('🎯 Khởi tạo quản lý hình ảnh nâng cao');
    
    // Thiết lập drag & drop cho container hình ảnh
    const currentImageContainer = document.getElementById('currentImageContainer');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    
    // Drag & drop events
    [currentImageContainer, imagePreviewContainer].forEach(container => {
        container.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.style.borderColor = '#007bff';
            this.style.backgroundColor = '#f0f8ff';
        });
        
        container.addEventListener('dragleave', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.style.borderColor = '';
            this.style.backgroundColor = '';
        });
        
        container.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            this.style.borderColor = '';
            this.style.backgroundColor = '';
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    handleImageSelection(file);
                } else {
                    showError('Vui lòng chọn file hình ảnh hợp lệ');
                }
            }
        });
    });
    
    updateModeDisplay();
}

/**
 * Cập nhật hiển thị mode
 */
function updateModeDisplay() {
    const modeText = document.getElementById('updateModeText');
    const modeDescription = document.getElementById('updateModeDescription');
    const currentMode = document.getElementById('currentMode');
    
    if (updateMode === 'formdata') {
        modeText.textContent = 'Cập nhật cả hình ảnh (FormData)';
        modeDescription.textContent = 'Tắt để chỉ cập nhật thông tin cơ bản';
        currentMode.textContent = 'Chế độ: FormData';
        currentMode.className = 'badge bg-success';
    } else {
        modeText.textContent = 'Chỉ cập nhật thông tin (JSON)';
        modeDescription.textContent = 'Bật để cập nhật cả hình ảnh';
        currentMode.textContent = 'Chế độ: JSON';
        currentMode.className = 'badge bg-primary';
    }
}

/**
 * Xử lý khi chọn hình ảnh
 */
function handleImageSelection(file) {
    console.log('🔍 Xử lý file hình ảnh:', file.name);
    
    // Validate file
    const validation = validateImageFile(file);
    if (!validation.valid) {
        showError(validation.error);
        return;
    }
    
    selectedImageFile = file;
    
    // Tạo preview
    createImagePreview(file);
    
    // Hiển thị thông tin file
    displayImageInfo(file);
    
    // Hiển thị nút điều khiển
    document.getElementById('imagePreviewContainer').style.display = 'block';
    document.getElementById('imageActionButtons').style.display = 'block';
    document.getElementById('selectImageBtn').innerHTML = '<i class="fas fa-camera me-2"></i>Chọn Hình Khác';
    
    // Bật chế độ FormData tự động
    if (!document.getElementById('updateImageMode').checked) {
        document.getElementById('updateImageMode').checked = true;
        updateMode = 'formdata';
        updateModeDisplay();
    }
    
    console.log('✅ Đã chọn hình ảnh thành công');
}

/**
 * Validate file hình ảnh
 */
function validateImageFile(file) {
    console.log('🔍 Validate file:', file.name);
    
    // Kiểm tra loại file
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    if (!allowedTypes.includes(file.type)) {
        return {
            valid: false,
            error: 'Loại file không được phép. Chỉ chấp nhận: JPG, PNG, GIF, WebP'
        };
    }
    
    // Kiểm tra kích thước (10MB)
    const maxSize = 10 * 1024 * 1024;
    if (file.size > maxSize) {
        return {
            valid: false,
            error: `File quá lớn. Tối đa ${maxSize / 1024 / 1024}MB`
        };
    }
    
    // Kiểm tra kích thước tối thiểu
    if (file.size < 1024) {
        return {
            valid: false,
            error: 'File quá nhỏ. Có thể file bị hỏng'
        };
    }
    
    return { valid: true };
}

/**
 * Tạo preview hình ảnh
 */
function createImagePreview(file) {
    console.log('🖼️ Tạo preview cho:', file.name);
    
    const reader = new FileReader();
    
    reader.onload = function(e) {
        const previewContainer = document.getElementById('imagePreview');
        
        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'image-preview image-fade-in';
        img.alt = 'Preview hình ảnh mới';
        
        previewContainer.innerHTML = '';
        previewContainer.appendChild(img);
        
        console.log('✅ Preview đã tạo thành công');
    };
    
    reader.onerror = function() {
        console.error('❌ Lỗi khi đọc file');
        showError('Không thể đọc file hình ảnh');
    };
    
    reader.readAsDataURL(file);
}

/**
 * Hiển thị thông tin file
 */
function displayImageInfo(file) {
    const sizeInMB = (file.size / 1024 / 1024).toFixed(2);
    document.getElementById('imageSize').textContent = sizeInMB + ' MB';
    document.getElementById('imageType').textContent = file.type.split('/')[1].toUpperCase();
    
    // Đọc kích thước hình ảnh
    const img = new Image();
    img.onload = function() {
        document.getElementById('imageDimensions').textContent = `${this.width}×${this.height}`;
        URL.revokeObjectURL(this.src);
    };
    img.src = URL.createObjectURL(file);
    
    document.getElementById('imageInfo').style.display = 'block';
}

/**
 * Xác nhận chọn hình ảnh mới
 */
function confirmImageSelection() {
    isImageChanged = true;
    
    // Ẩn nút điều khiển tạm thời
    document.getElementById('imageActionButtons').style.display = 'none';
    
    // Hiển thị nút xóa hình hiện tại
    document.getElementById('removeCurrentImageBtn').style.display = 'block';
    
    // Cập nhật text nút
    document.getElementById('selectImageBtn').innerHTML = '<i class="fas fa-check me-2"></i>Hình Ảnh Đã Chọn';
    document.getElementById('selectImageBtn').className = 'btn btn-success';
    
    console.log('✅ Đã xác nhận sử dụng hình ảnh mới');
}

/**
 * Hủy chọn hình ảnh
 */
function cancelImageSelection() {
    selectedImageFile = null;
    isImageChanged = false;
    
    // Reset preview
    const previewContainer = document.getElementById('imagePreview');
    previewContainer.className = 'image-preview-placeholder';
    previewContainer.innerHTML = `
        <div class="text-center">
            <i class="fas fa-cloud-upload-alt fa-2x mb-2 text-success"></i>
            <div class="small">Preview hình ảnh mới</div>
        </div>
    `;
    
    // Ẩn containers
    document.getElementById('imagePreviewContainer').style.display = 'none';
    document.getElementById('imageActionButtons').style.display = 'none';
    document.getElementById('imageInfo').style.display = 'none';
    document.getElementById('removeCurrentImageBtn').style.display = 'none';
    
    // Reset nút
    document.getElementById('selectImageBtn').innerHTML = '<i class="fas fa-camera me-2"></i>Chọn Hình Ảnh Mới';
    document.getElementById('selectImageBtn').className = 'btn btn-outline-primary';
    
    // Reset file input
    document.getElementById('imageFile').value = '';
    
    console.log('❌ Đã hủy chọn hình ảnh');
}

/**
 * Xóa hình ảnh hiện tại
 */
function removeCurrentImage() {
    Swal.fire({
        title: 'Xóa hình ảnh hiện tại?',
        text: 'Hành động này sẽ xóa hình ảnh khỏi sản phẩm',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            // Xóa hình ảnh hiện tại (sẽ implement logic xóa)
            showCurrentImagePlaceholder();
            document.getElementById('removeCurrentImageBtn').style.display = 'none';
            
            console.log('🗑️ Đã xóa hình ảnh hiện tại');
            
            Swal.fire({
                icon: 'success',
                title: 'Đã xóa!',
                text: 'Hình ảnh đã được xóa',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
}

/**
 * Khởi tạo character counter
 */
function initializeCharacterCounter() {
    const descriptionTextarea = document.getElementById('description');
    const charCount = document.getElementById('charCount');
    const maxLength = 1000;

    function updateCharCount() {
        const length = descriptionTextarea.value.length;
        charCount.textContent = length;
        
        if (length > maxLength * 0.8) {
            charCount.className = 'text-warning';
        } else if (length >= maxLength) {
            charCount.className = 'text-danger';
        } else {
            charCount.className = 'text-muted';
        }
    }

    descriptionTextarea.addEventListener('input', updateCharCount);
}

/**
 * Tải dữ liệu sản phẩm
 */
function loadProductData(id) {
    console.log('📦 Tải dữ liệu sản phẩm từ ProductApiController:', id);
    
    return fetch(`/api/product/${id}`)
        .then(response => response.json())
        .then(data => {
            console.log('📋 Dữ liệu sản phẩm:', data);
            
            if (data.success && data.data) {
                currentProductData = data.data;
                populateForm(data.data);
                setupCurrentImage(data.data);
                updateProductInfo(data.data);
                return data.data;
            } else if (data.id) {
                currentProductData = data;
                populateForm(data);
                setupCurrentImage(data);
                updateProductInfo(data);
                return data;
            } else {
                throw new Error('Product not found');
            }
        });
}

/**
 * Thiết lập hình ảnh hiện tại
 */
function setupCurrentImage(product) {
    console.log('🖼️ Thiết lập hình ảnh hiện tại');
    
    const currentImageContainer = document.getElementById('currentImageContainer');
    
    if (product.image) {
        const imageUrl = getImageUrl(product.image);
        console.log('📸 URL hình ảnh:', imageUrl);
        
        const img = document.createElement('img');
        img.className = 'current-image image-fade-in';
        img.alt = 'Hình ảnh hiện tại';
        img.src = imageUrl;
        
        img.onload = function() {
            currentImageContainer.innerHTML = `
                <label class="small text-muted mb-2">Hình ảnh hiện tại:</label>
                <div></div>
            `;
            currentImageContainer.querySelector('div').appendChild(this);
            
            // Hiển thị nút xóa nếu có hình ảnh
            document.getElementById('removeCurrentImageBtn').style.display = 'block';
        };
        
        img.onerror = function() {
            showCurrentImagePlaceholder();
        };
    } else {
        showCurrentImagePlaceholder();
    }
}

/**
 * Hiển thị placeholder hình ảnh hiện tại
 */
function showCurrentImagePlaceholder() {
    const currentImageContainer = document.getElementById('currentImageContainer');
    currentImageContainer.innerHTML = `
        <label class="small text-muted mb-2">Hình ảnh hiện tại:</label>
        <div class="current-image-placeholder">
            <div class="text-center">
                <i class="fas fa-image fa-3x mb-2"></i>
                <div>Chưa có hình ảnh</div>
                <small class="text-muted">Kéo thả hoặc click để thêm</small>
            </div>
        </div>
    `;
    
    // Thêm click event cho placeholder
    currentImageContainer.querySelector('.current-image-placeholder').addEventListener('click', function() {
        document.getElementById('imageFile').click();
    });
}

/**
 * Lấy URL hình ảnh
 */
function getImageUrl(imagePath) {
    if (!imagePath) return null;
    
    if (imagePath.startsWith('http')) {
        return imagePath;
    }
    
    if (imagePath.startsWith('uploads/')) {
        return '/' + imagePath;
    }
    
    return '/uploads/products/' + imagePath;
}

/**
 * Tải danh mục
 */
function loadCategories() {
    console.log('🏷️ Tải danh mục từ CategoryApiController');
    
    return fetch('/api/category')
        .then(response => response.json())
        .then(data => {
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
 * Điền dữ liệu vào form
 */
function populateForm(product) {
    console.log('📝 Điền dữ liệu vào form:', product.name);
    
    document.getElementById('productId').value = product.id;
    document.getElementById('name').value = product.name;
    document.getElementById('price').value = product.price;
    document.getElementById('description').value = product.description;
    
    setTimeout(() => {
        if (product.category_id) {
            document.getElementById('category_id').value = product.category_id;
        }
    }, 100);
    
    // Cập nhật character count
    const event = new Event('input');
    document.getElementById('description').dispatchEvent(event);
}

/**
 * Cập nhật thông tin sản phẩm
 */
function updateProductInfo(product) {
    const productInfo = document.getElementById('productInfo');
    productInfo.innerHTML = `
        <div class="col-md-6">
            <p class="mb-1"><strong>ID:</strong> #${product.id}</p>
            <p class="mb-1"><strong>Danh Mục:</strong> ${product.category_name || 'Chưa phân loại'}</p>
            <p class="mb-1"><strong>Ngày tạo:</strong> ${formatDate(new Date())}</p>
        </div>
        <div class="col-md-6">
            <p class="mb-1"><strong>Giá Hiện Tại:</strong> ${formatPrice(product.price)} VNĐ</p>
            <p class="mb-1"><strong>Hình Ảnh:</strong> ${product.image ? '✅ Có' : '❌ Chưa có'}</p>
            <p class="mb-0"><strong>Trạng thái:</strong> <span class="badge bg-success">Hoạt động</span></p>
        </div>
    `;
}

/**
 * MAIN: Cập nhật sản phẩm (tự động chọn JSON hoặc FormData)
 */
function updateProduct() {
    console.log('📤 Bắt đầu cập nhật sản phẩm');
    console.log('🔧 Mode hiện tại:', updateMode);
    console.log('🖼️ Có thay đổi hình ảnh:', isImageChanged);
    
    if (isUploading) {
        console.log('⚠️ Đang upload, bỏ qua request');
        return;
    }
    
    const updateBtn = document.getElementById('updateBtn');
    const originalContent = updateBtn.innerHTML;
    
    // Hiển thị loading
    isUploading = true;
    updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang cập nhật...';
    updateBtn.disabled = true;
    
    clearErrors();
    clearSuccess();
    
    try {
        // Lấy dữ liệu form
        const formData = {
            name: document.getElementById('name').value.trim(),
            description: document.getElementById('description').value.trim(),
            price: parseFloat(document.getElementById('price').value) || 0,
            category_id: document.getElementById('category_id').value || null
        };
        
        console.log('📋 Dữ liệu form:', formData);
        
        // Validation
        const validation = validateFormData(formData);
        if (!validation.valid) {
            displayErrors(validation.errors);
            return;
        }
        
        // Quyết định method dựa trên mode và có hình ảnh
        if (updateMode === 'formdata' && isImageChanged && selectedImageFile) {
            updateWithFormData(formData);
        } else {
            updateWithJSON(formData);
        }
        
    } catch (error) {
        console.error('❌ Lỗi chuẩn bị dữ liệu:', error);
        showError('Có lỗi xảy ra: ' + error.message);
        
    } finally {
        setTimeout(() => {
            isUploading = false;
            updateBtn.innerHTML = originalContent;
            updateBtn.disabled = false;
        }, 2000);
    }
}

/**
 * Cập nhật bằng FormData (có hình ảnh)
 */
function updateWithFormData(formData) {
    console.log('📸 Cập nhật bằng FormData (có hình ảnh)');
    
    const requestData = new FormData();
    requestData.append('name', formData.name);
    requestData.append('description', formData.description);
    requestData.append('price', formData.price);
    if (formData.category_id) {
        requestData.append('category_id', formData.category_id);
    }
    if (selectedImageFile) {
        requestData.append('image', selectedImageFile);
    }
    
    const headers = {
        'X-Requested-With': 'XMLHttpRequest'
    };
    
    showUploadProgress();
    
    sendUpdateRequest(requestData, headers, 'FormData');
}

/**
 * Cập nhật bằng JSON (chỉ thông tin)
 */
function updateWithJSON(formData) {
    console.log('📝 Cập nhật bằng JSON (chỉ thông tin)');
    
    const requestData = JSON.stringify(formData);
    const headers = {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    };
    
    sendUpdateRequest(requestData, headers, 'JSON');
}

/**
 * Gửi request cập nhật
 */
function sendUpdateRequest(requestData, headers, method) {
    const apiUrl = `/api/product/${productId}`;
    console.log('🔗 Gửi request đến:', apiUrl, 'Method:', method);
    
    fetch(apiUrl, {
        method: 'PUT',
        headers: headers,
        body: requestData
    })
    .then(response => {
        console.log('📡 Response:', response.status);
        
        if (!response.ok) {
            return response.text().then(text => {
                throw new Error(`HTTP ${response.status}: ${text}`);
            });
        }
        
        return response.json();
    })
    .then(data => {
        console.log('📋 Kết quả:', data);
        
        if (data.success || data.message) {
            hideUploadProgress();
            
            showSuccess(data.message || 'Cập nhật thành công!');
            
            Swal.fire({
                icon: 'success',
                title: 'Cập nhật thành công!',
                html: createSuccessMessage(data, method),
                showCancelButton: true,
                confirmButtonText: '<i class="fas fa-eye me-2"></i>Xem sản phẩm',
                cancelButtonText: '<i class="fas fa-edit me-2"></i>Tiếp tục chỉnh sửa'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/product/show/${productId}`;
                } else {
                    // Reset image state và reload data
                    if (isImageChanged) {
                        cancelImageSelection();
                    }
                    setTimeout(() => {
                        loadProductData(productId);
                    }, 1000);
                }
            });
            
        } else if (data.errors) {
            hideUploadProgress();
            displayErrors(data.errors);
        } else {
            throw new Error('Response không hợp lệ');
        }
    })
    .catch(error => {
        console.error('❌ Lỗi update:', error);
        hideUploadProgress();
        showError('Lỗi cập nhật: ' + error.message);
    });
}

/**
 * Tạo thông báo thành công
 */
function createSuccessMessage(data, method) {
    let message = '<div class="text-start">';
    message += '<p class="mb-2"><strong>✅ Cập nhật thành công!</strong></p>';
    message += `<p><i class="fas fa-cog me-2"></i>Phương thức: ${method}</p>`;
    
    if (method === 'FormData' && isImageChanged) {
        message += '<p><i class="fas fa-image me-2"></i>Hình ảnh: Đã cập nhật</p>';
    }
    
    if (data.image_path) {
        message += `<p><i class="fas fa-link me-2"></i>Path: ${data.image_path}</p>`;
    }
    
    message += '</div>';
    return message;
}

/**
 * Validation form data
 */
function validateFormData(data) {
    const errors = {};
    
    if (!data.name || data.name.length < 3) {
        errors.name = 'Tên sản phẩm phải có ít nhất 3 ký tự';
    }
    
    if (!data.description || data.description.length < 10) {
        errors.description = 'Mô tả phải có ít nhất 10 ký tự';
    }
    
    if (isNaN(data.price) || data.price < 0) {
        errors.price = 'Giá sản phẩm phải là số không âm';
    }
    
    return {
        valid: Object.keys(errors).length === 0,
        errors: errors
    };
}

/**
 * Hiển thị/ẩn progress
 */
function showUploadProgress() {
    const progress = document.getElementById('uploadProgress');
    progress.style.display = 'block';
    
    let width = 0;
    const interval = setInterval(() => {
        width += Math.random() * 15;
        if (width > 90) width = 90;
        
        progress.querySelector('.progress-bar').style.width = width + '%';
        
        if (width >= 90) {
            clearInterval(interval);
        }
    }, 200);
}

function hideUploadProgress() {
    const progress = document.getElementById('uploadProgress');
    const bar = progress.querySelector('.progress-bar');
    
    bar.style.width = '100%';
    setTimeout(() => {
        progress.style.display = 'none';
        bar.style.width = '0%';
    }, 500);
}

/**
 * Các hàm utility và UI
 */
function validateField(fieldName, condition, errorMessage) {
    const field = document.getElementById(fieldName);
    
    if (condition) {
        field.classList.remove('is-invalid');
    } else {
        field.classList.add('is-invalid');
        let feedback = field.nextElementSibling;
        if (feedback && feedback.classList.contains('input-group')) {
            feedback = feedback.nextElementSibling;
        }
        if (feedback && feedback.classList.contains('invalid-feedback')) {
            feedback.textContent = errorMessage;
        }
    }
}

function displayErrors(errors) {
    const errorContainer = document.getElementById('errorContainer');
    const errorList = document.getElementById('errorList');
    
    errorList.innerHTML = '';
    
    for (const [field, message] of Object.entries(errors)) {
        const li = document.createElement('li');
        li.textContent = message;
        errorList.appendChild(li);
        
        const fieldElement = document.getElementById(field);
        if (fieldElement) {
            fieldElement.classList.add('is-invalid');
        }
    }
    
    errorContainer.style.display = 'block';
    errorContainer.scrollIntoView({ behavior: 'smooth' });
}

function clearErrors() {
    document.getElementById('errorContainer').style.display = 'none';
    document.querySelectorAll('.is-invalid').forEach(field => {
        field.classList.remove('is-invalid');
    });
}

function showSuccess(message) {
    const container = document.getElementById('successContainer');
    const messageElement = document.getElementById('successMessage');
    
    messageElement.textContent = message;
    container.style.display = 'block';
    container.scrollIntoView({ behavior: 'smooth' });
}

function clearSuccess() {
    document.getElementById('successContainer').style.display = 'none';
}

function showEditForm() {
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('editContainer').style.display = 'block';
}

function showErrorState() {
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('errorState').style.display = 'block';
}

function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price);
}

function formatDate(date) {
    return date.toLocaleDateString('vi-VN');
}

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

console.log('🎉 Product Edit with Advanced Image Management loaded');
console.log('👤 User: MHoang287');
console.log('📅 Time: 2025-06-13 05:38:09');
</script>

<?php include_once 'app/views/shares/footer.php'; ?>