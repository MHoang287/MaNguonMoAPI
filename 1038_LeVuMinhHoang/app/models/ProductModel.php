<?php
/**
 * Model quản lý dữ liệu sản phẩm
 * Bao gồm các chức năng CRUD và tìm kiếm, lọc sản phẩm
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
     * Lấy danh sách sản phẩm với các tùy chọn lọc và sắp xếp
     * @param array $options - Các tùy chọn như search, category_id, price range, sort, limit, offset
     * @return array - Danh sách sản phẩm
     */
    public function getProducts($options = [])
    {
        // Câu truy vấn cơ bản với JOIN để lấy tên danh mục
        $query = "SELECT p.id, p.name, p.description, p.price, p.category_id, c.name as category_name
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
     * @param array $options - Các tùy chọn lọc tương tự getProducts()
     * @return int - Tổng số sản phẩm
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
     * Lấy danh sách sản phẩm nổi bật (mới nhất)
     * @param int $limit - Số lượng sản phẩm cần lấy
     * @return array - Danh sách sản phẩm nổi bật
     */
    public function getFeaturedProducts($limit = 8)
    {
        $query = "SELECT p.id, p.name, p.description, p.price, c.name as category_name
                FROM " . $this->table_name . " p
                LEFT JOIN category c ON p.category_id = c.id
                ORDER BY p.id DESC LIMIT :limit";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Lấy sản phẩm theo danh mục
     * @param int $categoryId - ID danh mục
     * @param int|null $limit - Giới hạn số lượng (tùy chọn)
     * @return array - Danh sách sản phẩm trong danh mục
     */
    public function getProductsByCategory($categoryId, $limit = null)
    {
        $query = "SELECT p.id, p.name, p.description, p.price, c.name as category_name
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
     * Lấy khoảng giá của tất cả sản phẩm (min-max)
     * @return object - Đối tượng chứa giá thấp nhất và cao nhất
     */
    public function getPriceRange()
    {
        $query = "SELECT MIN(price) as min_price, MAX(price) as max_price FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * Lấy thông tin chi tiết sản phẩm theo ID
     * @param int $id - ID sản phẩm
     * @return object|false - Thông tin sản phẩm hoặc false nếu không tìm thấy
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
     * Thêm sản phẩm mới
     * @param string $name - Tên sản phẩm
     * @param string $description - Mô tả sản phẩm
     * @param float $price - Giá sản phẩm
     * @param int $category_id - ID danh mục
     * @return bool|array - true nếu thành công, array lỗi nếu thất bại
     */
    public function addProduct($name, $description, $price, $category_id)
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

        // Thực hiện insert vào database
        $query = "INSERT INTO " . $this->table_name . " (name, description, price, category_id) VALUES (:name, :description, :price, :category_id)";
        $stmt = $this->conn->prepare($query);
        
        // Sanitize dữ liệu để tránh XSS
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        $category_id = htmlspecialchars(strip_tags($category_id));
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Cập nhật thông tin sản phẩm
     * @param int $id - ID sản phẩm
     * @param string $name - Tên sản phẩm mới
     * @param string $description - Mô tả mới
     * @param float $price - Giá mới
     * @param int $category_id - ID danh mục mới
     * @return bool - true nếu thành công, false nếu thất bại
     */
    public function updateProduct($id, $name, $description, $price, $category_id)
    {
        $query = "UPDATE " . $this->table_name . " SET name=:name, description=:description, price=:price, category_id=:category_id WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        
        // Sanitize dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));
        $price = htmlspecialchars(strip_tags($price));
        $category_id = htmlspecialchars(strip_tags($category_id));
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);

        if ($stmt->execute()) {
            return true;
        }
            return false;
    }

    /**
     * Xóa sản phẩm theo ID
     * @param int $id - ID sản phẩm cần xóa
     * @return bool - true nếu thành công, false nếu thất bại
     */
    public function deleteProduct($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>