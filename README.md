# phpzip
#PHP zip Archive


# Example For Create Archive
```php
$zip = new /armanabl/phpzip();
$zip->create_archive_root_folder = 'files';
$zip->create_archive("archive.zip", __DIR__."/data/files");
```


# Example For Extract Archive
```php
$zip = new /armanabl/phpzip();
$zip->extract_archive("archive.zip", __DIR__."/data/files");
```
