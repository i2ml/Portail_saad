<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>403 forbidden</title>
</head>
<body>
<div class="wrap">
    <section class="mb-32 text-gray-800 text-center">
        <div class="flex flex-wrap justify-center">
            <img class="h-72" src="<?php echo site_url('/images/') ?>forbidden_icon.svg"
                 alt="forbidden access illustration"/>
        </div>
        <div class="px-6 py-12 md:px-12">
            <h2 class="mt-8 mr-8 ml-5 mb-3 text-4xl font-semibold">
                Malheureusement, Vous n'avez pas</h2>
            <h2 class="mr-8 ml-5 mb-3 text-4xl font-semibold mb-8"> l'autorisation d'accéder à cette page !</h2>
        </div>

        <a href="<?php
        if (session()->get('isLoggedIn')) {
            echo site_url('/connexionReussie');
        } else {
            echo site_url('/connexion');
        } ?>"
           class="mt-8 bg-whte mt-5 hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
            Retourner à l'accueil
        </a>
    </section>
</div>
</body>
</html>
