<?php

namespace Modules\GeneralAnatomyTemplate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralAnatomyTemplate\Models\AnatomyTemplate;

class AnatomyTemplateController extends Controller
{
    public function index()
    {
        return AnatomyTemplate::query()->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['nullable', 'string', 'max:50', 'unique:anatomy_templates,code'],
            'name' => ['required', 'string', 'max:255', 'unique:anatomy_templates,name'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(AnatomyTemplate::create($data)->refresh(), 201);
    }

    public function show(AnatomyTemplate $anatomyTemplate): AnatomyTemplate
    {
        return $anatomyTemplate;
    }

    public function update(Request $request, AnatomyTemplate $anatomyTemplate): AnatomyTemplate
    {
        $data = $request->validate([
            'code' => ['nullable', 'string', 'max:50', \Illuminate\Validation\Rule::unique('anatomy_templates', 'code')->ignore($anatomyTemplate->id)],
            'name' => ['sometimes', 'string', 'max:255', \Illuminate\Validation\Rule::unique('anatomy_templates', 'name')->ignore($anatomyTemplate->id)],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $anatomyTemplate->update($data);
        return $anatomyTemplate;
    }

    public function destroy(AnatomyTemplate $anatomyTemplate)
    {
        $anatomyTemplate->delete();
        return response()->json(null, 204);
    }
}
