<main class="main prose p-10 max-w-none">
    <h1 class="title">Les services d'aides à domicile dans votre secteur</h1>
    <div class="grid grid-cols-1">
        <section class="all-saads">

            <?php foreach ($saads as $saad) { ?>
                <article class="card border grid grid-cols-6 mt-5">
                    <img
                        class="col" src="<?php echo site_url('/images/').$saad['image']; ?>">
                    <div class="col">
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
                    <div class="col">
                        <form action="<?= esc(base_url()) ?>/AdminController/createSaad/<?= esc($saad['id'], 'url'); ?>" >
                            <button class="blue-button"> Modifier </button>
                        </form>
                    </div>
                    <div class="col">
                        <form action="<?= esc(base_url()) ?>/AdminController/saadDelete/<?= esc($saad['id'], 'url'); ?>" onclick="return confirm('Cette suppression est définitive, êtes vous certains de vouloir l\'effectuer ?')">
                            <button class="blue-button"> Supprimer </button>
                        </form>
                    </div>
                </article>
            </div>
            <?php
            }
            ?>
        </section>
    </div>
</main>