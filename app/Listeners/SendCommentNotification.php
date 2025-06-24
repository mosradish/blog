<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use Illuminate\Support\Facades\Mail;

namespace App\Listeners;

use App\Events\CommentPosted;
use Illuminate\Support\Facades\Http;

class SendCommentNotification
{
    public function handle(CommentPosted $event): void
    {
        $comment = $event->comment;
        $post = $comment->post;

        // Lambda の公開 HTTP エンドポイント
        $lambdaUrl = config('services.lambda.comment_notify_url');

        $payload = [
            'post_title' => $post->title,
            'comment_content' => $comment->body,
            'author_email' => $post->user?->email,
            'commenter_email' => $comment->user?->email,
        ];

        try {
            Http::post($lambdaUrl, $payload);
        } catch (\Exception $e) {
            \Log::error('Lambda 通知エラー: ' . $e->getMessage());
        }
    }
}