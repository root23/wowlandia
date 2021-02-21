<?php

namespace App\Orchid\Screens;

use App\Models\Product;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;

class ProductEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Товары';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Редактирование товара';

    public $exists = false;

    /**
     * Query data.
     *
     * @param Product $product
     * @return array
     */
    public function query(Product $product): array
    {
        $this->exists = $product->exists;

        if ($this->exists) {
            $this->name = 'Редактирование товара';
        }

        $product->load('attachment');

        return [
            'product' => $product,
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
            Button::make('Сохранить')
            ->icon('pencil')
            ->method('createOrUpdate')
            ->canSee(!$this->exists),

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
                Input::make('product.title')
                    ->title('Title')
                    ->placeholder('Введите название товара')
                    ->help('Название товара'),

                Cropper::make('product.cover_image')
                    ->title('Изображение')
                    ->targetRelativeUrl()
                    ->width(750)
                    ->height(250),

                Input::make('product.tag')
                    ->title('Тег')
                    ->placeholder('Введите тег товара')
                    ->help('Тег товара'),

                Group::make([
                    Input::make('product.delivery_width')
                        ->title('Ширина (доставка)')
                        ->help('Ширина товара при доставке'),

                    Input::make('product.delivery_height')
                        ->title('Длина (доставка)')
                        ->help('Длина товара при доставке'),

                    Input::make('product.delivery_depth')
                        ->title('Глубина (доставка)')
                        ->help('Глубина товара при доставке'),

                    Input::make('product.delivery_weight')
                        ->title('Вес (доставка)')
                        ->help('Вес товара при доставке'),
                ]),

                Upload::make('product.attachment')
                    ->acceptedFiles('image/*')
                    ->title('Все фото'),

                Quill::make('product.description')
                    ->title('Описание'),

            ])
        ];
    }

    /**
     * @param Product $product
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Product $product, Request $request) {
        $product->fill($request->get('product'))->save();

        $product->attachment()->syncWithoutDetaching(
            $request->input('product.attachment', [])
        );

        Alert::info('Новый товар создан.');

        return redirect()->route('platform.product.list');
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Product $product) {
        $product->delete();

        Alert::info('Товар был успешно удален.');

        return redirect()->route('platform.product.list');
    }
}
