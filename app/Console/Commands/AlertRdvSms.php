<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FasterMessageService;

class AlertRdvSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dc:alert-rdv-sms';

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
        $fs= new FasterMessageService();
        $result=$fs->sendSMS("0194312721","Bonjour M. David GNONLONFOU, n'oubliez pas votre rdv avec le centre demain matin à 12h.");

        info($result);
    }
}
