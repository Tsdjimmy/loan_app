<?php


namespace App\services;

use App\Models\Loan;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoanServices
{

    public static function createLoan( $request )
    {
        $rules = [
            'loan_amount' => 'required',
            'loan_type' => 'required',
            'duration' => 'required',
        ];

        $validator = Validator::make($request->input(), $rules, GeneralHelper::customMessage());

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ]);
        }
        $uid = Auth::user()->id;
        $loan = new Loan();
        $loan->loan_amount = $request->input('loan_amount');
        $loan->loan_type = $request->input('loan_type');
        $loan->duration = $request->input('duration');
        $loan->user_id = $uid;

        $loan->save();

        return response()->json(['message' => 'Loan record was successfully created'], 200);

    }

    public static function getLoan( $request )
    {
        $loan_id = $request->input('loan_id');
        $loan_data = Loan::select('loans.*', 'users.username', 'admins.username as admin')
        ->where('loans.id', $loan_id)
        ->join('users', 'users.id', '=', 'loans.user_id')
        ->join('admins', 'admins.id', '=', 'loans.approved_by')
        ->get();
        if( !$loan_data )
            return response()->json(['message' => 'Loan data not found'], 200);
        return response()->json(['message' => 'Fetched Successfully', 'data' => $loan_data], 200);
    }

    public static function allLoan()
    {
        $loan_data = Loan::select('loans.*', 'users.username')
        ->join('users', 'users.id', '=', 'loans.user_id')
        ->get();
        if( !$loan_data )
            return response()->json(['message' => 'Loan data not found'], 200);
        return response()->json(['message' => 'Fetched Successfully', 'data' => $loan_data], 200);
    }

    public static function approveLoan( $request )
    {
        $admin = Auth::user()->id;
        $loan_id = $request->input('loan_id');
        $status = $request->input('status');

        if($status == null)
        return response()->json(['message' => 'Status is required'], 200);

        if( $status != 'approved' &&  $status != 'rejected')
            return response()->json(['message' => 'Invalid Status Entered'], 200);

        $loan_data = Loan::where('id', $loan_id)->first();

        if( !$loan_data )
            return response()->json(['message' => 'Loan data not found'], 200);

        $update = Loan::where('id', $loan_id)->update([
            'status' => $status,
            'approved_at' => Carbon::now(),
            'approved_by' => $admin
        ]);

        return response()->json(['message' => 'Loan Status ' .$status.' Successfully', 'data' => $update], 200);

    }
}