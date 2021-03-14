<?php

namespace App\Http\Requests\App;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Slug;

class PostRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $regex = '/^[A-Za-z0-9-éèàù]{1,50}?(,[A-Za-z0-9-éèàù]{1,50})*$/';
        $id = $this->post ? ',' . $this->post->id : '';
        return $rules = [
            'name' => 'required|max:255',
            'slug' => ['required', 'max:255', new Slug, 'unique:posts,slug' . $id],
            'seo_title' => 'required|max:60',
            'description' => 'required|max:500',
            'content' => 'required|max:65000',
            'meta_description' => 'required|max:160',
            'meta_keywords' => 'required|regex:' . $regex,
            'thumbnail' => 'required|max:255',
            'categories' => 'required',
            'account_id' => 'required',
        ];
    }
}
