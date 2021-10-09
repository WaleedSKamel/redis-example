<?php

namespace App\Console\Commands;

use App\Jobs\SendSubscriptionExpiryMessageJob;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SubscriptionExpiryNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:SubscriptionExpiryNotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check which subscription customer has been expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $customers = Customer::query()->where('subscription_end_date', '<', Carbon::now()->format('Y-m-d'))
            ->get();
        foreach ($customers as $customer) {
            $expired_date = Carbon::createFromFormat('Y-m-d', $customer->subscription_end_date)
                ->toDateString();
            dispatch(new SendSubscriptionExpiryMessageJob($customer,$expired_date))
            ->onQueue('Waleed');

        }

    }
}
