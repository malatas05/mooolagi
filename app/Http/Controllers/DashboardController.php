<?php

namespace App\Http\Controllers;

use App\Models\CustomRequest;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $customRequests = CustomRequest::where('user_id', Auth::id())
            ->with('product')
            ->latest()
            ->paginate(8);

        return view('dashboard', compact('customRequests'));
    }

    public function show(CustomRequest $customRequest)
    {
        abort_unless($customRequest->user_id === Auth::id(), 403);

        $customRequest->load(['product', 'slotValues.slot.section']);

        return view('requests.show', compact('customRequest'));
    }
}