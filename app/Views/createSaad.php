<div class="bg-grey-recherche text-center half-a-border-on-bottom">

<?php
            $errors = \Config\Services::validation()->getErrors();
            helper(['form']);
            if ($success) {
                ?>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Votre message a bien été envoyé !</h4>
                    <p>Merci pour votre message, nous vous souhaitons une bonne fin de journée.</p>
                </div>
                <?php
            } else {
                if (isset($success)) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Votre message n'a pas été envoyé !</h4>
                        <p>Une erreur s'est produite lors de l'envoi de votre message. Veuillez vérifier les information
                            saisies dans le formulaire de contact.</p>
                        
                    </div>
                    <?php
                }
            }


            ?>
    <?php if($saad) { ?>
    <form action="<?php echo base_url(); ?>/SaadController/storeSaad/<?php echo $saad['id'] ?>" class="half-a-border-on-top" enctype="multipart/form-data" method="post">
        <h2 class="title pt-5">Modifier <?php echo $saad['nom'] ?> </h2>
    <?php } else { ?>
    <form action="<?php echo base_url(); ?>/SaadController/storeSaad" class="half-a-border-on-top" enctype="multipart/form-data" method="post">
        <h2 class="title pt-5">Créer un SAAD</h2>
    <?php } ?>


        <div class="flex items-center justify-center">

            <div class="flex border-2 rounded mr-10">
                <input type="text" name="nom" placeholder="Nom" value="<?php if (!$success) { echo set_value('nom');
                        } ?>" class="px-4 py-2 w-80 form-control <?php if (isset($errors['nom'])) {
                                   echo("is-invalid");
                               } ?>">
                               
            </div><?php if (isset($errors['nom'])) { ?>
                            <div class="invalid-feedback">
                                <?= $errors['nom'] ?>
                            </div>
                            <?php
                        } ?>


            





            


            <div class="flex border-2 rounded mr-10">
                <input type="text" name="tel" placeholder="Tel" value="<?php if (!$success) { echo set_value('tel');
                        } ?>" class="px-4 py-2 w-80 form-control <?php if (isset($errors['tel'])) {
                                   echo("is-invalid");
                               } ?>">
                               
            </div><?php if (isset($errors['tel'])) { ?>
                            <div class="invalid-feedback">
                                <?= $errors['tel'] ?>
                            </div>
                            <?php
                        } ?>


            <div class="flex border-2 rounded">
                <input type="email" name="mail" placeholder="Mail" value="<?php if (!$success) { echo set_value('mail');
                        } ?>" class="px-4 py-2 w-80 form-control <?php if (isset($errors['mail'])) {
                                   echo("is-invalid");
                               } ?>">
                               
            </div><?php if (isset($errors['mail'])) { ?>
                            <div class="invalid-feedback">
                                <?= $errors['mail'] ?>
                            </div>
                            <?php
                        } ?>
        </div>

        <div class="flex items-center justify-center mt-5">

            <div class="flex border-2 rounded mr-10">
                <input type="text" name="site" placeholder="Site" value="<?php if (!$success) { echo set_value('site');
                        } ?>" class="px-4 py-2 w-80 form-control <?php if (isset($errors['site'])) {
                                   echo("is-invalid");
                               } ?>">
                               
            </div><?php if (isset($errors['site'])) { ?>
                            <div class="invalid-feedback">
                                <?= $errors['site'] ?>
                            </div>
                            <?php
                        } ?>



            <div class="flex border-2 rounded mr-10">
                <input type="text" name="siret_siren" placeholder="Siret / Siren" value="<?php if (!$success) { echo set_value('siret_siren');
                        } ?>" class="px-4 py-2 w-80 form-control <?php if (isset($errors['siret_siren'])) {
                                   echo("is-invalid");
                               } ?>">
                               
            </div><?php if (isset($errors['siret_siren'])) { ?>
                            <div class="invalid-feedback">
                                <?= $errors['siret_siren'] ?>
                            </div>
                            <?php
                        } ?>


        <div class="flex border-2 rounded">
                <input type="text" name="adresse" placeholder="Adresse" value="<?php if (!$success) { echo set_value('adresse');
                        } ?>" class="px-4 py-2 w-80 form-control <?php if (isset($errors['adresse'])) {
                                   echo("is-invalid");
                               } ?>">
                               
            </div><?php if (isset($errors['adresse'])) { ?>
                            <div class="invalid-feedback">
                                <?= $errors['adresse'] ?>
                            </div>
                            <?php
                        } ?>
            </div>


        <select class="form-select p-3 m-5 bg-white border" name="idCategorie">
            <option value="1"> CPOM 1 </option>
            <option value="2"> CPOM 2 </option>
            <option value="3"> Hors CPOM</option>
        </select>

        Choisir une image : <?php if($saad) {
            echo "(Si vous ne changez pas d'image, nous garderons l'ancienne.)";
        }?> <input name="image" type="file" />

        <div class="text-center mb-5 mt-10">
            <button type="submit" class="blue-button"> Valider </button>
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