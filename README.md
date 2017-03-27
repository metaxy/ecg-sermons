 
 
# Installation

## Manual

If you do not have Composer, you may install it by following the instructions at [getcomposer.org](https://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:
```
php composer.phar global require "fxp/composer-asset-plugin:~1.1.1"
php composer.phar install
```
mkdir web/assets 
make it writable
Now you should be able to access the application.

http://localhost/bko3/web/


# Design
## Bisher
 `/sermons/json/{categoryId}` -> alles aus einer Kategorien categoryId
 
 `/sermons/json/limited/{limit}` -> {limit} aus allen Kategorien
 
 `/sermons/json/limited/{categoryId}/{limit}` -> {limit} aus allen Kategorie {categoryId}
 
 `/sermons/json/limited/{categoryId}/{limit}`
 
 `/sermons/hit/{sermonId}` -> Eine Predigt wurde runtergeladen
 
 `/sermons/json/popular/{categoryId}` -> Die beliebsten aus der Kategorie {categoryId}
 
 `/sermons/json/popular/{categoryId}/{limit}` -> Die {limit}-beliebsten aus der Kategorie {categoryId}

 `/sermons/feed/` -> Atom Feed
 
 `/sermons/feed/{categoryId}` -> Atom Feed for Kategorie
 
## Neue API

## Auflisten
Filter: 
```
query[categoryId] :: int[]|int
query[language] :: int[]|int
query[title] :: string
query[date] :: string
query[speaker] :: string[] | string
query[seriesName] :: string
```

 `/sermon/list`
Ausgabe: 
```
[
    {
        "title": ""
    }
]
``` 
 
 `/sermon/feed`
## Einfügen
 `/sermon/create`
## Statistic
 `/sermon/hit/{id}`

