    <div class="bg-grey-recherche text-center half-a-border-on-bottom">

            <form action="<?php echo base_url(); ?>/NouvelleConnexionController/loginAuth" method="post" class="half-a-border-on-top">
                <h2 class="text-yellow-header-title text-3xl mb-8 mt-5 font-semibold">Connexion</h2>
                <div class="flex items-center justify-center">
                    <div class="flex border-2 rounded mr-10">
                        <input type="email" name="mail" placeholder="Email" value="<?= set_value('mail') ?>" class="px-4 py-2 w-80">
                    </div>

                    <div class="flex border-2 rounded">
                        <input type="password" name="motdepasse" placeholder="Password" class="px-4 py-2 w-80">
                    </div>
                </div>

                <div class="text-center mb-5 mt-10">
                    <button type="submit" class="bg-blue-header-btn text-white font-bold py-2 px-4 rounded">Connexion</button>
                </div>
            </form>


        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-warning">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>
        </div>
</div>
