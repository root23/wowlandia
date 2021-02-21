<?php

namespace App\Orchid\Screens;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Repository;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\Button;
use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;

class OrderEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Новый заказ';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Заказы';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Order $order): array
    {
        $this->exists = $order->exists;

        if ($this->exists) {
            $this->name = 'Редактирование заказа';

            $cart = null;
            $cartArray = [];
            if ($order->shopping_cart_id) {
                $cart = Cart::restore($order->shopping_cart_id)->content();
                foreach ($cart as $cartItem) {
                    if ($cartItem->options['sale_price']) {
                        $price = $cartItem->options['sale_price'];
                    } else {
                        $price = $cartItem->price;
                    }
                    array_push($cartArray, new Repository([
                        'id' => $cartItem->id,
                        'name' => $cartItem->name,
                        'price' => $price,
                        'quantity' => $cartItem->quantity,
                        ]));
                }
            }
        }

        return [
            'order' => $order,
            'cart' => $cartArray,
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Обновить')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('order.id')
                    ->title('ID')
                    ->disabled(),

                Input::make('order.invoice_id')
                    ->title('Код операции')
                    ->disabled(),

                Input::make('order.amount')
                    ->title('Стоимость')
                    ->disabled(),

                CheckBox::make('order.is_paid')
                    ->value(0)
                    ->disabled()
                    ->title('Оплачено')
                    ->placeholder('Оплачено'),

                Input::make('order.shopping_cart_id')
                    ->title('Корзина')
                    ->disabled(),

                TextArea::make('order.description')
                ->rows(3)
                ->max(255)
                ->title('Описание')
                ->placeholder('Введите описание заказа')
                ->help('Текст описания заказа (для заметок)'),
            ]),
            Layout::table('cart', [
                TD::make('id', 'id'),
                TD::make('name', 'Наименование'),
                TD::make('quantity', 'Количество'),
                TD::make('price', 'Цена'),
            ])
        ];
    }

    public function createOrUpdate(Order $order, Request $request): \Illuminate\Http\RedirectResponse
    {
        $order->fill($request->get('order'))->save();
        Alert::info('Новый заказ добавлен');

        return redirect()->route('platform.orders.list');
    }

    public function remove(Order $order): \Illuminate\Http\RedirectResponse
    {
        $order->delete();
        Alert::info('Заказ был успешно удален.');

        return redirect()->route('platform.orders.list');
    }

}
