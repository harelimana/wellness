# wellness

Wellness

Implementation


sudo apt install composer

composer create-project symfony/skeleton my-project

OR

sudo php composer.phar create-project symfony/skeleton julienoids

cd my-project

sudo ln -s /var/www/html/my-project/ /home/axxahretz/Documents/
sudo chmod 777 -R /var/www/html/my-project/
 
composer require symfony/maker-bundle --dev
composer require server --dev
composer require --dev profiler
composer require annotations
composer require twig
composer require symfony/routing
composer require sensio/framework-extra-bundle
composer require fzaninotto/faker
composer require symfony/orm-pack
composer require symfony/form
composer require --dev doctrine/doctrine-fixtures-bundle
composer require symfony/asset
composer require symfony/validator
composer require symfony/validator doctrine/annotations


php bin/console generate:controller //creates the Templates\ctrDir\index.html.twig

// 0°=== modify file.env (database et logins)
DATABASE_URL=mysql://root:root@127.0.0.1:3306/my-project
// 1°=== create a DB
php bin/console doctrine:database:create
// 2°=== create  entities
php bin/console make:entity => ex : Article (in singular) => one classe with properties
// 3°=== add tables => and fields (the ? Gives the list  of possibilities [fields models] => c'est à la suite de la création de l'entite
// 4° Faire la migration => gérer les differences entre la DB et les tables
sudo php bin/console make:migration
// 5° Modification de la DB
sudo php bin/console doctrine:migrations:migrate
// 6° creer une fixtures
sudo composer require orm-fixtures --dev
sudo php bin/console make:fixtures
// 7° confectionner le code requis au sein de la classe Fixctures
$faker = \Faker\Factory::create('FR_fr')
$article = New Article();
$rticle->setNom();
// 8° persister les Entites et populate les Tables
sudo php bin/console doctrine:fixtures:load
// 9° create Controllers
sudo php bin/console make:controller
and give the controllerName ex: FilmController

// 9.1° create the index (list of items)
// 9.2° Add items
// 9.3° update items
// 9.4° delete items

// 10° generate forms
php bin/console make:form App:Film

sudo php bin/console make:form  //it creates FormTypes in the same time

// 11. ajouter le boostrap de TWIG dans config/packages/twig.yaml //juste la 'value' entre crochets et sa propriété 'form-thèmes': 

config/packages/twig.yaml
twig:
    form_themes: ['bootstrap_4_layout.html.twig']
// 12. je peux parfois debugguer les routes

php bin/console debug:route

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
sudo php bin/console server:run
http://127.0.0.1:8000/home

sudo git commit -m "Initial commit"

sudo git add .
sudo git commit
sudo git push

https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony2/les-relations-entre-entites-avec-doctrine2

478831354

//resize images 
convert public/assets/img/tmp/our-2.jpg -resize 1240x450 public/assets/img/tmp/our-2.jpg
//swft_mailer
php bin/console swiftmailer:email:send
https://symfony.com/doc/current/security/form_login_setup.html
Use mailtrap
