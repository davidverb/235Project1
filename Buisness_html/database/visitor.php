<?php
    function getVisitorByEmp($empID) {
        global $db;
        $query2 = 'SELECT * FROM contacts
                    WHERE employeeID = :employeeID
                    ORDER BY email';
        $statement2 = $db->prepare($query2);
        $statement2->bindValue(":employeeID", $employeeID);
        $statement2->execute();
        $visitors = $statement2;
        
        return $visitors;
    }
    
    function delVisitor($feedID) { 
        global $db;
        $query = 'DELETE FROM contacts
                  WHERE feedID = :feedID';
        $statement = $db->prepare($query);
        $statement->bindValue(':feedID', $feedID);
        $count = $statement->execute();
        $statement->closeCursor();
        /* echo "Fields: " . $visitor_name . $visitor_email . $visitor_msg; */

        if ($count > 0){
            return $visitor_id;
        } else {
            return 1;
        }
    }
    
    function addVisitor($fname,$lname, $email, $commBox){
        global $db;
        $query = 'INSERT INTO contacts
                     (fname, lname, email, employeeID)
                  VALUES
                     (:fname, :lname, :email, :commBox, 1)';
        $statement = $db->prepare($query);
        $statement->bindValue(':fname', $fname);
        $statement->bindValue(':lname', $lname);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':commBox', $commBox);
        $count = $statement->execute();
        $statement->closeCursor();
        /* echo "Fields: " . $visitor_name . $visitor_email . $visitor_msg; */

        if ($count == 1){
            return $visitor_name;
        } else {
            return 1;
        }
    }
?>