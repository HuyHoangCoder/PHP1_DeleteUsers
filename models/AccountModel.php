
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

