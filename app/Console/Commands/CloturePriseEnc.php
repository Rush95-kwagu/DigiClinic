<?php

namespace App\Console\Commands;

use App\Models\PriseEnc;
use Illuminate\Console\Command;

class CloturePriseEnc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'priseenc:cloture-auto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clôture automatique des prises en charge de plus de 2 semaines';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         $deuxSemainesAvant = now()->subWeeks(2);
        
        $count = PriseEnc::where('created_at', '<=', $deuxSemainesAvant)
                         ->where('status', 'en_cours')
                         ->update([
                             'status' => 'cloture_auto',
                             'date_cloture' => now()
                         ]);
                        
        $this->info("{$count} prises en charge ont été clôturées automatiquement.");
    
    }
}
