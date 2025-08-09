<?php
include_once ("templates/header.php");
?>

<div class="container" id="view-contact-container">

    <form id="create-form" action="<?= $BASE_URL ?>config/process.php" method='POST'>
    
    <?php include_once ("templates/backbtn.html"); ?>

    <h1 id="main-title">Adicione um Contato</h1>

    <input type="hidden" name="type" value="create">
    <div class="form-group">
        <label for="nome">Nome do Contato:</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do contato" required>
    </div>
    <div class="form-group">
        <label for="phone">Telefone:</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Digite o telefone do contato" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" name="email" placeholder="Digite o email do contato" required>
    </div>
    <div class="form-group">
        <label for="observations">Observações:</label>
        <textarea type="text" class="form-control" id="observations" name="observations" placeholder="Observações do contato" rows="3"></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-info">Criar Contato</button>
    
    </form>
</div>
<?php
include_once ("templates/footer.php");
?>