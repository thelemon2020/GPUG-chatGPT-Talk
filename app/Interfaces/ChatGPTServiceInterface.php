<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ChatGPTServiceInterface
{
    public function askChatGPT(Request $request): string;
}
