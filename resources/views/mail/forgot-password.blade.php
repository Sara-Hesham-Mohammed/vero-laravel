<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Email Verification Code</title>
    <meta name="description" content="reset password.">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>

<?php
    $reset_link = 'http://localhost:5173/reset-password?token=' . urlencode($data['token']);
?>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <a href="<?php echo $reset_link ?>" target="_blank" style="text-decoration: none; ">
        Reset password
    </a>
</body>

</html>