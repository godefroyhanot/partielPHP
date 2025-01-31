<?php
require 'db_connection.php';

$question_id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
$stmt->bind_param("i", $question_id);
$stmt->execute();
$stmt->close();

$conn->close();

header("Location: index.php");
exit();
?>