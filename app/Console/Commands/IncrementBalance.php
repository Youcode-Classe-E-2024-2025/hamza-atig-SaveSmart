<?php

namespace App\Console\Commands;

use App\Models\Balence;
use DB;
use Illuminate\Console\Command;

class IncrementBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'balance:increment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increment user balance by here monthly income every month';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $balences = Balence::all();
        foreach($balences as $balence){
            $balence->update([
                'balance' => $balence->balance + $balence->Montly_income
            ]);
            $balence->save();
        }
        
     
        
    }
}
