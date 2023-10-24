<?php

namespace App\Http\Services\ChatGPT;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ChatGPTClient
{
    public function sendToChatGPT(array $prompts, float $temperature): Response
    {
        $payload = $this->generatePayload($prompts, $temperature);
        return Http::withToken(config('services.chatGPT.token'))->asJson()
            ->post('https://api.openai.com/v1/chat/completions', $payload);
    }

    private function generatePayload(array $prompts, float $temperature): array
    {
        return [
            'model'       => config('services.chatGPT.model'),
            'messages'    => $prompts,
            'temperature' => $temperature,
        ];
    }
}
