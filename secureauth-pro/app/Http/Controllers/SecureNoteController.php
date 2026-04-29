<?php

namespace App\Http\Controllers;

use App\Models\SecureNote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class SecureNoteController extends Controller
{
    public function index(Request $request): View
    {
        Gate::authorize('viewAny', SecureNote::class);

        return view('secure-notes.index', [
            'notes' => $request->user()
                ->secureNotes()
                ->latest()
                ->paginate(8),
        ]);
    }

    public function create(): View
    {
        Gate::authorize('create', SecureNote::class);

        return view('secure-notes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Gate::authorize('create', SecureNote::class);

        $validated = $this->validated($request);

        $secureNote = $request->user()->secureNotes()->create($validated);

        return redirect()->route('secure-notes.show', $secureNote)
            ->with('success', __('Secure note created.'));
    }

    public function show(SecureNote $secureNote): View
    {
        Gate::authorize('view', $secureNote);

        return view('secure-notes.show', [
            'note' => $secureNote,
        ]);
    }

    public function edit(SecureNote $secureNote): View
    {
        Gate::authorize('update', $secureNote);

        return view('secure-notes.edit', [
            'note' => $secureNote,
        ]);
    }

    public function update(Request $request, SecureNote $secureNote): RedirectResponse
    {
        Gate::authorize('update', $secureNote);

        $secureNote->update($this->validated($request));

        return redirect()->route('secure-notes.show', $secureNote)
            ->with('success', __('Secure note updated.'));
    }

    public function destroy(SecureNote $secureNote): RedirectResponse
    {
        Gate::authorize('delete', $secureNote);

        $secureNote->delete();

        return redirect()->route('secure-notes.index')
            ->with('success', __('Secure note deleted.'));
    }

    /**
     * @return array{title: string, content: string}
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'content' => ['required', 'string', 'max:5000'],
        ]);
    }
}
