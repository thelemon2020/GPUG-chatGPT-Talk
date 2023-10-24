<?php

namespace App\Http\Controllers\ChatGPT;

use App\Http\Controllers\Controller;
use App\Interfaces\ChatGPTServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Ask extends Controller
{
    private ChatGPTServiceInterface $chatGPTService;
    public function __construct(ChatGPTServiceInterface $chatGPTService)
    {
        $this->chatGPTService = $chatGPTService;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $chatGptResponse = $this->chatGPTService->askChatGPT($request);

        return new JsonResponse([
            'message' => $chatGptResponse
        ]);
    }
}
