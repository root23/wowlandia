<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Idma\Robokassa\Payment;
use Illuminate\Http\Request;
use Davidnadejdin\LaravelRobokassa\Robokassa;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Idma\Robokassa\Exception\EmptyDescriptionException
     * @throws \Idma\Robokassa\Exception\InvalidInvoiceIdException
     * @throws \Idma\Robokassa\Exception\InvalidSumException
     */
    public function index(Request $request)
    {
        $action = $request->get('action');
        if (!isset($action)) {
            return response()->json([
                'error' => 'No action',
            ], 404);
        } elseif ($action == 'new_payment') {
            $payment = new Payment(
                env('ROBOKASSA_LOGIN'),
                env('ROBOKASSA_PASSWORD'),
                env('ROBOKASSA_PASSWORD2'),
                env('ROBOKASSA_TEST_MODE')
            );

            $payment
                ->setInvoiceId(uniqid())
                ->setSum(3)
                ->setDescription('some description');

            return response()->json([
                'payment_url' => $payment->getPaymentUrl(),
                'payment_id' => $payment->getInvoiceId(),
            ], 200);
        } elseif ($action == 'success') {
            dd($request);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
