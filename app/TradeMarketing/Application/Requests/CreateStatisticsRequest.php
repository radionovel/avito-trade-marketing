<?php
declare(strict_types=1);


namespace App\TradeMarketing\Application\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class CreateStatisticsRequest
{
    use ProvidesConvenienceMethods;

    /**
     * @throws ValidationException
     */
    public function __construct(private readonly Request $request)
    {
        $this->validateRequest();
    }

    /**
     * @throws ValidationException
     */
    protected function validateRequest(): void
    {
        $this->validate($this->request, $this->rules(), $this->messages());
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date|date_format:Y-m-d',
            'clicks' => 'integer|min:0',
            'views' => 'integer|min:0',
            'cost' => 'numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'date.*' => 'Не корректная дата в поле date. Дата должна передаваться в формате YYYY-MM-DD.',
            'clicks.*' => 'Поле clicks должно быть целым числом больше 0.',
            'views.*' => 'Поле views должно быть целым числом больше 0.',
            'cost.*' => 'Поле cost должно быть числом больше 0.',
        ];
    }

    /**
     * @return Request
     */
    public function request(): Request
    {
        return $this->request;
    }
}
