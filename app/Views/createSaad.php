<div class="bg-grey-recherche text-center half-a-border-on-bottom">

    <form action="<?php echo base_url(); ?>/AdminController/storeSaad" class="half-a-border-on-top" enctype="multipart/form-data" method="post">
        <h2 class="title pt-5">Créer un gérant de Saad</h2>

        <div class="flex items-center justify-center">
            <div class="flex border-2 rounded mr-10">
                <input type="text" name="nom" placeholder="Nom" value="<?= set_value('nom') ?>" class="px-4 py-2 w-80">
            </div>

            <div class="flex border-2 rounded mr-10">
                <input type="text" name="tel" placeholder="Tel" value="<?= set_value('tel') ?>" class="px-4 py-2 w-80">
            </div>

            <div class="flex border-2 rounded">
                <input type="email" name="mail" placeholder="Mail" value="<?= set_value('mail') ?>" class="px-4 py-2 w-80">
            </div>
        </div>

        <div class="flex items-center justify-center mt-5">
            <div class="flex border-2 rounded mr-10">
                <input type="text" name="site" placeholder="Site" value="<?= set_value('site') ?>" class="px-4 py-2 w-80">
            </div>

            <div class="flex border-2 rounded mr-10">
                <input type="text" name="siret_siren" placeholder="Siret / Siren" value="<?= set_value('siret_siren') ?>" class="px-4 py-2 w-80">
            </div>

            <div class="flex border-2 rounded">
                <input type="text" name="adresse" placeholder="adresse" value="<?= set_value('adresse') ?>" class="px-4 py-2 w-80">
            </div>
        </div>


        <select class="form-select p-3 m-5 bg-white border" name="idCategorie">
            <option value="1"> CPOM 1 </option>
            <option value="2"> CPOM 2 </option>
        </select>

        Choisir une image : <input name="image" type="file" />

        <div class="text-center mb-5 mt-10">
            <button type="submit" class="blue-button">Créer le SAAD</button>
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