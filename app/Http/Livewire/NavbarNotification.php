<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class NavbarNotification extends Component
{
    public function render()
    {
        return view('livewire.navbar-notification', [
            'expiredOrders' => $this->expiredOrders,
            'ordersToClaim' => $this->ordersToClaim,
            'pendingOrders' => $this->pendingOrders,
            'notificationTotal' => $this->notificationTotal,
        ]);
    }

    public function getExpiredOrdersProperty()
    {
        return Order::where('status_id', 4)
            ->count();
    }

    public function getOrdersToClaimProperty()
    {
        return Order::where('status_id', 2)->count();
    }

    public function getPendingOrdersProperty()
    {
        return Order::where('status_id', 1)->count();
    }

    public function getNotificationTotalProperty()
    {
        return $this->ordersToClaim + $this->expiredOrders + $this->PendingOrders;
    }
}
