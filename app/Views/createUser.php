<div class="bg-grey-recherche text-center half-a-border-on-bottom">

            <form action="<?php echo base_url(); ?>/AdminController/store" class="half-a-border-on-top" method="post">
                <h2 class="title pt-5">Créer un gérant de Saad</h2>

                <div class="flex items-center justify-center">
                    <div class="flex border-2 rounded mr-10">
                        <input type="text" name="nom" placeholder="Nom" value="<?= set_value('nom') ?>" class="px-4 py-2 w-80">
                    </div>

                    <div class="flex border-2 rounded mr-10">
                        <input type="text" name="prenom" placeholder="Prenom" value="<?= set_value('prenom') ?>" class="px-4 py-2 w-80">
                    </div>

                    <div class="flex border-2 rounded mr-10">
                        <input type="email" name="mail" placeholder="Mail" value="<?= set_value('mail') ?>" class="px-4 py-2 w-80">
                    </div>
                </div>
                <div class="flex items-center justify-center mt-10">
                    <div class="flex border-2 rounded mr-10">
                        <input type="password" name="password" placeholder="Mot de passe" class="px-4 py-2 w-80">
                    </div>

                    <div class="flex border-2 rounded mr-10">
                        <input type="password" name="confirmpassword" placeholder="Confirmer le mot de passe" class="px-4 py-2 w-80">
                    </div>
                </div>

                <div class="text-center mb-5 mt-10">
                    <button type="submit" class="blue-button">Créer le gérant</button>
                </div>
            </form>


            <?php if (isset($validation)) : ?>
                <div>
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>