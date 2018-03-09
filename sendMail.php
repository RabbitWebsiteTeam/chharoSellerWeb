<?php
# Include the Autoloader (see "Libraries" for install instructions)
//require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-7d3deaa48d95b3dddc881a7aa74dbf6c');
$domain = "sandboxb137558349f14b0c86820a7a95b9bc48.mailgun.org";

# Make the call to the client.
echo $result = $mgClient->sendMessage("$domain",
          array('from'    => 'Mailgun Sandbox <postmaster@sandboxb137558349f14b0c86820a7a95b9bc48.mailgun.org>',
                'to'      => 'RabbitDevelopers <rabbitdigitaldevelopers@gmail.com>',
                'subject' => 'Hello RabbitDevelopers',
                'text'    => 'Congratulations RabbitDevelopers, you just sent an email with Mailgun!  You are truly awesome! '));

# You can see a record of this email in your logs: https://app.mailgun.com/app/logs .

# You can send up to 300 emails/day from this sandbox server.
# Next, you should add your own domain so you can send 10,000 emails/month for free.