<?php
/**
 * Model quản lý dữ liệu tài khoản người dùng
 * Bao gồm các chức năng đăng ký, đăng nhập, quản lý thông tin cá nhân
 */
class AccountModel {
    private $conn;
    private $table_name = "account"; // Tên bảng trong database

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Lấy thông tin tài khoản theo username
     * @param string $username - Tên đăng nhập
     * @return object|false - Thông tin tài khoản hoặc false nếu không tìm thấy
     */
    public function getAccountByUsername($username) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Lấy thông tin tài khoản theo ID
     * @param int $id - ID tài khoản
     * @return object|false - Thông tin tài khoản hoặc false nếu không tìm thấy
     */
    public function getAccountById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Lấy thông tin tài khoản theo email
     * @param string $email - Địa chỉ email
     * @return object|false - Thông tin tài khoản hoặc false nếu không tìm thấy
     */
    public function getAccountByEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Lưu tài khoản mới vào database
     * @param string $username - Tên đăng nhập
     * @param string $fullName - Họ tên đầy đủ
     * @param string $password - Mật khẩu (sẽ được mã hóa)
     * @param string|null $phone - Số điện thoại (tùy chọn)
     * @param string|null $email - Email (tùy chọn)
     * @param string|null $avatar - Đường dẫn avatar (tùy chọn)
     * @param string $role - Vai trò (user/admin), mặc định là user
     * @return bool - true nếu thành công, false nếu thất bại
     */
    public function save($username, $fullName, $password, $phone = null, $email = null, $avatar = null, $role = 'user') {
        // Kiểm tra username đã tồn tại chưa
        if ($this->getAccountByUsername($username)) {
            return false;
        }

        // Kiểm tra email đã tồn tại chưa (nếu có email)
        if ($email && $this->getAccountByEmail($email)) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " SET 
                  username=:username, 
                  fullname=:fullname, 
                  phone=:phone, 
                  email=:email, 
                  avatar=:avatar, 
                  password=:password, 
                  role=:role";
        
        $stmt = $this->conn->prepare($query);

        // Sanitize dữ liệu để tránh XSS
        $username = htmlspecialchars(strip_tags($username));
        $fullName = htmlspecialchars(strip_tags($fullName));
        $phone = $phone ? htmlspecialchars(strip_tags($phone)) : null;
        $email = $email ? htmlspecialchars(strip_tags($email)) : null;
        $avatar = $avatar ? htmlspecialchars(strip_tags($avatar)) : null;
        $password = password_hash($password, PASSWORD_BCRYPT); // Mã hóa mật khẩu
        $role = htmlspecialchars(strip_tags($role));

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":fullname", $fullName);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":avatar", $avatar);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":role", $role);
        
        return $stmt->execute();
    }

    /**
     * Cập nhật thông tin tài khoản
     * @param int $id - ID tài khoản
     * @param string|null $username - Username mới (null = không thay đổi)
     * @param string|null $fullName - Họ tên mới (null = không thay đổi)
     * @param string|null $phone - Số điện thoại mới (null = không thay đổi)
     * @param string|null $email - Email mới (null = không thay đổi)
     * @param string|null $avatar - Avatar mới (null = không thay đổi)
     * @param string|null $role - Vai trò mới (null = không thay đổi)
     * @return bool - true nếu thành công, false nếu thất bại
     */
    public function update($id, $username = null, $fullName = null, $phone = null, $email = null, $avatar = null, $role = null) {
        // Kiểm tra tài khoản có tồn tại không
        if (!$this->getAccountById($id)) {
            return false;
        }

        $updateFields = [];
        $params = [':id' => $id];

        // Chỉ cập nhật các trường được chỉ định
        if ($username !== null) {
            // Kiểm tra username mới có trùng với tài khoản khác không
            $existingAccount = $this->getAccountByUsername($username);
            if ($existingAccount && $existingAccount->id != $id) {
                return false;
            }
            $updateFields[] = "username = :username";
            $params[':username'] = htmlspecialchars(strip_tags($username));
        }

        if ($fullName !== null) {
            $updateFields[] = "fullname = :fullname";
            $params[':fullname'] = htmlspecialchars(strip_tags($fullName));
        }

        if ($phone !== null) {
            $updateFields[] = "phone = :phone";
            $params[':phone'] = htmlspecialchars(strip_tags($phone));
        }

        if ($email !== null) {
            // Kiểm tra email mới có trùng với tài khoản khác không
            $existingAccount = $this->getAccountByEmail($email);
            if ($existingAccount && $existingAccount->id != $id) {
                return false;
            }
            $updateFields[] = "email = :email";
            $params[':email'] = htmlspecialchars(strip_tags($email));
        }

        if ($avatar !== null) {
            $updateFields[] = "avatar = :avatar";
            $params[':avatar'] = htmlspecialchars(strip_tags($avatar));
        }

        if ($role !== null) {
            $updateFields[] = "role = :role";
            $params[':role'] = htmlspecialchars(strip_tags($role));
        }

        // Nếu không có trường nào để cập nhật
        if (empty($updateFields)) {
            return false;
        }

        $query = "UPDATE " . $this->table_name . " SET " . implode(", ", $updateFields) . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        return $stmt->execute($params);
    }

    /**
     * Cập nhật mật khẩu tài khoản
     * @param int $id - ID tài khoản
     * @param string $newPassword - Mật khẩu mới (sẽ được mã hóa)
     * @return bool - true nếu thành công, false nếu thất bại
     */
    public function updatePassword($id, $newPassword) {
        $query = "UPDATE " . $this->table_name . " SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        // Mã hóa mật khẩu mới
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }

    /**
     * Xóa tài khoản theo ID
     * @param int $id - ID tài khoản cần xóa
     * @return bool - true nếu thành công, false nếu thất bại
     */
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        
        return $stmt->execute();
    }

    /**
     * Lấy danh sách tất cả tài khoản (có phân trang)
     * @param int|null $limit - Số lượng bản ghi trên mỗi trang (null = không giới hạn)
     * @param int $offset - Vị trí bắt đầu (cho phân trang)
     * @return array - Danh sách tài khoản
     */
    public function getAllAccounts($limit = null, $offset = 0) {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        
        if ($limit) {
            $query .= " LIMIT :offset, :limit";
        }
        
        $stmt = $this->conn->prepare($query);
        
        if ($limit) {
            $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
            $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Đếm tổng số tài khoản trong hệ thống
     * @return int - Tổng số tài khoản
     */
    public function countAccounts() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ)->total;
    }

    /**
     * Xác thực mật khẩu
     * @param string $password - Mật khẩu thô
     * @param string $hashedPassword - Mật khẩu đã mã hóa trong database
     * @return bool - true nếu mật khẩu đúng, false nếu sai
     */
    public function verifyPassword($password, $hashedPassword) {
        return password_verify($password, $hashedPassword);
    }
}
?>