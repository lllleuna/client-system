<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    public function getArea()
    {
        $response = Http::get('https://psgc.gitlab.io/api/island-groups/');
        return response()->json($response->json());
    }

    public function getRegions($areaCode)
    {
        $response = Http::get("https://psgc.gitlab.io/api/island-groups/{$areaCode}/regions/");
        return response()->json($response->json());
    }

    public function getProvinces($regionCode)
    {
        $response = Http::get("https://psgc.gitlab.io/api/regions/{$regionCode}/provinces/");
        return response()->json($response->json());
    }

    public function getCitiesMunicipals($regionCode)
    {
        $response = Http::get("https://psgc.gitlab.io/api/regions/{$regionCode}/cities-municipalities/");
        return response()->json($response->json());
    }

    public function getBarangays($cityOrMunicipalityCode)
    {
        $response = Http::get("https://psgc.gitlab.io/api/cities-municipalities/{$cityOrMunicipalityCode}/barangays/");
        return response()->json($response->json());
    }

    public function getProvinceName($provinceCode)
    {
        $response = Http::get("https://psgc.gitlab.io/api/provinces/{$provinceCode}/");
        return response()->json($response->json());
    }

    public function getCityMunicipalityName($cityCode)
    {
        $response = Http::get("https://psgc.gitlab.io/api/cities-municipalities/{$cityCode}/");
        return response()->json($response->json());
    }

    public function getBarangayName($barangayCode)
    {
        $response = Http::get("https://psgc.gitlab.io/api/barangays/{$barangayCode}/");
        return response()->json($response->json());
    }

    public function getAllRegions()
    {
        $response = Http::get("https://psgc.gitlab.io/api/regions/");
        return response()->json($response->json());
    }


}

