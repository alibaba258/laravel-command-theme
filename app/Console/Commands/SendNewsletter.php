<?php

namespace App\Console\Commands;

use App\Mail\NewsletterMail;
use Illuminate\Console\Command;
use Hexadog\ThemesManager\Facades\ThemesManager;
use Mail;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends Notifications about Orders';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = [
            [
                'id' => 'HS-B-001',
                'company' => [
                    'theme' => 'hls/sauerland',
                    'name' => 'Sauerland'
                ]
            ],
            [
                'id' => 'HN-B-001',
                'company' => [
                    'theme' => 'hls/heimatladen',
                    'name' => 'Heimatladen'
                ]
            ],
        ];


        foreach($orders as $order){
            ThemesManager::set($order['company']['theme']);
            dump($order['id'] . '/' . ThemesManager::current());
            Mail::to('hello@example.org')->send(new NewsletterMail($order));
        }


    }
}
