<h1 class="title">Sélectionnez les services d'aide à domicile à lier à l'utilisateur :</h1>

<?php

use App\Models\PersonneModel;
use App\Models\SaadModel;

/**
 * @var PersonneModel $user
 * @var SaadModel[] $saads
 * @var SaadModel[] $currentSaadList
 * @var $notificationTitle string - le titre de la notification
 * @var $notificationMessage string - le message de la notification
 */
?>
<div class="container mx-auto">
    <?php if (isset($notificationTitle) and isset($notificationMessage)) {
        ?>

        <!--code for notification starts-->
        <div role="alert"
             class="sm:mr-6 xl:w-5/12 mx-auto absolute left-0 sm:left-auto right-0 sm:w-6/12 md:w-3/5 justify-between w-11/12 bg-white shadow-lg rounded flex sm:flex-row flex-col transition duration-150 ease-in-out"
             id="notification">
            <div
                    class="sm:px-6 p-2 flex mt-4 sm:mt-0 ml-4 sm:ml-0 items-center justify-center bg-blue-header-btn sm:rounded-tl sm:rounded-bl w-12 h-12 sm:h-auto sm:w-auto text-white">
                <img src="<?php echo site_url('/images/') ?>coloured_multiple_with_separator-svg1.svg"
                     alt="check icon"/>
            </div>
            <div class="flex flex-col justify-center xl:-ml-4 pl-4 xl:pl-1 sm:w-3/5 pt-4 sm:pb-4 pb-2">
                <h1 class="text-lg text-gray-800 font-semibold pb-1"><?php echo $notificationTitle ?></h1>
                <p class="text-sm text-gray-600 font-normal"><?php echo $notificationMessage ?></p>
            </div>
            <div
                    class="flex sm:flex-col sm:justify-center sm:border-l items-center border-gray-300 sm:w-1/6 pl-4 sm:pl-0">
                <a href="javascript:void(0)" class="sm:pt-4 pb-4 flex sm:justify-center w-full cursor-pointer"
                   onclick="closeModal()">
                    <span class="sm:text-sm text-xs text-gray-800 cursor-pointer">Fermer</span>
                </a>
            </div>
        </div>
        <!--code for notification ends-->
    <?php } ?>
    <div class="max-w-sm rounded overflow-hidden shadow-lg mx-auto">
        <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2 first-letter:capitalize"> <?php echo $user['nom'] . ' ' . $user['prenom'] ?></div>
            <?php if ($user['mail']) { ?>
                <i class="fa-solid fa-envelope fa-lg mt-2"></i>
                <p class="inline ml-1"> E-mail :
                    <a class="link"
                       href="mailto:<?php echo $user['mail'] ?>">
                        <?php echo $user['mail'] ?> </a>
                </p>
            <?php } ?>
        </div>
        <?php
        if (!empty($currentSaadList) && is_array($currentSaadList)) { ?>
            <div class="px-6 pt-4 pb-2">
                <?php foreach ($currentSaadList as $userSaad) { ?>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"><?php echo $userSaad['nom'] ?></span>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>

<div class="container mx-auto px-4 sm:px-8">
    <?php if (!empty($saads) && is_array($saads)) { ?>
        <div class="py-8">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <form method="POST" id="linkForm"
                          action="<?= esc(base_url()) ?>/SaadListController/editSaadLink/<?= esc($user['id'], 'url'); ?>"></form>
                    <table class=" min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fa-solid fa-house fa-lg"></i> SAAD :
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fa-solid fa-users fa-lg"></i> Liste des gérants :
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fa-solid fa-link fa-lg"></i> Attribuer à l'utilisateur :
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
                                    <p class="text-gray-900 whitespace-no-wrap capitalize">
                                        <?php echo implode(' / ', $saad['noms']) ?>
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center mb-4">
                                        <?php
                                        // set a $isLinked to true if $saad is in $currentSaadList
                                        $isLinked = false;
                                        if (!empty($currentSaadList) && is_array($currentSaadList)) {
                                            foreach ($currentSaadList as $userSaad) {
                                                if ($userSaad['id'] === $saad['id']) {
                                                    $isLinked = true;
                                                }
                                            }
                                        }
                                        ?>
                                        <label for="toggle<?php echo $saad['id'] ?>"
                                               class="flex items-center cursor-pointer">
                                            <div class="relative">
                                                <input id="toggle<?php echo $saad['id'] ?>" type="checkbox"
                                                       form="linkForm" class="sr-only"
                                                    <?php echo !$isLinked ?: "checked" ?> name="saad[]"
                                                       value="<?php echo $saad['id'] ?>"/>
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

        <h3>Aucun saad n'a été trouvé</h3>

        Il n'existe aucun utilisateur dans la base de données.

    <?php } ?>
    <div class="flex flex-wrap justify-center">
        <form action="<?= esc(base_url()) ?>/SaadListController/deleteAllLinks/<?= esc($user['id'], 'url'); ?>">
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
