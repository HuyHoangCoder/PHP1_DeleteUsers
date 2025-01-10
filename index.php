
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

