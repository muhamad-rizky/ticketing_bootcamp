<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

// Form Request
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of tickets.
     */
    public function index(): View
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Display the specified ticket.
     */
    public function show($id): View
    {
        $ticket = Ticket::findOrFail($id);

        // ✅ Authorization check (ANTI IDOR)
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for creating a new ticket.
     */
    public function create(): View
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(StoreTicketRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        // ✅ Pakai user login (bukan hardcode)
        $validatedData['user_id'] = auth()->id();

        // Default status
        $validatedData['status'] = 'open';

        $ticket = Ticket::create($validatedData);

        return redirect()
            ->route('tickets.show', $ticket->id)
            ->with('success', 'Tiket berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified ticket.
     */
    public function edit(Ticket $ticket): View
    {
        // ✅ Authorization check
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified ticket in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket): RedirectResponse
    {
        // ✅ Authorization check
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        $ticket->update($request->validated());

        return redirect()
            ->route('tickets.show', $ticket->id)
            ->with('success', 'Tiket berhasil diperbarui!');
    }

    /**
     * Remove the specified ticket from storage.
     */
    public function destroy(Ticket $ticket): RedirectResponse
    {
        // ✅ Authorization check
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Tiket berhasil dihapus!');
    }
}
