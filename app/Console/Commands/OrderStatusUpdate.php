<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;

class OrderStatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:statusUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update expired order status';

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
        Order::where('status_id', 1)
            ->where('expiration_time', '<=', now())
            ->update(['status_id' => 4]);
        // info("something");
        return 0;
    }
}
