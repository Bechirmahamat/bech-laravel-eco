<?php

namespace App\Http\Requests;

use App\Models\Products;
use Illuminate\Foundation\Http\FormRequest;

class AddProductRquest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:30'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:1.00'], // Assuming price is a numeric value
            'quantity' => ['required', 'numeric', 'max:200'], // Assuming quantity is an integer and must be non-negative
            'image' => ['required', 'image', 'mimes:png,jpeg,jpg', 'max:2048'],
            'category' => ['required', 'string', 'max:40'],
            'discount_price' => ['required', 'string', 'max:20'], // Assuming discount_price is a numeric value
        ];
    }
}
