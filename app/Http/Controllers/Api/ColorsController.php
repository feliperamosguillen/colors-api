<?php

namespace App\Http\Controllers\Api;

use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ColorRequest;

class ColorsController extends Controller
{
    private $pageLenght = 6;

    /**
    * List of colors
    * @param Request $request
    * @return JsonResponse
    */
    public function index()
    {
        return response()->json(Color::paginate($this->pageLenght));
    }

    /**
     * Show one color
    * @param Request $request
    * @return JsonResponse
    */
    public function show(Color $color)
    {
        return response()->json($color);
    }

    /**
    * Create new Color
    * @param Request $request
    * @return JsonResponse
    */
    public function store(ColorRequest $request)
    {
        $data = $request->validated();
        $color = Color::create($data);
        return response()->json($color, 201);
    }

    /**
    * Update a Color
    * @param Request $request
    * @return JsonResponse
    */
    public function update(ColorRequest $request, Color $color)
    {
        $data = $request->validated();
        $color->update($data);
        return response()->json($color, 201);
    }

    /**
    * Delete a Colors
    * @param Request $request
    * @return JsonResponse
    */
    public function destroy(Color $color)
    {
        $color->delete();
        return response()->json(null, 204);
    }
}
