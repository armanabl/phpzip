<?php

use ZipArchive;

/**
 * Class Zip
 */
class Zip
{
    public $create_archive_root_folder = '';

    public $zip;

    public function __construct()
    {
        $this->zip = new ZipArchive();
    }

    /**
     * Create new zip Archive
     * @param $Archive_name
     * @param $dir
     */
    public function create_archive($Archive_name, $dir)
    {
        if ($this->zip->open($Archive_name, ZipArchive::CREATE) === TRUE) {
            $this->check_add_files($dir, $this->create_archive_root_folder);
            $this->zip->close();
        }
    }

    /**
     * check Director and add file and folder to zip file
     * @param $dir
     * @param $root_folder
     */
    public function check_add_files($dir, $root_folder)
    {
        if ($handle = opendir($dir)) {
            // Add all files inside the directory
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    if (!is_dir($dir . '/' . $entry)) {
                        $this->zip->addFile($dir . '/' . $entry, $root_folder . '/' . $entry);
                    } else {
                        $this->check_add_files($dir . '/' . $entry, $root_folder . '/' . $entry);
                    }
                }
            }
            closedir($handle);
        }
    }
}