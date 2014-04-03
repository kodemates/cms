Rosario-CMS
===========

CMS based on Symfony2
This is a ßeta project.

## Requirements ##

You need to have these dependencies installed: 

 - `php >= 5.4` with extensions enabled: `intl`, `mysql` or `sqlite`
 - Composer: [Download composer](http://getcomposer.org/download/)
 - Node.js stable version: [Install Node.js](https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager)
 - Grunt.js: Install it with `npm install -g grunt-cli` (as superuser)
 - Sass: [Install Sass](http://sass-lang.com/install)

## Install ##
Make sure you have the **Requirements** listed above installed.

 1. Clone the repo

    `git clone https://github.com/lucciano/rosario-cms.git
     cd rosario-cms`
    
 2. Install dependencies using composer:
   `composer.phar install `

 3. Create from template config file set up the database connection:
 
   3.1. `cp app/config/parameters.yml.dist app/config/parameters.yml`

   3.2. Open `app/config/parameters.yml` with a text editor and set your database parameters.

   3.3. Create the database: 
       3.3.1.`php app/console doctrine:database:create`
       3.3.1.`php app/console doctrine:schema:create`

 4. Install node dependencies and run grunt tasks.
 
   4.1.  Install node dependencies `npm install`.

   4.2.  Install bower dependencies: `grunt install`.

 5.  Run the app
        `php app/console server:run`
       
## Aims ##
* Static website
* Strong integration with JS (maybe through AngularJS)
* Extensions
  * Pages, directory
  * Calendar
  * Blog, Blog Post
  * Etc, etc
* Skineable
  * Structure (how each content is displayed)
  * Coordinator
  * Assets (js/css/images)

## Components ##
The system consists on two main compontents: content and anchors.

### Anchors ###
 Anchors are used to show the content in every moment, at least there must be the following anchors:
 
 * Organizator 

Set the possible blocks, for example 'header, 'menu', 'content', each one can be completed with another anchor.

 * Crude

To show content without modifications (specially binary, images, JS, CSS)

 * Specific
List content in an specific way.
        
### Content ###
 Each content defines its own data as well as its relationship with other content.
 * Binary
 * Page 
 * Directory 

### Coding standards ###

    http://symfony.com/doc/current/contributing/code/standards.html
