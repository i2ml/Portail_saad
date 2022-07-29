<form action="<?= esc(base_url()) ?>/filter" method="post">
    <p>Filtre par pathologie </p>

    <?php
    foreach ($pathologies as $pathologie){
        ?>
        <div class="mr-5"> <input type="checkbox" name="pathologie[]" value="<?php echo $pathologie['id'] ?>"
                <?php
                if(isset($pathologieSelectionnee) && in_array($pathologie['id'], $pathologieSelectionnee)){
                    echo "checked";
                }
                ?>>
            <?php echo $pathologie['nom'] ?> </div>
        <?php
    }
    ?>

    <p>Filtre par public </p>

    <?php
    foreach ($publics as $public){
        ?>
        <div class="mr-5"> <input type="checkbox" name="public[]" value="<?php echo $public['id'] ?>"<?php
            if(isset($publicSelectionne) && in_array($public['id'], $publicSelectionne)){
                echo "checked";
            }
            ?>>
            <?php echo $public['nom'] ?> </div>
        <?php
    }
    ?>
    <button type="submit" class="blue-button"> Filtrer </button>

</form>

<div class="container mx-auto px-4 sm:px-8">
    <h2 class="title">Les services d'aides à domicile dans votre secteur</h2>
    <div class="container grid md:grid-cols-2 grid-cols-1 gap-6 p-8">
        <?php
        foreach ($saads as $saad) {
            if (in_array($saad['id'], $idFiltrer) && $saad['idCategorie'] != 3) { ?>
                <div class="">
                    <div class="grid min-w-full shadow-md rounded-lg overflow-hidden p-2">
                        <img class="col" src="<?php echo site_url('/images/logosaads/') . $saad['image']; ?>"
                             alt="logo du saad  <?php echo $saad['nom'] ?>">
                        <div class="col-start-2 col-end-6">
                            <h3 class="first-letter:capitalize text-2xl mx-2">
                                <?php echo $saad['nom'] ?>
                            </h3>

                            <?php if ($saad['tel']) { ?>
                                <div>
                                    <div class="mx-2 mt-5 inline-block text-lg">
                                        <i class="fa-solid fa-phone fa-lg mt-2"></i>
                                        <p class="inline font-semibold ml-1"> Tel :
                                        <p class="inline">
                                            <a class="link"
                                               href="tel:<?php echo $saad['tel'] ?>">
                                                <?php echo $saad['tel'] ?> </a>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($saad['mail']) { ?>
                                <div>
                                    <div class="mx-2 mt-1 inline-block text-lg">
                                        <i class="fa-solid fa-envelope fa-lg mt-2"></i>
                                        <p class="inline font-semibold ml-1"> E-mail :
                                        <p class="inline">
                                            <a class="link"
                                               href="mailto:<?php echo $saad['mail'] ?>">
                                                <?php echo $saad['mail'] ?> </a>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($saad['site']) { ?>
                                <div>
                                    <div class="mx-2 mt-1 inline-block text-lg">
                                        <i class="fa-solid fa-globe fa-lg mt-2"></i>
                                        <p class="inline font-semibold ml-1"> Site :
                                        <p class="inline">
                                            <a class="link"
                                               href="<?php echo $saad['site'] ?> ">
                                                <?php echo $saad['site'] ?> </a>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($saad['adresse']) { ?>
                                <div>
                                    <div class="mx-2 mt-1 inline-block text-lg">
                                        <i class="fa-solid fa-house fa-lg mt-2"></i>
                                        <p class="inline font-semibold ml-1"> Adresse :
                                        <p class="inline"><a class="link"
                                                             href=""> <?php echo $saad['adresse'] ?> </a></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            <?php }
        }
        ?>
    </div>
</div>