<?php

namespace App\Jobs;

use App\Events\gotMessage;
use App\Models\Chat;
use App\Models\UserChatUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class sendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Chat $chat, public UserChatUser $uc)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        gotMessage::dispatch([
            'user_chat_id' => $this->uc->id,
            'to_id' => $this->uc->to_id,
            'from_id' => $this->uc->from_id,
            'created_at' => $this->uc->created_at,
            'chat_id' => $this->chat->id,
            'body' => $this->chat->body,
        ]);


    }
}
