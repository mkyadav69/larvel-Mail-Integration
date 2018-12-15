<?php

namespace App\Jobs;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use App\Mail\ForgetPassword;

class ProcessEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $template;

    protected $email;

    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($template, $email, $data = [])
    {
        $this->template = $template;
        $this->email = $email;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        if ($this->template == 'forget_password_link') {
            \Mail::to($this->email)->send(new ForgetPassword($this->data));
        }
    }
}
