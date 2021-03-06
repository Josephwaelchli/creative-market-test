<?php

namespace App\Http\Controllers;

use App\Models\SellerApplication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SellerApplicationController extends Controller
{
    /**
     * Check if the given portfolio url has already been submitted.
     * @param Request $request
     * @return JsonResponse
     */
    public function portfolioUnique(Request $request): JsonResponse
    {
        $application = SellerApplication::where('portfolio_url', $request->portfolio_url)->first();
        $portfolio_unique = empty($application);

        return response()->json(
            [
                'unique' => $portfolio_unique,
            ]
        );
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        // Validate data one last time before creating record.
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required|max:64',
                'last_name' => 'required|max:64',
                'shop_category' => 'required|exists:shop_categories,slug',
                'portfolio_url' => 'required|URL',
                'owns_content_confirmed' => 'required|accepted',
                'meta' => 'required|json',
            ]
        );
        $validation_errors = $validator->errors();
        if ($validation_errors->any()) {
            return response()->json(
                [
                    'error' => 'validation failed',
                    'validation' => $validation_errors,
                ]
            )->setStatusCode(400);
        }

        // Parse necessary request content and create record if validation passes.
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'shop_category' => $request->shop_category,
            'portfolio_url' => $request->portfolio_url,
            'owns_content_confirmed' => $request->owns_content_confirmed,
            'meta' => $request->meta,
        ];

        return SellerApplication::create($data);
    }
}
