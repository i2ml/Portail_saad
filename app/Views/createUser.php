<div class="bg-grey-recherche text-center half-a-border-on-bottom">

<?php
            $errors = \Config\Services::validation()->getErrors();
            helper(['form']);
            if ($success) {
                ?>
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">L'utilisateur a bien été créé !</h4>
                    <p>Nous vous souhaitons une bonne fin de journée.</p>
                </div>
                <?php
            } else {
                if (isset($success)) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">L'utilisateur n'a pas pu être créé !</h4>
                        <p>Une erreur s'est produite lors de l'enregistrement. Veuillez vérifier les information
                            saisies dans le formulaire de création.</p>
                        
                    </div>
                    <?php
                }
            }


            ?>
            <form action="<?php echo base_url(); ?>/PersonController/store" class="half-a-border-on-top" method="post">
                <h2 class="title pt-5">Créer un gérant de Saad</h2>

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
                        <input type="text" name="prenom" placeholder="Prenom" value="<?php if (!$success) { echo set_value('prenom');
                        } ?>" class="px-4 py-2 w-80 form-control <?php if (isset($errors['prenom'])) {
                                   echo("is-invalid");
                               } ?>">
                               
                    </div><?php if (isset($errors['prenom'])) { ?>
                            <div class="invalid-feedback">
                                <?= $errors['prenom'] ?>
                            </div>
                            <?php
                        } ?>

                    
                    <div class="flex border-2 rounded mr-10">
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
                <div class="flex items-center justify-center mt-10">
                    <div class="flex border-2 rounded mr-10">
                        <input type="password" name="password" placeholder="Mot de passe" class="px-4 py-2 w-80">
                    </div><?php if (isset($errors['password'])) { ?>
                            <div class="invalid-feedback">
                                <?= $errors['password'] ?>
                            </div>
                            <?php
                        } ?>



                    <div class="flex border-2 rounded mr-10">
                        <input type="password" name="confirmpassword" placeholder="Confirmer le mot de passe" class="px-4 py-2 w-80">
                    </div><?php if (isset($errors['confirmpassword'])) { ?>
                            <div class="invalid-feedback">
                                <?= $errors['confirmpassword'] ?>
                            </div>
                            <?php
                        } ?>
                </div>

                <div class="text-center mb-5 mt-10">
                    <button type="submit" class="blue-button">Créer le gérant</button>
                </div>
            </form>



            
        </div>
    </div>
</div>