<?php

namespace App\Http\Controllers;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::all();
        return view('agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('agenda.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
        ]);

        Agenda::create($validatedData);

        return redirect()->route('agendas.index')->with('success', 'Agenda created successfully.');
    }

    public function show(Agenda $agenda)
    {
        return view('agenda.show', compact('agenda'));
    }
    public function edit(Agenda $agenda)
    {
        return view('agenda.edit', compact('agenda'));
    }
    public function update(Request $request, Agenda $agenda)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
        ]);

        $agenda->update($validatedData);

        return redirect()->route('agendas.index')->with('success', 'Agenda updated successfully.');
    }
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('agendas.index')->with('success', 'Agenda deleted successfully.');
    }
}