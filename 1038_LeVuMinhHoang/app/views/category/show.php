<?php 
$pageTitle = "Chi Tiết Danh Mục";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Breadcrumb - Đường dẫn điều hướng -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Trang Chủ</a></li>
                <li class="breadcrumb-item"><a href="/category/list" class="text-decoration-none">Danh Mục</a></li>
                <li class="breadcrumb-item active" id="breadcrumbCategoryName">Chi Tiết Danh Mục</li>
            </ol>
        </nav>

        <!-- Loading State - Trạng thái đang tải dữ liệu từ API -->
        <div id="loadingContainer" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <div class="mt-2">Đang tải thông tin danh mục từ CategoryApiController...</div>
        </div>

        <!-- Category Content - Nội dung danh mục -->
        <div id="categoryContent" style="display: none;">
            <!-- Category Header -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="category-header-card" data-aos="fade-up">
                        <div class="category-hero" id="categoryHero">
                            <div class="hero-content">
                                <div class="row align-items-center">
                                    <div class="col-lg-8">
                                        <div class="category-info text-white">
                                            <div class="category-badge mb-3">
                                                <span class="badge bg-light text-dark fs-6" id="categoryIdBadge">
                                                    <i class="fas fa-hashtag me-1"></i>ID: Đang tải...
                                                </span>
                                            </div>
                                            <h1 class="display-4 fw-bold mb-3" id="categoryName">
                                                <i class="fas fa-folder-open me-3"></i>
                                                Đang tải...
                                            </h1>
                                            <p class="lead mb-4" id="categoryDescription">
                                                Đang tải mô tả...
                                            </p>
                                            
                                            <div class="category-meta">
                                                <div class="row">
                                                    <div class="col-md-4 mb-2">
                                                        <i class="fas fa-calendar-plus me-2"></i>
                                                        <span>Tạo: Từ API</span>
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <i class="fas fa-edit me-2"></i>
                                                        <span>Sửa: Từ API</span>
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <i class="fas fa-database me-2"></i>
                                                        <span>Nguồn: CategoryApiController</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-center">
                                        <div class="category-stats">
                                            <div class="stat-circle">
                                                <div class="stat-number" id="totalProducts">0</div>
                                                <div class="stat-label">Sản Phẩm</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="hero-actions">
                                <div class="btn-group" role="group" id="actionButtons">
                                    <!-- Nút sẽ được tạo bằng JavaScript dựa trên quyền user -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Row - Hàng thống kê -->
            <div class="row mb-5">
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                    <div class="stat-card bg-primary">
                        <div class="stat-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number counter" id="statProducts">0</h3>
                            <p class="stat-label">Sản Phẩm</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-card bg-success">
                        <div class="stat-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number counter" id="statOrders">0</h3>
                            <p class="stat-label">Đơn Hàng</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-card bg-warning">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number" id="statRevenue">0M</h3>
                            <p class="stat-label">Doanh Thu</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-card bg-info">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number" id="statRating">0</h3>
                            <p class="stat-label">Đánh Giá</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- API Information Card -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="card border-0 bg-light" data-aos="fade-up">
                        <div class="card-body">
                            <h6 class="card-title">
                                <i class="fas fa-code text-primary me-2"></i>Thông Tin API
                            </h6>
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <div class="api-info">
                                        <i class="fas fa-server fa-2x text-primary mb-2"></i>
                                        <h6 class="mb-1">Controller</h6>
                                        <small class="text-muted">CategoryApiController</small>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="api-info">
                                        <i class="fas fa-link fa-2x text-success mb-2"></i>
                                        <h6 class="mb-1">Endpoint</h6>
                                        <small class="text-muted">GET /api/category/{id}</small>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="api-info">
                                        <i class="fas fa-database fa-2x text-warning mb-2"></i>
                                        <h6 class="mb-1">Model</h6>
                                        <small class="text-muted">CategoryModel</small>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="api-info">
                                        <i class="fas fa-clock fa-2x text-info mb-2"></i>
                                        <h6 class="mb-1">Response Time</h6>
                                        <small class="text-muted" id="responseTime">< 100ms</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error State - Trạng thái lỗi -->
        <div id="errorState" class="text-center py-5" style="display: none;">
            <i class="fas fa-exclamation-triangle fa-5x text-danger mb-4"></i>
            <h3 class="text-danger">Không tìm thấy danh mục</h3>
            <p class="text-muted mb-4" id="errorMessage">Danh mục không tồn tại hoặc đã bị xóa.</p>
            <div class="d-flex gap-2 justify-content-center">
                <button class="btn btn-primary" onclick="loadCategoryData()">
                    <i class="fas fa-retry me-2"></i>Thử Lại
                </button>
                <a href="/category/list" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Về danh sách danh mục
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* CSS styles tương tự như show.php cũ nhưng có thêm các class mới */
.category-header-card {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.category-hero {
    padding: 60px 40px;
    position: relative;
    color: white;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-content {
    position: relative;
    z-index: 2;
}

.hero-actions {
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 3;
}

.stat-circle {
    width: 120px;
    height: 120px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    backdrop-filter: blur(10px);
}

.stat-circle .stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: white;
}

.stat-circle .stat-label {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.9);
    margin: 0;
}

.stat-card {
    border-radius: 15px;
    padding: 30px 20px;
    text-align: center;
    color: white;
    border: none;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-icon {
    font-size: 2.5rem;
    margin-bottom: 15px;
    opacity: 0.8;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 1rem;
    opacity: 0.9;
    margin: 0;
}

.api-info {
    padding: 15px;
    border-radius: 8px;
    background: white;
    margin-bottom: 10px;
}

@media (max-width: 768px) {
    .category-hero {
        padding: 40px 20px;
    }
    
    .hero-actions {
        position: static;
        margin-top: 20px;
        text-align: center;
    }
    
    .stat-circle {
        width: 100px;
        height: 100px;
    }
}
</style>

<script>
// Lấy ID danh mục từ URL
const urlParts = window.location.pathname.split('/');
const categoryId = urlParts[urlParts.length - 1];

console.log('🆔 ID danh mục từ URL:', categoryId);

// Biến lưu trữ dữ liệu danh mục
let categoryData = null;
let loadStartTime = 0;

// Khởi tạo khi tài liệu được tải xong
$(document).ready(function() {
    console.log('🚀 Khởi tạo trang chi tiết danh mục với CategoryApiController');
    
    // Tải dữ liệu danh mục từ API
    loadCategoryData();
});

/**
 * Tải dữ liệu danh mục từ CategoryApiController
 * Sử dụng endpoint: GET /api/category/{id}
 */
async function loadCategoryData() {
    console.log('📚 Tải dữ liệu danh mục từ CategoryApiController');
    
    // Ghi nhận thời gian bắt đầu để tính response time
    loadStartTime = performance.now();
    
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
        
        // Tính response time
        const responseTime = Math.round(performance.now() - loadStartTime);
        updateResponseTime(responseTime);
        
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
            // Lưu dữ liệu
            categoryData = data;
            
            // Hiển thị dữ liệu
            displayCategoryData(data);
            
            // Hiển thị nội dung
            showCategoryContent();
            
            // Cập nhật page title
            updatePageTitle(data.name);
            
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
 * Hiển thị dữ liệu danh mục lên giao diện
 * @param {Object} category - Dữ liệu danh mục từ API
 */
function displayCategoryData(category) {
    console.log('🎨 Hiển thị dữ liệu danh mục:', category.name);
    
    // Cập nhật breadcrumb
    document.getElementById('breadcrumbCategoryName').textContent = category.name;
    
    // Cập nhật header
    document.getElementById('categoryIdBadge').innerHTML = `<i class="fas fa-hashtag me-1"></i>ID: ${category.id}`;
    document.getElementById('categoryName').innerHTML = `
        <i class="fas fa-folder-open me-3"></i>${escapeHtml(category.name)}
    `;
    
    // Cập nhật mô tả
    const descriptionElement = document.getElementById('categoryDescription');
    if (category.description && category.description.trim() !== '') {
        descriptionElement.textContent = category.description;
        descriptionElement.classList.remove('fst-italic', 'opacity-75');
    } else {
        descriptionElement.textContent = 'Chưa có mô tả cho danh mục này';
        descriptionElement.classList.add('fst-italic', 'opacity-75');
    }
    
    // Tạo action buttons
    createActionButtons(category);
    
    // Cập nhật thống kê
    updateStatistics();
}

/**
 * Tạo các nút hành động dựa trên quyền user
 * @param {Object} category - Dữ liệu danh mục
 */
function createActionButtons(category) {
    const container = document.getElementById('actionButtons');
    container.innerHTML = '';
    
    // Nút chia sẻ (có cho tất cả user)
    const shareBtn = document.createElement('button');
    shareBtn.className = 'btn btn-info btn-lg';
    shareBtn.innerHTML = '<i class="fas fa-share me-2"></i>Chia Sẻ';
    shareBtn.onclick = () => shareCategory(category);
    container.appendChild(shareBtn);
    
    // Nút admin (chỉ cho user MHoang287)
    if (isAdmin()) {
        const editBtn = document.createElement('a');
        editBtn.className = 'btn btn-warning btn-lg';
        editBtn.href = `/category/edit/${category.id}`;
        editBtn.innerHTML = '<i class="fas fa-edit me-2"></i>Chỉnh Sửa';
        container.appendChild(editBtn);
        
        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'btn btn-danger btn-lg';
        deleteBtn.innerHTML = '<i class="fas fa-trash me-2"></i>Xóa';
        deleteBtn.onclick = () => deleteCategory(category.id);
        container.appendChild(deleteBtn);
    }
}

/**
 * Xóa danh mục sử dụng CategoryApiController
 * Sử dụng endpoint: DELETE /api/category/{id}
 * @param {number} id - ID danh mục
 */
async function deleteCategory(id) {
    console.log('🗑️ Yêu cầu xóa danh mục ID:', id);
    
    const result = await Swal.fire({
        title: 'Xác nhận xóa danh mục',
        html: `
            <p>Bạn có chắc chắn muốn xóa danh mục <strong>"${categoryData.name}"</strong>?</p>
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Hành động này không thể hoàn tác!
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash"></i> Xóa',
        cancelButtonText: '<i class="fas fa-times"></i> Hủy',
        reverseButtons: true
    });
    
    if (result.isConfirmed) {
        console.log('✅ Người dùng xác nhận xóa');
        
        try {
            // Hiển thị loading
            Swal.fire({
                title: 'Đang xóa danh mục...',
                html: 'Vui lòng đợi trong giây lát',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Gọi CategoryApiController - method destroy()
            const response = await fetch(`/api/category/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            console.log('📡 Response xóa danh mục:', response.status);
            
            const data = await response.json();
            console.log('📋 Kết quả xóa:', data);
            
            if (response.ok && data.message) {
                // Xóa thành công
                Swal.fire({
                    icon: 'success',
                    title: 'Đã xóa!',
                    text: data.message,
                    confirmButtonText: 'Về danh sách'
                }).then(() => {
                    window.location.href = '/category/list';
                });
                
            } else {
                throw new Error(data.message || 'Không thể xóa danh mục');
            }
            
        } catch (error) {
            console.error('❌ Lỗi khi xóa danh mục:', error);
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: `Có lỗi xảy ra: ${error.message}`,
                confirmButtonText: 'Đóng'
            });
        }
    }
}

/**
 * Chia sẻ danh mục
 * @param {Object} category - Dữ liệu danh mục
 */
function shareCategory(category) {
    console.log('📤 Chia sẻ danh mục:', category.name);
    
    const url = window.location.href;
    
    if (navigator.share) {
        // Sử dụng Web Share API nếu có
        navigator.share({
            title: `Danh mục ${category.name} - TechTafu`,
            text: `Khám phá danh mục ${category.name} tại TechTafu`,
            url: url
        }).then(() => {
            console.log('✅ Chia sẻ thành công');
        }).catch(err => {
            console.log('❌ Lỗi chia sẻ:', err);
            copyToClipboard(url);
        });
    } else {
        // Fallback: sao chép link
        copyToClipboard(url);
    }
}

/**
 * Sao chép URL vào clipboard
 * @param {string} url - URL cần sao chép
 */
function copyToClipboard(url) {
    navigator.clipboard.writeText(url).then(() => {
        Swal.fire({
            icon: 'success',
            title: 'Đã sao chép!',
            text: 'Link danh mục đã được sao chép vào clipboard',
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    }).catch(err => {
        console.error('❌ Lỗi sao chép:', err);
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: 'Không thể sao chép link',
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    });
}

/**
 * Cập nhật thống kê (giả lập)
 */
function updateStatistics() {
    // Tạo số liệu giả lập
    const stats = {
        products: Math.floor(Math.random() * 45) + 5,
        orders: Math.floor(Math.random() * 90) + 10,
        revenue: Math.floor(Math.random() * 90) + 10,
        rating: (Math.random() * 1 + 4).toFixed(1)
    };
    
    // Animate counters
    animateValue(document.getElementById('totalProducts'), 0, stats.products, 1500);
    animateValue(document.getElementById('statProducts'), 0, stats.products, 1000);
    animateValue(document.getElementById('statOrders'), 0, stats.orders, 1200);
    
    // Update revenue và rating
    setTimeout(() => {
        document.getElementById('statRevenue').textContent = stats.revenue + 'M';
        document.getElementById('statRating').textContent = stats.rating;
    }, 500);
}

/**
 * Cập nhật response time
 * @param {number} time - Thời gian response (ms)
 */
function updateResponseTime(time) {
    const element = document.getElementById('responseTime');
    if (time < 100) {
        element.textContent = `${time}ms`;
        element.className = 'text-success';
    } else if (time < 500) {
        element.textContent = `${time}ms`;
        element.className = 'text-warning';
    } else {
                element.textContent = `${time}ms`;
        element.className = 'text-danger';
    }
}

/**
 * Cập nhật page title
 * @param {string} categoryName - Tên danh mục
 */
function updatePageTitle(categoryName) {
    document.title = `${categoryName} - Danh Mục - TechTafu`;
    
    // Cập nhật meta description
    let metaDescription = document.querySelector('meta[name="description"]');
    if (!metaDescription) {
        metaDescription = document.createElement('meta');
        metaDescription.name = 'description';
        document.getElementsByTagName('head')[0].appendChild(metaDescription);
    }
    metaDescription.content = `Xem chi tiết danh mục ${categoryName} tại TechTafu. Khám phá các sản phẩm chất lượng trong danh mục này.`;
}

// Các hàm utility

/**
 * Kiểm tra quyền admin
 * @returns {boolean}
 */
function isAdmin() {
    return '<?= $_SESSION['username'] ?? '' ?>' === 'MHoang287';
}

/**
 * Escape HTML để tránh XSS
 * @param {string} text
 * @returns {string}
 */
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

/**
 * Animate giá trị số
 * @param {HTMLElement} obj - Element cần animate
 * @param {number} start - Giá trị bắt đầu
 * @param {number} end - Giá trị kết thúc
 * @param {number} duration - Thời gian (ms)
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
    document.getElementById('categoryContent').style.display = 'none';
    document.getElementById('errorState').style.display = 'none';
}

/**
 * Ẩn loading
 */
function hideLoading() {
    document.getElementById('loadingContainer').style.display = 'none';
}

/**
 * Hiển thị nội dung danh mục
 */
function showCategoryContent() {
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('categoryContent').style.display = 'block';
    document.getElementById('errorState').style.display = 'none';
}

/**
 * Hiển thị trạng thái lỗi
 * @param {string} message - Thông báo lỗi
 */
function showErrorState(message) {
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('categoryContent').style.display = 'none';
    document.getElementById('errorState').style.display = 'block';
    document.getElementById('errorMessage').textContent = message;
}

// Auto-refresh khi focus lại tab
document.addEventListener('visibilitychange', function() {
    if (!document.hidden && categoryData) {
        console.log('👁️ Tab được focus lại, refresh dữ liệu');
        loadCategoryData();
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Escape để về danh sách
    if (e.key === 'Escape') {
        window.location.href = '/category/list';
    }
    
    // E để edit (chỉ admin)
    if (e.key === 'e' && isAdmin() && categoryData) {
        e.preventDefault();
        window.location.href = `/category/edit/${categoryData.id}`;
    }
});

console.log('🎉 Category Show API Script loaded successfully');
console.log(`👤 Current user: <?= $_SESSION['username'] ?? 'Guest' ?>`);
console.log(`📅 Current time: <?= date('Y-m-d H:i:s') ?>`);
</script>

<?php include_once 'app/views/shares/footer.php'; ?>