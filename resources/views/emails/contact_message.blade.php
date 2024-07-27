<!-- resources/views/emails/contact_message.blade.php -->

<!DOCTYPE html>
<html>

<head>
    <title>New Contact Message</title>
</head>

<body>
    <h1>New Contact Message</h1>
    <p><strong>First Name:</strong> {{ $contactMessage->first_name }}</p>
    <p><strong>Last Name:</strong> {{ $contactMessage->last_name }}</p>
    <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
    <p><strong>Message:</strong> {{ $contactMessage->message }}</p>
</body>

</html>
