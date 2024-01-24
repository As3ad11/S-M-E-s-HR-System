<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Feed;
use Illuminate\Http\Request;

class FeedAnnouncement extends Controller
{
    public function Index(Request $request)
    {
        if ($request->has('feed_date')) {
            $feed_date = $request->get('feed_date');
        }

        $feed_date = (isset($feed_date) and $feed_date) ? $feed_date : now()->format('Y-m-d');

        if ($request->has('submit_feed_create')) {
            if ($request->get('location') and $request->get('time') and $request->get('title') and $request->get('description')) {
                Feed::query()
                    ->create([
                        'user_id' => auth()->user()->id,
                        'title' => $request->get('title'),
                        'description' => $request->get('description'),
                        'location' => $request->get('location'),
                        'time' => $request->get('time'),
                        'created_at' => now(),
                    ]);
            }
        }

        if ($request->has('submit_feed_update')) {
            if ($request->get('location') and $request->get('time') and $request->get('title') and $request->get('description')) {
                Feed::query()
                    ->where('id', $request->get('feed_id'))
                    ->where('user_id', auth()->user()->id)
                    ->update([
                        'title' => $request->get('title'),
                        'description' => $request->get('description'),
                        'location' => $request->get('location'),
                        'time' => $request->get('time'),
                    ]);
            }
        }

        if ($request->has('submit_feed_delete')) {
            Feed::query()->where('id', $request->get('feed_id'))->delete();
        }

        if ($request->has('submit_announcement_create')) {
            if ($request->get('title') and $request->get('announcement')) {
                Announcement::query()
                    ->create([
                        'user_id' => auth()->user()->id,
                        'title' => $request->get('title'),
                        'announcement' => $request->get('announcement'),
                        'created_at' => now(),
                    ]);
            }
        }

        if ($request->has('submit_announcement_update')) {
            if ($request->get('announcement')) {
                Announcement::query()
                    ->where('id', $request->get('announcement_id'))
                    ->where('user_id', auth()->user()->id)
                    ->update([
                        'title' => $request->get('title'),
                        'announcement' => $request->get('announcement')
                    ]);
            }
        }

        if ($request->has('submit_announcement_delete')) {
            Announcement::query()->where('id', $request->get('announcement_id'))->delete();
        }

        return view('system.feed_announcement.index', [
            'feeds' => Feed::query()
                ->whereRaw('cast(created_at as date) = ?', $feed_date)
                ->orderBy('created_at', 'desc')
                ->get(),
            'announcements' => Announcement::query()
                ->orderBy('created_at', 'desc')
                ->get(),
            'feed_date' => $feed_date,
        ]);
    }
}
