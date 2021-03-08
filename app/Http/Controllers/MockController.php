<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class MockController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
 
    public function purchase(Request $request)
    {
        $this->validate($request, [
            'receipt' => 'required',
        ]);

        $last_char_of_receipt = substr($request->get('receipt'), -1);

        $my_status = false;
        if (is_numeric($last_char_of_receipt) && $last_char_of_receipt % 2 == 1) {
            $my_status = true;
        }

        return response()->json([
            'status' => $my_status,
            'expire-date' => Carbon::now()->add(1, 'day')->format("Y-d-m H:i:s")
        ]);
    }
}
