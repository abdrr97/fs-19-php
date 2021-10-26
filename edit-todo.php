<?php

$id = $_GET['id'];

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=php_pdo_db', 'root', '');

$statement = $pdo->prepare('SELECT * FROM todos WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$todo = $statement->fetch(PDO::FETCH_ASSOC);

if (empty(trim($id)) || !isset($id) || !isset($todo) || empty($todo))
{
    header('Location: index.php');
}

// echo '<pre>';
// var_dump($todo);
// echo '</pre>';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $title = $_POST['title'];
    $completed = isset($_POST['completed']) ? 1 : 0;

    $statement = $pdo->prepare(" UPDATE todos SET title = :title , completed = :completed WHERE id = :id ");

    $statement->bindValue(':id', $id);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':completed', $completed);

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
        <input value="<?php echo $todo['title']; ?>" type="text" name="title">
        <input <?php echo $todo['completed'] ? 'checked' : '' ?> type="checkbox" name="completed">

        <button>Update</button>
    </form>

</body>

</html>