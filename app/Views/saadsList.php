<h1 class="title">Les services d'aides à domicile dans votre secteur</h1>
<div class="container mx-auto px-4 sm:px-8">
    <?php if (!empty($saads) && is_array($saads)) { ?>
        <div class="py-8">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fa-solid fa-house fa-lg"></i> SAAD :
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fa-solid fa-users fa-lg"></i> Liste des gérants :
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fa-solid fa-cog fa-lg"></i> Attribuer à l'utilisateur :
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($saads as $saad) { ?>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white">
                                    <div class="flex">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap capitalize">
                                                <?php echo $saad['nom']?>
                                            </p>
                                            <p class="text-gray-600 whitespace-no-wrap text-sm"><?php echo $saad['mail'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <form action="<?= esc(base_url()) ?>/SaadListController/saadLink/<?= esc($saad['id'], 'url'); ?>">
                                        <p class="text-gray-900 whitespace-no-wrap capitalize">
                                            <?php echo $saad['nom']?>
                                        </p>
                                    </form>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <form action="<?= esc(base_url()) ?>/SaadListController/saadLink/<?= esc($saad['id'], 'url'); ?>">
                                        <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                            Lier des SAAD
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } else { ?>

        <h3>Aucun SAAD n'a été trouvé</h3>

        Il n'existe aucun SAAD dans la base de données.

    <?php } ?>
</div>


<main class="main prose p-10 max-w-none">

    <div class="grid grid-cols-1">
        <section class="all-saads">

            <?php foreach ($saads as $saad) { ?>
            <article class="card border grid grid-cols-6 mt-5">
                <img
                        class="col" src="<?php echo site_url('/images/logosaads/') . $saad['image']; ?>" alt="logo du saad">
                <div class="col">
                    <h3 class="text-blue-header-btn text-2xl m-5">
                        <?php echo $saad['nom'] ?>
                    </h3>

                    <?php if ($saad['tel']) { ?>
                        <p class="m-2">
                            Tel : <?php echo $saad['tel'] ?>
                        </p>
                    <?php } ?>
                    <?php if ($saad['mail']) { ?>
                        <p class="m-2">
                            E-mail : <a class="link" href=""> <?php echo $saad['mail'] ?> </a>
                        </p>
                    <?php } ?>
                    <?php if ($saad['site']) { ?>
                        <p class="m-2">
                            Site : <a class="link" href=""> <?php echo $saad['site'] ?> </a>
                        </p>
                    <?php } ?>
                </div>
                <div class="col">
                    <form action="<?= esc(base_url()) ?>/SaadController/createSaad/<?= esc($saad['id'], 'url'); ?>">
                        <button class="blue-button"> Modifier</button>
                    </form>
                </div>
                <?php
                if (session()->get('accountType') === SUPER_ADMIN) {
                    ?>
                    <div class="col">
                        <form action="<?= esc(base_url()) ?>/SaadController/saadDelete/<?= esc($saad['id'], 'url'); ?>"
                              onclick="return confirm('Cette suppression est définitive, êtes vous certains de vouloir l\'effectuer ?')">
                            <button class="blue-button"> Supprimer</button>
                        </form>
                    </div>
                <?php } ?>
            </article>
    </div>
    <?php } ?>
    </section>
    </div>
</main>