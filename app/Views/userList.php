<h2 class="title"> Liste des utilisateurs </h2>
<?php if (!empty($users) && is_array($users)) { ?>

    <?php foreach ($users as $user) { ?>
        <div class="card m-5 grid grid-cols-6">
            <p> <?php echo $user['nom'] . ' ' . $user['prenom']; ?> </p>
            <?php
            if ($user['id'] === session()->get('id')) { ?>
                <p> Votre compte </p>
            <?php } else { ?>
                <?php if ($user['accountType'] === SUPER_ADMIN) { ?>
                    <p> Admin </p>
                    <form action="<?= esc(base_url()) ?>/AdminController/userDowngrade/<?= esc($user['id'], 'url'); ?>">
                        <button class="blue-button"> Rétrograder</button>
                    </form>
                <?php } else { ?>
                    <p> Gérant de Saad </p>
                    <form action="<?= esc(base_url()) ?>/AdminController/userUpgrade/<?= esc($user['id'], 'url'); ?>">
                        <button class="blue-button"> Passer admin</button>
                    </form>
                    <form action="<?= esc(base_url()) ?>/AdminController/userDelete/<?= esc($user['id'], 'url'); ?>"
                          onclick="return confirm('Cette suppression est définitive, êtes vous certains de vouloir l\'effectuer ?')">
                        <button class="blue-button"> Supprimer</button>
                    </form>
                <?php }
            } ?>
        </div>

    <?php } ?>

<?php } else { ?>

    <h3>Aucun utilisateur</h3>

    Il n'existe aucun utilisateur

<?php } ?>