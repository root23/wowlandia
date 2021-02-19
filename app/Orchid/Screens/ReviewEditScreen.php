<?php

namespace App\Orchid\Screens;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Review;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Relation;

class ReviewEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Отзывы';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Редактирование';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Review $review): array
    {
        $this->exists = $review->exists;

        if ($this->exists) {
            $this->name = 'Редактирование отзыва';
        }

        return [
            'review' => $review,
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
                Input::make('review.title')
                    ->title('Имя')
                    ->placeholder('Введите имя')
                    ->required()
                    ->help('Имя посетителя'),

                Input::make('review.email')
                    ->title('Email')
                    ->placeholder('Введите email')
                    ->type('email')
                    ->required()
                    ->help('Email Пользователя'),

                TextArea::make('review.message')
                    ->title('Текст отзыва')
                    ->placeholder('Введите текст отзыва')
                    ->help('Текст отзыва')
                    ->rows(5)
                    ->maxlength(255),

                Input::make('review.rating')
                    ->title('Оценка')
                    ->placeholder('Введите оценку')
                    ->type('number')
                    ->min(1)
                    ->max(5)
                    ->required()
                    ->help('Оценка в отзыве'),

                CheckBox::make('review.is_active')
                    ->value(1)
                    ->title('Отображать')
                    ->placeholder('Отображать')
                    ->help('Отображение на сайте'),

                Relation::make('review.product_id')
                    ->title('Товар')
                    ->required()
                    ->fromModel(Product::class, 'title'),

                Cropper::make('review.image')
                    ->title('Изображение')
                    ->targetRelativeUrl()
                    ->width(750)
                    ->height(250),
            ]),
        ];
    }

    /**
     * @param Review $review
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Review $review, Request $request): \Illuminate\Http\RedirectResponse
    {
        $review->fill($request->get('review'))->save();
        Alert::info('Новый отзыв добавлен');

        return redirect()->route('platform.reviews.list');
    }

    /**
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Review $review): \Illuminate\Http\RedirectResponse
    {
        $review->delete();
        Alert::info('Отзыв был успешно удален.');

        return redirect()->route('platform.reviews.list');
    }
}
