<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');
require_once('app/helpers/SessionHelper.php');

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }
    
    private function isAdmin() {
        return SessionHelper::isAdmin();
    }


    // READ - Hiển thị danh sách tất cả danh mục
    public function list()
    {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/category/list.php';
    }

    // READ - Hiển thị form thêm danh mục mới
    public function create()
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        include 'app/views/category/create.php';
    }

    // CREATE - Xử lý thêm danh mục mới
    public function store()
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            
            // Validate dữ liệu
            $errors = [];
            
            if (empty($name)) {
                $errors[] = "Tên danh mục không được để trống";
            } elseif (strlen($name) > 100) {
                $errors[] = "Tên danh mục không được quá 100 ký tự";
            } elseif ($this->categoryModel->checkCategoryExists($name)) {
                $errors[] = "Tên danh mục đã tồn tại";
            }
            
            if (empty($errors)) {
                $result = $this->categoryModel->createCategory($name, $description);
                if ($result) {
                    $_SESSION['success'] = "Thêm danh mục thành công";
                    header("Location: /category/list");
                    exit;
                } else {
                    $errors[] = "Có lỗi xảy ra khi thêm danh mục";
                }
            }
            
            // Nếu có lỗi, hiển thị lại form với thông báo lỗi
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $_POST;
            include 'app/views/category/create.php';
        }
    }

    // READ - Hiển thị form chỉnh sửa danh mục
    public function edit($id)
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            $_SESSION['error'] = "Không tìm thấy danh mục";
            header("Location: /category/list");
            exit;
        }
        
        include 'app/views/category/edit.php';
    }

    // UPDATE - Xử lý cập nhật danh mục
    public function update($id)
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            
            // Kiểm tra danh mục có tồn tại không
            $category = $this->categoryModel->getCategoryById($id);
            if (!$category) {
                $_SESSION['error'] = "Không tìm thấy danh mục";
                header("Location: /category/list");
                exit;
            }
            
            // Validate dữ liệu
            $errors = [];
            
            if (empty($name)) {
                $errors[] = "Tên danh mục không được để trống";
            } elseif (strlen($name) > 100) {
                $errors[] = "Tên danh mục không được quá 100 ký tự";
            } elseif ($this->categoryModel->checkCategoryExists($name, $id)) {
                $errors[] = "Tên danh mục đã tồn tại";
            }
            
            if (empty($errors)) {
                $result = $this->categoryModel->updateCategory($id, $name, $description);
                if ($result) {
                    $_SESSION['success'] = "Cập nhật danh mục thành công";
                    header("Location: /category/list");
                    exit;
                } else {
                    $errors[] = "Có lỗi xảy ra khi cập nhật danh mục";
                }
            }
            
            // Nếu có lỗi, hiển thị lại form với thông báo lỗi
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $_POST;
            include 'app/views/category/edit.php';
        }
    }

    // READ - Hiển thị chi tiết danh mục
    public function show($id)
    {
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            $_SESSION['error'] = "Không tìm thấy danh mục";
            header("Location: /category/list");
            exit;
        }
        
        include 'app/views/category/show.php';
    }

    // DELETE - Xóa danh mục
    public function delete($id)
    {
        if (!$this->isAdmin()) {
            echo "Bạn không có quyền truy cập chức năng này!";
            exit;
        }
        // Kiểm tra danh mục có tồn tại không
        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            $_SESSION['error'] = "Không tìm thấy danh mục";
            header("Location: /category/list");
            exit;
        }
        
        $result = $this->categoryModel->deleteCategory($id);
        if ($result) {
            $_SESSION['success'] = "Xóa danh mục thành công";
        } else {
            $_SESSION['error'] = "Có lỗi xảy ra khi xóa danh mục";
        }
        
        header("Location: /category/list");
        exit;
    }

    // Xử lý AJAX để kiểm tra trùng lặp tên danh mục
    public function checkName()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name'] ?? '');
            $excludeId = $_POST['exclude_id'] ?? null;
            
            $exists = $this->categoryModel->checkCategoryExists($name, $excludeId);
            
            header('Content-Type: application/json');
            echo json_encode(['exists' => $exists]);
            exit;
        }
    }
}
?>