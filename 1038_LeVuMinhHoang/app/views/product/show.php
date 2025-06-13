<?php 
$pageTitle = "Chi Tiết Sản Phẩm";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản Phẩm</a></li>
                <li class="breadcrumb-item active" id="breadcrumbProductName">Chi Tiết Sản Phẩm</li>
            </ol>
        </nav>

        <!-- Loading State -->
        <div id="loadingContainer" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <div class="mt-2">Đang tải thông tin sản phẩm...</div>
        </div>

        <!-- Product Content -->
        <div id="productContent" style="display: none;">
            <div class="row">
                <!-- Product Image -->
                <div class="col-lg-6 mb-4" data-aos="fade-right">
                    <div class="product-image-container">
                        <!-- Hình ảnh chính sẽ được load bằng JavaScript -->
                        <div id="mainImageContainer">
                            <!-- Placeholder cho hình ảnh -->
                            <div class="image-placeholder main-image-placeholder">
                                <div class="text-center">
                                    <i class="fas fa-image fa-4x mb-3"></i>
                                    <div>Đang tải hình ảnh...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Thumbnail Gallery -->
                    <div class="row mt-3" id="thumbnailGallery">
                        <!-- Thumbnails sẽ được tạo bằng JavaScript -->
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="product-details">
                        <div class="mb-3">
                            <span id="productCategory" class="badge bg-primary fs-6">Đang tải...</span>
                        </div>
                        
                        <h1 id="productName" class="display-6 fw-bold mb-3">Đang tải...</h1>
                        
                        <!-- Rating -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="stars text-warning me-2">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="text-muted">(4.5/5 - 123 đánh giá)</span>
                        </div>

                        <div class="price-section mb-4">
                            <h2 id="productPrice" class="price text-danger mb-2">Đang tải...</h2>
                            <div class="price-details text-muted">
                                <small id="originalPrice"><del>Giá gốc: Đang tải...</del></small>
                                <span class="badge bg-success ms-2">Tiết kiệm 20%</span>
                            </div>
                        </div>

                        <!-- Product Features -->
                        <div class="features mb-4">
                            <h5 class="mb-3">Đặc Điểm Nổi Bật</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Chính hãng 100%</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Bảo hành 12 tháng</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Miễn phí vận chuyển</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Đổi trả trong 7 ngày</li>
                            </ul>
                        </div>

                        <!-- Quantity and Actions -->
                        <div class="action-section">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label class="form-label">Số Lượng</label>
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" class="form-control text-center" id="quantity" value="1" min="1">
                                        <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex">
                                <button id="addToCartBtn" class="btn btn-primary btn-lg me-md-2 flex-fill" onclick="addToCart()">
                                    <i class="fas fa-cart-plus me-2"></i>Thêm Vào Giỏ Hàng
                                </button>
                                <button type="button" class="btn btn-success btn-lg flex-fill">
                                    <i class="fas fa-shopping-bag me-2"></i>Mua Ngay
                                </button>
                            </div>

                            <!-- Admin Actions - Chỉ hiện với user MHoang287 -->
                            <div id="adminActions" class="row mt-3" style="display: none;">
                                <div class="col-6 d-grid">
                                    <button id="editProductBtn" class="btn btn-outline-warning">
                                        <i class="fas fa-edit me-2"></i>Chỉnh Sửa
                                    </button>
                                </div>
                                <div class="col-6 d-grid">
                                    <button id="deleteProductBtn" class="btn btn-outline-danger">
                                        <i class="fas fa-trash me-2"></i>Xóa
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Share -->
                        <div class="share-section mt-4 pt-4 border-top">
                            <h6 class="mb-3">Chia Sẻ Sản Phẩm</h6>
                            <div class="share-buttons">
                                <a href="#" class="btn btn-outline-primary btn-sm me-2" onclick="shareOnFacebook()">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-outline-info btn-sm me-2" onclick="shareOnTwitter()">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-outline-success btn-sm me-2" onclick="shareOnWhatsApp()">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="#" class="btn btn-outline-secondary btn-sm" onclick="copyToClipboard()">
                                    <i class="fas fa-link"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Description Tabs -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card" data-aos="fade-up">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#description" role="tab">
                                        <i class="fas fa-info-circle me-2"></i>Mô Tả
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#specifications" role="tab">
                                        <i class="fas fa-list-ul me-2"></i>Thông Số Kỹ Thuật
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#reviews" role="tab">
                                        <i class="fas fa-star me-2"></i>Đánh Giá
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <h5 class="mb-3">Mô Tả Sản Phẩm</h5>
                                    <div id="productDescription" class="lead">
                                        Đang tải mô tả sản phẩm...
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="specifications" role="tabpanel">
                                    <h5 class="mb-3">Thông Số Kỹ Thuật</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tbody id="specificationsTable">
                                                <tr>
                                                    <td><strong>Thương Hiệu</strong></td>
                                                    <td>TechTafu</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Model</strong></td>
                                                    <td id="specModel">Đang tải...</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Màu Sắc</strong></td>
                                                    <td>Đen, Trắng, Xám</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Bảo Hành</strong></td>
                                                    <td>12 tháng</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    <h5 class="mb-3">Đánh Giá Khách Hàng</h5>
                                    <div class="review-item mb-4 p-3 border rounded">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://via.placeholder.com/40x40/007bff/ffffff?text=U" 
                                                 class="rounded-circle me-3" alt="User">
                                            <div>
                                                <h6 class="mb-0">Nguyễn Văn A</h6>
                                                <div class="stars text-warning">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0">Sản phẩm rất tốt, chất lượng cao và giá cả hợp lý. Tôi rất hài lòng với việc mua hàng này.</p>
                                    </div>
                                    
                                    <div class="review-item mb-4 p-3 border rounded">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="https://via.placeholder.com/40x40/28a745/ffffff?text=B" 
                                                 class="rounded-circle me-3" alt="User">
                                            <div>
                                                <h6 class="mb-0">Trần Thị B</h6>
                                                <div class="stars text-warning">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mb-0">Giao hàng nhanh, đóng gói cẩn thận. Sản phẩm đúng như mô tả.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
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
</section>

<style>
/* CSS cho xử lý hình ảnh */
.product-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 1rem;
}

.main-image-placeholder {
    height: 500px;
}

.image-placeholder {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
    border-radius: 0.375rem;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

.thumbnail-img {
    cursor: pointer;
    transition: all 0.3s ease;
    height: 120px;
    object-fit: cover;
}

.thumbnail-img:hover {
    opacity: 0.8;
    transform: scale(1.05);
}

.thumbnail-placeholder {
    height: 120px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.main-product-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 1rem;
    cursor: pointer;
}

.image-error {
    background: #f8f9fa;
    border: 2px dashed #dee2e6;
}
</style>

<script>
// Biến toàn cục
let currentProduct = null; // Sản phẩm hiện tại
let productId = null; // ID sản phẩm
let imageLoadErrors = new Set(); // Danh sách hình ảnh lỗi

// Lấy ID sản phẩm từ URL
const urlParts = window.location.pathname.split('/');
productId = urlParts[urlParts.length - 1];

console.log('ID sản phẩm từ URL:', productId);

// Khởi tạo khi tài liệu được tải xong
$(document).ready(function() {
    console.log('Khởi tạo trang chi tiết sản phẩm');
    
    // Tải dữ liệu sản phẩm
    loadProductData(productId);
    
    // Kiểm tra quyền admin
    checkAdminStatus();
});

/**
 * Tải dữ liệu sản phẩm từ API
 */
function loadProductData(id) {
    console.log('Tải dữ liệu sản phẩm ID:', id);
    
    fetch(`/api/product/${id}`)
        .then(response => {
            console.log('Response API:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Dữ liệu sản phẩm:', data);
            
            if (data) {
                currentProduct = data; // Lưu sản phẩm hiện tại
                populateProductData(data); // Điền dữ liệu vào giao diện
                setupProductImages(data); // Thiết lập hình ảnh
                showProductContent(); // Hiển thị nội dung
                updatePageTitle(data.name); // Cập nhật tiêu đề trang
            } else {
                throw new Error('Product not found');
            }
        })
        .catch(error => {
            console.error('Lỗi khi tải sản phẩm:', error);
            showErrorState();
        });
}

/**
 * Điền dữ liệu sản phẩm vào giao diện
 */
function populateProductData(product) {
    console.log('Điền dữ liệu sản phẩm:', product.name);
    
    // Cập nhật breadcrumb
    document.getElementById('breadcrumbProductName').textContent = product.name;
    
    // Cập nhật thông tin cơ bản
    document.getElementById('productName').textContent = product.name;
    document.getElementById('productCategory').textContent = product.category_name || 'Chưa phân loại';
    document.getElementById('productPrice').textContent = formatPrice(product.price) + ' VNĐ';
    
    // Cập nhật mô tả
    const descriptionElement = document.getElementById('productDescription');
    if (product.description) {
        descriptionElement.innerHTML = product.description.replace(/\n/g, '<br>');
    } else {
        descriptionElement.innerHTML = '<em class="text-muted">Chưa có mô tả chi tiết cho sản phẩm này.</em>';
    }
    
    // Cập nhật giá gốc (giả sử cao hơn 20%)
    const originalPrice = Math.round(product.price * 1.2);
    document.getElementById('originalPrice').innerHTML = `<del>Giá gốc: ${formatPrice(originalPrice)} VNĐ</del>`;
    
    // Cập nhật thông số kỹ thuật
    document.getElementById('specModel').textContent = product.name;
    
    // Thiết lập nút admin
    setupAdminButtons(product.id);
}

/**
 * Thiết lập hình ảnh sản phẩm với xử lý lỗi thông minh
 */
function setupProductImages(product) {
    console.log('Thiết lập hình ảnh cho sản phẩm');
    
    const mainImageContainer = document.getElementById('mainImageContainer');
    const thumbnailGallery = document.getElementById('thumbnailGallery');
    
    if (product.image && !imageLoadErrors.has(product.image)) {
        // Có hình ảnh và chưa bị lỗi
        const imageUrl = getImageUrl(product.image);
        
        // Tạo hình ảnh chính
        const mainImg = document.createElement('img');
        mainImg.className = 'main-product-image';
        mainImg.alt = product.name;
        mainImg.src = imageUrl;
        
        // Xử lý khi tải thành công
        mainImg.onload = function() {
            console.log('Hình ảnh chính tải thành công');
            mainImageContainer.innerHTML = '';
            mainImageContainer.appendChild(this);
        };
        
        // Xử lý khi tải thất bại
        mainImg.onerror = function() {
            console.log('Hình ảnh chính tải thất bại');
            imageLoadErrors.add(product.image); // Đánh dấu lỗi
            showImagePlaceholder(mainImageContainer, 'main');
        };
        
        // Tạo thumbnails
        createThumbnails(product, thumbnailGallery);
    } else {
        // Không có hình ảnh hoặc đã lỗi
        console.log('Không có hình ảnh hoặc hình ảnh đã lỗi');
        showImagePlaceholder(mainImageContainer, 'main');
        createPlaceholderThumbnails(thumbnailGallery);
    }
}

/**
 * Tạo thumbnails
 */
function createThumbnails(product, container) {
    console.log('Tạo thumbnails');
    
    container.innerHTML = '';
    
    // Thumbnail 1 - hình ảnh thật
    const col1 = document.createElement('div');
    col1.className = 'col-3';
    
    if (product.image && !imageLoadErrors.has(product.image)) {
        const thumb1 = document.createElement('img');
        thumb1.className = 'img-fluid rounded-2 border thumbnail-img';
        thumb1.alt = 'Thumbnail 1';
        thumb1.src = getImageUrl(product.image);
        
        thumb1.onload = function() {
            console.log('Thumbnail 1 tải thành công');
        };
        
        thumb1.onerror = function() {
            console.log('Thumbnail 1 tải thất bại');
            this.parentNode.innerHTML = '<div class="thumbnail-placeholder image-placeholder"><div class="text-center"><i class="fas fa-image fa-2x"></i></div></div>';
        };
        
        thumb1.onclick = function() {
            changeMainImage(this.src);
        };
        
        col1.appendChild(thumb1);
    } else {
        col1.innerHTML = '<div class="thumbnail-placeholder image-placeholder"><div class="text-center"><i class="fas fa-image fa-2x"></i></div></div>';
    }
    
    container.appendChild(col1);
    
    // Thumbnails 2, 3, 4 - placeholder
    for (let i = 2; i <= 4; i++) {
        const col = document.createElement('div');
        col.className = 'col-3';
        col.innerHTML = `<div class="thumbnail-placeholder image-placeholder" onclick="showNoImageMessage()"><div class="text-center"><i class="fas fa-image fa-2x mb-1"></i><div class="small">${i}</div></div></div>`;
        container.appendChild(col);
    }
}

/**
 * Tạo placeholder thumbnails
 */
function createPlaceholderThumbnails(container) {
    console.log('Tạo placeholder thumbnails');
    
    container.innerHTML = '';
    
    for (let i = 1; i <= 4; i++) {
        const col = document.createElement('div');
        col.className = 'col-3';
        col.innerHTML = `<div class="thumbnail-placeholder image-placeholder" onclick="showNoImageMessage()"><div class="text-center"><i class="fas fa-image fa-2x mb-1"></i><div class="small">${i}</div></div></div>`;
        container.appendChild(col);
    }
}

/**
 * Hiển thị placeholder cho hình ảnh
 */
function showImagePlaceholder(container, type) {
    console.log('Hiển thị placeholder cho:', type);
    
    const placeholderClass = type === 'main' ? 'main-image-placeholder' : 'thumbnail-placeholder';
    const iconSize = type === 'main' ? 'fa-5x' : 'fa-3x';
    
    container.innerHTML = `
        <div class="image-placeholder ${placeholderClass} image-error">
            <div class="text-center">
                <i class="fas fa-image ${iconSize} mb-3"></i>
                <div>Không có hình ảnh</div>
            </div>
        </div>
    `;
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
    
    return '/uploads/' + imagePath;
}

/**
 * Thay đổi hình ảnh chính
 */
function changeMainImage(src) {
    console.log('Thay đổi hình ảnh chính:', src);
    
    const mainContainer = document.getElementById('mainImageContainer');
    const currentImg = mainContainer.querySelector('.main-product-image');
    
    if (currentImg) {
        currentImg.src = src;
    }
    
    // Highlight thumbnail được chọn
    document.querySelectorAll('.thumbnail-img').forEach(thumb => {
        thumb.classList.remove('border-primary');
        if (thumb.src === src) {
            thumb.classList.add('border-primary');
        }
    });
}

/**
 * Hiển thị thông báo không có hình ảnh
 */
function showNoImageMessage() {
    Swal.fire({
        icon: 'info',
        title: 'Thông báo',
        text: 'Sản phẩm này chưa có hình ảnh bổ sung',
        timer: 2000,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
}

/**
 * Kiểm tra quyền admin
 */
function checkAdminStatus() {
    // Kiểm tra user hiện tại (từ PHP session)
    const currentUser = '<?= $_SESSION['username'] ?? '' ?>' || 'MHoang287'; // Fallback cho demo
    
    console.log('Current user:', currentUser);
    
    if (currentUser === 'MHoang287') {
        document.getElementById('adminActions').style.display = 'flex';
        console.log('Hiển thị nút admin');
    }
}

/**
 * Thiết lập nút admin
 */
function setupAdminButtons(productId) {
    const editBtn = document.getElementById('editProductBtn');
    const deleteBtn = document.getElementById('deleteProductBtn');
    
    if (editBtn) {
        editBtn.onclick = () => editProduct(productId);
    }
    
    if (deleteBtn) {
        deleteBtn.onclick = () => deleteProduct(productId);
    }
}

/**
 * Tăng số lượng
 */
function increaseQuantity() {
    const qty = document.getElementById('quantity');
    qty.value = parseInt(qty.value) + 1;
    console.log('Tăng số lượng lên:', qty.value);
}

/**
 * Giảm số lượng
 */
function decreaseQuantity() {
    const qty = document.getElementById('quantity');
    if (parseInt(qty.value) > 1) {
        qty.value = parseInt(qty.value) - 1;
        console.log('Giảm số lượng xuống:', qty.value);
    }
}

/**
 * Thêm vào giỏ hàng
 */
function addToCart() {
    if (!currentProduct) {
        console.log('Không có sản phẩm để thêm vào giỏ');
        return;
    }
    
    const button = document.getElementById('addToCartBtn');
    const originalContent = button.innerHTML;
    const quantity = document.getElementById('quantity').value;
    
    console.log('Thêm vào giỏ hàng:', currentProduct.name, 'x', quantity);
    
    // Hiển thị loading
    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang thêm...';
    button.disabled = true;
    
    // Giả lập API call
    setTimeout(() => {
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: `Đã thêm ${quantity} sản phẩm vào giỏ hàng`,
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
        
        // Khôi phục nút
        button.innerHTML = originalContent;
        button.disabled = false;
        
        // Cập nhật số lượng giỏ hàng (nếu có)
        updateCartCount();
    }, 1000);
}

/**
 * Chỉnh sửa sản phẩm
 */
function editProduct(id) {
    console.log('Chuyển đến trang chỉnh sửa sản phẩm:', id);
    window.location.href = `/product/edit/${id}`;
}

/**
 * Xóa sản phẩm
 */
function deleteProduct(id) {
    console.log('Yêu cầu xóa sản phẩm:', id);
    
    Swal.fire({
        title: 'Xác nhận xóa',
        text: "Sản phẩm sẽ bị xóa vĩnh viễn và không thể khôi phục!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash"></i> Xóa',
        cancelButtonText: '<i class="fas fa-times"></i> Hủy',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            console.log('Người dùng xác nhận xóa');
            
            // Hiển thị loading
            Swal.fire({
                title: 'Đang xóa...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Gọi API DELETE
            fetch(`/api/product/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Kết quả xóa:', data);
                
                if (data.message) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Đã xóa!',
                        text: data.message,
                        confirmButtonText: 'Về danh sách'
                    }).then(() => {
                        window.location.href = '/Product';
                    });
                } else {
                    throw new Error('Delete failed');
                }
            })
            .catch(error => {
                console.error('Lỗi khi xóa:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Có lỗi xảy ra khi xóa sản phẩm'
                });
            });
        }
    });
}

/**
 * Chia sẻ lên Facebook
 */
function shareOnFacebook() {
    console.log('Chia sẻ lên Facebook');
    const url = encodeURIComponent(window.location.href);
    const title = encodeURIComponent(currentProduct?.name || 'Sản phẩm tuyệt vời');
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
}

/**
 * Chia sẻ lên Twitter
 */
function shareOnTwitter() {
    console.log('Chia sẻ lên Twitter');
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent(`Xem sản phẩm tuyệt vời này: ${currentProduct?.name || 'Sản phẩm'}`);
    window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'width=600,height=400');
}

/**
 * Chia sẻ lên WhatsApp
 */
function shareOnWhatsApp() {
    console.log('Chia sẻ lên WhatsApp');
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent(`Xem sản phẩm này: ${currentProduct?.name || 'Sản phẩm'} - ${url}`);
    window.open(`https://wa.me/?text=${text}`, '_blank');
}

/**
 * Sao chép link vào clipboard
 */
function copyToClipboard() {
    console.log('Sao chép link vào clipboard');
    
    navigator.clipboard.writeText(window.location.href).then(() => {
        // Thành công với API mới
        console.log('Đã sao chép bằng Clipboard API');
        showCopySuccess();
    }).catch(err => {
        console.error('Clipboard API thất bại:', err);
        
        // Fallback cho trình duyệt cũ
        const textArea = document.createElement('textarea');
        textArea.value = window.location.href;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            console.log('Đã sao chép bằng execCommand');
            showCopySuccess();
        } catch (err) {
            console.error('execCommand cũng thất bại:', err);
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Không thể sao chép link. Vui lòng copy thủ công.',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }
        
        document.body.removeChild(textArea);
    });
}

/**
 * Hiển thị thông báo sao chép thành công
 */
function showCopySuccess() {
    Swal.fire({
        icon: 'success',
        title: 'Đã sao chép!',
        text: 'Đường dẫn đã được sao chép vào clipboard',
        timer: 1500,
        showConfirmButton: false,
        toast: true,
        position: 'top-end'
    });
}

/**
 * Cập nhật số lượng giỏ hàng trên header
 */
function updateCartCount() {
    // Giả lập cập nhật số lượng giỏ hàng
    const cartCount = document.getElementById('cartCount');
    if (cartCount) {
        const currentCount = parseInt(cartCount.textContent || '0');
        const newCount = currentCount + parseInt(document.getElementById('quantity').value);
        cartCount.textContent = newCount;
        console.log('Cập nhật số lượng giỏ hàng:', newCount);
    }
}

/**
 * Cập nhật tiêu đề trang
 */
function updatePageTitle(productName) {
    console.log('Cập nhật tiêu đề trang:', productName);
    
    // Cập nhật title của trang
    document.title = productName + ' - TechTafu';
    
    // Cập nhật meta description cho SEO
    let metaDescription = document.querySelector('meta[name="description"]');
    if (!metaDescription) {
        metaDescription = document.createElement('meta');
        metaDescription.name = 'description';
        document.getElementsByTagName('head')[0].appendChild(metaDescription);
    }
    metaDescription.content = `${productName} - Sản phẩm chất lượng cao với giá cả hợp lý tại TechTafu`;
    
    // Cập nhật Open Graph tags cho social sharing
    updateOpenGraphTags(productName);
}

/**
 * Cập nhật Open Graph tags cho social media
 */
function updateOpenGraphTags(productName) {
    console.log('Cập nhật Open Graph tags');
    
    const ogTitle = document.querySelector('meta[property="og:title"]') || createMetaTag('property', 'og:title');
    const ogDescription = document.querySelector('meta[property="og:description"]') || createMetaTag('property', 'og:description');
    const ogImage = document.querySelector('meta[property="og:image"]') || createMetaTag('property', 'og:image');
    const ogUrl = document.querySelector('meta[property="og:url"]') || createMetaTag('property', 'og:url');
    
    ogTitle.content = productName + ' - TechTafu';
    ogDescription.content = `Mua ${productName} chính hãng với giá tốt nhất tại TechTafu`;
    ogUrl.content = window.location.href;
    
    if (currentProduct?.image) {
        ogImage.content = getImageUrl(currentProduct.image);
    }
}

/**
 * Tạo meta tag mới
 */
function createMetaTag(attribute, value) {
    const meta = document.createElement('meta');
    meta.setAttribute(attribute, value);
    document.getElementsByTagName('head')[0].appendChild(meta);
    return meta;
}

/**
 * Hiển thị nội dung sản phẩm
 */
function showProductContent() {
    console.log('Hiển thị nội dung sản phẩm');
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('productContent').style.display = 'block';
}

/**
 * Hiển thị trạng thái lỗi
 */
function showErrorState() {
    console.log('Hiển thị trạng thái lỗi');
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('errorState').style.display = 'block';
}

/**
 * Định dạng giá tiền
 */
function formatPrice(price) {
    return new Intl.NumberFormat('vi-VN').format(price);
}

// Event listeners cho keyboard navigation
document.addEventListener('DOMContentLoaded', function() {
    console.log('Thiết lập keyboard navigation');
    
    // Điều khiển số lượng bằng phím
    const quantityInput = document.getElementById('quantity');
    if (quantityInput) {
        quantityInput.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowUp') {
                e.preventDefault();
                increaseQuantity();
            } else if (e.key === 'ArrowDown') {
                e.preventDefault();
                decreaseQuantity();
            }
        });
    }
    
    // Khởi tạo GLightbox cho gallery nếu có
    if (typeof GLightbox !== 'undefined') {
        console.log('Khởi tạo GLightbox');
        const lightbox = GLightbox({
            selector: '.glightbox'
        });
    }
});

// Auto-refresh khi focus lại tab
window.addEventListener('focus', function() {
    console.log('Tab được focus lại');
    if (currentProduct && Date.now() - lastLoadTime > 60000) { // Refresh sau 1 phút
        console.log('Tải lại dữ liệu sản phẩm');
        loadProductData(productId);
        lastLoadTime = Date.now();
    }
});

// Biến để track thời gian load cuối
let lastLoadTime = Date.now();

// Performance monitoring
window.addEventListener('load', function() {
    console.log('Trang đã load xong sau:', Date.now() - lastLoadTime, 'ms');
});
</script>

<?php include_once 'app/views/shares/footer.php'; ?>