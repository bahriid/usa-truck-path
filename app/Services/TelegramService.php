<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected $botToken;
    protected $baseUrl;

    public function __construct()
    {
        $this->botToken = env('TELEGRAM_BOT_TOKEN');
        $this->baseUrl = "https://api.telegram.org/bot{$this->botToken}";
    }

    /**
     * Create a chat invite link with usage limit
     *
     * @param string $chatId The Telegram chat/group ID (e.g., -1001234567890)
     * @param int $memberLimit Maximum number of users that can use this link (1 for one-time)
     * @param int $expireTime Link expiration in seconds from now (optional)
     * @param string $name Name/description for the invite link (optional)
     * @return array|null Returns array with 'invite_link' or null on failure
     */
    public function createChatInviteLink($chatId, $memberLimit = 1, $expireTime = null, $name = null)
    {
        try {
            $params = [
                'chat_id' => $chatId,
                'member_limit' => $memberLimit,
            ];

            if ($expireTime) {
                $params['expire_date'] = time() + $expireTime;
            }

            if ($name) {
                $params['name'] = $name;
            }

            $response = Http::post("{$this->baseUrl}/createChatInviteLink", $params);

            if ($response->successful() && $response->json('ok')) {
                return $response->json('result');
            }

            Log::error('Telegram API Error: '.$response->body());

            return null;
        } catch (\Exception $e) {
            Log::error('Telegram Service Error: '.$e->getMessage());

            return null;
        }
    }

    /**
     * Revoke a chat invite link
     *
     * @param string $chatId The Telegram chat/group ID
     * @param string $inviteLink The invite link to revoke
     * @return bool
     */
    public function revokeChatInviteLink($chatId, $inviteLink)
    {
        try {
            $response = Http::post("{$this->baseUrl}/revokeChatInviteLink", [
                'chat_id' => $chatId,
                'invite_link' => $inviteLink,
            ]);

            return $response->successful() && $response->json('ok');
        } catch (\Exception $e) {
            Log::error('Telegram Revoke Error: '.$e->getMessage());

            return false;
        }
    }

    /**
     * Get chat information
     *
     * @param string $chatId
     * @return array|null
     */
    public function getChat($chatId)
    {
        try {
            $response = Http::get("{$this->baseUrl}/getChat", [
                'chat_id' => $chatId,
            ]);

            if ($response->successful() && $response->json('ok')) {
                return $response->json('result');
            }

            return null;
        } catch (\Exception $e) {
            Log::error('Telegram Get Chat Error: '.$e->getMessage());

            return null;
        }
    }
}
