<%--    NewsLetter Webpage
        Author: David Verbeck
        Updated: 11-6-19         
        Converted .php website to .aspx
--%>

<%@ Page Language="C#" %>
<%@ Import Namespace="System.Data.SqlClient" %>

<!DOCTYPE html>
<script runat="server">
            protected void btnSend_Click(object sender, EventArgs e)
            {
                if (Page.IsValid)
                {
                    // Code that uses the data entered by the user
                    // Define data objects
                    SqlConnection conn;
                    SqlCommand comm;
                    // Read the connection string from Web.config
                    string connectionString =
                        ConfigurationManager.ConnectionStrings[
                        "dave_buisnessdb"].ConnectionString;
                    // Initialize connection
                    conn = new SqlConnection(connectionString);
                    // Create command 
                    comm = new SqlCommand("EXEC InsertNewsletter @fnameTextBox,@lnameTextBox, @emailTextBox", conn);
                    comm.Parameters.Add("@fnameTextBox", System.Data.SqlDbType.NChar, 50);
                    comm.Parameters["@fnameTextBox"].Value = fname.Text;
                    comm.Parameters.Add("@lnameTextBox", System.Data.SqlDbType.NChar, 50);
                    comm.Parameters["@lnameTextBox"].Value = lname.Text;
                    comm.Parameters.Add("@emailTextBox", System.Data.SqlDbType.NChar, 50);
                    comm.Parameters["@emailTextBox"].Value = email.Text;
                    Session["fname"] = fname.Text;
                    Session["lname"] = lname.Text;

                    // Enclose database code in Try-Catch-Finally
                    try
                    {
                        // Open the connection
                        conn.Open();
                        // Execute the command
                        comm.ExecuteNonQuery();
                        // Reload page if the query executed successfully
                        Response.Redirect("Newsletter_confirm.html");
                    }
                    catch (SqlException ex)
                    {
                        // Display error message
                        dbErrorMessage.Text =
                           "Error submitting the data!" + ex.Message.ToString();

                    }
                    finally
                    {
                        // Close the connection
                        conn.Close();
                    }
                }
            }
</script>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server" >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fall2018 Portfolio</title>
    <link href="B_Css/style3.css" rel="stylesheet" />
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
                <li><a href="B_Contact.aspx">Contact</a></li>
                <li><a href="Adminlogin.php">Admin</a></li>
            </ul>
        </nav>
</header>
<section>
    <article>
        <p><Strong>Sign up for our weekly newsletter from Happy Hound!</strong></p>
        
        <form id="form1" runat="server">
            <div>
                <label for="fname">First Name: </label>
                <asp:textbox id="fname" type="text" runat="server"/>
            &nbsp;&nbsp;
                <asp:RequiredFieldValidator ID="RequiredFieldValidator1" runat="server" ControlToValidate="fname"
                    CssClass="text-danger">Required</asp:RequiredFieldValidator>
            </div>
            <br>
            <div>
                <label for="lname">Last Name: </label>
                <asp:textbox id="lname" type="text" runat="server" />
            &nbsp;&nbsp;&nbsp;
                <asp:RequiredFieldValidator ID="RequiredFieldValidator2" runat="server" ControlToValidate="lname"
                   CssClass="text-danger" >Required</asp:RequiredFieldValidator>
            </div>
        <br>
            <div>
                <label for="email">E-Mail: </label>
               <asp:textbox ID="email" type="email" runat="server" />
            &nbsp;&nbsp;&nbsp;
                <asp:RequiredFieldValidator ID="RequiredFieldValidator3" runat="server" ControlToValidate="email"
                    CssClass="text-danger">Required</asp:RequiredFieldValidator>
            </div>
            <br>
            
                &nbsp;<asp:Button ID="btnSend" runat="server" OnClick="btnSend_Click" Text="Send" />

        &nbsp;
            <br />
            <br />
&nbsp;<asp:Label ID="dbErrorMessage" runat="server"></asp:Label>

        </form>
    </article>
</section>
<footer>
        <p>To email us,&nbsp;<a href="mail:davidverb2@gmail.com">Click Here</a></p>
</footer>
</body>
</html>