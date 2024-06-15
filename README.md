### Casino Backend
## clone the application
git clone https://github.com/cybersoldattech/casino-back-end.git
cd casino-back-end

### PHP Packages
```bash
    composer install 
```

### Configuraiton ENV Project
```bash
    cp .env.example .env
```

### Generate Key Projet for session key data encryption

```bash
    php artisan key:generate
```

## If it's your fist deployment

```bash
    php artisan migrate --seed
```

## Else

```bash
    php artisan migrate:fresh --seed
```
## Create the symbolic link

```bash
    php artisan storage:link
```

```bash
    php artisan serve
```

### The API will be accessible at: http://localhost:8000/api . where 8000 is the application startup port

##### for GET all brands
```bash
      http://localhost:8000/api/brands 
```

##### for POST add brands
```bash
      http://localhost:8000/api/brands 
```

##### for PUT add brands where id represents the brand identifier
```bash
      http://localhost:8000/api/brands/id 
```

##### for DELETE add brands where id represents the brand identifier
```bash
      http://localhost:8000/api/brands/id 
```


### admin interface will be accessible at: http://localhost:8000/admin . where 8000 is the application startup port

##### the brand table
```bash
      http://localhost:8000/admin/brands/ 
```

##### Interface to create the brand

```bash
      http://localhost:8000/admin/brands/create
```

##### Interface for modifying the brand
```bash
      http://localhost:8000/admin/brands/id/edit
```