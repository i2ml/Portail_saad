# Portail SAAD

Ceci est le repos du portail d'aide à domicile du Gard. Un projet réalisé par i2ml demandé par le Conseil Départemental du Gard.
## Installation 

Après avoir cloné le repo lancer :
```
    composer install
```

Normalement tout devrait s'installer.

##Tailwind
Nous utilisons tailwind, pour mettre a jour le css il faut faire la commande suivante :
```
    npx tailwindcss -i ./app/input.css -o ./public/style.css --watch
```
(Et normalement c'est bon)

##Config

Modifiez le fichier `env` avec vos informations et faites en une copie que vous nommez `.env`
