<?php
/* Set e-mail recipient */
$myemail  = "novibesde@gmail.com";

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

    /* Prepare the message for the e-mail */
    $subject = "Report From OlympiaMC";
    $message_content = "Hello,
    This is a report from the OlympiaMC Bootstrap Template. Below is the information...

    Name: $name
    E-mail: $email

    Message: $message

    End of message
    ";

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
