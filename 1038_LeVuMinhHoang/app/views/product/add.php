<?php 
$pageTitle = "Thêm Sản Phẩm";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb - Đường dẫn điều hướng với comment tiếng Việt -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản Phẩm</a></li>
                <li class="breadcrumb-item active">Thêm Sản Phẩm</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Form Card chính để thêm sản phẩm -->
                <div class="card shadow-lg border-0" data-aos="fade-up">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-plus-circle me-2"></i>Thêm Sản Phẩm Mới với Hình Ảnh
                        </h4>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- Container hiển thị lỗi -->
                        <div id="errorContainer" class="alert alert-danger" style="display: none;">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Có lỗi xảy ra:</strong>
                            <ul id="errorList" class="mb-0 mt-2"></ul>
                        </div>

                        <!-- Container hiển thị thông báo thành công -->
                        <div id="successContainer" class="alert alert-success" style="display: none;">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong id="successMessage"></strong>
                        </div>

                        <!-- Form thêm sản phẩm với enctype để upload file -->
                        <form id="productForm" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Cột trái: Thông tin cơ bản của sản phẩm -->
                                <div class="col-lg-8">
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

                                    <!-- Dropdown chọn danh mục -->
                                    <div class="mb-3">
                                        <label for="category_id" class="form-label fw-bold">
                                            <i class="fas fa-list me-1"></i>Danh Mục
                                        </label>
                                        <select class="form-select" id="category_id" name="category_id">
                                            <option value="">Chọn danh mục...</option>
                                            <!-- Danh mục sẽ được load từ CategoryApiController bằng JavaScript -->
                                        </select>
                                        <div class="invalid-feedback"></div>
                                        <!-- Indicator hiển thị khi đang load danh mục -->
                                        <div id="categoryLoading" class="text-center mt-2" style="display: none;">
                                            <small class="text-muted">
                                                <i class="fas fa-spinner fa-spin me-1"></i>Đang tải danh mục từ CategoryApiController...
                                            </small>
                                        </div>
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
                                            <span id="charCount">0</span>/1000 ký tự
                                        </div>
                                    </div>
                                </div>

                                <!-- Cột phải: Upload hình ảnh -->
                                <div class="col-lg-4">
                                    <div class="image-upload-section">
                                        <label for="image" class="form-label fw-bold">
                                            <i class="fas fa-camera me-1"></i>Hình Ảnh Sản Phẩm
                                        </label>
                                        
                                        <!-- Container preview hình ảnh -->
                                        <div id="imagePreviewContainer" class="mb-3">
                                            <div id="imagePreview" class="image-preview-placeholder">
                                                <div class="text-center">
                                                    <i class="fas fa-cloud-upload-alt fa-3x mb-3 text-muted"></i>
                                                    <h6 class="text-muted">Chọn hình ảnh</h6>
                                                    <p class="small text-muted mb-0">
                                                        Kéo thả hoặc click để chọn file<br>
                                                        <small>Tối đa 10MB, định dạng: JPG, PNG, GIF, WebP</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Input file ẩn -->
                                        <input type="file" 
                                               class="form-control" 
                                               id="image" 
                                               name="image" 
                                               accept="image/*"
                                               style="display: none;">
                                        
                                        <!-- Các nút điều khiển upload -->
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-outline-primary" id="selectImageBtn">
                                                <i class="fas fa-folder-open me-2"></i>Chọn Hình Ảnh
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" id="removeImageBtn" style="display: none;">
                                                <i class="fas fa-trash me-2"></i>Xóa Hình Ảnh
                                            </button>
                                        </div>

                                        <!-- Progress bar khi upload -->
                                        <div id="uploadProgress" class="mt-3" style="display: none;">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                                     role="progressbar" 
                                                     style="width: 0%">
                                                </div>
                                            </div>
                                            <small class="text-muted mt-1">Đang upload hình ảnh đến ProductApiController...</small>
                                        </div>

                                        <!-- Thông tin chi tiết về hình ảnh đã chọn -->
                                        <div id="imageInfo" class="mt-3" style="display: none;">
                                            <div class="card border-0 bg-light">
                                                <div class="card-body p-3">
                                                    <h6 class="card-title mb-2">
                                                        <i class="fas fa-info-circle me-1"></i>Thông Tin Hình Ảnh
                                                    </h6>
                                                    <div class="row text-center">
                                                        <div class="col-6">
                                                            <small class="text-muted">Kích thước</small>
                                                            <div id="imageDimensions" class="fw-bold">-</div>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-muted">Dung lượng</small>
                                                            <div id="imageSize" class="fw-bold">-</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Các nút hành động -->
                            <div class="row mt-4">
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

                <!-- Card gợi ý cho việc tạo sản phẩm hiệu quả -->
                <div class="card mt-4 border-0 bg-light" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fas fa-lightbulb text-warning me-2"></i>Mẹo để tạo sản phẩm hiệu quả
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="small fw-bold text-primary">Thông tin sản phẩm:</h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Sử dụng tên sản phẩm rõ ràng và dễ tìm kiếm</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Viết mô tả chi tiết và chính xác</li>
                                    <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Đặt giá hợp lý và cạnh tranh</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="small fw-bold text-success">Hình ảnh sản phẩm:</h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Sử dụng hình ảnh chất lượng cao</li>
                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Tỷ lệ khung hình vuông hoặc 4:3 tốt nhất</li>
                                    <li class="mb-0"><i class="fas fa-check text-success me-2"></i>Kích thước tối thiểu 800x600 pixel</li>
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
/* CSS cho phần upload hình ảnh với comment tiếng Việt */
.image-preview-placeholder {
    width: 100%;
    height: 300px;
    border: 2px dashed #dee2e6; /* Đường viền nét đứt */
    border-radius: 0.375rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa; /* Màu nền nhạt */
    cursor: pointer; /* Con trỏ chuột dạng tay khi hover */
    transition: all 0.3s ease; /* Hiệu ứng chuyển đổi mượt */
}

.image-preview-placeholder:hover {
    border-color: #0d6efd; /* Đổi màu viền khi hover */
    background-color: #e7f1ff; /* Đổi màu nền khi hover */
}

.image-preview-placeholder.dragover {
    border-color: #0d6efd; /* Màu viền khi kéo file vào */
    background-color: #e7f1ff;
    transform: scale(1.02); /* Phóng to nhẹ khi dragover */
}

.image-preview {
    width: 100%;
    height: 300px;
    border-radius: 0.375rem;
    object-fit: cover; /* Giữ tỷ lệ hình ảnh */
    border: 2px solid #dee2e6;
}

.upload-progress {
    background: linear-gradient(45deg, #007bff, #0056b3); /* Gradient cho progress bar */
}

/* Animation cho preview hình ảnh */
.image-fade-in {
    animation: fadeInScale 0.5s ease;
}

@keyframes fadeInScale {
    from {
        opacity: 0;
        transform: scale(0.8); /* Bắt đầu từ kích thước nhỏ */
    }
    to {
        opacity: 1;
        transform: scale(1); /* Phóng to về kích thước bình thường */
    }
}

/* Responsive cho mobile */
@media (max-width: 768px) {
    .image-preview-placeholder,
    .image-preview {
        height: 250px; /* Giảm chiều cao trên mobile */
    }
}
</style>

<script>
// Biến toàn cục để quản lý trạng thái upload hình ảnh
let selectedImageFile = null; // File hình ảnh được chọn
let isUploading = false; // Trạng thái đang upload
let currentImagePreview = null; // Preview hiện tại

// Khởi tạo khi tài liệu được tải xong
$(document).ready(function() {
    console.log('🚀 Khởi tạo trang thêm sản phẩm với upload hình ảnh');
    
    // Tải danh sách danh mục từ CategoryApiController
    loadCategories();
    
    // Thiết lập các event listener cho form và upload
    setupEventListeners();
    
    // Khởi tạo character counter cho mô tả
    initializeCharacterCounter();
    
    // Thiết lập drag & drop cho upload hình ảnh
    setupImageUpload();
});

/**
 * Thiết lập các event listener cho form
 */
function setupEventListeners() {
    console.log('🎧 Thiết lập event listeners');
    
    // Xử lý submit form - ngăn submit mặc định và gọi API
    $('#productForm').on('submit', function(e) {
        e.preventDefault(); // Ngăn form submit theo cách thông thường
        console.log('📝 Form được submit');
        submitFormWithImage();
    });
    
    // Validate realtime khi người dùng nhập liệu
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
    
    // Nút chọn hình ảnh - mở dialog chọn file
    $('#selectImageBtn').on('click', function() {
        console.log('📁 Mở dialog chọn file');
        document.getElementById('image').click();
    });
    
    // Nút xóa hình ảnh đã chọn
    $('#removeImageBtn').on('click', function() {
        console.log('🗑️ Xóa hình ảnh đã chọn');
        removeSelectedImage();
    });
    
    // Xử lý khi chọn file từ input
    $('#image').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            console.log('📸 File được chọn:', file.name);
            handleImageSelection(file);
        }
    });
}

/**
 * Thiết lập drag & drop upload hình ảnh
 */
function setupImageUpload() {
    console.log('🎯 Thiết lập drag & drop upload');
    
    const previewContainer = document.getElementById('imagePreviewContainer');
    
    // Ngăn hành vi mặc định của browser khi kéo thả file
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        previewContainer.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });
    
    // Highlight vùng kéo thả khi drag over
    ['dragenter', 'dragover'].forEach(eventName => {
        previewContainer.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        previewContainer.addEventListener(eventName, unhighlight, false);
    });
    
    // Xử lý khi drop file vào vùng
    previewContainer.addEventListener('drop', handleDrop, false);
    
    // Click để chọn file
    previewContainer.addEventListener('click', function() {
        document.getElementById('image').click();
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    function highlight(e) {
        const placeholder = document.getElementById('imagePreview');
        if (placeholder.classList.contains('image-preview-placeholder')) {
            placeholder.classList.add('dragover');
        }
    }
    
    function unhighlight(e) {
        const placeholder = document.getElementById('imagePreview');
        placeholder.classList.remove('dragover');
    }
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            const file = files[0];
            console.log('📸 File được drop:', file.name);
            handleImageSelection(file);
        }
    }
}

/**
 * Xử lý khi chọn hình ảnh (từ file input hoặc drag & drop)
 */
function handleImageSelection(file) {
    console.log('🔍 Xử lý file được chọn:', file.name);
    
    // Validate file trước khi xử lý
    const validationResult = validateImageFile(file);
    if (!validationResult.valid) {
        console.log('❌ File không hợp lệ:', validationResult.error);
        showError(validationResult.error);
        return;
    }
    
    selectedImageFile = file;
    
    // Tạo preview hình ảnh ngay lập tức
    createImagePreview(file);
    
    // Hiển thị thông tin file
    displayImageInfo(file);
    
    // Hiển thị nút xóa hình ảnh
    document.getElementById('removeImageBtn').style.display = 'block';
    
    console.log('✅ Đã chọn hình ảnh thành công');
}

/**
 * Validate file hình ảnh được chọn
 */
function validateImageFile(file) {
    console.log('🔍 Validate file hình ảnh:', file.name);
    
    // Kiểm tra loại file - chỉ cho phép các định dạng hình ảnh
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    if (!allowedTypes.includes(file.type)) {
        return {
            valid: false,
            error: 'Loại file không được phép. Chỉ chấp nhận: JPG, PNG, GIF, WebP'
        };
    }
    
    // Kiểm tra kích thước file (10MB = 10 * 1024 * 1024 bytes)
    const maxSize = 10 * 1024 * 1024;
    if (file.size > maxSize) {
        return {
            valid: false,
            error: `Kích thước file quá lớn. Tối đa ${maxSize / 1024 / 1024}MB`
        };
    }
    
    // Kiểm tra kích thước tối thiểu (để tránh file bị hỏng)
    const minSize = 1024; // 1KB
    if (file.size < minSize) {
        return {
            valid: false,
            error: 'File quá nhỏ. Có thể file bị hỏng'
        };
    }
    
    console.log('✅ File hình ảnh hợp lệ');
    return { valid: true };
}

/**
 * Tạo preview hình ảnh sử dụng FileReader
 */
function createImagePreview(file) {
    console.log('🖼️ Tạo preview cho:', file.name);
    
    const reader = new FileReader();
    
    reader.onload = function(e) {
        const previewContainer = document.getElementById('imagePreview');
        
        // Tạo element img mới
        const img = document.createElement('img');
        img.src = e.target.result;
        img.className = 'image-preview image-fade-in';
        img.alt = 'Preview sản phẩm';
        
        // Thay thế placeholder bằng hình ảnh
        previewContainer.className = '';
        previewContainer.innerHTML = '';
        previewContainer.appendChild(img);
        
        currentImagePreview = img;
        
        console.log('✅ Đã tạo preview thành công');
    };
    
    reader.onerror = function() {
        console.error('❌ Lỗi khi đọc file');
        showError('Không thể đọc file hình ảnh');
    };
    
    // Đọc file dưới dạng Data URL
    reader.readAsDataURL(file);
}

/**
 * Hiển thị thông tin chi tiết file hình ảnh
 */
function displayImageInfo(file) {
    console.log('📋 Hiển thị thông tin file');
    
    // Hiển thị dung lượng file
    const sizeInMB = (file.size / 1024 / 1024).toFixed(2);
    document.getElementById('imageSize').textContent = sizeInMB + ' MB';
    
    // Tạo URL tạm thời để đọc kích thước hình ảnh
    const img = new Image();
    img.onload = function() {
        document.getElementById('imageDimensions').textContent = `${this.width} x ${this.height}`;
        URL.revokeObjectURL(this.src); // Giải phóng bộ nhớ
    };
    img.src = URL.createObjectURL(file);
    
    // Hiển thị container thông tin
    document.getElementById('imageInfo').style.display = 'block';
}

/**
 * Xóa hình ảnh đã chọn và reset về trạng thái ban đầu
 */
function removeSelectedImage() {
    console.log('🗑️ Xóa hình ảnh đã chọn');
    
    selectedImageFile = null;
    currentImagePreview = null;
    
    // Reset preview về placeholder
    const previewContainer = document.getElementById('imagePreview');
    previewContainer.className = 'image-preview-placeholder';
    previewContainer.innerHTML = `
        <div class="text-center">
            <i class="fas fa-cloud-upload-alt fa-3x mb-3 text-muted"></i>
            <h6 class="text-muted">Chọn hình ảnh</h6>
            <p class="small text-muted mb-0">
                Kéo thả hoặc click để chọn file<br>
                <small>Tối đa 10MB, định dạng: JPG, PNG, GIF, WebP</small>
            </p>
        </div>
    `;
    
    // Ẩn thông tin file và nút xóa
    document.getElementById('imageInfo').style.display = 'none';
    document.getElementById('removeImageBtn').style.display = 'none';
    
    // Reset file input
    document.getElementById('image').value = '';
    
    console.log('✅ Đã xóa hình ảnh');
}

/**
 * Khởi tạo bộ đếm ký tự cho mô tả
 */
function initializeCharacterCounter() {
    console.log('🔢 Khởi tạo character counter');
    
    const descriptionTextarea = document.getElementById('description');
    const charCount = document.getElementById('charCount');
    const maxLength = 1000;

    function updateCharCount() {
        const length = descriptionTextarea.value.length;
        charCount.textContent = length;
        
        // Thay đổi màu sắc theo độ dài
        if (length > maxLength * 0.8) {
            charCount.className = 'text-warning';
        } else if (length >= maxLength) {
            charCount.className = 'text-danger';
        } else {
            charCount.className = 'text-muted';
        }
        
        console.log('📝 Số ký tự mô tả:', length);
    }

    // Lắng nghe sự kiện nhập liệu
    descriptionTextarea.addEventListener('input', updateCharCount);
    
    // Cập nhật lần đầu
    updateCharCount();
}

/**
 * Tải danh sách danh mục từ CategoryApiController
 */
function loadCategories() {
    console.log('🏷️ Bắt đầu tải danh sách danh mục từ CategoryApiController');
    
    const categorySelect = document.getElementById('category_id');
    const categoryLoading = document.getElementById('categoryLoading');
    
    // Hiển thị loading indicator
    categoryLoading.style.display = 'block';
    
    // Gọi CategoryApiController để lấy danh mục
    fetch('/api/category')
        .then(response => {
            console.log('📡 Response từ CategoryApiController:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('📋 Dữ liệu danh mục nhận được:', data);
            
            // Reset dropdown và thêm option mặc định
            categorySelect.innerHTML = '<option value="">Chọn danh mục...</option>';
            
            if (data && Array.isArray(data)) {
                // Thêm option cho mỗi danh mục
                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    option.title = category.description || category.name; // Tooltip hiển thị mô tả
                    categorySelect.appendChild(option);
                    console.log(`➕ Đã thêm danh mục: ${category.name} (ID: ${category.id})`);
                });
                
                console.log(`✅ Đã load thành công ${data.length} danh mục`);
            } else {
                console.log('⚠️ Không có danh mục nào');
                categorySelect.innerHTML = '<option value="">Không có danh mục</option>';
            }
        })
        .catch(error => {
            console.error('❌ Lỗi khi tải danh mục:', error);
            categorySelect.innerHTML = '<option value="">Lỗi tải danh mục</option>';
            showError('Không thể tải danh sách danh mục. Vui lòng thử lại sau.');
        })
        .finally(() => {
            // Ẩn loading indicator
            categoryLoading.style.display = 'none';
        });
}

/**
 * Submit form với hình ảnh sử dụng ProductApiController
 */
function submitFormWithImage() {
    console.log('📤 Bắt đầu submit form với hình ảnh đến ProductApiController');
    
    if (isUploading) {
        console.log('⚠️ Đang trong quá trình upload, bỏ qua request');
        return;
    }
    
    const submitBtn = document.getElementById('submitBtn');
    const originalContent = submitBtn.innerHTML;
    
    // Hiển thị trạng thái loading
    isUploading = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang lưu...';
    submitBtn.disabled = true;
    
    // Xóa các lỗi và thông báo trước đó
    clearErrors();
    clearSuccess();
    
    try {
        // Tạo FormData để gửi cả file và dữ liệu
        const formData = new FormData();
        
        // Thêm dữ liệu form vào FormData
        formData.append('name', document.getElementById('name').value.trim());
        formData.append('description', document.getElementById('description').value.trim());
        formData.append('price', document.getElementById('price').value);
        formData.append('category_id', document.getElementById('category_id').value || '');
        
        // Thêm file hình ảnh nếu có
        if (selectedImageFile) {
            formData.append('image', selectedImageFile);
            console.log('📸 Đã thêm file hình ảnh vào FormData:', selectedImageFile.name);
        }
        
        // Log dữ liệu gửi đi để debug
        console.log('📋 Dữ liệu gửi đến ProductApiController:');
        for (let [key, value] of formData.entries()) {
            if (value instanceof File) {
                console.log(`  ${key}: File(${value.name}, ${value.size} bytes)`);
            } else {
                console.log(`  ${key}: ${value}`);
            }
        }
        
        // Validate dữ liệu phía client trước khi gửi
        const clientValidation = validateFormDataClient(formData);
        if (!clientValidation.valid) {
            console.log('❌ Client validation failed');
            displayErrors(clientValidation.errors);
            return;
        }
        
        // Hiển thị progress bar nếu có hình ảnh
        if (selectedImageFile) {
            showUploadProgress();
        }
        
        // Gửi dữ liệu đến ProductApiController
        fetch('/api/product', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
                // Không set Content-Type để browser tự set cho FormData
            },
            body: formData
        })
        .then(response => {
            console.log('📡 Response từ ProductApiController:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('📋 Response data:', data);
            
            if (data.success && data.message) {
                // Thành công
                console.log('✅ Tạo sản phẩm thành công');
                
                // Ẩn progress bar
                hideUploadProgress();
                
                showSuccess(data.message);
                
                // Hiển thị modal xác nhận với thông tin chi tiết
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    html: createSuccessMessage(data),
                    showCancelButton: true,
                    confirmButtonText: '<i class="fas fa-list me-2"></i>Về danh sách',
                    cancelButtonText: '<i class="fas fa-plus me-2"></i>Thêm sản phẩm khác',
                    reverseButtons: true
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
                console.log('❌ Có lỗi validation từ server:', data.errors);
                hideUploadProgress();
                displayErrors(data.errors);
                
            } else {
                throw new Error(data.message || 'Unknown response format');
            }
        })
        .catch(error => {
            console.error('❌ Lỗi khi tạo sản phẩm:', error);
            hideUploadProgress();
            showError('Có lỗi xảy ra khi tạo sản phẩm: ' + error.message);
        });
        
    } catch (error) {
        console.error('❌ Lỗi chuẩn bị dữ liệu:', error);
        showError('Có lỗi xảy ra khi chuẩn bị dữ liệu: ' + error.message);
        
    } finally {
        // Khôi phục nút submit sau 2 giây
        setTimeout(() => {
            isUploading = false;
            submitBtn.innerHTML = originalContent;
            submitBtn.disabled = false;
        }, 2000);
    }
}

/**
 * Tạo thông báo thành công chi tiết
 */
function createSuccessMessage(data) {
    let message = '<div class="text-start">';
    message += '<p class="mb-2"><strong>Sản phẩm đã được tạo thành công!</strong></p>';
    
    if (data.product_id) {
        message += `<p class="mb-1"><i class="fas fa-hashtag me-2"></i>ID sản phẩm: <code>${data.product_id}</code></p>`;
    }
    
    if (data.image_path) {
        message += `<p class="mb-1"><i class="fas fa-image me-2"></i>Hình ảnh: <span class="text-success">Đã upload thành công</span></p>`;
    }
    
    message += '</div>';
    return message;
}

/**
 * Validate dữ liệu form phía client
 */
function validateFormDataClient(formData) {
    console.log('🔍 Validate dữ liệu form phía client');
    
    const errors = {};
    
    // Lấy giá trị từ FormData
    const name = formData.get('name');
    const description = formData.get('description');
    const price = formData.get('price');
    
    // Validate tên sản phẩm
    if (!name || name.trim().length === 0) {
        errors.name = 'Tên sản phẩm không được để trống';
    } else if (name.trim().length < 3) {
        errors.name = 'Tên sản phẩm phải có ít nhất 3 ký tự';
    } else if (name.trim().length > 255) {
        errors.name = 'Tên sản phẩm không được vượt quá 255 ký tự';
    }
    
    // Validate mô tả
    if (!description || description.trim().length === 0) {
        errors.description = 'Mô tả không được để trống';
    } else if (description.trim().length < 10) {
        errors.description = 'Mô tả phải có ít nhất 10 ký tự';
    } else if (description.trim().length > 1000) {
        errors.description = 'Mô tả không được vượt quá 1000 ký tự';
    }
    
    // Validate giá
    if (!price || price.trim().length === 0) {
        errors.price = 'Giá sản phẩm không được để trống';
    } else {
        const priceNum = parseFloat(price);
        if (isNaN(priceNum)) {
            errors.price = 'Giá sản phẩm phải là số';
        } else if (priceNum < 0) {
            errors.price = 'Giá sản phẩm không được âm';
        } else if (priceNum > 999999999) {
            errors.price = 'Giá sản phẩm quá lớn';
        }
    }
    
    const isValid = Object.keys(errors).length === 0;
    console.log('📋 Kết quả validation client:', isValid ? 'PASS' : 'FAIL');
    
    return {
        valid: isValid,
        errors: errors
    };
}

/**
 * Hiển thị progress bar upload
 */
function showUploadProgress() {
    console.log('📊 Hiển thị progress bar upload');
    
    const progressContainer = document.getElementById('uploadProgress');
    const progressBar = progressContainer.querySelector('.progress-bar');
    
    progressContainer.style.display = 'block';
    
    // Giả lập progress (vì fetch API không hỗ trợ progress tracking)
    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 20;
        if (progress > 90) {
            progress = 90; // Dừng ở 90% đợi response
        }
        
        progressBar.style.width = progress + '%';
        
        if (progress >= 90) {
            clearInterval(interval);
        }
    }, 200);
    
    // Lưu interval để có thể clear later
    progressContainer.setAttribute('data-interval', interval);
}

/**
 * Ẩn progress bar upload
 */
function hideUploadProgress() {
    console.log('📊 Ẩn progress bar upload');
    
    const progressContainer = document.getElementById('uploadProgress');
    const progressBar = progressContainer.querySelector('.progress-bar');
    const interval = progressContainer.getAttribute('data-interval');
    
    // Clear interval nếu có
    if (interval) {
        clearInterval(parseInt(interval));
    }
    
    // Set progress 100% rồi ẩn
    progressBar.style.width = '100%';
    
    setTimeout(() => {
        progressContainer.style.display = 'none';
        progressBar.style.width = '0%';
    }, 500);
}

/**
 * Validate một field cụ thể với hiệu ứng thị giác
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
    console.log('❌ Hiển thị lỗi cho field:', fieldName, '-', message);
    
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
    console.log('❌ Hiển thị danh sách lỗi từ server:', errors);
    
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
    console.log('🧹 Xóa tất cả thông báo lỗi');
    
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
    console.log('✅ Hiển thị thông báo thành công:', message);
    
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
    console.log('🔄 Reset form về trạng thái ban đầu');
    
    // Reset tất cả input
    document.getElementById('productForm').reset();
    
    // Reset image
    removeSelectedImage();
    
    // Xóa lỗi và thông báo
    clearErrors();
    clearSuccess();
    
    // Reset character counter
    document.getElementById('charCount').textContent = '0';
    document.getElementById('charCount').className = 'text-muted';
    
    // Focus vào field đầu tiên
    document.getElementById('name').focus();
    
    console.log('✅ Đã reset form thành công');
}

/**
 * Hiển thị thông báo lỗi chung
 */
function showError(message) {
    console.error('❌ Hiển thị lỗi chung:', message);
    
    Swal.fire({
        icon: 'error',
        title: 'Lỗi!',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true
    });
}

console.log('🎉 Product Add with Image Script loaded successfully');
console.log(`👤 Current user: `);
console.log(`📅 Current time: `);
</script>

<?php include_once 'app/views/shares/footer.php'; ?>