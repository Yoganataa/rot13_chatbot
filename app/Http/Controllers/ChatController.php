<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ChatController extends Controller
{
    public function index()
    {
        $messages = Message::all();

        // pic
        $userProfilePicUrl = 'https://imgx.sonora.id/crop/0x0:0x0/700x465/filters:format(webp):quality(50)/photo/2024/07/09/maxwelljpg-20240709044042.jpg';
        $botProfilePicUrl = 'https://assets.pikiran-rakyat.com/crop/296x142:830x604/703x0/webp/photo/2024/07/04/1382596661.png';

        return view('chat', compact('messages', 'userProfilePicUrl', 'botProfilePicUrl'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // ori msg
        $message = new Message();
        $message->sender = 'user';
        $message->message = $request->message;
        $message->save();

        // rp
        $botMessage = $this->generateBotResponse($request->message);

        // sv
        $botResponse = new Message();
        $botResponse->sender = 'bot';
        $botResponse->message = $botMessage;
        $botResponse->save();

        return redirect()->route('chat.index');
    }

    public static function encryptROT13($text)
    {
        return strtr($text,
            'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz',
            'NOPQRSTUVWXYZABCDEFGHIJKLMnopqrstuvwxyzabcdefghijklm'
        );
    }

    private function generateBotResponse($message)
    {
        if (strtolower($message) == 'samlekom' || strtolower($message) == 'tulong') {
            return 'Yok opo gess!';
        }
        return "Pengen ngopo kon tak ewangi kene!";
    }
}
