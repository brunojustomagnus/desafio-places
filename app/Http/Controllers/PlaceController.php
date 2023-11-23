<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
class PlaceController extends Controller
{
    public function index(Request $request)
    {
        try {
            $places = Place::all();
            // $places = Place::paginate(20); //Caso queira a API paginada, basta descomentar essa linha e comentar a de cima.
            return response()->json(['places' => $places], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }
    public function filterByName(Request $request)
    {
        try {
            $name = $request->input('name');
            $filtered_places = Place::filterByName($name);
            if ($filtered_places->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No places found with the given name',
                ], 404);
            }
            if ($filtered_places->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No places found with the given name',
                ], 404);
            }
            return response()->json(['places' => $filtered_places], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to filter places by name'], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $validator = Place::validateStoreOrUpdate($data);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $place = new Place();
            $place->name = $data['name']; 
            $place->slug = $data['slug'];
            $place->city = $data['city'];
            $place->state = $data['state'];
            $place->save();
            return response()->json($place, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to store place', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Request $request)
    {
        try {
            $place = Place::find($request->place_id);
            if (!$place) {
                return response()->json(['message' => 'Place not found'], 404);
            }
            return response()->json(['places' => $place], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch place by id'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $place = Place::findOrFail($id);
            $data = $request->all();
            $validator = Place::validateStoreOrUpdate($data);
            
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $place->update($data);
            return response()->json($place, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update place'], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $place = Place::find($id);

            if (!$place) {
                return response()->json(['message' => 'Place not found'], 404);
            }

            $place->delete();

            return response()->json(['message' => 'Place deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete the place'], 500);
        }
    }
}
