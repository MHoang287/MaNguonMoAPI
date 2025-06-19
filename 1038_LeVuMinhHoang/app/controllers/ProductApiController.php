<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');

/**
 * Controller API cho quản lý sản phẩm
 * Hỗ trợ CRUD operations và upload hình ảnh thông qua API
 */
class ProductApiController
{
    private $productModel;
    private $db;
    
    // Thư mục lưu trữ hình ảnh upload
    private $uploadDir = 'uploads/products/';
    
    // Kích thước file tối đa (10MB)
    private $maxFileSize = 10 * 1024 * 1024;
    
    // Các định dạng hình ảnh được phép
    private $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        
        // Đặt header Content-Type cho API response
        header('Content-Type: application/json');
        
        // Tạo thư mục upload nếu chưa tồn tại
        $this->createUploadDirectory();
        
        // Xử lý CORS cho frontend JavaScript
        $this->handleCors();
    }

    /**
     * Tạo thư mục upload nếu chưa tồn tại
     */
    private function createUploadDirectory()
    {
        if (!is_dir($this->uploadDir)) {
            if (!mkdir($this->uploadDir, 0755, true)) {
                error_log("❌ Không thể tạo thư mục upload: " . $this->uploadDir);
            } else {
                error_log("✅ Đã tạo thư mục upload: " . $this->uploadDir);
            }
        }
    }

    /**
     * Xử lý CORS headers để frontend có thể gọi API
     */
    private function handleCors()
    {
        // Cho phép các domain gọi API
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
        
        // Xử lý preflight request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }

    /**
     * Lấy danh sách sản phẩm với hỗ trợ lọc và tìm kiếm
     * GET /api/product
     */
    public function index()
    {
        try {
            error_log("📦 API: Lấy danh sách sản phẩm");
            
            // Lấy các tham số query từ URL
            $options = $this->getQueryParams();
            
            // Gọi model để lấy dữ liệu sản phẩm
            $products = $this->productModel->getProducts($options);
            
            // Xử lý đường dẫn hình ảnh cho từng sản phẩm
            $products = $this->processImagePaths($products);
            
            // Trả về dữ liệu JSON
            echo json_encode([
                'success' => true,
                'data' => $products,
                'total' => $this->productModel->getTotalProducts($options),
                'message' => 'Lấy danh sách sản phẩm thành công'
            ]);
            
            error_log("✅ API: Đã trả về " . count($products) . " sản phẩm");
            
        } catch (Exception $e) {
            error_log("❌ API Error: " . $e->getMessage());
            $this->sendErrorResponse('Có lỗi xảy ra khi lấy danh sách sản phẩm', 500);
        }
    }

    /**
     * Lấy thông tin chi tiết một sản phẩm
     * GET /api/product/{id}
     */
    public function show($id)
    {
        try {
            error_log("🔍 API: Lấy sản phẩm ID: " . $id);
            
            // Validate ID
            if (!is_numeric($id) || $id <= 0) {
                $this->sendErrorResponse('ID sản phẩm không hợp lệ', 400);
                return;
            }
            
            // Lấy thông tin sản phẩm từ database
            $product = $this->productModel->getProductById($id);

            if ($product) {
                // Xử lý đường dẫn hình ảnh
                $product = $this->processImagePath($product);
                
                echo json_encode([
                    'success' => true,
                    'data' => $product,
                    'message' => 'Lấy thông tin sản phẩm thành công'
                ]);
                
                error_log("✅ API: Đã trả về sản phẩm: " . $product->name);
            } else {
                error_log("❌ API: Không tìm thấy sản phẩm ID: " . $id);
                $this->sendErrorResponse('Không tìm thấy sản phẩm', 404);
            }
        } catch (Exception $e) {
            error_log("❌ API Error: " . $e->getMessage());
            $this->sendErrorResponse('Có lỗi xảy ra khi lấy thông tin sản phẩm', 500);
        }
    }

    /**
     * Thêm sản phẩm mới với hỗ trợ upload hình ảnh
     * POST /api/product
     */
    public function store()
    {
        try {
            error_log("➕ API: Tạo sản phẩm mới");
            
            // Lấy dữ liệu từ request
            $data = $this->getRequestData();
            
            // Validate dữ liệu đầu vào
            $validationResult = $this->validateProductData($data);
            if ($validationResult !== true) {
                $this->sendErrorResponse('Dữ liệu không hợp lệ', 400, $validationResult);
                return;
            }
            
            // Xử lý upload hình ảnh nếu có
            $imagePath = null;
            if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                error_log("📸 API: Có file hình ảnh được upload");
                $uploadResult = $this->handleImageUpload($_FILES['image']);
                
                if ($uploadResult['success']) {
                    $imagePath = $uploadResult['path'];
                    error_log("✅ Upload thành công: " . $imagePath);
                } else {
                    error_log("❌ Upload thất bại: " . $uploadResult['error']);
                    $this->sendErrorResponse($uploadResult['error'], 400);
                    return;
                }
            }
            
            // Thêm sản phẩm vào database
            $result = $this->productModel->addProduct(
                $data['name'],
                $data['description'],
                $data['price'],
                $data['category_id'],
                $imagePath
            );

            if (is_array($result)) {
                // Có lỗi validation từ model
                error_log("❌ API: Validation errors từ model");
                $this->sendErrorResponse('Dữ liệu không hợp lệ', 400, $result);
            } else {
                // Thành công
                error_log("✅ API: Tạo sản phẩm thành công");
                http_response_code(201);
                echo json_encode([
                    'success' => true,
                    'message' => 'Tạo sản phẩm thành công',
                    'product_id' => $result,
                    'image_path' => $imagePath
                ]);
            }
        } catch (Exception $e) {
            error_log("❌ API Error: " . $e->getMessage());
            $this->sendErrorResponse('Có lỗi xảy ra khi tạo sản phẩm', 500);
        }
    }

    /**
     * Xử lý route động cho update bằng POST + _method=PUT
     * Phải được gọi từ router chính
     */
    public static function handleApiRoutes()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        
        // Xử lý route /api/product/{id}
        if (preg_match('#^/api/product/(\d+)$#', $uri, $matches)) {
            $id = (int)$matches[1];
            $controller = new self();
            
            error_log("🌐 API Route: $method $uri");
            
            switch ($method) {
                case 'GET':
                    $controller->show($id);
                    break;
                    
                case 'POST':
                    // Kiểm tra _method=PUT để xử lý như update
                    if (isset($_POST['_method']) && strtoupper($_POST['_method']) === 'PUT') {
                        error_log("📝 Xử lý POST với _method=PUT như UPDATE");
                        $controller->update($id);
                    } else {
                        error_log("❌ POST không có _method=PUT");
                        http_response_code(405);
                        echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
                    }
                    break;
                    
                case 'PUT':
                    $controller->update($id);
                    break;
                    
                case 'DELETE':
                    $controller->destroy($id);
                    break;
                    
                default:
                    http_response_code(405);
                    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
            }
            exit;
        }
        
        // Xử lý route /api/product/upload-image
        if ($uri === '/api/product/upload-image' && $method === 'POST') {
            (new self())->uploadImage();
            exit;
        }
        
        // Xử lý route /api/product (list)
        if ($uri === '/api/product' && $method === 'GET') {
            (new self())->index();
            exit;
        }
    }

    /**
     * Cập nhật sản phẩm với hỗ trợ thay đổi hình ảnh
     * PUT /api/product/{id} hoặc POST + _method=PUT
     */
    public function update($id)
    {
        try {
            error_log("📝 API: Cập nhật sản phẩm ID: " . $id);
            
            if (!is_numeric($id) || $id <= 0) {
                $this->sendErrorResponse('ID sản phẩm không hợp lệ', 400);
                return;
            }
            
            $existingProduct = $this->productModel->getProductById($id);
            if (!$existingProduct) {
                error_log("❌ API: Sản phẩm không tồn tại ID: " . $id);
                $this->sendErrorResponse('Sản phẩm không tồn tại', 404);
                return;
            }
            
            // Lấy dữ liệu từ $_POST (form-data) hoặc JSON body
            $data = $this->getRequestData();
            
            error_log("📊 Dữ liệu nhận được: " . json_encode($data));
            error_log("📁 Files nhận được: " . json_encode($_FILES));
            
            // Validate dữ liệu
            $validationResult = $this->validateProductData($data);
            if ($validationResult !== true) {
                error_log("❌ Validation failed: " . json_encode($validationResult));
                $this->sendErrorResponse('Dữ liệu không hợp lệ', 400, $validationResult);
                return;
            }
            
            // Xử lý hình ảnh
            $imagePath = $existingProduct->image; // Giữ hình ảnh cũ mặc định
            
            if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                error_log("📸 API: Có hình ảnh mới được upload");
                
                $uploadResult = $this->handleImageUpload($_FILES['image']);
                
                if ($uploadResult['success']) {
                    // Xóa hình ảnh cũ nếu có
                    if (!empty($existingProduct->image)) {
                        $this->deleteOldImage($existingProduct->image);
                    }
                    
                    $imagePath = $uploadResult['path'];
                    error_log("✅ Cập nhật hình ảnh thành công: " . $imagePath);
                } else {
                    error_log("❌ Upload hình ảnh thất bại: " . $uploadResult['error']);
                    $this->sendErrorResponse($uploadResult['error'], 400);
                    return;
                }
            }
            
            // Cập nhật sản phẩm trong database
            $result = $this->productModel->updateProduct(
                $id,
                $data['name'],
                $data['description'],
                $data['price'],
                $data['category_id'],
                $imagePath
            );

            if ($result) {
                error_log("✅ API: Cập nhật sản phẩm thành công");
                echo json_encode([
                    'success' => true,
                    'message' => 'Cập nhật sản phẩm thành công',
                    'image_path' => $imagePath
                ]);
            } else {
                error_log("❌ API: Cập nhật sản phẩm thất bại");
                $this->sendErrorResponse('Cập nhật sản phẩm thất bại', 400);
            }
        } catch (Exception $e) {
            error_log("❌ API Error: " . $e->getMessage());
            $this->sendErrorResponse('Có lỗi xảy ra khi cập nhật sản phẩm', 500);
        }
    }

    /**
     * Xóa sản phẩm và hình ảnh liên quan
     * DELETE /api/product/{id}
     */
    public function destroy($id)
    {
        try {
            error_log("🗑️ API: Xóa sản phẩm ID: " . $id);
            
            // Validate ID
            if (!is_numeric($id) || $id <= 0) {
                $this->sendErrorResponse('ID sản phẩm không hợp lệ', 400);
                return;
            }
            
            // Lấy thông tin sản phẩm để có đường dẫn hình ảnh
            $product = $this->productModel->getProductById($id);
            if (!$product) {
                error_log("❌ API: Sản phẩm không tồn tại ID: " . $id);
                $this->sendErrorResponse('Sản phẩm không tồn tại', 404);
                return;
            }
            
            // Xóa sản phẩm khỏi database
            $result = $this->productModel->deleteProduct($id);

            if ($result) {
                // Xóa hình ảnh liên quan nếu có
                if (!empty($product->image)) {
                    $this->deleteOldImage($product->image);
                }
                
                error_log("✅ API: Xóa sản phẩm thành công");
                echo json_encode([
                    'success' => true,
                    'message' => 'Xóa sản phẩm thành công'
                ]);
            } else {
                error_log("❌ API: Xóa sản phẩm thất bại");
                $this->sendErrorResponse('Xóa sản phẩm thất bại', 400);
            }
        } catch (Exception $e) {
            error_log("❌ API Error: " . $e->getMessage());
            $this->sendErrorResponse('Có lỗi xảy ra khi xóa sản phẩm', 500);
        }
    }

    /**
     * Upload hình ảnh riêng biệt (endpoint bổ sung)
     * POST /api/product/upload-image
     */
    public function uploadImage()
    {
        try {
            error_log("📸 API: Upload hình ảnh độc lập");
            
            if (empty($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                $this->sendErrorResponse('Không có file hình ảnh hợp lệ', 400);
                return;
            }
            
            $uploadResult = $this->handleImageUpload($_FILES['image']);
            
            if ($uploadResult['success']) {
                error_log("✅ API: Upload hình ảnh thành công");
                echo json_encode([
                    'success' => true,
                    'message' => 'Upload hình ảnh thành công',
                    'image_path' => $uploadResult['path'],
                    'image_url' => $uploadResult['url']
                ]);
            } else {
                error_log("❌ API: Upload hình ảnh thất bại");
                $this->sendErrorResponse($uploadResult['error'], 400);
            }
        } catch (Exception $e) {
            error_log("❌ API Error: " . $e->getMessage());
            $this->sendErrorResponse('Có lỗi xảy ra khi upload hình ảnh', 500);
        }
    }

    /**
     * Xóa hình ảnh
     * DELETE /api/product/delete-image
     */
    public function deleteImage()
    {
        try {
            error_log("🗑️ API: Xóa hình ảnh");
            
            $data = json_decode(file_get_contents("php://input"), true);
            $imagePath = $data['image_path'] ?? '';
            
            if (empty($imagePath)) {
                $this->sendErrorResponse('Đường dẫn hình ảnh không hợp lệ', 400);
                return;
            }
            
            if ($this->deleteOldImage($imagePath)) {
                error_log("✅ API: Xóa hình ảnh thành công");
                echo json_encode([
                    'success' => true,
                    'message' => 'Xóa hình ảnh thành công'
                ]);
            } else {
                error_log("❌ API: Xóa hình ảnh thất bại");
                $this->sendErrorResponse('Xóa hình ảnh thất bại', 400);
            }
        } catch (Exception $e) {
            error_log("❌ API Error: " . $e->getMessage());
            $this->sendErrorResponse('Có lỗi xảy ra khi xóa hình ảnh', 500);
        }
    }

    /**
     * Xử lý upload hình ảnh với validation đầy đủ
     */
    private function handleImageUpload($file)
    {
        error_log("📸 Bắt đầu xử lý upload hình ảnh");
        
        try {
            // Kiểm tra lỗi upload
            if ($file['error'] !== UPLOAD_ERR_OK) {
                return [
                    'success' => false,
                    'error' => $this->getUploadErrorMessage($file['error'])
                ];
            }
            
            // Kiểm tra kích thước file
            if ($file['size'] > $this->maxFileSize) {
                error_log("❌ File quá lớn: " . $file['size'] . " bytes");
                return [
                    'success' => false,
                    'error' => 'Kích thước file quá lớn. Tối đa ' . ($this->maxFileSize / 1024 / 1024) . 'MB'
                ];
            }
            
            // Kiểm tra loại file bằng mime type
            $mimeType = mime_content_type($file['tmp_name']);
            if (!in_array($mimeType, $this->allowedTypes)) {
                error_log("❌ Loại file không được phép: " . $mimeType);
                return [
                    'success' => false,
                    'error' => 'Loại file không được phép. Chỉ chấp nhận: ' . implode(', ', $this->allowedTypes)
                ];
            }
            
            // Kiểm tra file có phải là hình ảnh thật không
            $imageInfo = getimagesize($file['tmp_name']);
            if ($imageInfo === false) {
                error_log("❌ File không phải là hình ảnh hợp lệ");
                return [
                    'success' => false,
                    'error' => 'File không phải là hình ảnh hợp lệ'
                ];
            }
            
            // Tạo tên file unique để tránh trung lặp
            $extension = $this->getFileExtension($mimeType);
            $fileName = $this->generateUniqueFileName($extension);
            $fullPath = $this->uploadDir . $fileName;
            
            error_log("📁 Đường dẫn file: " . $fullPath);
            
            // Di chuyển file từ temp đến thư mục upload
            if (move_uploaded_file($file['tmp_name'], $fullPath)) {
                error_log("✅ Upload file thành công");
                
                // Tạo thumbnail (tùy chọn)
                $this->createThumbnail($fullPath, $imageInfo);
                
                return [
                    'success' => true,
                    'path' => $fileName, // Chỉ lưu tên file vào DB
                    'url' => '/' . $fullPath, // URL đầy đủ để hiển thị
                    'size' => $file['size'],
                    'dimensions' => $imageInfo[0] . 'x' . $imageInfo[1]
                ];
            } else {
                error_log("❌ Không thể di chuyển file upload");
                return [
                    'success' => false,
                    'error' => 'Không thể lưu file. Vui lòng thử lại'
                ];
            }
        } catch (Exception $e) {
            error_log("❌ Lỗi upload: " . $e->getMessage());
            return [
                'success' => false,
                'error' => 'Có lỗi xảy ra trong quá trình upload: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Tạo thumbnail cho hình ảnh (tùy chọn)
     */
    private function createThumbnail($imagePath, $imageInfo)
    {
        try {
            error_log("🖼️ Tạo thumbnail cho: " . $imagePath);
            
            $thumbnailDir = $this->uploadDir . 'thumbnails/';
            if (!is_dir($thumbnailDir)) {
                mkdir($thumbnailDir, 0755, true);
            }
            
            $thumbnailPath = $thumbnailDir . 'thumb_' . basename($imagePath);
            $thumbnailWidth = 300; // Chiều rộng thumbnail
            $thumbnailHeight = 300; // Chiều cao thumbnail
            
            // Tạo thumbnail dựa trên loại hình ảnh
            switch ($imageInfo[2]) {
                case IMAGETYPE_JPEG:
                    $source = imagecreatefromjpeg($imagePath);
                    break;
                case IMAGETYPE_PNG:
                    $source = imagecreatefrompng($imagePath);
                    break;
                case IMAGETYPE_GIF:
                    $source = imagecreatefromgif($imagePath);
                    break;
                default:
                    error_log("⚠️ Không thể tạo thumbnail cho loại file này");
                    return false;
            }
            
            if ($source) {
                // Tính toán kích thước thumbnail giữ tỷ lệ
                $originalWidth = $imageInfo[0];
                $originalHeight = $imageInfo[1];
                
                $ratio = min($thumbnailWidth / $originalWidth, $thumbnailHeight / $originalHeight);
                $newWidth = $originalWidth * $ratio;
                $newHeight = $originalHeight * $ratio;
                
                // Tạo thumbnail
                $thumbnail = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($thumbnail, $source, 0, 0, 0, 0, $newWidth, $newHeight, $originalWidth, $originalHeight);
                
                // Lưu thumbnail
                imagejpeg($thumbnail, $thumbnailPath, 85);
                
                // Giải phóng bộ nhớ
                imagedestroy($source);
                imagedestroy($thumbnail);
                
                error_log("✅ Tạo thumbnail thành công: " . $thumbnailPath);
                return true;
            }
        } catch (Exception $e) {
            error_log("❌ Lỗi tạo thumbnail: " . $e->getMessage());
        }
        
        return false;
    }

    /**
     * Xóa hình ảnh cũ khi cập nhật hoặc xóa sản phẩm
     */
    private function deleteOldImage($imagePath)
    {
        if (empty($imagePath)) {
            return true;
        }
        
        try {
            error_log("🗑️ Xóa hình ảnh cũ: " . $imagePath);
            
            // Xóa file chính
            $fullPath = $this->uploadDir . $imagePath;
            if (file_exists($fullPath)) {
                if (unlink($fullPath)) {
                    error_log("✅ Đã xóa file chính: " . $fullPath);
                } else {
                    error_log("❌ Không thể xóa file chính: " . $fullPath);
                }
            }
            
            // Xóa thumbnail nếu có
            $thumbnailPath = $this->uploadDir . 'thumbnails/thumb_' . $imagePath;
            if (file_exists($thumbnailPath)) {
                if (unlink($thumbnailPath)) {
                    error_log("✅ Đã xóa thumbnail: " . $thumbnailPath);
                } else {
                    error_log("❌ Không thể xóa thumbnail: " . $thumbnailPath);
                }
            }
            
            return true;
        } catch (Exception $e) {
            error_log("❌ Lỗi khi xóa hình ảnh: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Tạo tên file unique dựa trên timestamp và random string
     */
    private function generateUniqueFileName($extension)
    {
        $timestamp = time();
        $randomString = bin2hex(random_bytes(8));
        return $timestamp . '_' . $randomString . '.' . $extension;
    }

    /**
     * Lấy extension file từ mime type
     */
    private function getFileExtension($mimeType)
    {
        $extensions = [
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp'
        ];
        
        return $extensions[$mimeType] ?? 'jpg';
    }

    /**
     * Lấy thông báo lỗi upload
     */
    private function getUploadErrorMessage($errorCode)
    {
        $errors = [
            UPLOAD_ERR_INI_SIZE => 'File quá lớn (vượt quá giới hạn của server)',
            UPLOAD_ERR_FORM_SIZE => 'File quá lớn (vượt quá giới hạn của form)',
            UPLOAD_ERR_PARTIAL => 'File chỉ được upload một phần',
            UPLOAD_ERR_NO_FILE => 'Không có file nào được upload',
            UPLOAD_ERR_NO_TMP_DIR => 'Không tìm thấy thư mục tạm',
            UPLOAD_ERR_CANT_WRITE => 'Không thể ghi file vào disk',
            UPLOAD_ERR_EXTENSION => 'Upload bị chặn bởi extension'
        ];
        
        return $errors[$errorCode] ?? 'Lỗi upload không xác định';
    }

    /**
     * Xử lý đường dẫn hình ảnh cho danh sách sản phẩm
     */
    private function processImagePaths($products)
    {
        foreach ($products as $product) {
            $product = $this->processImagePath($product);
        }
        return $products;
    }

    /**
     * Xử lý đường dẫn hình ảnh cho một sản phẩm
     */
    private function processImagePath($product)
    {
        if (!empty($product->image)) {
            // Tạo URL đầy đủ cho hình ảnh
            $product->image_url = '/' . $this->uploadDir . $product->image;
            
            // Kiểm tra file có tồn tại không
            $fullPath = $this->uploadDir . $product->image;
            $product->image_exists = file_exists($fullPath);
            
            // Thêm URL thumbnail nếu có
            $thumbnailPath = $this->uploadDir . 'thumbnails/thumb_' . $product->image;
            if (file_exists($thumbnailPath)) {
                $product->thumbnail_url = '/' . $thumbnailPath;
            }
        } else {
            $product->image_url = null;
            $product->image_exists = false;
            $product->thumbnail_url = null;
        }
        
        return $product;
    }

    /**
     * Lấy dữ liệu từ request (JSON hoặc form-data)
     */
    private function getRequestData()
    {
        // Nếu có file upload, dữ liệu sẽ ở $_POST
        if (!empty($_FILES)) {
            return [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'price' => $_POST['price'] ?? '',
                'category_id' => $_POST['category_id'] ?? null
            ];
        }
        
        // Nếu không có file, dữ liệu ở JSON body
        $input = file_get_contents("php://input");
        return json_decode($input, true) ?? [];
    }

    /**
     * Lấy các tham số query từ URL
     */
    private function getQueryParams()
    {
        return [
            'search' => $_GET['search'] ?? '',
            'category_id' => $_GET['category_id'] ?? '',
            'min_price' => $_GET['min_price'] ?? '',
            'max_price' => $_GET['max_price'] ?? '',
            'sort' => $_GET['sort'] ?? 'newest',
            'limit' => $_GET['limit'] ?? 20,
            'offset' => $_GET['offset'] ?? 0
        ];
    }

    /**
     * Validate dữ liệu sản phẩm
     */
    private function validateProductData($data)
    {
        $errors = [];
        
        // Validate tên sản phẩm
        if (empty($data['name']) || trim($data['name']) === '') {
            $errors['name'] = 'Tên sản phẩm không được để trống';
        } elseif (mb_strlen(trim($data['name'])) < 3) {
            $errors['name'] = 'Tên sản phẩm phải có ít nhất 3 ký tự';
        } elseif (mb_strlen($data['name']) > 255) {
            $errors['name'] = 'Tên sản phẩm không được vượt quá 255 ký tự';
        }
        
        // Validate mô tả
        if (empty($data['description']) || trim($data['description']) === '') {
            $errors['description'] = 'Mô tả không được để trống';
        } else {
            // Loại bỏ dấu cách, dấu chấm, phẩy, ký tự đặc biệt để kiểm tra độ dài thực sự
            $descContent = preg_replace('/[\s\.\,\!\?\-\_\(\)\[\]\{\}\:\;\'\"\`\/\\\\]/u', '', $data['description']);
            if (mb_strlen($descContent) < 10) {
                $errors['description'] = 'Mô tả phải có ít nhất 10 ký tự thực sự (không tính ký tự đặc biệt/dấu cách)';
            }
        }
        
        // Validate giá
        if (empty($data['price'])) {
            $errors['price'] = 'Giá sản phẩm không được để trống';
        } elseif (!is_numeric($data['price'])) {
            $errors['price'] = 'Giá sản phẩm phải là số';
        } elseif ($data['price'] < 0) {
            $errors['price'] = 'Giá sản phẩm không được âm';
        } elseif ($data['price'] > 999999999) {
            $errors['price'] = 'Giá sản phẩm quá lớn';
        }
        
        // Validate category_id (tùy chọn)
        if (!empty($data['category_id']) && !is_numeric($data['category_id'])) {
            $errors['category_id'] = 'ID danh mục không hợp lệ';
        }
        
        return empty($errors) ? true : $errors;
    }

    /**
     * Gửi response lỗi với format chuẩn
     */
    private function sendErrorResponse($message, $statusCode = 400, $errors = [])
    {
        http_response_code($statusCode);
        echo json_encode([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
            'status_code' => $statusCode
        ]);
    }
}
?>