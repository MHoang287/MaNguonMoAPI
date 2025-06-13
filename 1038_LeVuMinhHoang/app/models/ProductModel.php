<?php
/**
 * Model quản lý dữ liệu sản phẩm
 * Đã được cập nhật để hỗ trợ trường image (hình ảnh)
 */
class ProductModel
{
    private $conn;
    private $table_name = "product"; // Tên bảng trong database

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /**
     * Lấy danh sách sản phẩm với hỗ trợ hình ảnh
     * @param array $options - Các tùy chọn lọc và sắp xếp
     * @return array - Danh sách sản phẩm bao gồm thông tin hình ảnh
     */
    public function getProducts($options = [])
    {
        // Câu truy vấn bao gồm trường image
        $query = "SELECT p.id, p.name, p.description, p.price, p.category_id, p.image, c.name as category_name
                FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id";
        
        $whereConditions = [];
        $params = [];
        
        // Tìm kiếm theo tên hoặc mô tả sản phẩm
        if (!empty($options['search'])) {
            $whereConditions[] = "(p.name LIKE :search OR p.description LIKE :search)";
            $params['search'] = '%' . $options['search'] . '%';
        }
        
        // Lọc theo danh mục
        if (!empty($options['category_id'])) {
            $whereConditions[] = "p.category_id = :category_id";
            $params['category_id'] = $options['category_id'];
        }
        
        // Lọc theo khoảng giá tối thiểu
        if (!empty($options['min_price'])) {
            $whereConditions[] = "p.price >= :min_price";
            $params['min_price'] = $options['min_price'];
        }
        
        // Lọc theo khoảng giá tối đa
        if (!empty($options['max_price'])) {
            $whereConditions[] = "p.price <= :max_price";
            $params['max_price'] = $options['max_price'];
        }
        
        // Thêm điều kiện WHERE nếu có
        if (!empty($whereConditions)) {
            $query .= " WHERE " . implode(" AND ", $whereConditions);
        }
        
        // Xử lý sắp xếp theo các tiêu chí khác nhau
        $sortBy = $options['sort'] ?? 'id';
        $sortOrder = $options['order'] ?? 'DESC';
        
        switch ($sortBy) {
            case 'name':
                $query .= " ORDER BY p.name " . $sortOrder;
                break;
            case 'price_asc':
                $query .= " ORDER BY p.price ASC";
                break;
            case 'price_desc':
                $query .= " ORDER BY p.price DESC";
                break;
            case 'category':
                $query .= " ORDER BY c.name " . $sortOrder . ", p.name ASC";
                break;
            case 'newest':
                $query .= " ORDER BY p.id DESC";
                break;
            case 'oldest':
                $query .= " ORDER BY p.id ASC";
                break;
            default:
                $query .= " ORDER BY p.id DESC";
                break;
        }
        
        // Xử lý phân trang
        if (!empty($options['limit'])) {
            $offset = $options['offset'] ?? 0;
            $query .= " LIMIT :limit OFFSET :offset";
            $params['limit'] = $options['limit'];
            $params['offset'] = $offset;
        }
        
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters với kiểu dữ liệu phù hợp
        foreach ($params as $key => $value) {
            if ($key === 'limit' || $key === 'offset') {
                $stmt->bindValue(':' . $key, (int)$value, PDO::PARAM_INT);
            } else {
                $stmt->bindValue(':' . $key, $value);
            }
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Đếm tổng số sản phẩm thỏa mãn điều kiện lọc
     */
    public function getTotalProducts($options = [])
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id";
        
        $whereConditions = [];
        $params = [];
        
        // Áp dụng các điều kiện lọc tương tự getProducts()
        if (!empty($options['search'])) {
            $whereConditions[] = "(p.name LIKE :search OR p.description LIKE :search)";
            $params['search'] = '%' . $options['search'] . '%';
        }
        
        if (!empty($options['category_id'])) {
            $whereConditions[] = "p.category_id = :category_id";
            $params['category_id'] = $options['category_id'];
        }
        
        if (!empty($options['min_price'])) {
            $whereConditions[] = "p.price >= :min_price";
            $params['min_price'] = $options['min_price'];
        }
        
        if (!empty($options['max_price'])) {
            $whereConditions[] = "p.price <= :max_price";
            $params['max_price'] = $options['max_price'];
        }
        
        if (!empty($whereConditions)) {
            $query .= " WHERE " . implode(" AND ", $whereConditions);
        }
        
        $stmt = $this->conn->prepare($query);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->total;
    }

    /**
     * Lấy danh sách sản phẩm nổi bật (bao gồm hình ảnh)
     */
    public function getFeaturedProducts($limit = 8)
    {
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name
                FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id
                ORDER BY p.id DESC LIMIT :limit";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Lấy sản phẩm theo danh mục (bao gồm hình ảnh)
     */
    public function getProductsByCategory($categoryId, $limit = null)
    {
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name
                FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id
                WHERE p.category_id = :category_id
                ORDER BY p.id DESC";
        
        if ($limit) {
            $query .= " LIMIT :limit";
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        
        if ($limit) {
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Lấy khoảng giá của tất cả sản phẩm
     */
    public function getPriceRange()
    {
        $query = "SELECT MIN(price) as min_price, MAX(price) as max_price FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Lấy thông tin chi tiết sản phẩm theo ID (bao gồm hình ảnh)
     */
    public function getProductById($id)
    {
        $query = "SELECT p.*, c.name as category_name
                FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id
                WHERE p.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * Thêm sản phẩm mới với hỗ trợ hình ảnh
     * @param string $name - Tên sản phẩm
     * @param string $description - Mô tả sản phẩm
     * @param float $price - Giá sản phẩm
     * @param int $category_id - ID danh mục
     * @param string $image - Đường dẫn hình ảnh (tùy chọn)
     * @return bool|array|int - ID sản phẩm mới hoặc array lỗi
     */
    public function addProduct($name, $description, $price, $category_id, $image = null)
    {
        $errors = [];

        // Validation dữ liệu đầu vào
        if (empty($name)) {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        }

        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống';
        }

        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = 'Giá sản phẩm không hợp lệ';
        }

        // Trả về lỗi nếu có
        if (count($errors) > 0) {
            return $errors;
        }

        // Thực hiện insert vào database (bao gồm trường image)
        $query = "INSERT INTO " . $this->table_name . " (name, description, price, category_id, image) VALUES (:name, :description, :price, :category_id, :image)";
        $stmt = $this->conn->prepare($query);
        
        // Sanitize dữ liệu để tránh XSS
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        $category_id = $category_id ? htmlspecialchars(strip_tags($category_id)) : null;
        $image = $image ? htmlspecialchars(strip_tags($image)) : null;
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':image', $image);

        if ($stmt->execute()) {
            // Trả về ID của sản phẩm vừa tạo
            return $this->conn->lastInsertId();
        }
        return false;
    }

    /**
     * Cập nhật thông tin sản phẩm với hỗ trợ hình ảnh
     * @param int $id - ID sản phẩm
     * @param string $name - Tên sản phẩm mới
     * @param string $description - Mô tả mới
     * @param float $price - Giá mới
     * @param int $category_id - ID danh mục mới
     * @param string $image - Đường dẫn hình ảnh mới (tùy chọn)
     * @return bool - true nếu thành công
     */
    public function updateProduct($id, $name, $description, $price, $category_id, $image = null)
    {
        // Nếu có hình ảnh mới, cập nhật cả hình ảnh
        if ($image !== null) {
            $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, price=:price, category_id=:category_id, image=:image WHERE id=:id";
        } else {
            // Nếu không có hình ảnh mới, không cập nhật trường image
            $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, price=:price, category_id=:category_id WHERE id=:id";
        }
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitize dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        $category_id = $category_id ? htmlspecialchars(strip_tags($category_id)) : null;
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        
        // Bind image parameter nếu có
        if ($image !== null) {
            $image = htmlspecialchars(strip_tags($image));
            $stmt->bindParam(':image', $image);
        }

        return $stmt->execute();
    }

    /**
     * Xóa sản phẩm theo ID
     * @param int $id - ID sản phẩm cần xóa
     * @return bool - true nếu thành công
     */
    public function deleteProduct($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    /**
     * Lấy danh sách sản phẩm có hình ảnh
     * @param int $limit - Giới hạn số lượng
     * @return array - Danh sách sản phẩm có hình ảnh
     */
    public function getProductsWithImages($limit = 10)
    {
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name
                FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id
                WHERE p.image IS NOT NULL AND p.image != ''
                ORDER BY p.id DESC LIMIT :limit";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Lấy danh sách sản phẩm không có hình ảnh
     * @param int $limit - Giới hạn số lượng
     * @return array - Danh sách sản phẩm không có hình ảnh
     */
    public function getProductsWithoutImages($limit = 10)
    {
        $query = "SELECT p.id, p.name, p.description, p.price, p.image, c.name as category_name
                FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id
                WHERE p.image IS NULL OR p.image = ''
                ORDER BY p.id DESC LIMIT :limit";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>