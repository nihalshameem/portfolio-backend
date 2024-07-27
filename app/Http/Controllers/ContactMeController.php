<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

        try {
            // Begin database transaction
            \DB::beginTransaction();

            $message = new ContactMessage();
            $message->first_name = $request->input('first_name');
            $message->last_name = $request->input('last_name');
            $message->email = $request->input('email');
            $message->message = $request->input('message');
            $message->save();

            $receiver = env('EMAIL_RECEIVER');

            // Send the email
            Mail::to($receiver)->send(new ContactMessageMail($message));

            // Commit the transaction
            \DB::commit();

            return response()->json([
                "status" => "success",
                "data" => $message,
                "message" => "Submitted successfully",
            ], 201);

        } catch (\Exception $e) {
            // Rollback the transaction
            \DB::rollBack();

            // Log the error or handle it as needed
            \Log::error('Error occurred while storing contact message: ' . $e->getMessage());

            return response()->json([
                "status" => "error",
                "data" => null,
                "message" => "An error occurred while processing your request. Please try again later.",
            ], 500);
        }
    }
}
