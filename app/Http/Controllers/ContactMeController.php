<?php

namespace App\Http\Controllers;

use App\Models\ContactMe;
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

        $userModel = new ContactMe();

        $data = $request->only(['first_name', 'last_name', 'email', 'message']);
        $insertResult = $userModel->create($data);

        if ($insertResult->isAcknowledged()) {
            $data['_id'] = $insertResult->getInsertedId();
        }

        return response()->json([
            "status" => "success",
            "data" => $data,
            "message" => "submitted successfully",
        ], 201);
    }
}
