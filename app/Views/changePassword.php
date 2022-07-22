<div class="bg-grey-recherche half-a-border-on-bottom">

            <form action="<?php echo base_url(); ?>/PersonController/changePassword/<?php echo $idUser ?>" class="half-a-border-on-top" method="post">
                <h2 class="title pt-5">Modifier mon mot de passe : </h2>

                <div class="container m-auto md:max-w-screen-sm">

                <div class="grid grid-cols-1 md:grid-cols-2">

    <div class="m-5 md:mr-5">


      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Nouveau Mot de passe
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="password" id="grid-password" type="password" placeholder="***********">
      
    </div>

    <div class="m-5 md:ml-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-confirmpassword">
         Confirmer le Mot de passe
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="confirmpassword" id="grid-confirmpassword" type="password" placeholder="***********">

    </div>

  </div>

                <div class="text-center mb-5 mt-10">
                    <button type="submit" class="blue-button">Modifier mon mot de passe</button>
                </div>
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