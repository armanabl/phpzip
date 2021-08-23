# phpzip
#PHP zip Archive


#Example
```php
$zip = new \armanabl/phpzip();
$zip->first_string_to_archive_file = 'files';
$zip->create_archive("a.zip", __DIR__."/data/files");
```
