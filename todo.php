<?php


include 'db.php';

// Function to fetch all TODO items
function getAllTodos() {
    global $db;
    $stmt = $db->query('SELECT * FROM todos ORDER BY created_at DESC');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to add a new TODO item
function addTodo($title, $description) {
    global $db;
    $stmt = $db->prepare('INSERT INTO todos (title, description) VALUES (?, ?)');
    $stmt->execute([$title, $description]);
}

// Function to delete a TODO item
function deleteTodo($id) {
    global $db;
    $stmt = $db->prepare('DELETE FROM todos WHERE id = ?');
    $stmt->execute([$id]);
}

// Function to update a TODO item
function updateTodo($id, $title, $description) {
    global $db;
    $stmt = $db->prepare('UPDATE todos SET title = ?, description = ? WHERE id = ?');
    $stmt->execute([$title, $description, $id]);
}
?>
