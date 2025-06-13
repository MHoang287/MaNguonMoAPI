<?php 
$pageTitle = "Danh Sách Danh Mục";
include_once 'app/views/shares/header.php'; 
?>

<section class="py-5">
    <div class="container">
        <!-- Page Header - Tiêu đề trang -->
        <div class="row mb-5">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3" data-aos="fade-right">
                    <i class="fas fa-tags text-primary me-3"></i>Quản Lý Danh Mục
                </h1>
                <p class="lead text-muted" data-aos="fade-right" data-aos-delay="100">
                    Tổ chức và quản lý các danh mục sản phẩm một cách hiệu quả thông qua API
                </p>
            </div>
            <!-- Nút thêm danh mục chỉ hiển thị cho admin -->
            <?php if ($_SESSION['username'] === 'MHoang287'): ?>
            <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                <a href="/category/create" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>Thêm Danh Mục
                </a>
            </div>
            <?php endif; ?>
        </div>

        <!-- Statistics Cards - Thẻ thống kê -->
        <div class="row mb-5">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up">
                <div class="card bg-primary text-white border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-list fa-3x mb-3"></i>
                        <h3 class="counter" id="totalCategories">0</h3>
                        <p class="mb-0">Tổng Danh Mục</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card bg-success text-white border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-eye fa-3x mb-3"></i>
                        <h3 class="counter" id="categoriesWithDescription">0</h3>
                        <p class="mb-0">Có Mô Tả</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card bg-warning text-dark border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-clock fa-3x mb-3"></i>
                        <h3 id="todayUpdate">0</h3>
                        <p class="mb-0">Cập Nhật Hôm Nay</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card bg-info text-white border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                        <h3>100%</h3>
                        <p class="mb-0">Hiệu Suất API</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter - Thanh tìm kiếm và lọc -->
        <div class="row mb-4">
            <div class="col-lg-6">
                <div class="input-group input-group-lg">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" id="categorySearch" placeholder="Tìm kiếm danh mục...">
                </div>
            </div>
            <div class="col-lg-3">
                <select class="form-select form-select-lg" id="sortBy">
                    <option value="newest">Mới nhất</option>
                    <option value="oldest">Cũ nhất</option>
                    <option value="name">Tên A-Z</option>
                    <option value="name-desc">Tên Z-A</option>
                </select>
            </div>
            <!-- Nút điều khiển chỉ hiển thị cho admin -->
            <?php if ($_SESSION['username'] === 'MHoang287'): ?>
            <div class="col-lg-3">
                <div class="btn-group w-100" role="group">
                    <button type="button" class="btn btn-outline-secondary active" id="gridView">
                        <i class="fas fa-th"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" id="listView">
                        <i class="fas fa-list"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary" onclick="refreshCategories()">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Loading State - Trạng thái đang tải -->
        <div id="loadingContainer" class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Đang tải...</span>
            </div>
            <div class="mt-2">Đang tải danh mục từ API...</div>
        </div>

        <!-- Categories Display - Hiển thị danh mục -->
        <div id="categoriesContainer" style="display: none;">
            <!-- Grid View - Hiển thị dạng lưới -->
            <div class="row" id="gridContainer">
                <!-- Danh mục sẽ được load bằng JavaScript -->
            </div>

            <!-- List View - Hiển thị dạng bảng (ẩn mặc định) -->
            <div class="d-none" id="listContainer">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Danh Sách Danh Mục</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Mô Tả</th>
                                    <th>Sản Phẩm</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody id="categoryTableBody">
                                <!-- Dữ liệu bảng sẽ được load bằng JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empty State - Trạng thái rỗng -->
        <div id="emptyState" class="text-center py-5" style="display: none;" data-aos="fade-up">
            <div class="empty-state">
                <i class="fas fa-folder-open fa-5x text-muted mb-4"></i>
                <h3 class="text-muted mb-3">Chưa Có Danh Mục Nào</h3>
                <p class="text-muted mb-4">Hãy tạo danh mục đầu tiên để tổ chức sản phẩm của bạn!</p>
                <a href="/category/create" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>Tạo Danh Mục Đầu Tiên
                </a>
            </div>
        </div>

        <!-- Error State - Trạng thái lỗi -->
        <div id="errorState" class="text-center py-5" style="display: none;">
            <i class="fas fa-exclamation-triangle fa-5x text-danger mb-4"></i>
            <h3 class="text-danger">Không thể tải danh mục</h3>
            <p class="text-muted mb-4" id="errorMessage">Có lỗi xảy ra khi kết nối với API.</p>
            <button class="btn btn-primary" onclick="loadCategories()">
                <i class="fas fa-retry me-2"></i>Thử Lại
            </button>
        </div>
    </div>
</section>

<style>
/* CSS cho animation và hiệu ứng */
.category-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.loading-shimmer {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

.fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
// Biến toàn cục để quản lý dữ liệu và trạng thái
let categoriesData = []; // Mảng chứa dữ liệu danh mục từ API
let filteredCategories = []; // Mảng chứa danh mục sau khi lọc
let currentView = 'grid'; // Chế độ hiển thị hiện tại: 'grid' hoặc 'list'

// Khởi tạo khi tài liệu được tải xong
$(document).ready(function() {
    console.log('🚀 Khởi tạo trang danh sách danh mục với CategoryApiController');
    
    // Tải dữ liệu danh mục từ API
    loadCategories();
    
    // Thiết lập các event listener
    setupEventListeners();
    
    // Thiết lập auto-refresh mỗi 5 phút
    setInterval(refreshCategories, 300000);
});

/**
 * Tải danh sách danh mục từ CategoryApiController
 * Sử dụng endpoint: GET /api/category
 */
async function loadCategories() {
    console.log('📚 Bắt đầu tải danh mục từ CategoryApiController');
    
    try {
        // Hiển thị trạng thái loading
        showLoading();
        
        // Gọi API CategoryApiController - method index()
        const response = await fetch('/api/category', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        console.log('📡 Response từ CategoryApiController:', response.status);
        
        // Kiểm tra response có thành công không
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        // Chuyển đổi response thành JSON
        const data = await response.json();
        console.log('📋 Dữ liệu danh mục nhận được:', data);
        
        // Kiểm tra và xử lý dữ liệu
        if (Array.isArray(data)) {
            categoriesData = data; // Lưu dữ liệu vào biến global
            filteredCategories = [...data]; // Copy để lọc
            
            if (data.length > 0) {
                // Có dữ liệu - hiển thị danh mục
                displayCategories(data);
                updateStatistics(data);
                console.log(`✅ Đã tải thành công ${data.length} danh mục`);
            } else {
                // Không có dữ liệu - hiển thị empty state
                showEmptyState();
                console.log('📭 Không có danh mục nào');
            }
        } else {
            throw new Error('Invalid data format from API');
        }
        
    } catch (error) {
        console.error('❌ Lỗi khi tải danh mục:', error);
        showErrorState(error.message);
    } finally {
        hideLoading(); // Ẩn loading trong mọi trường hợp
    }
}

/**
 * Hiển thị danh sách danh mục lên giao diện
 * @param {Array} categories - Mảng danh mục cần hiển thị
 */
function displayCategories(categories) {
    console.log(`🎨 Hiển thị ${categories.length} danh mục`);
    
    if (currentView === 'grid') {
        displayGridView(categories);
    } else {
        displayListView(categories);
    }
    
    // Hiển thị container danh mục
    document.getElementById('categoriesContainer').style.display = 'block';
    document.getElementById('emptyState').style.display = 'none';
    document.getElementById('errorState').style.display = 'none';
}

/**
 * Hiển thị danh mục dạng lưới (grid)
 * @param {Array} categories - Mảng danh mục
 */
function displayGridView(categories) {
    console.log('🔲 Hiển thị danh mục dạng grid');
    
    const container = document.getElementById('gridContainer');
    container.innerHTML = ''; // Xóa nội dung cũ
    
    // Tạo card cho từng danh mục
    categories.forEach((category, index) => {
        const categoryCard = createCategoryCard(category, index);
        container.appendChild(categoryCard);
        
        // Animation delay cho từng card
        setTimeout(() => {
            categoryCard.classList.add('fade-in');
        }, index * 100);
    });
    
    console.log(`✅ Đã tạo ${categories.length} category cards`);
}

/**
 * Hiển thị danh mục dạng bảng (list)
 * @param {Array} categories - Mảng danh mục
 */
function displayListView(categories) {
    console.log('📋 Hiển thị danh mục dạng list');
    
    const tbody = document.getElementById('categoryTableBody');
    tbody.innerHTML = ''; // Xóa nội dung cũ
    
    // Tạo row cho từng danh mục
    categories.forEach((category, index) => {
        const row = createCategoryRow(category, index);
        tbody.appendChild(row);
    });
    
    console.log(`✅ Đã tạo ${categories.length} table rows`);
}

/**
 * Tạo card danh mục cho grid view
 * @param {Object} category - Đối tượng danh mục
 * @param {number} index - Chỉ số trong mảng
 * @returns {HTMLElement} - Element div chứa card
 */
function createCategoryCard(category, index) {
    console.log(`🎴 Tạo card cho danh mục: ${category.name}`);
    
    const col = document.createElement('div');
    col.className = 'col-xl-4 col-lg-6 mb-4 category-item';
    col.setAttribute('data-aos', 'fade-up');
    col.setAttribute('data-aos-delay', index * 100);
    
    // Tạo màu gradient ngẫu nhiên cho header
    const colors = ['#667eea', '#764ba2', '#f093fb', '#f5576c', '#4facfe', '#00f2fe'];
    const headerColor = colors[index % colors.length];
    
    col.innerHTML = `
        <div class="card category-card h-100 shadow-sm border-0">
            <div class="card-header bg-gradient position-relative" style="background: linear-gradient(135deg, ${headerColor} 0%, ${adjustColor(headerColor, -20)} 100%);">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="text-white mb-0 fw-bold">
                        <i class="fas fa-folder-open me-2"></i>
                        ${escapeHtml(category.name)}
                    </h5>
                    ${createActionDropdown(category)}
                </div>
                <div class="position-absolute top-0 start-0 m-2">
                    <span class="badge bg-light text-dark">ID: ${category.id}</span>
                </div>
            </div>
            
            <div class="card-body">
                <div class="category-description mb-3">
                    ${createDescriptionHtml(category.description)}
                </div>
                
                <div class="category-stats mb-3">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="stat-item">
                                <h6 class="mb-1 text-primary">${Math.floor(Math.random() * 45) + 5}</h6>
                                <small class="text-muted">Sản Phẩm</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-item">
                                <h6 class="mb-1 text-success">${Math.floor(Math.random() * 900) + 100}</h6>
                                <small class="text-muted">Lượt Xem</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-item">
                                <h6 class="mb-1 text-warning">${Math.floor(Math.random() * 90) + 10}</h6>
                                <small class="text-muted">Đơn Hàng</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-footer bg-transparent">
                ${createActionButtons(category)}
            </div>
        </div>
    `;
    
    return col;
}

/**
 * Tạo row danh mục cho list view
 * @param {Object} category - Đối tượng danh mục
 * @param {number} index - Chỉ số trong mảng
 * @returns {HTMLElement} - Element tr chứa row
 */
function createCategoryRow(category, index) {
    console.log(`📝 Tạo row cho danh mục: ${category.name}`);
    
    const row = document.createElement('tr');
    row.innerHTML = `
        <td><span class="badge bg-primary">${category.id}</span></td>
        <td class="fw-bold">${escapeHtml(category.name)}</td>
        <td class="text-muted">
            ${category.description ? 
                escapeHtml(category.description.substring(0, 100)) + (category.description.length > 100 ? '...' : '') : 
                'Chưa có mô tả'
            }
        </td>
        <td><span class="badge bg-success">${Math.floor(Math.random() * 45) + 5}</span></td>
        <td>
            <div class="btn-group btn-group-sm" role="group">
                <a href="/category/show/${category.id}" class="btn btn-outline-info" title="Xem chi tiết">
                    <i class="fas fa-eye"></i>
                </a>
                ${createEditButton(category)}
                ${createDeleteButton(category)}
            </div>
        </td>
    `;
    
    return row;
}

/**
 * Tạo dropdown menu hành động (chỉ cho admin)
 * @param {Object} category - Đối tượng danh mục
 * @returns {string} - HTML string
 */
function createActionDropdown(category) {
    if (!isAdmin()) return '';
    
    return `
        <div class="dropdown">
            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-cog"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="/category/show/${category.id}">
                        <i class="fas fa-eye me-2"></i>Xem Chi Tiết
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="/category/edit/${category.id}">
                        <i class="fas fa-edit me-2"></i>Chỉnh Sửa
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="#" onclick="deleteCategory(${category.id})">
                        <i class="fas fa-trash me-2"></i>Xóa
                    </a>
                </li>
            </ul>
        </div>
    `;
}

/**
 * Tạo HTML cho mô tả danh mục
 * @param {string} description - Mô tả danh mục
 * @returns {string} - HTML string
 */
function createDescriptionHtml(description) {
    if (!description || description.trim() === '') {
        return '<p class="text-muted fst-italic">Chưa có mô tả</p>';
    }
    
    const truncated = description.length > 150 ? 
        description.substring(0, 150) + '...' : 
        description;
        
    return `<p class="text-muted mb-2">${escapeHtml(truncated)}</p>`;
}

/**
 * Tạo nút hành động cho card footer
 * @param {Object} category - Đối tượng danh mục
 * @returns {string} - HTML string
 */
function createActionButtons(category) {
    const viewBtn = `
        <a href="/category/show/${category.id}" class="btn btn-outline-primary">
            <i class="fas fa-eye"></i>
        </a>
    `;
    
    if (!isAdmin()) {
        return `<div class="btn-group w-100" role="group">${viewBtn}</div>`;
    }
    
    return `
        <div class="btn-group w-100" role="group">
            ${viewBtn}
            <a href="/category/edit/${category.id}" class="btn btn-outline-warning flex-grow-1">
                <i class="fas fa-edit me-1"></i>Chỉnh Sửa
            </a>
            <button class="btn btn-outline-danger" onclick="deleteCategory(${category.id})">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    `;
}

/**
 * Tạo nút chỉnh sửa (chỉ cho admin)
 * @param {Object} category - Đối tượng danh mục
 * @returns {string} - HTML string
 */
function createEditButton(category) {
    if (!isAdmin()) return '';
    
    return `
        <a href="/category/edit/${category.id}" class="btn btn-outline-warning" title="Chỉnh sửa">
            <i class="fas fa-edit"></i>
        </a>
    `;
}

/**
 * Tạo nút xóa (chỉ cho admin)
 * @param {Object} category - Đối tượng danh mục
 * @returns {string} - HTML string
 */
function createDeleteButton(category) {
    if (!isAdmin()) return '';
    
    return `
        <button class="btn btn-outline-danger" onclick="deleteCategory(${category.id})" title="Xóa">
            <i class="fas fa-trash"></i>
        </button>
    `;
}

/**
 * Xóa danh mục sử dụng CategoryApiController
 * Sử dụng endpoint: DELETE /api/category/{id}
 * @param {number} id - ID danh mục cần xóa
 */
function deleteCategory(id) {
    console.log('🗑️ Yêu cầu xóa danh mục ID:', id);
    
    // Tìm thông tin danh mục để hiển thị trong confirm
    const category = categoriesData.find(cat => cat.id === id);
    const categoryName = category ? category.name : `ID ${id}`;
    
    Swal.fire({
        title: 'Xác nhận xóa danh mục',
        html: `
            <p>Bạn có chắc chắn muốn xóa danh mục <strong>"${categoryName}"</strong>?</p>
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Các sản phẩm trong danh mục này sẽ chuyển về 'Chưa phân loại'
            </div>
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fas fa-trash"></i> Xóa',
        cancelButtonText: '<i class="fas fa-times"></i> Hủy',
        reverseButtons: true
    }).then(async (result) => {
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
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    // Tải lại danh sách danh mục
                    loadCategories();
                    
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
    });
}

/**
 * Thiết lập các event listener cho giao diện
 */
function setupEventListeners() {
    console.log('🎧 Thiết lập event listeners');
    
    // Tìm kiếm realtime với debounce
    let searchTimeout;
    $('#categorySearch').on('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            console.log('🔍 Tìm kiếm:', searchTerm);
            filterCategories(searchTerm);
        }, 300);
    });
    
    // Sắp xếp
    $('#sortBy').on('change', function() {
        const sortBy = this.value;
        console.log('🔄 Sắp xếp theo:', sortBy);
        sortCategories(sortBy);
    });
    
    // Chuyển đổi view
    $('#gridView').on('click', function() {
        switchView('grid');
    });
    
    $('#listView').on('click', function() {
        switchView('list');
    });
}

/**
 * Lọc danh mục theo từ khóa tìm kiếm
 * @param {string} searchTerm - Từ khóa tìm kiếm
 */
function filterCategories(searchTerm) {
    if (!searchTerm) {
        // Không có từ khóa - hiển thị tất cả
        filteredCategories = [...categoriesData];
    } else {
        // Lọc theo tên và mô tả
        filteredCategories = categoriesData.filter(category => {
            const nameMatch = category.name.toLowerCase().includes(searchTerm);
            const descMatch = category.description && 
                category.description.toLowerCase().includes(searchTerm);
            return nameMatch || descMatch;
        });
    }
    
    console.log(`🔍 Lọc được ${filteredCategories.length}/${categoriesData.length} danh mục`);
    
    if (filteredCategories.length > 0) {
        displayCategories(filteredCategories);
    } else {
        showEmptyState();
    }
}

/**
 * Sắp xếp danh mục
 * @param {string} sortBy - Tiêu chí sắp xếp
 */
function sortCategories(sortBy) {
    const sorted = [...filteredCategories];
    
    switch (sortBy) {
        case 'name':
            sorted.sort((a, b) => a.name.localeCompare(b.name));
            break;
        case 'name-desc':
            sorted.sort((a, b) => b.name.localeCompare(a.name));
            break;
        case 'newest':
            sorted.sort((a, b) => b.id - a.id);
            break;
        case 'oldest':
            sorted.sort((a, b) => a.id - b.id);
            break;
        default:
            break;
    }
    
    filteredCategories = sorted;
    displayCategories(filteredCategories);
}

/**
 * Chuyển đổi chế độ hiển thị
 * @param {string} view - Chế độ hiển thị: 'grid' hoặc 'list'
 */
function switchView(view) {
    console.log('👀 Chuyển đổi view:', view);
    
    currentView = view;
    
    if (view === 'grid') {
        document.getElementById('gridContainer').classList.remove('d-none');
        document.getElementById('listContainer').classList.add('d-none');
        document.getElementById('gridView').classList.add('active');
        document.getElementById('listView').classList.remove('active');
    } else {
        document.getElementById('gridContainer').classList.add('d-none');
        document.getElementById('listContainer').classList.remove('d-none');
        document.getElementById('listView').classList.add('active');
        document.getElementById('gridView').classList.remove('active');
    }
    
    // Hiển thị lại với view mới
    displayCategories(filteredCategories);
}

/**
 * Cập nhật thống kê
 * @param {Array} categories - Mảng danh mục
 */
function updateStatistics(categories) {
    console.log('📊 Cập nhật thống kê');
    
    // Tổng số danh mục
    animateValue(document.getElementById('totalCategories'), 0, categories.length, 1500);
    
    // Số danh mục có mô tả
    const withDescription = categories.filter(cat => cat.description && cat.description.trim() !== '').length;
    animateValue(document.getElementById('categoriesWithDescription'), 0, withDescription, 1800);
    
    // Cập nhật hôm nay (giả lập)
    document.getElementById('todayUpdate').textContent = Math.floor(Math.random() * 5) + 1;
}

/**
 * Refresh danh mục
 */
function refreshCategories() {
    console.log('🔄 Refresh danh mục');
    loadCategories();
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
 * Điều chỉnh màu sắc
 * @param {string} color - Mã màu hex
 * @param {number} amount - Lượng điều chỉnh
 * @returns {string}
 */
function adjustColor(color, amount) {
    const usePound = color[0] === "#";
    const col = usePound ? color.slice(1) : color;
    const num = parseInt(col, 16);
    let r = (num >> 16) + amount;
    let g = (num >> 8 & 0x00FF) + amount;
    let b = (num & 0x0000FF) + amount;
    r = r > 255 ? 255 : r < 0 ? 0 : r;
    g = g > 255 ? 255 : g < 0 ? 0 : g;
    b = b > 255 ? 255 : b < 0 ? 0 : b;
    return (usePound ? "#" : "") + (r << 16 | g << 8 | b).toString(16).padStart(6, '0');
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
 * Hiển thị trạng thái loading
 */
function showLoading() {
    document.getElementById('loadingContainer').style.display = 'block';
    document.getElementById('categoriesContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'none';
    document.getElementById('errorState').style.display = 'none';
}

/**
 * Ẩn trạng thái loading
 */
function hideLoading() {
    document.getElementById('loadingContainer').style.display = 'none';
}

/**
 * Hiển thị trạng thái rỗng
 */
function showEmptyState() {
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('categoriesContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'block';
    document.getElementById('errorState').style.display = 'none';
}

/**
 * Hiển thị trạng thái lỗi
 * @param {string} message - Thông báo lỗi
 */
function showErrorState(message) {
    document.getElementById('loadingContainer').style.display = 'none';
    document.getElementById('categoriesContainer').style.display = 'none';
    document.getElementById('emptyState').style.display = 'none';
    document.getElementById('errorState').style.display = 'block';
    document.getElementById('errorMessage').textContent = message;
}

// Debug helper (chỉ trong development)
if (window.location.hostname === 'localhost') {
    window.debugCategory = {
        categoriesData,
        filteredCategories,
        loadCategories,
        refreshCategories
    };
    console.log('🔧 Debug helpers available in window.debugCategory');
}

console.log('🎉 Category List API Script loaded successfully');
console.log(`👤 Current user: <?= $_SESSION['username'] ?? 'Guest' ?>`);
console.log(`📅 Current time: <?= date('Y-m-d H:i:s') ?>`);
</script>

<?php include_once 'app/views/shares/footer.php'; ?>