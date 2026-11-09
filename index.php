<?php

session_start();
//$_SESSION = [];

if (!isset($_SESSION["tarefas"])) {
    $_SESSION["tarefas"] = [];
};

if (!empty(trim($_POST['task']))) {
    $_SESSION["tarefas"][] = $_POST['task'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>
</head>

<body>
    <h1>Lista de Tarefas</h1>
    <form action="index.php" method="post">
        <?php if ($_SESSION['tarefas'] != ""): ?>
        <?php foreach ($_SESSION['tarefas'] as $item): ?>
        <div>
            <?php if (array_key_exists('checked', $_POST) && in_array($item, $_POST['checked'])): ?>
            <input type="checkbox" name='checked[]' value="<?= $item ?>" checked> <s><b><?= $item ?></b></s> <i
                style="font-size: 12px;">Conluído!</i>
            <?php else: ?>
            <input type="checkbox" name='checked[]' value="<?= $item ?>"> <b><?= $item ?></b>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <br>
        <div>
            <input type="text" name="task" placeholder="Nova tarefa">
            <input type="submit" value="Adicionar">
        </div>
        <div>
            <br>
            <input type="submit" value="Atualizar">
        </div>
    </form>
</body>

</html>
