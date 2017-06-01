read -p "Quel fichier d'environnement utiliser ? " TYPE_ENV

if [ $TYPE_ENV = "sqlite" ]
then
	echo "Chargement de l'environnement SQLITE"
	cp env/env.sqlite .env
else
	echo "Chargement de l'environnement MYSQL"
	cp env/env.default .env
fi

php artisan config:clear

echo "Fichier d'environnement mis en place"