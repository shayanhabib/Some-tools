<?php 
/**
 * Transfer Files Server to Server using PHP Copy
 */
 
/* Source File URL */
$remote_file_url = 'https://demolink.co/backup-18-05-2021-exceptionalstaffing.ca.zip';
 
/* New file name and path for this file */
$local_file = 'backup-18-05-2021-exceptionalstaffing.ca.zip';
 
/* Copy the file from source url to server */
$copy = copy( $remote_file_url, $local_file );
 
/* Add notice for success/failure */
if( !$copy ) {
    echo "Doh! failed to copy $file...\n";
}
else{
    echo "WOOT! success to copy $file...\n";
}
?>