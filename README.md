Để triển khai chức năng **Xóa tài khoản theo ID** theo mô hình MVC, dưới đây là hướng dẫn chi tiết:

---

### **1. Phần Model**

Thêm hàm `delete_account()` vào file `models/AccountModel.php` để xử lý việc xóa tài khoản theo ID.

```php

<?php
// models/AccountModel.php
require_once './config/database.php';

// Hàm xóa tài khoản theo ID
function delete_account($id) {
    $sql = "DELETE FROM users WHERE id = ?";
    pdo_execute($sql, $id);
}

// Hàm lấy danh sách tài khoản để hiển thị (tùy chọn)
function get_all_accounts() {
    $sql = "SELECT id, username, email FROM users";
    return pdo_query($sql);
}
?>

```

---

### **2. Phần Controller**

Thêm các hàm điều khiển liên quan đến xóa tài khoản vào file `controllers/AccountController.php`.

```php

<?php
// controllers/AccountController.php
require_once './models/AccountModel.php';

// Hiển thị danh sách tài khoản để xóa
function list_accounts() {
    $accounts = get_all_accounts();
    require './views/account/list_accounts.php';
}

// Xử lý xóa tài khoản
function delete_account_action() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        delete_account($id);
        $message = "Xóa tài khoản thành công!";
        require './views/account/success_message.php';
    } else {
        echo "ID không được cung cấp!";
    }
}
?>

```

---

### **3. Phần View**

### **3.1. Giao diện hiển thị danh sách tài khoản (`views/account/list_accounts.php`)**

```php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài khoản</title>
</head>
<body>
    <h2>Danh sách tài khoản</h2>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Email</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($accounts as $account): ?>
        <tr>
            <td><?php echo htmlspecialchars($account['id']); ?></td>
            <td><?php echo htmlspecialchars($account['username']); ?></td>
            <td><?php echo htmlspecialchars($account['email']); ?></td>
            <td>
                <a href="index.php?action=delete_account_action&id=<?php echo htmlspecialchars($account['id']); ?>"
                   onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

```

### **3.2. Thông báo thành công (`views/account/success_message.php`)**

```php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thành công</title>
</head>
<body>
    <h2><?php echo htmlspecialchars($message); ?></h2>
    <a href="index.php?action=list_accounts">Quay lại danh sách tài khoản</a>
</body>
</html>

```

---

### **4. Phần Điều hướng chính (`index.php`)**

```php

<?php
// index.php
require_once './controllers/AccountController.php';

// Lấy action từ URL
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'list_accounts':
        list_accounts();
        break;

    case 'delete_account_action':
        delete_account_action();
        break;

    default:
        echo "Trang không tồn tại!";
        break;
}
?>

```

---

### **5. Cách kiểm tra chức năng**

1. **Hiển thị danh sách tài khoản:**
    - Truy cập URL:
        
        ```bash
        
        http://localhost/duanmau2023/index.php?action=list_accounts
        
        ```
        
    - Trang sẽ hiển thị danh sách tài khoản với nút "Xóa" cho từng tài khoản.
2. **Xóa tài khoản:**
    - Nhấn vào nút "Xóa" bên cạnh tài khoản muốn xóa.
    - Hệ thống sẽ hỏi xác nhận trước khi xóa.
    - Sau khi xác nhận, tài khoản sẽ được xóa và hiển thị thông báo thành công.
3. **Kiểm tra cơ sở dữ liệu:**
    - Mở bảng `users` trong cơ sở dữ liệu để kiểm tra xem tài khoản đã bị xóa hay chưa.

---

### **6. Debug nếu gặp lỗi**

- **Không xóa được tài khoản:**
    - Kiểm tra kết nối cơ sở dữ liệu (`pdo_get_connection()`).
    - Chạy thử câu lệnh SQL trực tiếp trên công cụ quản lý cơ sở dữ liệu để kiểm tra lỗi.
- **Lỗi không tìm thấy ID:**
    - Kiểm tra URL để đảm bảo tham số `id` được truyền đúng (ví dụ: `index.php?action=delete_account_action&id=1`).
    - Kiểm tra logic trong hàm `delete_account_action()`.
