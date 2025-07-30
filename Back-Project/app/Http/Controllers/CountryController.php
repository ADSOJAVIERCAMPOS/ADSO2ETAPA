<?php

namespace App\Http\Controllers;

use App\Business\CountryBusiness;
use App\Exceptions\NotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CountryController extends Controller
{
    protected $countryBusiness;

    public function __construct(CountryBusiness $countryBusiness)
    {
        $this->countryBusiness = $countryBusiness;
    }
    //Obtiene todos
    public function index()
    {
        try {
            $countries = $this->countryBusiness->getAll();
            return response()->json([
                'countries' => $countries,
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining country',
                'status' => 500
            ], 500);
        }
    }
    // Muestra en especifico con el id
    public function show($id_country)
    {
        try {
            $country= $this->countryBusiness->getById($id_country);
            return response()->json([
                'country' => $country,
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error in obtaining country',
                'status' => 500
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
            'name_country' => 'required|unique:countries', 
            'city' => 'required',
            'departament'=> 'required',
            'location_geography' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                    'status' => 400
                ], 400);
            }
            // Crear 
            $country = $this->countryBusiness->create($request->all());
    
            return response()->json([
                'message' => 'successful create',
                'status' => 201
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $e->errors(),
                'status' => 400
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating the country',
                'status' => 500,
                'error' => $e->getMessage() 
            ], 500);
        }
    }
    //Actualizar
    public function update(Request $request, $id_country)
{
    try {

        $validator = Validator::make($request->all(), [
            'name_country' => 'required|unique:countries',   
            'city' => 'required',
            'departament'=> 'required',
            'location_geography' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }
        $country = $this->countryBusiness->update($id_country, $request->all());

        if (!$country) {
            throw new NotFoundException('not found');
        }

        return response()->json([
            'message' => 'successful update',
            'status' => 200
        ], 200);
    } catch (NotFoundException $e) {
        return response()->json([
            'message' => $e->getMessage(),
            'status' => 404
        ], 404);
    } catch (ValidationException $e) {
        return response()->json([
            'message' => 'Validation error',
            'errors' => $e->errors(),
            'status' => 400
        ], 400);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error updating the country',
            'status' => 500,
            'error' => $e->getMessage() 
        ], 500);
    }
}
    //Eliminar 
    public function destroy($id_country)
    {
        try {
            $this->countryBusiness->delete($id_country);
            return response()->json([
                'message' => 'Successful eliminated',
                'status' => 200
            ], 200);
        } catch (NotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting the country',
                'status' => 500,
                'error' => $e->getMessage()
            ], 500);
        }
    } 
}
