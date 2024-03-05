<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titre' => 'required|min:5|max:255',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:now',
            'capacity' => 'required|integer|min:1',
            'category_id' => 'required|exists:categorys,id',
            'lieu' => 'required|string',
            
        ];
    }
}
