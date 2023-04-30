Eitaayar API Client
================

This PHP package provides a simple way to interact with the Eitaayar API for sending messages and documents to Telegram chats.

Installation
------------

To install this package, you can use Composer:

    composer require usermp/eitaayar

Usage
-----
To use this package, you need to have an [Eitaayar](https://eitaayar.ir/) API token.


Sending a message
-----------------
To send a text message to a chat, you can use the sendMessage() method. Here's an example:

    use Usermp\Eitaayar\Eitaayar;

    // Send a message to the chat with ID 12345678
    $message = Eitaayar::sendMessage(12345678, "Hello, world!");

The sendMessage() method returns an array with information about the message that was sent.

Sending a document
------------------
To send a document to a chat, you can use the sendDocument() method. Here's an example:

    use Usermp\Eitaayar\Eitaayar;

    // Send a document to the chat with ID 12345678
    $message = Eitaayar::sendDocument(12345678, "/path/to/document.pdf");

The sendDocument() method returns an array with information about the message that was sent.

License
-------
Eitaayar API Client is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
