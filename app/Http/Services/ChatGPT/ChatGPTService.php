<?php

namespace App\Http\Services\ChatGPT;

use App\Interfaces\ChatGPTServiceInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class ChatGPTService implements ChatGPTServiceInterface
{
    private ChatGPTClient $client;

    public function __construct(ChatGPTClient $client)
    {
        $this->client = $client;
    }

    public function askChatGPT(Request $request): string
    {
        $prompt = $request->prompt;
        $temperature = $request->temp;
        $response = $this->parseResponse($this->client->sendToChatGPT($prompt, $temperature));
        return $response;
    }

    private function parseResponse(Response $response): string
    {
        return json_decode($response->body())->choices[0]->message->content;
    }
}
