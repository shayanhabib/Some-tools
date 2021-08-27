<?php //echo 'testing 123'; die;
/*
 * PHP: Recursively Backup Files & Folders to ZIP-File
 * (c) 2012-2014: Marvin Menzerath - http://menzerath.eu
 * contribution: Drew Toddsby
*/
// Make sure the script can handle large folders/files
ini_set('max_execution_time', 3600);
//ini_set('memory_limit','20480M');
ini_set("memory_limit", "-1");
set_time_limit(0);
// Start the backup!

$folder_name = "jempe";

zipData($folder_name, 'backup_'.$folder_name.'.zip');

echo 'Finished.';

// Here the magic happens :)
function zipData($source, $destination) {
	if (extension_loaded('zip')) {
		if (file_exists($source)) {
			$zip = new ZipArchive();
			if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
				$source = realpath($source);
				if (is_dir($source)) {
					$iterator = new RecursiveDirectoryIterator($source);
					// skip dot files while iterating 
					$iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
					$files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
					foreach ($files as $file) {
						$file = realpath($file);
						if (is_dir($file)) {
							$zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
						} else if (is_file($file)) {
							$zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
						}
					}
				} else if (is_file($source)) {
					$zip->addFromString(basename($source), file_get_contents($source));
				}
			}
			return $zip->close();
		}
	}
	return false;
}

?>