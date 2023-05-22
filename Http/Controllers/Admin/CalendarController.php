<?php

namespace Modules\Bookable\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Core\Http\Controllers\Controller;
use Modules\Bookable\Models\Calendar;

class CalendarController extends Controller {

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Request $request) {

        if ($request->ajax()) {

            $data = Calendar::whereDate('start', '>=', $request->start)
                    ->whereDate('end', '<=', $request->end)
                    ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }

        return view('bookable-admin::calendar.index');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'nullable|string|max:255',
        ]);
        $event = Calendar::create([
                    'title' => $request->input('title'),
                    'start' => $request->input('startdate') . ' ' . $request->input('starttime'),
                    'end' => $request->input('enddate') . ' ' . $request->input('endtime'),
        ]);

        return response()->json([
                    'message' => 'Event created successfully',
                    'event' => $event,
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function ajax(Request $request) {

        switch ($request->type) {
            case 'add':
                $event = Calendar::create([
                            'title' => $request->title,
                            'start' => $request->start,
                            'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = Calendar::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = Calendar::find($request->id)->delete();

                return response()->json($event);
                break;

            default:
                # code...
                break;
        }
    }

}
