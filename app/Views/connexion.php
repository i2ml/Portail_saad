    <div class="bg-grey-recherche half-a-border-on-bottom">

            <form action="<?php echo base_url(); ?>/NouvelleConnexionController/loginAuth" method="post" class="half-a-border-on-top">
                <h2 class="title pt-5">Connexion</h2>
                <div class="container m-auto md:max-w-screen-sm">

                <div class="grid grid-cols-1 md:grid-cols-2">

    <div class="m-5 md:mr-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-email">
        Email
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="grid-email" name="mail" type="email" placeholder="ex. votre@mail.fr" value="<?= set_value('mail') ?>">
      
    </div>

    <div class="m-5 md:ml-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-motdepasse">
        Mot de passe
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="motdepasse" id="grid-motdepasse" type="password" placeholder="***********">

    </div>

  </div>

                <div class="text-center mb-5 mt-10">
                    <button type="submit" class="blue-button">Connexion</button>
                </div>
            </div>
            </form>


        <?php if (session()->getFlashdata('msg')) : ?>
                <?= session()->getFlashdata('msg') ?>
        <?php endif; ?>
        </div>
</div>
