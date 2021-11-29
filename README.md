

## About Subscription app

Subscription app is an app that people can use to handle subscription management for posts


## deploying
After downloading the source code, do composer install on the app directory to install the dependecies, then  setup the database, do 
php artisan:migrate , to migrate database files

## dispatching subscription emails via the command line
Run php artisan publish:online-posts, then you run the queue worker after to dispatch the email(s) on the queue, using  php artisan queue:work --queue=high,default


##Api documentation
the api documenation can be found at https://documenter.getpostman.com/view/4695863/UVJcmHMz

# subscriptionplatform
