<div class="container mx-auto px-4 sm:px-8">
    <h2 class="title">Les services d'aides à domicile dans votre secteur</h2>
    <?php
    foreach ($saads as $saad) {
        if ($saad['idCategorie'] != 3) { ?>
            <div class="py-8">
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="grid min-w-full shadow-md rounded-lg overflow-hidden">
                        <img class="col" src="<?php echo site_url('/images/logosaads/') . $saad['image']; ?>"
                             alt="logo du saad  <?php echo $saad['nom'] ?>">
                        <div class="col-start-2 col-end-6">
                            <h3 class="text-blue-header-btn text-2xl mx-2">
                                <?php echo $saad['nom'] ?>
                            </h3>

                            <?php if ($saad['tel']) { ?>
                                <div>
                                    <div class="mx-2 mt-5 inline-block text-lg">
                                        <i class="fa-solid fa-phone fa-lg mt-2"></i>
                                        <p class="inline font-semibold ml-1"> Tel :
                                        <p class="inline"> <?php echo $saad['tel'] ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($saad['mail']) { ?>
                                <div>
                                    <div class="mx-2 mt-1 inline-block text-lg">
                                        <i class="fa-solid fa-envelope fa-lg mt-2"></i>
                                        <p class="inline font-semibold ml-1"> E-mail :
                                        <p class="inline"><a class="link" href=""> <?php echo $saad['mail'] ?> </a></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($saad['site']) { ?>
                                <div>
                                    <div class="mx-2 mt-1 inline-block text-lg">
                                        <i class="fa-solid fa-globe fa-lg mt-2"></i>
                                        <p class="inline font-semibold ml-1"> Site :
                                        <p class="inline"><a class="link" href=""> <?php echo $saad['site'] ?> </a></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }
    ?>
</div>