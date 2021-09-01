<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    const FORM_VALIDATION_RULES = [
        'description' => 'required|min:10|max:1000',
        'price' => 'required|numeric|between:0,99999.99',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $ads = Advertisement::paginate(8);

        return view('advertisement.index', ['ads' => $ads]);
    }

    public function create()
    {
        return view('advertisement.create');
    }

    public function store(Request $request)
    {
        $request->validate(self::FORM_VALIDATION_RULES);

        $ad = Advertisement::create($request->all());
        $ad->updateImage($request->image);

        return redirect(route('advertisement.show', [$ad->id]))
            ->with('message_type', 'success')
            ->with('message', 'You have successfully posted advertisement.');
    }

    public function show($id)
    {
        $ad = Advertisement::find($id);

        if (!$ad) {
            abort(404);
        }
        return view('advertisement.show', ['ad' => $ad]);
    }

    public function edit($id)
    {
        $ad = Advertisement::find($id);

        if (!$ad) {
            abort(404);
        }

        if (Auth::id() !== $ad->user_id) {
            abort(403);
        }

        return view('advertisement.edit', ['ad' => $ad]);
    }

    public function update(Request $request, $id)
    {
        $ad = Advertisement::find($id);

        if (Auth::id() !== $ad->user_id) {
            abort(403);
        }

        $request->validate(self::FORM_VALIDATION_RULES);

        $ad->update($request->all());
        $ad->updateImage($request->image);

        return redirect(route('advertisement.show', [$ad->id]))
            ->with('message_type', 'success')
            ->with('message', 'You have successfully updated advertisement.');
    }

    public function destroy($id)
    {
        $ad = Advertisement::find($id);

        if (!$ad) {
            return redirect(route('advertisement.admin'));
        }

        if (Auth::id() !== $ad->user_id) {
            abort(403);
        }

        $ad->delete();

        return redirect(route('advertisement.admin'))
            ->with('message_type', 'success')
            ->with('message', 'You have successfully deleted advertisement.');
    }

    public function admin()
    {
        $ads = Advertisement::where('user_id', Auth::id())->get();

        return view('advertisement.admin', ['ads' => $ads]);
    }
}
