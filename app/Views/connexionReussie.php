<?php
/**

 * @var $notificationTitle string - le titre de la notification
 * @var $notificationMessage string - le message de la notification
 */
?>
<h2 class="title">
    Espace <?php
    if (session()->get('accountType') === SUPER_ADMIN) {
        echo "administrateur";
    } else {
        echo "gestionnaire de saad";
    } ?>
</h2>
<div class="container mx-auto px-10">
    <?php if (isset($notificationTitle) and isset($notificationMessage)) {
        ?>
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
    //check if the user is a super admin
    if (session()->get('accountType') === SUPER_ADMIN) {
        ?>


        <h3 class="my-10 text-xl font-semibold">
            <i class="fa-solid fa-user fa-xl"></i> Gestion des utilisateurs :
        </h3>
        <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 xl:gap-7 md:gap-3 gap-1">
            <a href="createUser">
                <div class="menu-card">
                    <i class="fa-solid fa-plus fa-2xl text-blue-header-btn"></i>
                    <p class="mt-5">Créer un utilisateur</p>
                </div>
            </a>
            <a href="userList">
                <div class="menu-card">
                    <i class="fa-solid fa-address-book fa-2xl text-blue-header-btn"></i>
                    <p class="mt-5">Gérer les utilisateurs</p>
                </div>
            </a>
        </div>

    <?php } ?>

    <h3 class="my-10 text-xl font-semibold">
        <i class="fa-solid fa-home fa-xl"></i> Gestions des saads :
    </h3>
    <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 xl:gap-7 md:gap-3 gap-1">
        <?php
        //check if the user is a super admin
        if (session()->get('accountType') === SUPER_ADMIN) {
            ?>
            <a href="createSaad">
                <div class="menu-card">
                    <i class="fa-solid fa-plus fa-2xl text-blue-header-btn"></i>
                    <p class="mt-5">Créer un SAAD</p>
                </div>
            </a>
        <?php } ?>
        <a href="mySaadsList/<?= esc(session()->get('id'), 'url'); ?>">
            <div class="menu-card">
                <i class="fa-solid fa-anchor fa-2xl text-blue-header-btn"></i>
                <p class="mt-5">Gérer les saads qui me sont attribués</p>
            </div>
        </a>
        <?php
        //check if the user is a super admin
        if (session()->get('accountType') === SUPER_ADMIN) {
            ?>
            <a href="saadsList">
                <div class="menu-card">
                    <i class="fa-solid fa-list-check fa-2xl text-blue-header-btn"></i>
                    <p class="mt-5">Gérer tous les saads</p>
                </div>
            </a>
        <?php } ?>
    </div>
    <h3 class="my-10 text-xl font-semibold">
        <i class="fa-solid fa-gear fa-xl"></i> Paramètres :
    </h3>
    <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 xl:gap-7 md:gap-3 gap-1">
        <a href="changePassword">
            <div class="menu-card">
                <i class="fa-solid fa-lock fa-2xl text-blue-header-btn"></i>
                <p class="mt-5">Changer de mot de passe</p>
            </div>
        </a>
        <a href="disconnect" onclick="return confirm('Êtes vous sûr de vouloir vous déconnecter ?')">
            <div class="menu-card">
                <i class="fa-solid fa-arrow-right-from-bracket fa-2xl text-blue-header-btn"></i>
                <p class="mt-5">Déconnexion</p>
            </div>
        </a>
    </div>
</div>