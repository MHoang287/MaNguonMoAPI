<?php
class CategoryModel
{
    private $conn;
    private $table_name = "category";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // READ - Lấy tất cả danh mục
    public function getCategories()
    {
        $query = "SELECT id, name, description FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    // READ - Lấy một danh mục theo ID
    public function getCategoryById($id)
    {
        $query = "SELECT id, name, description FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    // CREATE - Thêm danh mục mới
    public function createCategory($name, $description)
    {
        $query = "INSERT INTO " . $this->table_name . " (name, description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $description);
        
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    // UPDATE - Cập nhật danh mục
    public function updateCategory($id, $name, $description)
    {
        $query = "UPDATE " . $this->table_name . " SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $description);
        $stmt->bindParam(3, $id);
        
        return $stmt->execute();
    }

    // DELETE - Xóa danh mục
    public function deleteCategory($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        
        return $stmt->execute();
    }

    // Kiểm tra tên danh mục đã tồn tại chưa (để tránh trùng lặp)
    public function checkCategoryExists($name, $excludeId = null)
    {
        $query = "SELECT COUNT(*) as count FROM " . $this->table_name . " WHERE name = ?";
        $params = [$name];
        
        if ($excludeId) {
            $query .= " AND id != ?";
            $params[] = $excludeId;
        }
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        
        return $result->count > 0;
    }
}
?>