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
     * @param $archive_path
     * @return bool
     */
    public function create_archive($Archive_name, $archive_path)
    {
        if ($this->zip->open($Archive_name, ZipArchive::CREATE) === TRUE) {
            $this->check_add_files($archive_path, $this->create_archive_root_folder);
            $this->zip->close();
            return true;
        }

        return false;
    }

    /**
     * Extract archive
     * @param $archive_name
     * @param $extract_path
     * @return bool
     */
    public function extract_archive($archive_name, $extract_path)
    {
        //check exist file
        if (file_exists($archive_name)) {
            //check archive
            if ($this->zip->open($archive_name) === TRUE) {
                $this->zip->extractTo($extract_path);
                $this->zip->close();

                return true;
            }
        }

        return false;
    }

    /**
     * check Director and add file and folder to zip file
     * @param $archive_path
     * @param $root_folder
     */
    public function check_add_files($archive_path, $root_folder)
    {
        if ($handle = opendir($archive_path)) {
            // Add all files inside the directory
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    if (!is_dir($archive_path . '/' . $entry)) {
                        $this->zip->addFile($archive_path . '/' . $entry, $root_folder . '/' . $entry);
                    } else {
                        $this->check_add_files($archive_path . '/' . $entry, $root_folder . '/' . $entry);
                    }
                }
            }
            closedir($handle);
        }
    }
}