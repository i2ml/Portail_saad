<h1 class="title">Sélectionnez les secteurs à lier au SAAD :</h1>

<?php

use App\Models\PersonneModel;
use App\Models\SaadModel;
use App\Models\SecteurModel;

/**
 * @var Array $secteurs - toutes les infos sur les secteurs
 * @var Array $saad - les infos sur le saad
 * @var Array $currentSecteurList - la liste des secteurs du saad
 */
?>
<div class="container mx-auto">
    <div class="max-w-sm mx-auto ">
        <div class="px-6 py-4">
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
        </div>
    </div>
</div>

<div class="container mx-auto px-4 sm:px-8">
    <?php if (!empty($secteurs) && is_array($secteurs)) { ?>
        <div class="py-8">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <form method="POST" id="linkForm"
                          action="<?= esc(base_url()) ?>/SecteurLinkController/editSecteurLink/<?= esc($saad['id'], 'url'); ?>"></form>
                    <table class=" min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fa-solid fa-house fa-lg"></i> Secteur :
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fa-solid fa-link fa-lg"></i> Lier au SAAD :
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($secteurs as $secteur) { ?>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white">
                                    <div class="flex">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap capitalize">
                                                <?php echo $secteur['nom'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center mb-4">
                                        <?php
                                        // set a $isLinked to true if $saad is in $currentSaadList
                                        $isLinked = false;
                                        if (!empty($currentSecteurList) && is_array($currentSecteurList)) {
                                            foreach ($currentSecteurList as $saadSecteur) {
                                                if ($saadSecteur['id'] === $secteur['id']) {
                                                    $isLinked = true;
                                                }
                                            }
                                        }
                                        ?>
                                        <label for="toggle<?php echo $secteur['id'] ?>"
                                               class="flex items-center cursor-pointer">
                                            <div class="relative">
                                                <input id="toggle<?php echo $secteur['id'] ?>" type="checkbox"
                                                       form="linkForm" class="sr-only"
                                                    <?php echo !$isLinked ?: "checked" ?> name="secteur[]"
                                                       value="<?php echo $secteur['id'] ?>"/>
                                                <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                                                <div class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition"></div>
                                            </div>
                                            <p class="ml-3 text-gray-900 font-medium">
                                                Attribuer
                                            </p>
                                        </label>
                                    </div
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } else { ?>

        <h3>Aucun secteur n'a été trouvé</h3>

        Il n'existe aucun secteur dans la base de données.

    <?php } ?>
    <div class="flex flex-wrap justify-center">
        <form action="<?= esc(base_url()) ?>/SecteurLinkController/deleteAllLinks/<?= esc($saad['id'], 'url'); ?>">
            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow sm:mr-16 sm:mt-0 mx-8 mt-8"
                    type="submit">
                Supprimer tous les liens
            </button>
        </form>
        <button class="bg-blue-200 hover:bg-blue-100 text-blue-900 font-semibold py-2 px-4 border border-blue-400 rounded shadow sm:ml-16 sm:mt-0 mx-8 mt-8"
                form="linkForm" type="submit">
            Envoyer la modification
        </button>
    </div>
</div>
