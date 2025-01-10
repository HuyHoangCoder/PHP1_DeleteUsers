
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

