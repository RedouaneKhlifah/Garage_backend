<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FournisseurRequest extends FormRequest
{
 public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
       $clientId = $this->route('client');

        $civilityValues = ['Madame', 'Mademoiselle', 'Monsieur', 'Société', 'Aucune'];

        return [
            'civility' => ['required', Rule::in($civilityValues)],
            'company' => ['required_if:civility,Société', 'nullable', 'string', 'max:255'],
            'first_name' => ['required_unless:civility,Société', 'nullable', 'string', 'max:255'],
            'last_name' => ['required_unless:civility,Société', 'nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
            'postal_code' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'email' => [
                'nullable',
                'email',
                Rule::unique('clients', 'email')->ignore($clientId)
            ],            
            'website' => ['nullable', 'string'],
            'main_phone' => ['nullable', 'string'],
            'secondary_phone' => ['nullable', 'string'],
            'fax' => ['nullable', 'string'],
            'payment_method' => ['nullable', 'string'],
            'ice' => ['nullable', 'numeric'],
            'observation' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'company.required_if' => 'The company field is required when civility is Société.',
            'first_name.required_unless' => 'The first name is required unless civility is Société.',
            'last_name.required_unless' => 'The last name is required unless civility is Société.',
            'email.unique' => trans("client.validation.email_already_exists"),
        ];
    }
}