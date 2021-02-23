<?php

namespace App\Http\Controllers\Api\Pochta;

use App\Http\Controllers\Controller;
use App\Services\PochtaService;
use Illuminate\Http\Request;

class PochtaController extends Controller {

    /**
     * @var PochtaService $service
     */
    private $service;

    public function __construct(PochtaService $service)
    {
        $this->service = $service;
    }

    public function calcDelivery(Request $request) {
        return response()->json([
            $this->service->getDeliveryRate($request),
        ], 200);
    }
}
