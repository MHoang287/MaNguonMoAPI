<?php 
$pageTitle = "Tìm Kiếm Sản Phẩm";
include_once 'app/views/shares/header.php'; 

// Set default values if not set
$searchTerm = $_GET['q'] ?? $_GET['search'] ?? '';
$selectedCategory = $_GET['category'] ?? '';
$selectedSort = $_GET['sort'] ?? 'newest';
$currentPage = max(1, (int)($_GET['page'] ?? 1));

// Helper function to get correct image path
function getImagePath($imagePath) {
    if (empty($imagePath)) {
        return 'https://via.placeholder.com/300x250/f8f9fa/6c757d?text=No+Image';
    }
    
    // If image path already starts with http/https, return as is
    if (strpos($imagePath, 'http') === 0) {
        return $imagePath;
    }
    
    // If image path starts with uploads/, add leading slash
    if (strpos($imagePath, 'uploads/') === 0) {
        return '/' . $imagePath;
    }
    
    // If no uploads/ prefix, assume it's in uploads folder
    return '/uploads/' . $imagePath;
}
?>

<!-- Search Hero Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <h1 class="display-5 fw-bold mb-3">
                    <i class="fas fa-search me-3"></i>Kết Quả Tìm Kiếm
                </h1>
                <?php if (!empty($searchTerm)): ?>
                    <p class="lead mb-4">
                        Tìm thấy <strong><?= $totalProducts ?? count($products) ?> sản phẩm</strong> 
                        cho từ khóa "<span class="text-warning fw-bold"><?= htmlspecialchars($searchTerm) ?></span>"
                    </p>
                <?php else: ?>
                    <p class="lead mb-4">Nhập từ khóa để tìm kiếm sản phẩm</p>
                <?php endif; ?>

                <!-- Advanced Search Form -->
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4">
                        <form method="GET" action="/product/search" id="searchForm">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-search text-primary"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control" 
                                               name="q" 
                                               value="<?= htmlspecialchars($searchTerm) ?>"
                                               placeholder="Nhập tên sản phẩm cần tìm..."
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select form-select-lg" name="category">
                                        <option value="">Tất cả danh mục</option>
                                        <?php if (!empty($categories)): ?>
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category->id ?>" 
                                                        <?= $selectedCategory == $category->id ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($category->name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-warning btn-lg w-100">
                                        <i class="fas fa-search me-2"></i>Tìm Kiếm
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search Suggestions -->
<?php if (empty($searchTerm)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4" data-aos="fade-up">
                <h3 class="fw-bold">Gợi Ý Tìm Kiếm Phổ Biến</h3>
                <p class="text-muted">Những từ khóa được tìm kiếm nhiều nhất</p>
            </div>
        </div>
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-8">
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="/product/search?q=laptop" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-laptop me-2"></i>Laptop
                    </a>
                    <a href="/product/search?q=điện thoại" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-mobile-alt me-2"></i>Điện Thoại
                    </a>
                    <a href="/product/search?q=tablet" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-tablet-alt me-2"></i>Tablet
                    </a>
                    <a href="/product/search?q=tai nghe" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-headphones me-2"></i>Tai Nghe
                    </a>
                    <a href="/product/search?q=gaming" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-gamepad me-2"></i>Gaming
                    </a>
                    <a href="/product/search?q=macbook" class="btn btn-outline-primary rounded-pill">
                        <i class="fab fa-apple me-2"></i>MacBook
                    </a>
                    <a href="/product/search?q=iphone" class="btn btn-outline-primary rounded-pill">
                        <i class="fab fa-apple me-2"></i>iPhone
                    </a>
                    <a href="/product/search?q=samsung" class="btn btn-outline-primary rounded-pill">
                        <i class="fas fa-mobile me-2"></i>Samsung
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Search Results -->
<?php if (!empty($searchTerm)): ?>
<section class="py-5">
    <div class="container">
        <!-- Search Info & Filters -->
        <div class="row mb-4">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="d-flex align-items-center">
                    <h4 class="fw-bold mb-0">Kết Quả Tìm Kiếm</h4>
                    <span class="badge bg-primary ms-3"><?= $totalProducts ?? count($products) ?> sản phẩm</span>
                </div>
                <p class="text-muted mb-0">
                    Từ khóa: "<strong><?= htmlspecialchars($searchTerm) ?></strong>"
                    <?php if (!empty($selectedCategory)): ?>
                        trong danh mục "<strong><?= htmlspecialchars($categories[array_search($selectedCategory, array_column($categories, 'id'))]->name ?? '') ?></strong>"
                    <?php endif; ?>
                </p>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="d-flex justify-content-end align-items-center gap-3">
                    <label for="sortSelect" class="form-label mb-0 fw-semibold">Sắp xếp:</label>
                    <select class="form-select w-auto" id="sortSelect" onchange="updateSort()">
                        <option value="newest" <?= $selectedSort == 'newest' ? 'selected' : '' ?>>Mới nhất</option>
                        <option value="oldest" <?= $selectedSort == 'oldest' ? 'selected' : '' ?>>Cũ nhất</option>
                        <option value="name" <?= $selectedSort == 'name' ? 'selected' : '' ?>>Tên A-Z</option>
                        <option value="price_asc" <?= $selectedSort == 'price_asc' ? 'selected' : '' ?>>Giá tăng dần</option>
                        <option value="price_desc" <?= $selectedSort == 'price_desc' ? 'selected' : '' ?>>Giá giảm dần</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Related Searches -->
        <div class="row mb-4">
            <div class="col-12" data-aos="fade-up">
                <div class="card border-0 bg-light">
                    <div class="card-body p-3">
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <span class="fw-semibold text-muted me-2">Tìm kiếm liên quan:</span>
                            <a href="/product/search?q=<?= urlencode($searchTerm) ?> gaming" class="btn btn-sm btn-outline-secondary">
                                <?= htmlspecialchars($searchTerm) ?> gaming
                            </a>
                            <a href="/product/search?q=<?= urlencode($searchTerm) ?> giá rẻ" class="btn btn-sm btn-outline-secondary">
                                <?= htmlspecialchars($searchTerm) ?> giá rẻ
                            </a>
                            <a href="/product/search?q=<?= urlencode($searchTerm) ?> chính hãng" class="btn btn-sm btn-outline-secondary">
                                <?= htmlspecialchars($searchTerm) ?> chính hãng
                            </a>
                            <a href="/product" class="btn btn-sm btn-outline-danger ms-auto">
                                <i class="fas fa-times me-1"></i>Xóa bộ lọc
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $index => $product): ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                        <div class="card product-card h-100 border-0 shadow-sm">
                            <div class="position-relative overflow-hidden">
                                <?php 
                                $imagePath = getImagePath($product->image);
                                ?>
                                <img src="<?= $imagePath ?>" 
                                     class="card-img-top" 
                                     alt="<?= htmlspecialchars($product->name) ?>"
                                     style="height: 250px; object-fit: cover; cursor: pointer;"
                                     onclick="window.location.href='/product/show/<?= $product->id ?>'"
                                     onerror="this.src='https://via.placeholder.com/300x250/f8f9fa/6c757d?text=<?= urlencode($product->name) ?>'">
                                
                                <!-- Highlight search term in product badges -->
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-primary rounded-pill">
                                        <?= htmlspecialchars($product->category_name ?? 'Chưa phân loại') ?>
                                    </span>
                                </div>
                                
                                <!-- Search relevance badge -->
                                <?php if (stripos($product->name, $searchTerm) !== false): ?>
                                    <div class="position-absolute top-0 start-0 m-2">
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-star"></i> Phù hợp
                                        </span>
                                    </div>
                                <?php endif; ?>

                                <!-- Product overlay on hover -->
                                <div class="product-overlay position-absolute w-100 h-100 d-flex align-items-center justify-content-center">
                                    <button class="btn btn-light btn-sm me-2" onclick="event.stopPropagation(); window.location.href='/product/show/<?= $product->id ?>'" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm" onclick="event.stopPropagation(); addToCartQuick(<?= $product->id ?>)" title="Thêm vào giỏ">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold mb-2" style="min-height: 48px;">
                                    <a href="/product/show/<?= $product->id ?>" class="text-decoration-none text-dark">
                                        <?php
                                        // Highlight search term in title
                                        $highlightedName = str_ireplace($searchTerm, '<mark class="bg-warning">' . $searchTerm . '</mark>', htmlspecialchars($product->name));
                                        echo $highlightedName;
                                        ?>
                                    </a>
                                </h5>
                                
                                <p class="card-text text-muted small flex-grow-1" style="min-height: 60px;">
                                    <?php
                                    // Highlight search term in description
                                    $description = substr($product->description, 0, 100);
                                    $highlightedDesc = str_ireplace($searchTerm, '<mark class="bg-warning">' . $searchTerm . '</mark>', htmlspecialchars($description));
                                    echo $highlightedDesc;
                                    ?>...
                                </p>
                                
                                <div class="price mb-3">
                                    <span class="h5 text-danger fw-bold">
                                        <?= number_format($product->price) ?> đ
                                    </span>
                                </div>
                                
                                <!-- Action buttons -->
                                <div class="mt-auto">
                                    <div class="row g-2">
                                        <div class="col-4">
                                            <a href="/product/show/<?= $product->id ?>" 
                                               class="btn btn-outline-primary btn-sm w-100" 
                                               title="Xem chi tiết">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                        <div class="col-8">
                                            <button onclick="addToCartQuick(<?= $product->id ?>)" 
                                                    class="btn btn-primary btn-sm w-100">
                                                <i class="fas fa-cart-plus me-1"></i>Thêm vào giỏ
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- No Results Found -->
                <div class="col-12">
                    <div class="text-center py-5" data-aos="fade-up">
                        <i class="fas fa-search-minus fa-5x text-muted mb-4"></i>
                        <h3 class="text-muted mb-3">Không tìm thấy sản phẩm nào</h3>
                        <p class="text-muted mb-4">
                            Không có sản phẩm nào phù hợp với từ khóa "<strong><?= htmlspecialchars($searchTerm) ?></strong>"
                        </p>
                        
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="card border-0 bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3">Gợi ý tìm kiếm:</h6>
                                        <ul class="list-unstyled text-start">
                                            <li><i class="fas fa-check text-success me-2"></i>Kiểm tra chính tả từ khóa</li>
                                            <li><i class="fas fa-check text-success me-2"></i>Thử sử dụng từ khóa ngắn gọn hơn</li>
                                            <li><i class="fas fa-check text-success me-2"></i>Tìm kiếm theo danh mục sản phẩm</li>
                                            <li><i class="fas fa-check text-success me-2"></i>Sử dụng từ đồng nghĩa</li>
                                        </ul>
                                        
                                        <div class="mt-3">
                                            <a href="/product" class="btn btn-primary me-2">
                                                <i class="fas fa-list me-2"></i>Xem tất cả sản phẩm
                                            </a>
                                            <button class="btn btn-outline-secondary" onclick="document.querySelector('input[name=q]').focus()">
                                                <i class="fas fa-search me-2"></i>Tìm kiếm lại
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination for search results -->
        <?php if (!empty($products) && isset($totalPages) && $totalPages > 1): ?>
            <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Search pagination" data-aos="fade-up">
                        <ul class="pagination justify-content-center">
                            <!-- Previous button -->
                            <?php if ($currentPage > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= buildSearchPaginationUrl($currentPage - 1) ?>">
                                    <i class="fas fa-chevron-left"></i> Trước
                                </a>
                            </li>
                            <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="fas fa-chevron-left"></i> Trước
                                </span>
                            </li>
                            <?php endif; ?>

                            <!-- Page numbers -->
                            <?php
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($totalPages, $currentPage + 2);
                            
                            for ($i = $startPage; $i <= $endPage; $i++): ?>
                                <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= buildSearchPaginationUrl($i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next button -->
                            <?php if ($currentPage < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= buildSearchPaginationUrl($currentPage + 1) ?>">
                                    Sau <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <?php else: ?>
                            <li class="page-item disabled">
                                <span class="page-link">
                                    Sau <i class="fas fa-chevron-right"></i>
                                </span>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<style>
.product-card {
    transition: all 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

.product-card:hover .product-overlay {
    opacity: 1;
    visibility: visible;
}

.product-overlay {
    background: rgba(0,0,0,0.7);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    top: 0;
    left: 0;
}

mark {
    background-color: #fff3cd;
    padding: 0.1em 0.2em;
    border-radius: 0.2em;
}

.search-highlight {
    background: linear-gradient(120deg, #a8e6cf 0%, #dcedc1 100%);
    padding: 0.1em 0.2em;
    border-radius: 0.2em;
    font-weight: 600;
}

/* Image loading animation */
.card-img-top {
    transition: opacity 0.3s ease;
}

.card-img-top[src*="placeholder"] {
    background: linear-gradient(45deg, #f0f0f0 25%, transparent 25%), 
                linear-gradient(-45deg, #f0f0f0 25%, transparent 25%), 
                linear-gradient(45deg, transparent 75%, #f0f0f0 75%), 
                linear-gradient(-45deg, transparent 75%, #f0f0f0 75%);
    background-size: 20px 20px;
    background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
    animation: slide 2s infinite linear;
}

@keyframes slide {
    0% { background-position: 0 0, 0 10px, 10px -10px, -10px 0px; }
    100% { background-position: 20px 20px, 20px 30px, 30px 10px, 10px 20px; }
}
</style>

<script>
// Update sort functionality
function updateSort() {
    const sortValue = document.getElementById('sortSelect').value;
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('sort', sortValue);
    urlParams.delete('page'); // Reset to first page when sorting
    window.location.href = window.location.pathname + '?' + urlParams.toString();
}

// Add to cart function
function addToCartQuick(productId) {
    const button = event.target.closest('button');
    const originalContent = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    button.disabled = true;

    fetch(`/product/addToCart/${productId}`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartCount();
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: data.message,
                timer: 1500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
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

// Update cart count
function updateCartCount() {
    fetch('/product/getCartInfo', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const cartCount = document.getElementById('cartCount');
            if (cartCount) {
                cartCount.textContent = data.data.cart_info.product_count || 0;
            }
        }
    })
    .catch(error => {
        console.error('Error updating cart count:', error);
    });
}

// Auto-focus search input
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="q"]');
    if (searchInput && !searchInput.value) {
        searchInput.focus();
    }
    
    // Preload images
    const images = document.querySelectorAll('.card-img-top');
    images.forEach(img => {
        const newImg = new Image();
        newImg.onload = function() {
            img.style.opacity = '1';
        };
        newImg.onerror = function() {
            img.src = `https://via.placeholder.com/300x250/f8f9fa/6c757d?text=${encodeURIComponent(img.alt)}`;
        };
        newImg.src = img.src;
    });
});

<?php
// Helper function for search pagination URLs
function buildSearchPaginationUrl($page) {
    $params = $_GET;
    $params['page'] = $page;
    return '/product/search?' . http_build_query($params);
}
?>
</script>

<?php include_once 'app/views/shares/footer.php'; ?>