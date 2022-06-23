<div class="bg-grey-recherche text-center half-a-border-on-bottom">


    <?php if($saad) { ?>
    <form action="<?php echo base_url(); ?>/SaadController/storeSaad/<?php echo $saad['id'] ?>" class="half-a-border-on-top" enctype="multipart/form-data" method="post">
        <h2 class="title pt-5">Modifier <?php echo $saad['nom'] ?> </h2>
    <?php } else { ?>
    <form action="<?php echo base_url(); ?>/SaadController/storeSaad" class="half-a-border-on-top" enctype="multipart/form-data" method="post">
        <h2 class="title pt-5">Créer un SAAD</h2>
    <?php } ?>


        <div class="flex items-center justify-center">
            <div class="flex border-2 rounded mr-10">
                <input type="text" name="nom" placeholder="Nom" value="<?php if($saad){echo $saad['nom'];} else set_value('nom'); ?>" class="px-4 py-2 w-80">
            </div>

            <div class="flex border-2 rounded mr-10">
                <input type="text" name="tel" placeholder="Tel" value="<?php if($saad){echo $saad['tel'];} else set_value('tel'); ?>" class="px-4 py-2 w-80">
            </div>

            <div class="flex border-2 rounded">
                <input type="email" name="mail" placeholder="Mail" value="<?php if($saad){echo $saad['mail'];} else set_value('mail'); ?>" class="px-4 py-2 w-80">
            </div>
        </div>

        <div class="flex items-center justify-center mt-5">
            <div class="flex border-2 rounded mr-10">
                <input type="text" name="site" placeholder="Site" value="<?php if($saad){echo $saad['site'];} else set_value('site'); ?>" class="px-4 py-2 w-80">
            </div>

            <div class="flex border-2 rounded mr-10">
                <input type="text" name="siret_siren" placeholder="Siret / Siren" value="<?php if($saad){echo $saad['siret_siren'];} else set_value('siret_siren'); ?>" class="px-4 py-2 w-80">
            </div>

            <div class="flex border-2 rounded">
                <input type="text" name="adresse" placeholder="adresse" value="<?php if($saad){echo $saad['adresse'];} else set_value('adresse'); ?>" class="px-4 py-2 w-80">
            </div>
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