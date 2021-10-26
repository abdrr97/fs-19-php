<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=php_pdo_db', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $todo_id = $_POST['id'];

    $statement = $pdo->prepare("DELETE FROM todos WHERE id = :id");
    $statement->bindValue(':id', $todo_id);
    $statement->execute();

    header('Location: index.php');

    exit;
}
else
{
    echo 'Not Allowed';
}
