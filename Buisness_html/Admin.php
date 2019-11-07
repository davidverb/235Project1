<?php

/********************************************************************/
/*  Date	Name	Description                                 */
/*  --------------------------------------------------------------- */
/*                                                                  */
/*  9/13/2019  David Verbeck   Added class logic. Updated delete.   */
/*                             Updated logic to support new table     */
/********************************************************************/
    
//    $fname = filter_input(INPUT_POST, 'fname');
//    $lname = filter_input(INPUT_POST, 'lname');
//    $email = filter_input(INPUT_POST, 'email');
//    /* echo "Fields: "   */
//    
    
    {
   try {
    include_once './database/database.php';
    $db = Database::getDB();
} catch (Exception $ex) {
    echo 'Connection error, please try again later ';
    exit();
}

    $action = filter_input(INPUT_POST, 'action');
    
    if ($action ==  NULL || $action == 'action'){
        
        $action = 'list_visitors';
    }

    //echo $action ;
      
    if ($action == 'delete_feedback') {
        $feedID = filter_input(INPUT_POST, 'feedID', FILTER_VALIDATE_INT);
        $query = 'DELETE FROM contacts
              WHERE feedID = :feedID';
        $statement = $db->prepare($query);
        $statement->bindValue(':feedID', $feedID);
        $success = $statement->execute();      
        $statement->closeCursor(); 
        $action = 'list_visitors';
    }
        
    if ($action == 'list_visitors'){
        // Read visitors 

        $query = 'SELECT * from contacts
                    ORDER BY fname';
        $statement = $db->prepare($query);
        $statement->execute();
        $contacts = $statement->fetchAll();
        $statement->closeCursor();
        /* echo "Fields: " . $fname . $email . $commBox; */
    }

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fall2018 Portfolio</title>
    <link href="B_Css/style4.css" rel="stylesheet" />
    <script src="js/port_formsubmit.js"></script>
</head>
<body>
<header>
        <h1>Happy Hound</h1>
        
        <figure>
        <img src="Images/paw_2_40.png" id="paw" alt=""/>&nbsp;&nbsp;<img src="Images/Happy pup 1.jpg" alt="Photo of Happy Dog" />&nbsp;&nbsp;<img src="Images/paw_2_40.png" id="paw" alt=""/>
        <figcaption>Meet Jimmy, our pet of the week!</figcaption>
        </figure>
        
        <h2>Activity Center</h2>
        <nav>
            <ul>
                <li><a href="B_Discrip.html">Main</a></li>
                <li><a href="B_Newsletter.html">Newsletter</a></li>
                <li><a href="B_Contact.html">Contact</a></li>
            </ul>
        </nav>
</header>
<section>
    <article>
  <h2>Administration Window</h2>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table>
      <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>E-Mail</th>
            <th>Message</th>
            <th>Employee Responsible</th>
            <th>Delete</th>
        </tr>
      <thead>
      <tbody>
        <?php foreach ($contacts as $contact) : ?>
            <tr>
                <td><?php echo $contact['fname']; ?></td>
                <td><?php echo $contact['lname']; ?></td>
                <td><?php echo $contact['email']; ?></td>
                <td><?php echo $contact['commBox']; ?></td>
                <td><?php echo $contact['employeeID']; ?></td>
                <td><form action="Admin.php" method="post">
                    <input type="hidden" name="action" value="delete_feedback">
                    <input type="hidden" name="feedID"
                           value="<?php echo $contact['feedID'] ; ?>">
                    <input type="submit" value="Delete">  
                </form></td>
            </tr>
            <?php endforeach; ?>
      </tbody>
    </table>
  <p>&nbsp;</p>
</section>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h1>&nbsp;</h1>
<h2>&nbsp;</h2>
</article>
</body>
</html>

