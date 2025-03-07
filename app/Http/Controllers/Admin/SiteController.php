<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    public function index()
    {
        return response()->json(Site::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|unique:sites,url',
        ]);
        
        $site = Site::create($validated);
        return response()->json($site, 201);
    }

    public function show(Site $site)
    {
        return response()->json($site);
    }

    public function update(Request $request, Site $site)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'url' => 'sometimes|url|unique:sites,url,' . $site->id,
        ]);
        
        $site->update($validated);
        return response()->json($site);
    }

    public function destroy(Site $site)
    {
        $site->delete();
        return response()->json(['message' => 'Site deleted successfully']);
    }
}
