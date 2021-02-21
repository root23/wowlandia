<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use App\Orchid\Layouts\OrderListLayout;
use Orchid\Screen\Screen;

class OrderListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Заказы';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Список заказов';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'orders' => Order::paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            OrderListLayout::class
        ];
    }
}
