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
                        <?php if (isset($errors) && !empty($errors)): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Có lỗi xảy ra:</strong>
                                <ul class="mb-0 mt-2">
                                    <?php foreach ($errors as $field => $error): ?>
                                        <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form action="/Product/save" method="POST" enctype="multipart/form-data" id="productForm">
                            <div class="row">
                                <!-- Product Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label fw-bold">
                                        <i class="fas fa-tag me-1"></i>Tên Sản Phẩm *
                                    </label>
                                    <input type="text" 
                                           class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                                           id="name" 
                                           name="name" 
                                           value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                                           placeholder="Nhập tên sản phẩm..."
                                           required>
                                    <div class="invalid-feedback">
                                        <?= $errors['name'] ?? '' ?>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label fw-bold">
                                        <i class="fas fa-dollar-sign me-1"></i>Giá *
                                    </label>
                                    <div class="input-group">
                                        <input type="number" 
                                               class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>" 
                                               id="price" 
                                               name="price" 
                                               value="<?= htmlspecialchars($_POST['price'] ?? '') ?>"
                                               placeholder="0"
                                               min="0"
                                               step="1000"
                                               required>
                                        <span class="input-group-text">VNĐ</span>
                                        <div class="invalid-feedback">
                                            <?= $errors['price'] ?? '' ?>
                                        </div>
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
                                                    <?= (isset($_POST['category_id']) && $_POST['category_id'] == $category->id) ? 'selected' : '' ?>>
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
                                <textarea class="form-control <?= isset($errors['description']) ? 'is-invalid' : '' ?>" 
                                          id="description" 
                                          name="description" 
                                          rows="5" 
                                          placeholder="Nhập mô tả chi tiết về sản phẩm..."
                                          required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                                <div class="invalid-feedback">
                                    <?= $errors['description'] ?? '' ?>
                                </div>
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
                                    <button type="submit" class="btn btn-primary btn-lg">
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
// Initialize Choices.js for category select
const categorySelect = new Choices('#category_id', {
    searchEnabled: true,
    placeholder: true,
    placeholderValue: 'Chọn danh mục...',
    noResultsText: 'Không tìm thấy danh mục',
    itemSelectText: 'Nhấn để chọn',
});

// Character counter for description
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

// Image upload handling
const imageInput = document.getElementById('image');
const uploadPlaceholder = document.getElementById('uploadPlaceholder');
const imagePreview = document.getElementById('imagePreview');
const previewImg = document.getElementById('previewImg');

imageInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validate file size (10MB)
        if (file.size > 10 * 1024 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Kích thước file quá lớn. Vui lòng chọn file nhỏ hơn 10MB.',
            });
            return;
        }

        // Validate file type
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Chỉ chấp nhận file hình ảnh (JPG, JPEG, PNG, GIF).',
            });
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            uploadPlaceholder.classList.add('d-none');
            imagePreview.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
});

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

// Form validation
document.getElementById('productForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const price = document.getElementById('price').value;
    const description = document.getElementById('description').value.trim();

    if (!name || !price || !description) {
        e.preventDefault();
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: 'Vui lòng điền đầy đủ thông tin bắt buộc.',
        });
    }
});
</script>

<?php include_once 'app/views/shares/footer.php'; ?>