<?php 
$pageTitle = htmlspecialchars($product->name);
include_once 'app/views/shares/header.php'; 

// Hàm xử lý đường dẫn hình ảnh
function getImageUrl($imagePath) {
    if (empty($imagePath)) {
        return 'https://via.placeholder.com/600x500/f8f9fa/6c757d?text=No+Image';
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

$imageUrl = getImageUrl($product->image);
$hasImage = !empty($product->image);
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/Product" class="text-decoration-none">Sản Phẩm</a></li>
                <li class="breadcrumb-item active"><?= htmlspecialchars($product->name) ?></li>
            </ol>
        </nav>

        <div class="row">
            <!-- Product Image -->
            <div class="col-lg-6 mb-4" data-aos="fade-right">
                <div class="product-image-container">
                    <img src="<?= $imageUrl ?>" 
                         class="img-fluid rounded-3 shadow glightbox main-product-image" 
                         alt="<?= htmlspecialchars($product->name) ?>"
                         data-gallery="product-gallery"
                         onerror="this.onerror=null; this.src='https://via.placeholder.com/600x500/f8f9fa/6c757d?text=No+Image';">
                </div>
                
                <!-- Thumbnail Gallery -->
                <div class="row mt-3">
                    <div class="col-3">
                        <img src="<?= $imageUrl ?>" 
                             class="img-fluid rounded-2 border thumbnail-img active" 
                             alt="Thumbnail 1"
                             onclick="changeMainImage(this.src)"
                             onerror="this.onerror=null; this.src='https://via.placeholder.com/150x120/f8f9fa/6c757d?text=1'">
                    </div>
                    <!-- Chỉ hiển thị placeholder thumbnails nếu có hình ảnh thực -->
                    <?php if ($hasImage): ?>
                    <div class="col-3">
                        <img src="https://via.placeholder.com/150x120/e9ecef/6c757d?text=2" 
                             class="img-fluid rounded-2 border thumbnail-img" 
                             alt="Thumbnail 2"
                             onclick="changeMainImage(this.src)">
                    </div>
                    <div class="col-3">
                        <img src="https://via.placeholder.com/150x120/e9ecef/6c757d?text=3" 
                             class="img-fluid rounded-2 border thumbnail-img" 
                             alt="Thumbnail 3"
                             onclick="changeMainImage(this.src)">
                    </div>
                    <div class="col-3">
                        <img src="https://via.placeholder.com/150x120/e9ecef/6c757d?text=4" 
                             class="img-fluid rounded-2 border thumbnail-img" 
                             alt="Thumbnail 4"
                             onclick="changeMainImage(this.src)">
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="product-details">
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6"><?= htmlspecialchars($product->category_name ?? 'Chưa phân loại') ?></span>
                    </div>
                    
                    <h1 class="display-6 fw-bold mb-3"><?= htmlspecialchars($product->name) ?></h1>
                    
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
                        <h2 class="price text-danger mb-2"><?= number_format($product->price) ?> VNĐ</h2>
                        <div class="price-details text-muted">
                            <small><del>Giá gốc: <?= number_format($product->price * 1.2) ?> VNĐ</del></small>
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
                            <a href="/Product/addToCart/<?= $product->id ?>" class="btn btn-primary btn-lg me-md-2 flex-fill">
                                <i class="fas fa-cart-plus me-2"></i>Thêm Vào Giỏ Hàng
                            </a>
                            <button type="button" class="btn btn-success btn-lg flex-fill">
                                <i class="fas fa-shopping-bag me-2"></i>Mua Ngay
                            </button>
                        </div>

                        <?php if (SessionHelper::isAdmin()): ?>
                        <div class="row mt-3">
                            <div class="col-6 d-grid">
                                <a href="/Product/edit/<?= $product->id ?>" class="btn btn-outline-warning">
                                    <i class="fas fa-edit me-2"></i>Chỉnh Sửa
                                </a>
                            </div>
                            <div class="col-6 d-grid">
                                <button class="btn btn-outline-danger" onclick="deleteProductWithAPI(<?= $product->id ?>)">
                                    <i class="fas fa-trash me-2"></i>Xóa
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Share -->
                    <div class="share-section mt-4 pt-4 border-top">
                        <h6 class="mb-3">Chia Sẻ Sản Phẩm</h6>
                        <div class="share-buttons">
                            <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-outline-info btn-sm me-2">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-outline-success btn-sm me-2">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-link"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
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
                                <p class="lead"><?= nl2br(htmlspecialchars($product->description)) ?></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>
                            <div class="tab-pane fade" id="specifications" role="tabpanel">
                                <h5 class="mb-3">Thông Số Kỹ Thuật</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td><strong>Thương Hiệu</strong></td>
                                                <td>TechTafu</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Model</strong></td>
                                                <td><?= htmlspecialchars($product->name) ?></td>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.thumbnail-img {
    cursor: pointer;
    transition: all 0.3s ease;
    opacity: 0.7;
}

.thumbnail-img:hover,
.thumbnail-img.active {
    opacity: 1;
    transform: scale(1.05);
    border-color: #007bff !important;
}

.main-product-image {
    max-height: 500px;
    object-fit: cover;
    background-color: #f8f9fa;
}

.product-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 0.75rem;
}
</style>

<script>
// Tăng số lượng
function increaseQuantity() {
    const qty = document.getElementById('quantity');
    qty.value = parseInt(qty.value) + 1;
}

// Giảm số lượng
function decreaseQuantity() {
    const qty = document.getElementById('quantity');
    if (parseInt(qty.value) > 1) {
        qty.value = parseInt(qty.value) - 1;
    }
}

// Thay đổi hình ảnh chính
function changeMainImage(src) {
    document.querySelector('.main-product-image').src = src;
    
    // Cập nhật active thumbnail
    document.querySelectorAll('.thumbnail-img').forEach(img => {
        img.classList.remove('active');
        if (img.src === src) {
            img.classList.add('active');
        }
    });
}

// Xóa sản phẩm sử dụng API
async function deleteProductWithAPI(productId) {
    const result = await Swal.fire({
        title: 'Bạn có chắc chắn?',
        text: "Sản phẩm sẽ bị xóa vĩnh viễn!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    });

    if (result.isConfirmed) {
        // Show loading
        Swal.fire({
            title: 'Đang xóa...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        try {
            // Gọi API để xóa sản phẩm
            const response = await fetch(`/api/product/${productId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    // Chuyển hướng về danh sách sản phẩm
                    window.location.href = '/product';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: data.message || 'Có lỗi xảy ra khi xóa sản phẩm'
                });
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: 'Có lỗi xảy ra khi kết nối với server'
            });
        }
    }
}

// Initialize lightbox cho hình ảnh
document.addEventListener('DOMContentLoaded', function() {
    // Initialize GLightbox nếu có
    if (typeof GLightbox !== 'undefined') {
        const lightbox = GLightbox({
            selector: '.glightbox'
        });
    }
    
    // Set active thumbnail khi load
    const firstThumbnail = document.querySelector('.thumbnail-img');
    if (firstThumbnail) {
        firstThumbnail.classList.add('active');
    }
});
</script>

<?php include_once 'app/views/shares/footer.php'; ?>