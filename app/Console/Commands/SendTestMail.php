<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class SendTestMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'app:send-test-mail';
    protected $signature = 'mail:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Mail::raw('This is a test email from Laravel!', function ($msg) {
            $msg->to('test@example.com')->subject('Mailtrap Test');
        });

        $this->info('✅ Test email sent! Check Mailtrap inbox.');
    }
}
