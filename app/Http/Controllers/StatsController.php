<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Owner;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        $owner = Owner::where('slug', $request->slug)->first();

        $orders_year = Order::whereYear('created_at', now()->format('Y'))->get();
        $orders_month = Order::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'))->get();
        $orders_day = Order::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->format('m'))->whereDay('created_at', now()->format('d'))->get();
        $orders_fifteen = Order::whereYear('created_at', now()->format('Y'))->whereBetween('created_at', [now()->subDay(15)->format('d'), now()->format('d')])->get();
        $orders_last_month = Order::whereYear('created_at', now()->format('Y'))->whereMonth('created_at', now()->subMonth(1)->format('m'))->get();

        $orders_items_month_bd = OrderDetail::whereYear('created_at', now()->format('Y'))
            ->whereMonth('created_at', now()->format('m'))

            ->get()->groupBy('item_id');

        $orders_items_month = [0];
        $orders_items_month_label = [];

        foreach($orders_items_month_bd as $item => $oim){
            if(Item::find($item)){
                $orders_items_month[] =
                    // $oim->item->name,
                    $oim->sum('quantity');
                $orders_items_month_label[] =
                    Item::find($item)->name;
            }
        }

        $orders_items_day_bd = OrderDetail::whereYear('created_at', now()->format('Y'))
            ->whereMonth('created_at', now()->format('m'))
            ->whereDay('created_at', now()->format('d'))

            ->get()->groupBy('item_id');
        $orders_items_day = [0];
        $orders_items_day_label = [];

        foreach ($orders_items_day_bd as $item => $oid) {
            if (Item::find($item)) {
                $orders_items_day[] =
                    // $oid->item->name,
                    $oid->sum('quantity');
                $orders_items_day_label[] =
                    Item::find($item)->name;
            }
        }

        $orders_items_fifteen = OrderDetail::whereYear('created_at', now()->format('Y'))->whereBetween('created_at', [now()->subDay(15)->format('d'), now()->format('d')])->get();

        return view('stats.index', compact('orders_year', 'orders_month', 'orders_day', 'owner', 'orders_fifteen', 'orders_last_month',
            'orders_items_month', 'orders_items_day', 'orders_items_fifteen', 'orders_items_day_label',
            'orders_items_month_label'));
    }
}
