<?php

namespace Bjnstnkvc\MailComponents\View\Components\Mail;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * @var string Table background color.
     */
    public $background;

    /**
     * @var string Table Header background color.
     */
    public $headerBackground;

    /**
     * @var bool Determine whether to show table row index column.
     */
    public $rowIndex;

    /**
     * @var object|null Table Eloquent model.
     */
    public $model;

    /**
     * @var string|array Table headers.
     */
    public $headers;

    /**
     * @var string|array Table columns.
     */
    public $columns;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($background = null, $headerBackground = null, $rowIndex = false, $model = null, $headers = null, $columns = null)
    {
        $this->background       = $background ?: config('mail_components.table.background');
        $this->headerBackground = $headerBackground ?: config('mail_components.table.header_background');
        $this->rowIndex         = filter_var($rowIndex ?: config('mail_components.table.row_index'), FILTER_VALIDATE_BOOLEAN);
        $this->model            = $model;
        $this->columns          = $this->model ?: $this->toArray($columns);
        $this->headers          = $this->model ? $this->getModelColumns() : $this->toArray($headers);
    }

    /**
     * Convert String values to array.
     *
     * @param $values
     *
     * @return array
     */
    protected function toArray($values): array
    {
        // Initialize values array.
        $preparedValues = [];

        if (is_null($values)) {
            return [];
        }

        if (is_string($values)) {
            foreach (Str::of($values)->split('/(\s*,*\s*)*,+(\s*,*\s*)*/') as $value) {
                $exploded = Str::of($value)->explode(':');

                if (Str::contains($exploded->last(), '|')) {
                    $preparedValues[$exploded->first()] = Str::of($exploded->last())->explode('|');;
                } else {
                    $preparedValues[$exploded->first()] = $exploded->last();
                }
            }

            return $preparedValues;
        }

        return $values;
    }

    /**
     * Get Model column names.
     *
     * @return array
     */
    public function getModelColumns(): array
    {
        return array_keys(array_merge(...array_values(is_object($this->model) ? $this->model->toArray() : $this->model)));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('mail-components::mail.table');
    }
}
