<?php

session_start();
//$_SESSION = [];

$verifica = '';

if (!isset($_SESSION["tarefas"])) {
    $_SESSION["tarefas"] = [];
};

/* print_r($_POST);
echo '<br>';
var_dump(in_array('remover', $_POST));
print_r($_SESSION['tarefas']); */

if (in_array('remover', $_POST)) {
    $key = array_search('remover', $_POST);
    $_SESSION['tarefas'] = array_diff($_SESSION['tarefas'], [$key]);
}

if (in_array($_POST['task'], $_SESSION["tarefas"])) {
    $verifica = 'Esta tarefa já foi adicionada';
    $_POST['task'] = '';
}

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

    <?php if ($verifica): ?>
        <ul>
            <li><?= $verifica; ?></li>
        </ul>
    <?php endif; ?>

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
                        <input style="padding: 1px 1px; font-size: 10px;" type="submit" value="remover" name='<?= $item ?>'>
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
