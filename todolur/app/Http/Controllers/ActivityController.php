<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    // read : menampilkan nama tugas
    public function index()
    {
        $activities = Activity::latest()->get();
        return view('activities.index', compact('activities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Activity::create($request->only('name', 'description'));

        return redirect()->route('activities.index')->with('success', 'Activity created successfully.');
    }
    // mengubah status tugas menjadi selesai
    public function updateStatus(Activity $activity)
    {
        $activity->is_completed = !$activity->is_completed;
        $activity->save();

        return redirect()->route('activities.index')->with('success', 'Activity status updated successfully.');
    }

    // delete : menghapus tugas
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully.');
    }
}
