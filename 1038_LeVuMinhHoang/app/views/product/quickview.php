<?php
// Function để xử lý đường dẫn hình ảnh
function getImageUrl($imagePath) {
    if (empty($imagePath)) {
        return 'https://via.placeholder.com/400x300/f8f9fa/6c757d?text=No+Image';
    }
    
    if (strpos($imagePath, 'http') === 0) {
        return $imagePath;
    }
    
    if (strpos($imagePath, 'uploads/') === 0) {
        return '/' . $imagePath;
    }
    
    return '/uploads/' . $imagePath;
}

$imageUrl = getImageUrl($product->image);
?>

<div class="row">
    <!-- Product Image -->
    <div class="col-md-6">
        <div class="text-center">
            <img src="<?= $imageUrl ?>" 
                 class="img-fluid rounded shadow" 
                 alt="<?= htmlspecialchars($product->name) ?>"
                 style="max-height: 300px; object-fit: cover;"
                 onerror="this.src='https://via.placeholder.com/400x300/f8f9fa/6c757d?text=No+Image'">
        </div>
    </div>
    
    <!-- Product Info -->
    <div class="col-md-6">
        <div class="d-flex flex-column h-100">
            <!-- Category Badge -->
            <div class="mb-2">
                <span class="badge bg-primary">
                    <?= htmlspecialchars($product->category_name ?? 'Chưa phân loại') ?>
                </span>
            </div>
            
            <!-- Product Name -->
            <h4 class="fw-bold mb-3"><?= htmlspecialchars($product->name) ?></h4>
            
            <!-- Rating -->
            <div class="d-flex align-items-center mb-3">
                <div class="stars text-warning me-2">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <small class="text-muted">(4.5/5 - 123 đánh giá)</small>
            </div>
            
            <!-- Price -->
            <div class="price-section mb-3">
                <h3 class="text-danger fw-bold mb-1">
                    <?= number_format($product->price) ?> đ
                </h3>
                <div class="text-muted">
                    <small><del>Giá gốc: <?= number_format($product->price * 1.2) ?> đ</del></small>
                    <span class="badge bg-success ms-2">Tiết kiệm 20%</span>
                </div>
            </div>
            
            <!-- Description -->
            <div class="mb-3 flex-grow-1">
                <h6 class="fw-semibold">Mô tả:</h6>
                <p class="text-muted small">
                    <?= htmlspecialchars(substr($product->description, 0, 150)) ?>
                    <?= strlen($product->description) > 150 ? '...' : '' ?>
                </p>
            </div>
            
            <!-- Features -->
            <div class="mb-3">
                <h6 class="fw-semibold">Đặc điểm nổi bật:</h6>
                <ul class="list-unstyled small">
                    <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Chính hãng 100%</li>
                    <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Bảo hành 12 tháng</li>
                    <li class="mb-1"><i class="fas fa-check text-success me-2"></i>Miễn phí vận chuyển</li>
                </ul>
            </div>
            
            <!-- Quantity -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Số lượng:</label>
                <div class="input-group" style="max-width: 150px;">
                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="decreaseQuickQuantity()">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" class="form-control form-control-sm text-center" id="quickQuantity" value="1" min="1">
                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="increaseQuickQuantity()">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="mt-auto">
                <div class="d-grid gap-2">
                    <button onclick="addToCartFromQuickView(<?= $product->id ?>)" class="btn btn-primary">
                        <i class="fas fa-cart-plus me-2"></i>Thêm Vào Giỏ Hàng
                    </button>
                    <div class="row g-2">
                        <div class="col-6">
                            <a href="/product/show/<?= $product->id ?>" class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-eye me-1"></i>Chi Tiết
                            </a>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-success btn-sm w-100">
                                <i class="fas fa-shopping-bag me-1"></i>Mua Ngay
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function increaseQuickQuantity() {
    const qty = document.getElementById('quickQuantity');
    qty.value = parseInt(qty.value) + 1;
}

function decreaseQuickQuantity() {
    const qty = document.getElementById('quickQuantity');
    if (parseInt(qty.value) > 1) {
        qty.value = parseInt(qty.value) - 1;
    }
}

function addToCartFromQuickView(productId) {
    const quantity = document.getElementById('quickQuantity').value;
    const button = event.target;
    const originalContent = button.innerHTML;
    
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang thêm...';
    button.disabled = true;

    fetch(`/product/addToCart/${productId}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update cart count
            updateCartCount();
            
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: data.message,
                timer: 1500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
            
            // Close modal after 1 second
            setTimeout(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('quickViewModal'));
                if (modal) {
                    modal.hide();
                }
            }, 1000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: data.message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng'
        });
    })
    .finally(() => {
        button.innerHTML = originalContent;
        button.disabled = false;
    });
}
</script>