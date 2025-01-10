
<?php
//hàm kết nối cơ sở dữ liệu pdo
function pdo_get_connection(){
    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=loginuser", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
//hàm thực thi câu lệnh sql thao tác dữ liệu như (INSERT UPDATE DELETE)
function pdo_execute($sql){
    $sql_args=array_slice(func_get_args(),1);
    try{
        $conn=pdo_get_connection();
        $stmt=$conn->prepare($sql);
        $stmt->execute($sql_args);

    }
    catch(PDOException $e){
        throw $e;
    }
    finally{
        unset($conn);
    }
}
// thực thi câu lệnh sql truy vấn kiểu (SELECT * FORM TEN_BANG) => trả về nhiều bản ghi 
function pdo_query($sql){
    $sql_args=array_slice(func_get_args(),1);

    try{
        $conn=pdo_get_connection();
        $stmt=$conn->prepare($sql);
        $stmt->execute($sql_args);
        $rows=$stmt->fetchAll();
        return $rows;
    }
    catch(PDOException $e){
        throw $e;
    }
    finally{
        unset($conn);
    }
}
// thực thi câu lệnh sql truy vấn dữ liệu (SELECT * FROM TEN_BANG WHERE ID/NAME/...) trả về một bản ghi 
function pdo_query_one($sql){
    $sql_args=array_slice(func_get_args(),1);
    try{
        $conn=pdo_get_connection();
        $stmt=$conn->prepare($sql);
        $stmt->execute($sql_args);
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        // đọc và hiển thị giá trị trong danh sách trả về
        return $row;
    }
    catch(PDOException $e){
        throw $e;
    }
    finally{
        unset($conn);
    }
}
pdo_get_connection();
?>
