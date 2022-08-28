<?php
declare(strict_types=1);


namespace App\TradeMarketing\Application\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class GetStatisticsRequest
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
            'from' => 'date|date_format:Y-m-d',
            'to' => 'date|date_format:Y-m-d',
        ];
    }

    public function messages(): array
    {
        return [
            'from.*' => 'Не корректная дата в поле from. Дата должна передаваться в формате YYYY-MM-DD.',
            'to.*' => 'Не корректная дата в поле to. Дата должна передаваться в формате YYYY-MM-DD.',
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
