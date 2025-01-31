<?php
require 'db_connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, question, success_count, failure_count FROM questions";
$result = $conn->query($sql);

$questions = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $questions[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Escape Game Rouen</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Escape Game Rouen</h1>
    <h2>Liste des questions</h2>
    <table border="1">
        <tr>
            <th>Question</th>
            <th>Taux de réussite</th>
            <th>Action</th>
        </tr>
        <?php foreach ($questions as $question) {
            $success_rate = ($question['success_count'] + $question['failure_count']) > 0 ? ($question['success_count'] / ($question['success_count'] + $question['failure_count'])) * 100 : 0;
        ?>
        <tr>
            <td><?php echo $question['question']; ?></td>
            <td><?php echo number_format($success_rate, 2); ?>%</td>
            <td><a href="delete_question.php?id=<?php echo $question['id']; ?>">Supprimer</a></td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="add_question.php" class="add-question" target="_blank ">Ajouter une question</a>
</body>
</html>