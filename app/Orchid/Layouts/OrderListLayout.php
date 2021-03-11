<?php

namespace App\Orchid\Layouts;

use App\Models\Order;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OrderListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'orders';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'Код'),

            TD::make('invoice_id', 'Операция')
                ->render(function (Order $order) {
                    return Link::make('Перейти')
                        ->route('platform.order.edit', $order);
                }),

            TD::make('username', 'Заказчик'),
            TD::make('delivery_type', 'Доставка'),
            TD::make('created_at', 'Создан'),
        ];
    }
}
