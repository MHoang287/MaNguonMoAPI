<?php 
$pageTitle = "Chỉnh Sửa Sản Phẩm";
include_once 'app/views/shares/header.php'; 
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
                        <form action="/Product/update" method="POST" enctype="multipart/form-data" id="editProductForm">
                            <input type="hidden" name="id" value="<?= $product->id ?>">
                            <input type="hidden" name="existing_image" value="<?= $product->image ?>">

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
                                          placeholder="Nhập mô tả chi tiết về sản phẩm..."
                                          required><?= htmlspecialchars($product->description) ?></textarea>
                                <div class="form-text">
                                    <span id="charCount">0</span>/500 ký tự
                                </div>
                            </div>

                            <!-- Current Image -->
                            <?php if (!empty($product->image)): ?>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-image me-1"></i>Hình Ảnh Hiện Tại
                                    </label>
                                    <div class="current-image-container">
                                        <img src="<?= $product->image ?>" 
                                             class="img-fluid rounded border" 
                                             style="max-height: 200px;"
                                             alt="Current product image">
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
                                        <p class="text-muted small">Hỗ trợ: JPG, JPEG, PNG, GIF (Tối đa 10MB)</p>
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
                                    <button type="submit" class="btn btn-warning btn-lg">
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

// Image upload handling (same as add.php)
const imageInput = document.getElementById('image');
const uploadPlaceholder = document.getElementById('uploadPlaceholder');
const imagePreview = document.getElementById('imagePreview');
const previewImg = document.getElementById('previewImg');

imageInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        if (file.size > 10 * 1024 * 1024) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Kích thước file quá lớn. Vui lòng chọn file nhỏ hơn 10MB.',
            });
            return;
        }

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

// Form validation
document.getElementById('editProductForm').addEventListener('submit', function(e) {
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