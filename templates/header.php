<?php

include_once ("config/url.php");
include_once ("config/process.php");

// limpa a mensagem

if(isset($_SESSION['msg'])){
    $printMsg = $_SESSION['msg'];
    $_SESSION['msg'] = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.7/css/bootstrap.min.css" integrity="sha512-fw7f+TcMjTb7bpbLJZlP8g2Y4XcCyFZW8uy8HsRZsH/SwbMw0plKHFHr99DN3l04VsYNwvzicUX/6qurvIxbxw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS -->
     <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
    <title>Agenda de Contatos</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand" href="<?= $BASE_URL ?>home.php">
            <img src="<?= $BASE_URL ?>img/logo.png" alt="Agenda">
        </a>
        <div>
            <div class="navbar-nav">
                <a class="nav-link active" id="home-link" href="<?= $BASE_URL ?>home.php">Agenda</a>
                <a class="nav-link active" href="<?= $BASE_URL ?>create.php">Adicionar Contato</a>
                <a class="nav-link active" href="<?= $BASE_URL ?>deleteds.php">Contatos Excluidos</a>
            </div>
        </div>
    </nav>
</header>

