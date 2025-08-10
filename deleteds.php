<?php
include_once ("templates/header.php");

?>

<div class="container">
    <?php if(isset($printMsg) && $printMsg != ''): ?>
        <p id="msg"> <?=$printMsg ?></p>
    <?php endif; ?>
    <h1 id="main-title">Contatos Excluidos</h1>
    <?php if(count($deleteds) > 0): ?>
        <table class="table" id="contacts-table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($deleteds as $deleted): ?>
                    <tr>
                        <td scope="row" class="col-id"> <?= $deleted["id"] ?></td>
                        <td scope="row"> <?= $deleted["nome"] ?></td>
                        <td scope="row"> <?= $deleted["phone"] ?></td>
                        <td scope="row"> <?= $deleted["email"] ?></td>
                        <td class="actions">
                            <a href="<?= $BASE_URL ?>contato.php?id=<?= $deleted["id"] ?>"><i class="fas fa-eye check-icon"></i></a>
                            <a href="<?= $BASE_URL ?>edit.php?id=<?= $deleted["id"] ?>"><i class="far fa-edit edit-icon"></i></a>
                        <form class="delete-form" action="<?= $BASE_URL ?>config/process.php" method="POST">
                            <input type="hidden" name="type" value="deleteds">
                            <input type="hidden" name="id" value="<?= $deleted["id"] ?>">
                            <button type="submit" class="delete-btn"><i class="fas fa-times delete-icon"></i></button>
                        </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <?php else: ?>
            <p id="empty-list-text">Você não possui contatos Excluidos</p>
    <?php endif; ?>
</div>

<?php
include_once ("templates/footer.php");
?>