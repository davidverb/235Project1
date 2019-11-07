<?php

/********************************************************************/
/*  Date	Name	Description                                 */
/*  --------------------------------------------------------------- */
/*                                                                  */
/*  9/8/2019  David Verbeck   Drops table when "delete" is pressed. */
/********************************************************************/
// Get IDs
$feedID = filter_input(INPUT_POST, 'feedID', FILTER_VALIDATE_INT);

{
try {
    include_once './database/database.php';
    $db = Database::getDB();
} catch (Exception $ex) {
    echo 'Connection error: ' . $e->getMessage();
    exit();
}
// Delete the feedback from the database
if ($feedID != false) {
    $query = 'DELETE FROM contacts
              WHERE feedID = :feedID';
    $statement = $db->prepare($query);
    $statement->bindValue(':feedID', $feedID);
    $success = $statement->execute();
    $statement->closeCursor();    
}
// Display the admin page
include('Admin.php');
}