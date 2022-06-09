    <div class="bg-grey-recherche text-center half-a-border-on-bottom">

            <form action="<?php echo base_url(); ?>/NouvelleConnexionController/loginAuth" method="post" class="half-a-border-on-top">
                <h2 class="title pt-5">Connexion</h2>
                <div class="flex items-center justify-center">
                    <div class="flex border-2 rounded mr-10">
                        <input type="email" name="mail" placeholder="Email" value="<?= set_value('mail') ?>" class="px-4 py-2 w-80">
                    </div>

                    <div class="flex border-2 rounded">
                        <input type="password" name="motdepasse" placeholder="Password" class="px-4 py-2 w-80">
                    </div>
                </div>

                <div class="text-center mb-5 mt-10">
                    <button type="submit" class="blue-button">Connexion</button>
                </div>
            </form>


        <?php if (session()->getFlashdata('msg')) : ?>
                <?= session()->getFlashdata('msg') ?>
        <?php endif; ?>
        </div>
</div>
