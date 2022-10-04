<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'name' => 'required|string|max:80',
      'email' => 'required|email|max:40',
      'phone' => 'required|numeric|max_digits:20'
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'name.required' => 'Debe ingresar el nombre',
      'email.required' => 'Debe ingresar su correo',
      'phone.required' => 'Debe ingresar su número celular'
    ];
  }
}
