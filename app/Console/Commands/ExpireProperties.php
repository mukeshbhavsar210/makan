<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Property;
use Carbon\Carbon;

class ExpireProperties extends Command {
    protected $signature = 'properties:expire';
    protected $description = 'Set status = 0 for expired properties based on plan duration';

    public function handle() {
        $today = Carbon::today();

        // Update status = 0 for expired properties
        // $expired = Property::where('status', 1)
        //     ->whereHas('plan', function($q) {
        //         $q->select('id', 'duration'); // duration in days
        //     })
        //     ->whereRaw('DATE_ADD(start_date, INTERVAL plans.duration DAY) <= ?', [$today])
        //     ->update(['status' => 0]);


        // Update properties where end_date is passed
        $expired = Property::where('verification', 'approved')
            ->whereNotNull('end_date')
            ->where('end_date', '<', $today)
            ->update(['verification' => 'expired']);

        $this->info("Expired properties: $expired");
    }
}
