<h2 class="title"> Liste des utilisateurs </h2>
<?php if (!empty($users) && is_array($users)) { ?>

    <?php foreach ($users as $user) { ?>
        <div class="card m-5">
            <p> <?php echo $user['nom'].' '.$user['prenom']; ?> </p>
            <?php if($user['accountType'] == 1) { ?>
                <p> Admin </p>
                <button class="blue-button"> Retrograder </button>


        <?php } else { ?>
                <p> Gérant de Saad </p>
                    <button class="blue-button"> Passer admin </button>
                <form action="<?= esc(base_url()) ?>/AdminController/userDelete/<?= esc($user['id'], 'url'); ?>" onclick="return confirm('Cette suppression est définitive, êtes vous certains de vouloir l\'effectuer ?')">
                    <button class="blue-button"> Supprimer </button>
                </form>
        <?php } ?>
        </div>

    <?php } ?>

<?php } else { ?>

    <h3>Aucun utilisateur</h3>

    Il n'existe aucun utilisateur

<?php } ?>