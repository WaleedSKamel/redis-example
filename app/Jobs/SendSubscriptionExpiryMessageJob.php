<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSubscriptionExpiryMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $customer;
    private $expire_date;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($customer, $expire_date)
    {
        $this->customer = $customer;
        $this->expire_date = $expire_date;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Todo send email for each expire user
        //info('running job');
        //dd($this->customer->toArray());
        sendmail('emails.subscription_expiration', $this->customer->email, 'Expiration Subscription', ['data' => $this->customer]);

    }
}
