<div class="bg-grey-recherche half-a-border-on-bottom">

<?php
            $errors = \Config\Services::validation()->getErrors();
            helper(['form']);
            


            ?>
    <?php if($saad) { ?>
    <form action="<?php echo base_url(); ?>/SaadController/storeSaad/<?php echo $saad['id'] ?>" class="half-a-border-on-top" enctype="multipart/form-data" method="post">
        <div class="container m-auto md:max-w-screen-md">
        <h2 class="title pt-5">Modifier <?php echo $saad['nom'] ?> </h2>
    <?php } else { ?>
    <form action="<?php echo base_url(); ?>/SaadController/storeSaad" class="half-a-border-on-top" enctype="multipart/form-data" method="post">
        <div class="container m-auto md:max-w-screen-md">
        <h2 class="title pt-5">Créer un SAAD</h2>
    <?php } 

    if ($success) {
                ?>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Le service d'AAD a bien été créé !</h4>
                    <p>Nous vous souhaitons une bonne fin de journée.</p>
                </div>
                <?php
            } else {
                if (isset($success)) {
                    ?>
                    <div class="alert alert-danger mb-8 text-center" role="alert">

            <i class="fa-solid fa-triangle-exclamation fa-xl"></i>

                        <h4 class="alert-heading text-red-700 font-bold">Le service n'a pas pu être enregistré !</h4>
                        <p>Une erreur s'est produite lors de l'enregistrement. Veuillez vérifier les information
                            saisies dans le formulaire de création.</p>
                        
                    </div>
                    <?php
                }
            }
        ?>


        <div class="grid grid-cols-1 md:grid-cols-3">

    <div class="m-5 md:mr-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-nom">
        Nom
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white form-control <?php if (isset($errors['nom'])) {
                                   echo("is-invalid border-red-500");
                                } ?>" id="grid-nom" name="nom" type="text" placeholder="ex. Diminu'Tifs" value="<?php if (!$success) { echo set_value('nom');
                                } ?>">
      <?php if (isset($errors['nom'])) { ?>
        <p class="text-red-500 text-xs italic invalid-feedback">Le Nom de la structure doit être renseigné</p><?php
                           } ?>

    </div>

    <div class="m-5 md:ml-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-tel">
        Téléphone
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control <?php if (isset($errors['tel'])) {
                                   echo("is-invalid border-red-500");
                               } ?>" value="<?php if (!$success) { echo set_value('tel'); } ?>" name="tel" id="grid-tel" type="text" placeholder="ex. 0836656565">
            <?php if (isset($errors['tel'])) { ?> 
                <p class="text-red-500 text-xs italic invalid-feedback">Le numéro doit être valide</p><?php
                           } ?>

    </div>

    <div class="m-5 md:ml-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-email">
        E-mail
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control <?php if (isset($errors['mail'])) {
                                   echo("is-invalid border-red-500");
                               } ?>" value="<?php if (!$success) { echo set_value('mail');
                            } ?>"id="grid-email" type="email" name="mail" placeholder="example@example.fr">
      <?php if (isset($errors['mail'])) { ?> 
                <p class="text-red-500 text-xs italic invalid-feedback">Renseignez une adresse mail valide</p><?php
                           } ?>
    </div>

  </div>
 


 <div class="grid grid-cols-1 md:grid-cols-3">

    <div class="m-5 md:mr-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-site">
        Site
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white form-control <?php if (isset($errors['site'])) {
                                   echo("is-invalid border-red-500");
                                } ?>" id="grid-site" name="site" type="text" placeholder="ex. diminutifs.com" value="<?php if (!$success) { echo set_value('site');
                                } ?>">
      <?php if (isset($errors['site'])) { ?>
        <p class="text-red-500 text-xs italic invalid-feedback">L'URL renseignée est trop longue</p><?php
                           } ?>

    </div>

    <div class="m-5 md:ml-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-siret_siren">
        Siret / Siren
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control <?php if (isset($errors['siret_siren'])) {
                                   echo("is-invalid border-red-500");
                               } ?>" value="<?php if (!$success) { echo set_value('siret_siren'); } ?>" name="siret_siren" id="grid-siret_siren" type="text" placeholder="ex. 12345678900001">

    </div>

    <div class="m-5 md:ml-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-adresse">
        Adresse
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control <?php if (isset($errors['adresse'])) {
                                   echo("is-invalid border-red-500");
                               } ?>" value="<?php if (!$success) { echo set_value('adresse');
                            } ?>"id="grid-adresse" type="adresse" name="adresse" placeholder="ex. 3 rue des lilas">
      <?php if (isset($errors['adresse'])) { ?> 
                <p class="text-red-500 text-xs italic invalid-feedback">l'adresse renseignée est trop longue</p><?php
                           } ?>
    </div>

  </div>
  <div class="grid grid-cols-1 md:grid-cols-2">

        <div>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold ml-5 mb-2" for="idCategorie">
        Catégorie
      </label>
        <select class="form-select bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mx-5 mb-5 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="idCategorie" name="idCategorie">
            <option value="1"> CPOM 1 </option>
            <option value="2"> CPOM 2 </option>
            <option value="3"> Hors CPOM</option>
        </select></div>


        <div><label class="block uppercase tracking-wide text-gray-700 text-xs font-bold ml-5 mb-2" for="image">
        Choisir une image </label> <?php if($saad) {
            echo "(Si vous ne changez pas d'image, nous garderons l'ancienne.)";
        }?> <input name="image" type="file" class="mx-5" /></div></div>

        <p class="text-2xl font-semibold text-blue-header-btn mb-3"> Public cible : </p>
        <div class="flex items-center justify-center">
            <div class="grid grid-cols-3 gap-1 text-left">
                <?php
                foreach ($publics as $public){
                    ?>
                    <div> <input type="checkbox" name="public[]" value="<?php echo $public['id'] ?>"> <?php echo $public['nom'] ?> </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <p class="text-2xl font-semibold text-yellow-header-title mb-3 mt-5"> Pathologies prise en charge : </p>
        <div class="flex items-center justify-center">
            <div class="grid grid-cols-3 gap-1 text-left">
            <?php
            foreach ($pathologies as $pathologie){
                ?>
                <div class="mr-5"> <input type="checkbox" name="pathologie[]" value="<?php echo $pathologie['id'] ?>"> <?php echo $pathologie['nom'] ?> </div>
                <?php
            }
            ?>
            </div>
        </div>

        <div class="text-center mb-5 mt-10">
            <button type="submit" class="blue-button"> Valider </button>
        </div>
    
    </form>




    
</div>
</div>
</div>
