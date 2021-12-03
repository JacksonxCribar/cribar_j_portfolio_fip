<?php
/**
 * Generates and sends an email from the submitted form values.
 * Returns true on success or false on failure.
 */
function sendMail()
{
    $firstname   = $_POST['firstname'];
    $lastname    = $_POST['lastname'];
    $emailSender = $_POST['email'];
    $topic       = $_POST['topic'];
    $inquiry     = $_POST['inquiry'];

    switch ($topic) {
        default:
        case 'general':
            $emailRecipient = 'general@site.com';
            $subject        = 'General Inquiry';
            break;
        case 'sales':
            $emailRecipient = 'sales@site.com';
            $subject        = 'Sales Inquiry';
            break;
        case 'support':
            $emailRecipient = 'support@site.com';
            $subject        = 'Support Inquiry';
            break;
    }

    $subject .= " from $firstname $lastname";

    $emailHeaders = [
        'From' => $emailSender,
    ];

    return mail(
        $emailRecipient,
        $subject,
        wordwrap($inquiry, 70),
        $emailHeaders
    );