<?php

namespace Eitaayar;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class Eitaayar
{
    private const EITAAYAR_BASE_URL = "https://eitaayar.ir/api/";
    /**
     * Get information about the bot.
     *
     * @return array the bot's information
     * @throws RequestException|GuzzleException if an error occurs while making the API request
     */
    public static function getMe(): array
    {
        $url = self::EITAAYAR_BASE_URL . env("EITAAYAR_TOKEN") . "/getMe";
        $client = new Client();
        try {
            $response = $client->get($url);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            throw new \RuntimeException('Error getting bot information: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Send a text message to a chat.
     *
     * @param int|string $chat_id the chat ID to send the message to
     * @param string $text the text of the message
     * @param string $title optional title for the message
     * @param bool $notification_disable whether to disable notifications for the message
     * @param int|string $id_message_to_reply optional ID of the message to reply to
     * @param int $date optional timestamp for the message (in seconds since the Unix epoch)
     * @param bool $pin whether to pin the message in the chat
     * @param int $viewCountForDelete optional number of views after which the message should be deleted
     *
     * @return array the message that was sent
     * @throws RequestException if an error occurs while making the API request
     */
    public static function sendMessage(
        string|int $chat_id,
        string $text,
        string $title = "",
        bool   $notification_disable = false,
        int|string $id_message_to_reply = "",
        int    $date = 0,
        bool   $pin = false,
        int    $viewCountForDelete = 0
    ): array
    {
        $url = self::EITAAYAR_BASE_URL . env("EITAAYAR_TOKEN") . "/sendMessage";
        $client = new Client();
        $data = array(
            "chat_id" => $chat_id,
            "text" => $text,
            "title" => $title,
            "notification_disable" => $notification_disable,
            "id_message_to_reply" => $id_message_to_reply,
            "date" => $date,
            "pin" => $pin,
            "viewCountForDelete" => $viewCountForDelete
        );
        $options = array(
            "headers" => array("Content-type" => "application/json"),
            "json" => $data
        );
        try {
            $response = $client->post($url, $options);
            return json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            throw new \InvalidArgumentException('Invalid argument passed to sendMessage: ' . $e->getMessage(), 0, $e);
        } catch (GuzzleException $e) {
            throw new \RuntimeException('Error sending message: ' . $e->getMessage(), 0, $e);
        }
    }
    /**
     * Send a document to a chat.
     *
     * @param int|string $chat_id the chat ID to send the document to
     * @param string $document_path the local path to the document to send
     * @param string $caption optional caption for the document
     * @param bool $notification_disable whether to disable notifications for the message
     * @param int|string $id_message_to_reply optional ID of the message to reply to
     * @param int $date optional timestamp for the message (in seconds since the Unix epoch)
     * @param bool $pin whether to pin the message in the chat
     *
     * @return array the message that was sent
     *@throws RequestException if an error occurs while making the API request
     */
    public static function sendDocument(
        int|string $chat_id,
        string     $document_path,
        string     $caption = "",
        bool       $notification_disable = false,
        int|string $id_message_to_reply = "",
        int        $date = 0,
        bool $pin = false
    ): array {
        $url = self::EITAAYAR_BASE_URL . env("EITAAYAR_TOKEN") . "/sendDocument";
        $client = new Client();
        $data = array(
            "chat_id" => $chat_id,
            "file" => new \CURLFile(realpath($document_path)),
            "caption" => $caption,
            "notification_disable" => $notification_disable,
            "id_message_to_reply" => $id_message_to_reply,
            "date" => $date,
            "pin" => $pin
        );
        $options = array(
            "headers" => array("Content-type" => "multipart/form-data"),
            "multipart" => $data
        );
        try {
            $response = $client->post($url, $options);
            return json_decode($response->getBody(), true);
        } catch (ClientException $e) {
            throw new \InvalidArgumentException('Invalid argument passed to sendDocument: ' . $e->getMessage(), 0, $e);
        } catch (GuzzleException $e) {
            throw new \RuntimeException('Error sending document: ' . $e->getMessage(), 0, $e);
        }
    }
}
