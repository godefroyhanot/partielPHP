<?php
require 'db_connection.php';

$question_id = $_GET['id'];
$question = "";
$expected_answer = ""; 
$success_message = "";
$failure_message = "";
$success_rate = 0;

$stmt = $conn->prepare("SELECT question, expected_answer, success_message, failure_message, success_count, failure_count FROM questions WHERE id = ?");
$stmt->bind_param("i", $question_id);
$stmt->execute();
$stmt->bind_result($question, $expected_answer, $success_message, $failure_message, $success_count, $failure_count);
$stmt->fetch();
$stmt->close();

if ($success_count + $failure_count > 0) {
    $success_rate = ($success_count / ($success_count + $failure_count)) * 100;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_answer = $_POST['user_answer'];

    if ($user_answer == $expected_answer) {
        $success_count++;
        $message = $success_message;
        $stmt = $conn->prepare("UPDATE questions SET success_count = success_count + 1 WHERE id = ?");
    } else {
        $failure_count++;
        $message = $failure_message;
        $stmt = $conn->prepare("UPDATE questions SET failure_count = failure_count + 1 WHERE id = ?");
    }

    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Répondre à la question</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Question:</h1>
    <p><?php echo htmlspecialchars($question); ?></p>
    <p>Taux de réussite: <?php echo number_format($success_rate, 2); ?>%</p>

    <?php if ($_SERVER["REQUEST_METHOD"] != "POST" || $user_answer != $expected_answer) { ?>
        <form method="post">
            <label for="user_answer">Votre réponse:</label><br>
            <input type="text" id="user_answer" name="user_answer" required><br><br>
            <input type="submit" value="Valider">
        </form>
    <?php } ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php } ?>
</body>
</html>