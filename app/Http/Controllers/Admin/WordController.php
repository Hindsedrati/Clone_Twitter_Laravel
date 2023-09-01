<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Http\Controllers\Controller;

use App\Models\Report;
use App\Models\User;
use App\Models\Word;

class WordController extends Controller
{
    public function blackListWords()
    {
        $words = Word::all();

        return $this->renderAdminView('admin.blackListWord', [ 'words' => $words ]);
    }

    public function wordAddView()
    {
        return $this->renderAdminView('admin.addWord', []);
    }

    public function wordAdd(Request $request)
    {
        $request->validate([
            'word' => ['required', 'string', 'max:255', 'unique:'.Word::class],
        ]);

        $word = new Word();
        $word->word = $request->word;
        $word->user_id = Auth::user()->id;
        $word->save();

        return back()->with('statut', 'Word added successfully.');
    }

    public function wordEditView(Word $word)
    {
        return $this->renderAdminView('admin.editWord', [ 'word' => $word ]);
    }

    public function wordUpdate(Request $request, Word $word)
    {
        $request->validate([
            'word' => ['required', 'string', 'max:255', 'unique:'.Word::class],
        ]);

        $word->word = $request->word;
        $word->user_id = Auth::user()->id;
        $word->save();

        return back()->with('statut', 'Word edited successfully.');
    }

    public function wordDelete(Word $word)
    {
        $word->delete();

        return back()->with('statut', 'Word deleted successfully.');
    }

    public function wordEdit(Request $request, Word $word)
    {
        $request->validate([
            'word' => ['required', 'string', 'max:255', 'unique:'.Word::class],
        ]);

        $word->word = $request->word;
        $word->user_id = Auth::user()->id;
        $word->save();

        return back()->with('statut', 'Word edited successfully.');
    }
}
