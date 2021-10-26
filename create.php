<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=php_pdo_db', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $title = $_POST['title'];
    $completed = isset($_POST['completed']) ? 1 : 0;

    $statement = $pdo->prepare("INSERT INTO todos (title, completed) VALUE (:title ,:status) ");
    $statement->bindValue(':title', $title);
    $statement->bindValue(':status', $completed);
    $statement->execute();

    header('Location: index.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="text" name="title">
        <input type="checkbox" name="completed">

        <button>Add Todo</button>
    </form>

</body>

</html>