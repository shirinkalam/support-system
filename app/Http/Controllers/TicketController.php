<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,admin');
    }

    public function new()
    {
        return view('tickets.new');
    }

    public function create(Request $request)
    {
        auth()->user()->tickets()->create(
            $request->all() + ['file_path' => $this->uploadFile($request)]
        );

        return back();
    }

    public function index()
    {
        $tickets = auth()->user()->tickets;

        return view('tickets.tickets',compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.ticket',compact('ticket'));
    }

    private function uploadFile(Request $request)
    {
        return $request->hasFile('file')
            ? $request->file->store('public')
            : null;
    }

    public function close(Ticket $ticket)
    {
        $ticket->close();

        return back();
    }
}
