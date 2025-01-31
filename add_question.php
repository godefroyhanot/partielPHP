<?php
require 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST['question'];
    $expected_answer = $_POST['expected_answer'];
    $success_message = $_POST['success_message'];
    $failure_message = $_POST['failure_message'];

    $stmt = $conn->prepare("INSERT INTO questions (question, expected_answer, success_message, failure_message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $question, $expected_answer, $success_message, $failure_message);

    if ($stmt->execute()) {
        $question_id = $stmt->insert_id;
        $share_link = "http://localhost/partielPHP/answer_question.php?id=" . $question_id;
        echo "Question ajoutée avec succès! Lien de partage: <a href='$share_link'>$share_link</a>";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une question</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Ajouter une question</h1>
    <form method="post">
        <label for="question">Question:</label><br>
        <textarea id="question" name="question" required></textarea><br><br>
        <label for="expected_answer">Réponse attendue:</label><br>
        <input type="text" id="expected_answer" name="expected_answer" required><br><br>
        <label for="success_message">Message de succès:</label><br>
        <textarea id="success_message" name="success_message" required></textarea><br><br>
        <label for="failure_message">Message de mauvaise réponse:</label><br>
        <textarea id="failure_message" name="failure_message" required></textarea><br><br>
        <input type="submit" value="Ajouter la question">
    </form>
</body>
</html>