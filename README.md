# TDD to learn 

Learn TDD by the practice. 

I hope to learn a lot without too much trouble in the skull.


1 . To create a new project, please start by cloning the project.

```bash
$ git clone https://github.com/Smart4U/tdd-to-learn.git
```

2 . rename the configuration file example.env like this .env. 

Then edit the file with correct information.


```text
APP_ENV=prod
APP_HOST=http://domain.com

DB_PORT=3306
DB_HOST=localhost
DB_NAME=name
DB_USER=user
DB_PASS=pass
```

3 . Add bundles to load in bundles.php like this.


```php
return [
    'AdminBundle::class',
    'BlogBundles::class',
    'Contact.bundle::class'
}
```