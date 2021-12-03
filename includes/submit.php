<?php
require 'mail/send-mail.php';
require 'recaptcha/validate-recaptcha.php';

$wasAjaxSubmit = !empty($_POST['ajax']);

if (!validateRecaptcha()) {
    if ($wasAjaxSubmit) {
        die('recaptcha-error');
    }
    else {
        header("Location: ../error-recaptcha.html");
        exit;
    }
}

if (!sendMail()) {
    if ($wasAjaxSubmit) {
        die('error');
    }
    else {
        header("Location: ../error.html");
        exit;
    }
}
else {
    if ($wasAjaxSubmit) {
        die('success');
    }
    else {
        header("Location: ../success.html");
        exit;
    }
}