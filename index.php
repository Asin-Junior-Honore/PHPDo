<?php
// index.php

include 'todo.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        addTodo($title, $description);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        deleteTodo($id);
    } elseif (isset($_POST['update'])) {
        $id = $_POST['update'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        updateTodo($id, $title, $description);
    }
}

// Fetch all TODO items
$todos = getAllTodos();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPDo - TODO List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>PHPDo - TODO List</h1>
        
        <!-- Form to add new TODO -->
        <form action="" method="POST">
            <input type="text" name="title" placeholder="Enter title" required>
            <textarea name="description" placeholder="Enter description"></textarea>
            <button type="submit" name="add">Add TODO</button>
        </form>
        
        <!-- List of TODO items -->
        <ul>
            <?php foreach ($todos as $todo): ?>
            <li>
                <form action="" method="POST">
                    <input type="text" name="title" value="<?= htmlspecialchars($todo['title']) ?>">
                    <textarea name="description"><?= htmlspecialchars($todo['description']) ?></textarea>
                    <input type="hidden" name="update" value="<?= $todo['id'] ?>">
                    <button type="submit">Update</button>
                    <button type="submit" name="delete" value="<?= $todo['id'] ?>">Delete</button>
                </form>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
