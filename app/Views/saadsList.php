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
                                <i class="fa-solid fa-cog fa-lg"></i> Options :
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
                                                <?php echo $saad['nom'] ?>
                                            </p>
                                            <p class="text-gray-600 whitespace-no-wrap text-sm"><?php echo $saad['mail'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <form action="<?= esc(base_url()) ?>/SaadListController/saadLink/<?= esc($saad['id'], 'url'); ?>">
                                        <p class="text-gray-900 whitespace-no-wrap capitalize">
                                            <?php
                                            echo implode(' / ', $saad['noms'])
                                            ?>
                                        </p>
                                    </form>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex">
                                        <form action="<?= esc(base_url()) ?>/SaadController/createSaad/<?= esc($saad['id'], 'url'); ?>">
                                            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                                Modifier
                                            </button>
                                        </form>
                                        <form action="<?= esc(base_url()) ?>/SaadController/saadDelete/<?= esc($saad['id'], 'url'); ?>">
                                            <button class="ml-2 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                                                    onclick="return confirm('Cette suppression est définitive, êtes vous certains de vouloir l\'effectuer ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
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