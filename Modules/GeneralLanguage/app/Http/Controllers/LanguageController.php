<?php

namespace Modules\GeneralLanguage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralLanguage\Models\Language;

class LanguageController extends Controller
{
    public function index()
    {
        return Language::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:languages,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:languages,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Language::create($data)->refresh(), 201);
    }

    public function show(Language $language): Language
    {
        return $language;
    }

    public function update(Request $request, Language $language): Language
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('languages', 'name')->ignore($language->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('languages', 'code')->ignore($language->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $language->update($data);

        return $language;
    }

    public function destroy(Language $language)
    {
        $language->delete();

        return response()->json(null, 204);
    }
}
