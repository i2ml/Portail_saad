<h2 class="title">
    Espace <?php
    if (session()->get('accountType') === SUPER_ADMIN) {
        echo "administrateur";
    } else {
        echo "gestionnaire de saad";
    } ?>
</h2>
<div class="container mx-auto px-10">
    <?php
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
        <a href="saadsList">
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
