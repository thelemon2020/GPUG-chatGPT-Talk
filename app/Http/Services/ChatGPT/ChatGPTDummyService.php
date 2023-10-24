<?php

namespace App\Http\Services\ChatGPT;

use App\Interfaces\ChatGPTServiceInterface;
use Illuminate\Http\Request;

class ChatGPTDummyService implements ChatGPTServiceInterface
{
    public function askChatGPT(Request $request): string
    {
        return "Test";
    }
}
