Shortlink
---------

RUN STEPS
1. git clone https://github.com/artistlabs/shortlink.git
2. composer install
2.1 assets:install если нужно
3. прописать настройки БД в parameters.yaml
4. bin/console doctrine:database:create
5. bin/console doctrine:migrations:migrate 
6. bin/console server:run
