<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactMeController extends Controller
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            $data = [
                "status" => "error",
                "data" => null,
                "message" => $validator->errors()->first(),
            ];
            return response()->json($data, 422);
        }

         $message = new ContactMessage();
        $message->first_name = $request->input('first_name');
        $message->last_name = $request->input('last_name');
        $message->email = $request->input('email');
        $message->message = $request->input('message');
        $message->save();

        return response()->json([
            "status" => "success",
            "data" => $message,
            "message" => "submitted successfully",
        ], 201);
    }
}
