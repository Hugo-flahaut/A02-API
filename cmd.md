## Récupérer le dossier
git pull
composer install
yarn install

## Lancer le serveur symfony 
symfony server:start
http://127.0.0.1:8000/api

## Créer la base de données
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

### Supprimer la base de données
php bin/console doctrine:database:drop -f

# Si il y a des erreurs !
php bin/console clear:cache