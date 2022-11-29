<?php
/**
 * @var bool $isAdmin
 * @var bool $mySaadList
 * @var array $saads

 * @var $notificationTitle string - le titre de la notification
 * @var $notificationMessage string - le message de la notification
 */

if ($mySaadList) {
    ?>
    <h1 class="title">Liste de vos SAAD</h1>
    <?php
} else {
    ?>
    <h1 class="title">Liste de tous les SAAD</h1>
    <?php
}
?>


<div class="container mx-auto px-4 sm:px-8">
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
    <?php }
    if (!empty($saads) && is_array($saads)) { ?>
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
                                        <form action="<?= esc(base_url()) ?>/SecteurLinkController/secteurLink/<?= esc($saad['id'], 'url'); ?>">
                                            <button class="ml-2 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                                Définir les secteurs d'action
                                            </button>
                                        </form>
                                        <?php
                                        // check if the user is a super admin
                                        if ($isAdmin) { ?>
                                            <form action="<?= esc(base_url()) ?>/SaadController/saadDelete/<?= esc($saad['id'], 'url'); ?>">
                                                <button class="ml-2 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                                                        onclick="return confirm('Cette suppression est définitive, êtes vous certains de vouloir l\'effectuer ?')">
                                                    Supprimer
                                                </button>
                                            </form>
                                        <?php } ?>
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