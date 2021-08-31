##Creative Market Test Project

###API
This project was created as a test in the Creative Market Application process. 
It was built using Laravel 8 to interface with a MySQL database via a rudimentary API.
This API contains the following two end points: 
* `POST` to `sellerApplications/portfolioUnique` which 
will return whether a given portfolio URL already exists within the seller application table.
* `POST` to `sellerApplications` which will create new seller applications records (assuming 
  validation passes).

###Database
The database consists of two main tables (and a couple of laravel defaults that we will ignore for this).

######shop_categories
* `id` unique, autoincrement, primary key
* `slug` unique, human read-able string to use for classification
* `name` a human-readable string that is descriptive enough to use in client facing contexts
* `created_at`/`updated_at` timestamps

######seller_applications
* `id` unique, autoincrement, primary key
* `first_name` string
* `last_name` string
* `shop_category` string, slug from the `shop_categories` table
* `portfolio_url` string, unique
* `owns_content_confirmed` tinyint, used to show agreement to owning content at the portfolio url given during application process.
* `meta` json, this column stores other data such as the list of other third party marketplaces used, and the question/answer 
data on the second page of the application. This structure allows us to easily store and read data that may be useful
  when reviewing applications, that likely won't need to be directly queried. It can also make future updates to the application
  process simpler, as migrating previous data will not be as difficult. Particularly I felt there was a chance the question/answers
  may change in the future, this structure makes it very easy to always see exactly what responses were used by this particular seller
  regardless of other changes that may be made to this form in the future. 
* `created_at`/`updated_at` timestamps

###Frontend
The form itself is powered by Vue 3, and styled using bootstrap 5, with a few minor
tweaks via sass variable overrides and additional classes. All assets are compiled via mix. 

###Running the application

* Clone the project source to your machine: `git@github.com:Josephwaelchli/creative-market-test.git`
* Run `cp .env.exmaple .env` to create a base environment file.
* If you do not have docker, download and install from the docker website: https://www.docker.com/products/docker-desktop
* After installing docker, run the following command from the root of the project (this will install the necessary 
  components to run the project via Laravel Sail). `docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/opt \
  -w /opt \
  laravelsail/php80-composer:latest \
  composer install --ignore-platform-reqs`
* Replace `sail` with `./vendor/bin/sail` if you do not have sail aliased. 
* Run `sail up` to launch the docker image. 
* Run `sail php artisan key:generate` to create a valid app key.
* Run `sail npm ci` to install components. 
* Run `sail npm run dev` to compile resources. The first run may only download additional webpack components 
  (a message will warn you if this is the case) re-run this command to compile assets if this cases arises.
* Run `sail php artisan migrate` to create database tables.
* Run `sail php artisan db:seed` to fill in the `shop_categories` table (without this sellerApplication create requests 
  will fail validation).
* Connect to the application at localhost and enjoy :)  
