<?php
/**
 * @var $publics array - contient la liste des publics ciblés disponibles en bdd
 */
?>

<div class="half-a-border-on-top">
    <form action="<?php echo site_url('saads') ?>" class=" bg-grey-recherche pt-16 half-a-border-on-bottom">
        <div class="flex items-center justify-center">
            <select class="form-select p-3 m-5 bg-white border" name="publicCible">
                <option disabled selected> Qui êtes vous ?</option>
                <?php
                //display one option for each public in the $publics array
                foreach ($publics as $public) {
                    ?>
                    <option value="<?php echo $public['id'] ?>"><?php echo $public['nom'] ?></option>
                    <?php
                }
                ?>
            </select>
            <div class="flex border-2 rounded mr-5">
                <input type="text" class="px-4 py-2 w-80" name="mainSearch">
                <button class="flex items-center justify-center px-4 border-l">
                    <svg class="w-6 h-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24">
                        <path
                                d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/>
                    </svg>
                </button>
            </div>
            <div class="flex border-2 rounded">
                <input type="text" class="px-4 py-2 w-80" placeholder="Adresse">
            </div>
        </div>
        <div class="text-center h-32">
            <button class="blue-button">
                Lancer la recherche
            </button>
        </div>
    </form>
</div>