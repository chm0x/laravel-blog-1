# MINI PROJECT: BLOG

Breeze
```
> composer require laravel/breeze --dev

# if you want to production, don't use the --dev flag
> composer require laravel/breeze

> php artisan breeze:install

> php artisan migrate

> npm install
```

## DEFINING MIGRATION

```
> php aritsan make:model Tag -r -f -m
> php aritsan make:model Category -r -f -m
> php aritsan make:model Article -r -f -m
```

Explanation: One user has Many articles or can create Many articles, while One Article is Created by One User and only One user withe the Categories. 

One Article belongs to One Category, while  a Category can have Many Posts. In short: One-to-Many relationship.

Tag: One article can have Many Tags, while One Tag can have Many Articles. :Many-to-Many:

Creating a Pivot Table:
```
> php artisan make:migration create_article_tag_table
```


## GENERATE DATA WITH SEEDERS/FACTORIES

```
> php artisan make:seeder CategorySeeder
```