<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Screenshot;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    // Display a listing of the projects
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    // Show the form for creating a new project
    public function create()
    {
        return view('projects.create');
    }

    // Store a newly created project in storage
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string',
            'mainImage' => 'required|image',
            'shortDesc' => 'required|string',
            'desc' => 'required|string',
            'overview.name' => 'required|string|max:255',
            'overview.duration' => 'required|string|max:255',
            'overview.tech' => 'required|string|max:255',
            'overview.role' => 'required|string|max:255',
            'features.*.title' => 'required|string|max:255',
            'features.*.desc' => 'required|string',
            'technical.*.title' => 'required|string|max:255',
            'technical.*.desc' => 'required|string',
            'challenge.*.title' => 'required|string|max:255',
            'challenge.*.desc' => 'required|string',
            'screenshots.*.title' => 'required|string|max:255',
            'screenshots.*.desc' => 'required|string',
            'screenshots.*.images.*' => 'nullable|image',
            'reference.*.text' => 'nullable|string|max:100',
            'reference.*.link' => 'nullable|string',
        ]);

        try {
            // Create the project
            $project = new Project();
            $project->title = $request->input('title');
            $project->slug = $request->input('slug');
            $project->shortDesc = $request->input('shortDesc');
            $project->desc = $request->input('desc');
            $project->overview = json_encode($request->input('overview'));
            $project->features = json_encode($request->input('features'));
            $project->technical = json_encode($request->input('technical'));
            $project->challenge = json_encode($request->input('challenge'));
            $project->outcome = $request->input('outcome');
            $project->conclusion = $request->input('conclusion');
            $project->reference = json_encode($request->input('reference'));

            if ($request->hasFile("mainImage")) {
                $mainImage = $request->file("mainImage");
                $filePath = 'assets/images/projects';
                $filename = date('YmdHis') . $mainImage->getClientOriginalName();
                $mainImage->move(public_path($filePath), $filename);
                $project->mainImage = $filePath . '/' . $filename;
            }

            $project->save();

            // Handle screenshots
            $screenshots = $request->input('screenshots');
            $screenshotData = [];
            $screenshotFilePath = 'assets/images/screenshots';
            foreach ($screenshots as $index => $screenshot) {
                $screenshotImages = [];
                if ($request->hasFile("screenshots.${index}.images")) {
                    foreach ($request->file("screenshots.${index}.images") as $image) {
                        $filename = date('YmdHis') . $index . $image->getClientOriginalName();
                        $image->move(public_path($screenshotFilePath), $filename);
                        $screenshotImages[] = $screenshotFilePath . '/' . $filename;
                    }
                }

                Screenshot::create([
                    'project_id' => $project->id,
                    'title' => $screenshot['title'],
                    'desc' => $screenshot['desc'],
                    'path' => json_encode($screenshotImages),
                ]);
            }

            return redirect()->route('projects.index')->with('success', 'Project created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create project.']);
        }
    }

    // Display the specified project
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    // Show the form for editing the specified project
    public function edit(Project $project)
    {
        $project->overview = json_decode($project->overview, true);
        $project->features = json_decode($project->features, true);
        $project->technical = json_decode($project->technical, true);
        $project->challenge = json_decode($project->challenge, true);
        $project->screenshots = json_decode($project->screenshots, true);
        $project->reference = json_decode($project->reference, true);
        // return gettype($project->overview);
        return view('projects.edit', compact('project'));
    }

    // Update the specified project in storage
    public function update(Request $request, Project $project)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string',
            'mainImage' => 'nullable|image',
            'shortDesc' => 'required|string',
            'desc' => 'required|string',
            'overview.name' => 'required|string|max:255',
            'overview.duration' => 'required|string|max:255',
            'overview.tech' => 'required|string|max:255',
            'overview.role' => 'required|string|max:255',
            'features.*.title' => 'required|string|max:255',
            'features.*.desc' => 'required|string',
            'technical.*.title' => 'required|string|max:255',
            'technical.*.desc' => 'required|string',
            'challenge.*.title' => 'required|string|max:255',
            'challenge.*.desc' => 'required|string',
            'screenshots.*.title' => 'required|string|max:255',
            'screenshots.*.desc' => 'required|string',
            'screenshots.*.images.*' => 'nullable|image',
            'reference.*.text' => 'nullable|string|max:100',
            'reference.*.link' => 'nullable|string',
        ]);

        try {
            // Update the project
            $project->title = $request->input('title');
            $project->slug = $request->input('slug');
            $project->shortDesc = $request->input('shortDesc');
            $project->desc = $request->input('desc');
            $project->overview = json_encode($request->input('overview'));
            $project->features = json_encode($request->input('features'));
            $project->technical = json_encode($request->input('technical'));
            $project->challenge = json_encode($request->input('challenge'));
            $project->outcome = $request->input('outcome');
            $project->conclusion = $request->input('conclusion');
            $project->reference = json_encode($request->input('reference'));

            if ($request->hasFile("mainImage")) {
                $mainImage = $request->file("mainImage");
                $filePath = 'assets/images/projects';
                $filename = date('YmdHis') . $mainImage->getClientOriginalName();
                $mainImage->move(public_path($filePath), $filename);
                $project->mainImage = $filePath . '/' . $filename;
            }

            $project->save();

            // Handle screenshots
            $screenshots = $request->input('screenshots');
            $screenshotData = [];
            $screenshotFilePath = 'assets/images/screenshots';
            $delScreenshot = explode(",", $request->deleted_screen_shot);
            Screenshot::destroy($delScreenshot);

            foreach ($screenshots as $index => $screenshot) {
                $screenshotImages = [];
                if ($request->hasFile("screenshots.${index}.images")) {
                    foreach ($request->file("screenshots.${index}.images") as $image) {
                        $filename = date('YmdHis') . $index . $image->getClientOriginalName();
                        $image->move(public_path($screenshotFilePath), $filename);
                        $screenshotImages[] = $screenshotFilePath . '/' . $filename;
                    }
                }
                if ($screenshot["id"] == "0") {
                    Screenshot::create([
                        'project_id' => $project->id,
                        'title' => $screenshot['title'],
                        'desc' => $screenshot['desc'],
                        'path' => json_encode($screenshotImages),
                    ]);
                } else {
                    $update = Screenshot::where('id', $screenshot["id"])->first();
                    if (empty($update) === false) {
                        $update->title = $screenshot['title'];
                        $update->desc = $screenshot['desc'];
                        if (empty($screenshotImages) === false) {
                            $update->path = json_encode($screenshotImages);
                        }
                        $update->save();
                    }
                }

            }

            return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update project.']);
        }
    }

    // Remove the specified project from storage
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
    public function getList()
    {
        $projects = Project::select('title', 'shortDesc', 'mainImage', 'slug')->get();

        return response()->json([
            "status" => "success",
            "data" => $projects,
            "message" => "",
        ], 200);
    }
    public function getProject($slug)
    {
        $project = Project::where("slug", $slug)->first();
        if (empty($project) === false) {
            $screenshots = [];
            foreach ($project->screenshots as $key => $item) {
                $item->path = json_decode($item->path, true);
                $screenshots[] = $item;
            }
        }
        $project->overview = json_decode($project->overview, true);
        $project->features = json_decode($project->features, true);
        $project->technical = json_decode($project->technical, true);
        $project->challenge = json_decode($project->challenge, true);
        $project->reference = json_decode($project->reference, true);
        $project->screenshots = $screenshots;

        return response()->json([
            "status" => "success",
            "data" => $project,
            "message" => "",
        ], 200);
    }
}
