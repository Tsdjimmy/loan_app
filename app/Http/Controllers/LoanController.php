<?php

namespace App\Http\Controllers;

use App\Models\loan;
use Illuminate\Http\Request;
use App\services\LoanServices;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public static function createLoan( Request $request ): \Illuminate\Http\JsonResponse
    {
        return LoanServices::createLoan( $request );
    }

    public static function approveLoan( Request $request ): \Illuminate\Http\JsonResponse
    {
        return LoanServices::approveLoan( $request );
    }

    public static function getLoan( Request $request ): \Illuminate\Http\JsonResponse
    {
        return LoanServices::getLoan( $request );
    }
    
    public static function allLoan( Request $request ): \Illuminate\Http\JsonResponse
    {
        return LoanServices::allLoan();
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
     * @param  \App\Models\loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(loan $loan)
    {
        //
    }
}
