<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::all();
        return view('certificates.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('certificates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string',
            'image' => 'required|image',
            'desc' => 'required|string',
            'file' => 'required|file',
            'earned_on' => 'required|date',
            'expiry_date' => 'nullable|date|after_or_equal:earned_on',
            'issuer' => 'required|string|max:255',
            'certificate_link' => 'nullable|url',
            'certificate_link_text' => 'nullable|string|max:255',
        ]);

        try {
            // Create the certificate
            $certificate = new Certificate();
            $certificate->title = $request->input('title');
            $certificate->slug = $request->input('slug');
            $certificate->desc = $request->input('desc');
            $certificate->earned_on = $request->input('earned_on');
            $certificate->expiry_date = $request->input('expiry_date');
            $certificate->issuer = $request->input('issuer');
            $certificate->certificate_link = $request->input('certificate_link');
            $certificate->certificate_link_text = $request->input('certificate_link_text');

            if ($request->hasFile("image")) {
                $image = $request->file("image");
                $filePath = 'assets/images/certificates';
                $filename = date('YmdHis') . $image->getClientOriginalName();
                $image->move(public_path($filePath), $filename);
                $certificate->image_path = $filePath . '/' . $filename;
            }

            if ($request->hasFile("file")) {
                $file = $request->file("file");
                $filePath = 'assets/images/certificates';
                $filename = date('YmdHis') . $file->getClientOriginalName();
                $file->move(public_path($filePath), $filename);
                $certificate->file_path = $filePath . '/' . $filename;
            }

            $certificate->save();

            return redirect()->route('certificates.index')->with('success', 'Certificate created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create certificate.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Certificate $certificate)
    {
        return view('certificates.show', compact('certificate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificate $certificate)
    {
        return view('certificates.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificate $certificate)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string',
            'image' => 'nullable|image',
            'desc' => 'required|string',
            'file' => 'nullable|file',
            'earned_on' => 'required|date',
            'expiry_date' => 'nullable|date|after_or_equal:earned_on',
            'issuer' => 'required|string|max:255',
            'certificate_link' => 'nullable|url',
            'certificate_link_text' => 'nullable|string|max:255',
        ]);

        try {
            // Create the certificate
            $certificate->title = $request->input('title');
            $certificate->slug = $request->input('slug');
            $certificate->desc = $request->input('desc');
            $certificate->earned_on = $request->input('earned_on');
            $certificate->expiry_date = $request->input('expiry_date');
            $certificate->issuer = $request->input('issuer');
            $certificate->certificate_link = $request->input('certificate_link');
            $certificate->certificate_link_text = $request->input('certificate_link_text');

            if ($request->hasFile("image")) {
                $image = $request->file("image");
                $filePath = 'assets/images/certificates';
                $filename = date('YmdHis') . $image->getClientOriginalName();
                $image->move(public_path($filePath), $filename);
                $certificate->image_path = $filePath . '/' . $filename;
            }

            if ($request->hasFile("file")) {
                $file = $request->file("file");
                $filePath = 'assets/images/certificates';
                $filename = date('YmdHis') . $file->getClientOriginalName();
                $file->move(public_path($filePath), $filename);
                $certificate->file_path = $filePath . '/' . $filename;
            }

            $certificate->save();

            return redirect()->route('certificates.index')->with('success', 'Certificate updated successfully!');
        } catch (\Exception $e) {
            throw $e;
            return redirect()->back()->withErrors(['error' => 'Failed to update certificate.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return redirect()->route('certificates.index')->with('success', 'Certificate deleted successfully.');
    }
    /**
     * API Endpoints
     */
    public function getList()
    {
        $certificates = Certificate::select('title', 'image_path', 'slug')->get();

        return response()->json([
            "status" => "success",
            "data" => $certificates,
            "message" => "",
        ], 200);
    }

    public function getCertificate($slug)
    {
        $project = Certificate::where("slug", $slug)->first();

        return response()->json([
            "status" => "success",
            "data" => $project,
            "message" => "",
        ], 200);
    }
}