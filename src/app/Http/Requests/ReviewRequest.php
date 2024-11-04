<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class ReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'score' => 'required',
            'image' => 'file|mimes:jpeg,png|max:1000000',
        ];
    }

    public function messages(): array
    {
        return [
            'score.required' => '評価を入力してください',
            'image.file' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'image.max' => '画像のサイズは1G以内にしてください'
        ];
    }
}
