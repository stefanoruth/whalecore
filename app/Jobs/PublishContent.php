<?php

namespace App\Jobs;

use App\Content;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class PublishContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $content;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->content->load('project', 'item.template');

        if (is_null($this->content->project->api_key)) {
            throw new Exception('Project is missing apikey');
        }

        Redis::set(config('cache.prefix').':'.$this->key(), json_encode($this->content->body));
    }

    public function key()
    {
        return sprintf(
            'content.%s.%s.%s',
            $this->content->project->api_key,
            $this->content->item->slug,
            $this->content->language_code
        );
    }
}
