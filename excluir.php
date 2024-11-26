<?php
include 'db.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $query = "DELETE FROM noticias WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
}

header("Location: index.php");
exit;
?>
