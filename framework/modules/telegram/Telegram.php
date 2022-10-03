<?php

namespace modules\telegram;

use GuzzleHttp\{
    Client,
    Exception\GuzzleException,
    Psr7
};

# Bot name: https://t.me/ISPP2PBOT
class Telegram {

    # URL TG
    const API         = 'https://api.telegram.org/bot';

    # Bot ID
    protected $bot_id;


    public function setBot($bot_id)
    {
        $this->bot_id = $bot_id;

        return $this;
    }

    private function send(string $method, array $params)
    {
        $client = new Client();

        try {
            $response = $client->post(
                self::API . $this->bot_id . '/' . $method, [
                    'form_params' => $params
                ]
            );

            if ($response->getStatusCode() != 200) {
                return null;
            }

            $result = json_decode($response->getBody()->getContents(), TRUE);

            return ($result['ok'] ?? false) === true;

        } catch (GuzzleException $e) {

            return false;
        }
    }

    protected function textMessage(int $chat_id, string $text)
    {
        $params = [
            'chat_id' => $chat_id,
            'text'    => $text
        ];

        return $this->send('sendMessage', $params);
    }

    protected function imageMessage(int $chat_id, string $text, string $image)
    {
        $params = [
            'chat_id' => $chat_id,
            'caption' => $text,
            'photo'   => $image
        ];

        return $this->send('sendPhoto', $params);
    }
}
