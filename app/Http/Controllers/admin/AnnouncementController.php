<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function AdminAnnouncementPage()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        return view('admin.announcement', compact('announcements'));
    }

    public function AdminAddAnnouncementRequest(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'priority' => 'required',
        ]);

        Announcement::create([
            'title' => $request->title,
            'body' => $request->body,
            'priority' => $request->priority,
            'author' => 'Admin',
            'created_at' => now(),
        ]);

        return redirect()
            ->route('admin.announcement.page')
            ->with('success', 'Announcement added successfully.');
    }


    public function AdminUpdateAnnouncementRequest(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'priority' => 'required',
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->update($request->only('title', 'body', 'priority'));

        return redirect()
            ->route('admin.announcement.page')
            ->with('success', 'Announcement updated successfully.');
    }

    public function AdminDeleteAnnouncementRequest($id)
    {
        Announcement::findOrFail($id)->delete();

        return redirect()
            ->route('admin.announcement.page')
            ->with('success', 'Announcement deleted successfully.');
    }
}
