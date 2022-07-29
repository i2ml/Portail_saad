<div class="bg-grey-recherche half-a-border-on-bottom">

<?php
            $errors = \Config\Services::validation()->getErrors();
            helper(['form']);
           


            ?>

            <form action="<?php echo base_url(); ?>/PersonController/store" class="half-a-border-on-top" method="post">
            <div class="container m-auto md:max-w-screen-sm">
                <h2 class="title pt-5">Créer un gérant de Saad</h2>

                <?php 
                 if ($success) {
                ?>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">L'utilisateur a bien été créé !</h4>
                    <p class="mb-20">Nous vous souhaitons une bonne fin de journée.</p>
                </div>
                <?php
            } else {
                if (isset($success)) {
                    ?>
                    <div class="alert alert-danger mb-8 text-center" role="alert">
                        <i class="fa-solid fa-triangle-exclamation fa-xl"></i>
                        <h4 class="alert-heading text-red-700 font-bold">L'utilisateur n'a pas pu être créé !</h4>
                        <p>Une erreur s'est produite lors de l'enregistrement. Veuillez vérifier les information
                            saisies dans le formulaire de création.</p>
                        
                    </div>
                    <?php
                }
            }

            ?>
                 <div class="grid grid-cols-1 md:grid-cols-2">

    <div class="m-5 md:mr-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
        Nom
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white form-control <?php if (isset($errors['nom'])) {
                                   echo("is-invalid border-red-500");
                                } ?>" id="grid-first-name" name="nom" type="text" placeholder="Pierre" value="<?php if (!$success) { echo set_value('nom');
                                } ?>">
      <?php if (isset($errors['nom'])) { ?>
        <p class="text-red-500 text-xs italic invalid-feedback">Le champs Nom doit être remplis</p><?php
                           } ?>

    </div>

    <div class="m-5 md:ml-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-prenom">
        Prénom
      </label>
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 form-control <?php if (isset($errors['prenom'])) {
                                   echo("is-invalid border-red-500");
                               } ?>" value="<?php if (!$success) { echo set_value('prenom'); } ?>" name="prenom" id="grid-prenom" type="text" placeholder="Brunel">
            <?php if (isset($errors['prenom'])) { ?> 
                <p class="text-red-500 text-xs italic invalid-feedback">Le champs Prénom doit être remplis</p><?php
                           } ?>

    </div>

  </div>
  <div class="grid grid-cols-1 m-5">
    <div>
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


  <div class="grid grid-cols-1 md:grid-cols-2">
    <div class="m-5 md:mr-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Mot-de-passe
      </label>
      <input name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white peer" id="grid-password" type="password" placeholder="******************">
      <?php if (isset($errors['password'])) { ?>
      <p class="text-red-500 text-xs italic invisible peer-invalid:visible">Veuillez renseigner un mot de passe valide</p> <?php
                        } ?>

    </div>
    <div class="m-5 md:ml-5">

      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-repassword">
        Confirmation Mot-de-passe
      </label>
      <input name="confirmpassword" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-repassword" type="password" placeholder="******************">
      <?php if (isset($errors['confirmpassword'])) { ?>
        <p class="text-red-500 text-xs italic invisible peer-invalid:visible">les champs ne correspondent pas</p> <?php
                        } ?>

    </div>
  </div>

                <div class="text-center mb-5 mt-10">
                    <button type="submit" class="blue-button">Créer le gérant</button>
                </div>


      
            </div>
            </form>
            
        </div>
        
    </div>
</div>


