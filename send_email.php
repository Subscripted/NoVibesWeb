<?php
/* Set e-mail recipient */
$myemail  = "lor.els@gmx.de";

/* Functions we used */
function check_input($data, $problem='') {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0) {
        show_error($problem);
    }
    return $data;
}

function show_error($myError) {
?>
    <html>
    <body>
    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>
    </body>
    </html>
<?php
exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $name = check_input($_POST['name'], "Please enter your name.");
    $email = check_input($_POST['email'], "Please enter a valid email address.");
    $message = check_input($_POST['message'], "Please enter a message.");

    /* Validate email */
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        show_error("E-mail address not valid.");
    }

    /* Validate name and message to prevent header injection */
    if (preg_match("/[\r\n]/", $name) || preg_match("/[\r\n]/", $email)) {
        show_error("Header injection detected.");
    }

    /* Prepare the message for the e-mail */
    $subject = "Report From Novibes.de";
    $message_content = "Hello,\nThis is a report from the Novibes.de Bootstrap Template. Below is the information...\n\nName: $name\nE-mail: $email\n\nMessage: $message\n\nEnd of message";

    /* Send the message using mail() function */
    if (mail($myemail, $subject, $message_content)) {
        echo "<script>
        alert('Thanks, your report has been submitted.');
        window.location.href='index.html';
        </script>";
        exit();
    } else {
        show_error("Error sending email.");
    }
} else {
    show_error("Invalid form submission.");
}
?>

/*
*try mail method and configurate the Rootserver properly, if not so - try to use other get methods
*/
