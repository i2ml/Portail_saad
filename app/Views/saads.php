<main class="main prose p-10 max-w-none">
    <h1 class="title">Les services d'aides à domicile dans votre secteur</h1>
    <div class="grid grid-cols-1">
        <section class="all-saads">

            <?php foreach ($saads as $saad) {
                if($saad['idCategorie'] != 3) { ?>
                <article class="card border grid grid-cols-6 mt-5">
                    <img
                        class="col-1" src="<?php echo site_url('/images/').$saad['image']; ?>">
                    <div class="col-start-2 col-end-6">
                        <h3 class="text-blue-header-btn text-2xl m-5">
                            <?php echo $saad['nom'] ?>
                        </h3>

                        <?php if($saad['tel']) { ?>
                        <p class="m-2">
                            Tel : <?php echo $saad['tel'] ?>
                        </p>
                        <?php } ?>
                        <?php if($saad['mail']) { ?>
                        <p class="m-2">
                            E-mail : <a class= "link" href=""> <?php echo $saad['mail'] ?> </a>
                        </p>
                        <?php } ?>
                        <?php if($saad['site']) { ?>
                        <p class="m-2">
                            Site : <a class= "link" href=""> <?php echo $saad['site'] ?> </a>
                        </p>
                        <?php } ?>
                    </div>
                </article>
            </div>
            <?php }
            }
            ?>
        </section>
    </div>
</main>