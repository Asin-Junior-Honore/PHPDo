<?php


include 'todo.php';

// Initialize variables for form inputs and errors
$title = $description = '';
$errors = array();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Validate inputs
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);

        if (empty($title)) {
            $errors[] = 'Title cannot be empty!';
        }

        if (empty($description)) {
            $errors[] = 'Description cannot be empty!';
        }

        // If no errors, add TODO item
        if (empty($errors)) {
            addTodo($title, $description);
            // Clear inputs after successful addition
            $title = $description = '';
        }
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

        <!-- Display errors if any -->
        <?php if (!empty($errors)): ?>
            <div class="error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form to add new TODO -->
        <form action="" method="POST">
            <input type="text" name="title" placeholder="Enter title" value="<?= htmlspecialchars($title) ?>" required>
            <textarea name="description"
                placeholder="Enter description"><?= htmlspecialchars($description) ?></textarea>
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