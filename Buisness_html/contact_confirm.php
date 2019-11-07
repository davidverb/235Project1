<?php
    
/*  Date	Name	Description                                 */
/*  --------------------------------------------------------------- */
/*                                                                  */
/*  9/8/2019  David Verbeck   Adds data to database on submit.      */
/*                            Tells users thank you.                */
/********************************************************************/

    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');
    $email = filter_input(INPUT_POST, 'email');
    $commBox = filter_input(INPUT_POST, 'commBox');
    /* echo "Fields: "   */
    
    // Validate inputs
    if ($fname == null || $lname == null ||
        $email == null || $commBox == null) {
        $error = "Invalid input data. Check all fields and try again.";
        echo "Form Data Error: " . $error; 
        exit();
        } else {

            include "database/database.php";
            include "database/visitor.php";
            $db = Database::getDB();
            if (!is_object($db)){
                $message = "We are experiencing technical difficulties. Please check back later.";
            } else {
                $visitor_name = addVisitor($fname, $lname, $email, $commBox);
                if ($visitor_name == 0) {
                    $message = "Unable to add to database. Please check back later.";
                } else{
                    $message = "Thank you, $fname  $lname, for contacting me! I will get back to you shortly.";
                }
            }

//             Add the product to the database  
            $query = 'INSERT INTO contacts
                         (fname, lname, email, commBox)
                      VALUES
                         (:fname, :lname, :email, :commBox)';
            $statement = $db->prepare($query);
            $statement->bindValue(':fname', $fname);
            $statement->bindValue(':lname', $lname);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':commBox', $commBox);
            $statement->execute();
            $statement->closeCursor();
            /* echo "Fields: " */

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fall2018 Portfolio</title>
    <link href="B_Css/style3.css" rel="stylesheet" />
    <link href="B_Css/form.css" rel="stylesheet" />
    <script src="js/port_formsubmit.js"></script>
</head>
<body>
<header>
    <h1>Happy Hound</h1>
    <img src="Images/paw_2_40.png" id="paw" alt=""/>&nbsp;&nbsp;<img src="Images/Happy pup 1.jpg" alt="Photo of Happy Dog" />&nbsp;&nbsp;<img src="Images/paw_2_40.png" id="paw" alt=""/>
    <h2>Activity Center</h2>
        <nav>
            <ul>
                <li><a href="B_Discrip.html">Main</a></li>
                <li><a href="B_Newsletter.html">Newsletter</a></li>
                <li><a href="Adminlogin.php">Admin</a></li>
            </ul>
        </nav>
</header>
<section>
    <article>
  <h2><?php echo $message; ?></h2>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
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
