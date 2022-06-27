<div class="bg-grey-recherche text-center half-a-border-on-bottom">

            <form action="<?php echo base_url(); ?>/PersonController/changePassword/<?php echo $idUser ?>" class="half-a-border-on-top" method="post">
                <h2 class="title pt-5">Modifier mon mot de passe : </h2>

                <div class="flex items-center justify-center mt-10">
                    <div class="flex border-2 rounded mr-10">
                        <input type="password" name="password" placeholder="Mot de passe" class="px-4 py-2 w-80">
                    </div>

                    <div class="flex border-2 rounded">
                        <input type="password" name="confirmpassword" placeholder="Confirmer le mot de passe" class="px-4 py-2 w-80">
                    </div>
                </div>

                <div class="text-center mb-5 mt-10">
                    <button type="submit" class="blue-button">Modifier mon mot de passe</button>
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