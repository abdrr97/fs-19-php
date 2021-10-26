<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=php_pdo_db', 'root', '');

$statement = $pdo->prepare('SELECT * FROM todos ORDER BY created_at DESC');
$statement->execute();
$todos = $statement->fetchAll(PDO::FETCH_ASSOC);

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

    <a href="./create.php">new todo</a>

    <ul>
        <?php foreach ($todos as $todo) : ?>
            <li>
                <p style="display: inline-block; 
                    text-decoration: <?php echo $todo['completed'] ? 'line-through' : '' ?>;">
                    <?php echo htmlentities($todo['title']) ?>
                </p>
                <form style="display: inline-block;" method="POST" action="./delete-todo.php">
                    <input name="id" type="hidden" value="<?php echo $todo['id'] ?>">
                    <button>delete</button>
                </form>

                <a href="./edit-todo.php?id=<?php echo $todo['id'] ?>">edit</a>

            </li>
        <?php endforeach; ?>
    </ul>

</body>

</html>