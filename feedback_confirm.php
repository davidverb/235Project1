<?php
    
    $fname = filter_input(INPUT_POST, 'fname');
    $lname = filter_input(INPUT_POST, 'lname');
    $commBox = filter_input(INPUT_POST, 'commBox');
    $email = filter_input(INPUT_POST, 'email');
    /* echo "Fields: "   */
    
    // Validate inputs
    if ($fname == null || $lname == null ||
        $commBox == null || $email == null) {
        $error = "Invalid input data. Check all fields and try again.";
        /* */
        echo "Form Data Error: " . $error; 
        exit();
        } else {
            $dsn = 'mysql:host=localhost;dbname=davecontactdb';
            $username = 'root';
            $password = 'Pa$$w0rd';

            try {
                $db = new PDO($dsn, $username, $password);

            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                /* include('database_error.php'); */
                echo "DB Error: " . $error_message; 
                exit();
            }

            // Add the product to the database  
            $query = 'INSERT INTO feedback
                         (fname, lname, email, commBox)
                      VALUES
                         (:fname, :lname, :email, :commBox)';
            $statement = $db->prepare($query);
            $statement->bindValue(':fname', $fname);
            $statement->bindValue(':lname', $lname);
            $statement->bindValue(':commBox', $commBox);
            $statement->bindValue(':email', $email);
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
    <title>Fall2014 Portfolio</title>
    <link href="Css/Styles1.css" rel="stylesheet" />
    <link href="Css/forms.css" rel="stylesheet" />
</head>
<body>
    <aside>
      <div class="siteSidebar">
          <div class="photo">
            <img src="Images/Photo1.png" alt="Self-Photo">
          </div>
          <div class="">
            <h1>David Verbeck</h1>
          </div>

        <nav class="siteNav">
                        
            <a href="https://www.linkedin.com/" ><img src="Images/linkedinIcon.png" alt="Linkedin" /></a>

            <a href="https://github.com/" ><img src="Images/GithubIcon.png" alt="Github" /></a>

          <div class="siteNav">
            <ul>
                <li><a href="Index.html">Home</a>&nbsp;</li>
                <li><a href="About.html">About</a>&nbsp;</li>
                <li><a href="Hist.html">Experience</a>&nbsp;</li>
                <li><a href="Contact.html">Contact Me</a>&nbsp;</li>
                <li><a href="Feedback.html">Feedback</a></li>
				<li><a href="Buisness_html/B_Discrip.html">Buisness Project</a></li>
            </ul>
          </div>
        </nav>      
    </div>        
    </aside>
    <article>
  <h2>Thank you, <?php echo $fname; ?> <?php echo $lname; ?>, for your time for sending a feedback form.</h2>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h1>&nbsp;</h1>
<h2>&nbsp;</h2>
</article>
</body>
</html>
