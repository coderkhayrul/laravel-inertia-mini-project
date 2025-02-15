<?php

namespace App\Http\Controllers\Api;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ListSectionRequest;
use App\Http\Resources\SectionResource;

class SectionController extends Controller
{
    public function __invoke(ListSectionRequest $request)
    {

        return "Success";
        $sections = Section::where('class_id', $request->class_id)->get();
        return SectionResource::collection($sections);
    }
}
