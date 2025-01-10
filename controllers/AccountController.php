
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

