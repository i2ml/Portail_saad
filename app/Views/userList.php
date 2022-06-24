<h2 class="title"> Liste des utilisateurs </h2>
<div class="container mx-auto px-4 sm:px-8">
    <?php if (!empty($users) && is_array($users)) { ?>
        <div class="py-8">
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fa-solid fa-signature fa-lg"></i> Nom du compte :
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="text-gray-700 fa-solid fa-building-shield fa-lg"></i> Type de compte :
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fa-solid fa-user-cog fa-lg"></i> Attribuer des saads :
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 uppercase tracking-wider">
                                <i class="fa-solid fa-user-cog fa-lg"></i> Réinitialiser le mot de passe :
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left font-semibold text-gray-700 tracking-wider"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white">
                                    <div class="flex">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap capitalize">
                                                <?php echo $user['nom'] . ' ' . $user['prenom']; ?>
                                            </p>
                                            <p class="text-gray-600 whitespace-no-wrap text-sm"><?php echo $user['mail'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?php
                                    if ($user['id'] === session()->get('id')) { ?>
                                    <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                  <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                  <span class="relative">Votre compte</span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?php } else { ?>
                                    <?php if ($user['accountType'] === SUPER_ADMIN) { ?>
                                    <form action="<?= esc(base_url()) ?>/PersonController/userDowngrade/<?= esc($user['id'], 'url'); ?>">
                                <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                  <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                  <button class="relative font-semibold">Administrateur</button>
                                </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <form action="<?= esc(base_url()) ?>/PersonController/userDowngrade/<?= esc($user['id'], 'url'); ?>">
                                        <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                            Rétrograder
                                        </button>
                                    </form>
                                    <?php } else { ?>
                                    <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight">
                                             <span aria-hidden
                                                   class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                            <button class="relative font-semibold">Gestionnaire de SAAD</button>
                                            </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <form action="<?= esc(base_url()) ?>/PersonController/userUpgrade/<?= esc($user['id'], 'url'); ?>">
                                        <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                            Promouvoir
                                        </button>
                                    </form>
                                    <?php }
                                    } ?>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <form action="<?= esc(base_url()) ?>/SaadListController/saadLink/<?= esc($user['id'], 'url'); ?>">
                                        <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                            Lier des SAAD
                                        </button>
                                    </form>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?php
                                    if ($user['id'] !== session()->get('id') && $user['accountType'] !== SUPER_ADMIN) { ?>
                                        <form action="<?= esc(base_url()) ?>/PersonController/resetPassword/<?= esc($user['mail'], 'url'); ?>">
                                            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                                Réinitialiser le mot de passe
                                            </button>
                                        </form>
                                    <?php } ?>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-right">
                                    <?php
                                    if ($user['id'] !== session()->get('id') && $user['accountType'] !== SUPER_ADMIN) { ?>
                                        <form action="<?= esc(base_url()) ?>/PersonController/userDelete/<?= esc($user['id'], 'url'); ?>"
                                              onclick="return confirm('Cette suppression est définitive, êtes vous certains de vouloir l\'effectuer ?')">
                                            <button class="inline-block text-gray-500 hover:text-red-700">
                                                <i class="fa-solid fa-trash fa-2xl"></i>
                                            </button>
                                        </form>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } else { ?>

        <h3>Aucun utilisateur n'a été trouvé</h3>

        Il n'existe aucun utilisateur dans la base de données.

    <?php } ?>
</div>

