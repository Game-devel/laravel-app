<?php
declare(strict_types=1);

namespace App\Models\post\requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'body' => 'required',
            'userId' => 'required|exists:users,id',
        ];
    }
}
