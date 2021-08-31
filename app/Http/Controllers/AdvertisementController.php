<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    const FORM_VALIDATION_RULES = [
        'description' => 'required|min:10|max:1000',
        'price' => 'required|numeric|between:0,99999.99',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

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

        return view('advertisement.edit', ['ad' => $ad]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(self::FORM_VALIDATION_RULES);

        $ad = Advertisement::find($id);
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
            return redirect(route('advertisement.index'));
        }

        $ad->delete();

        return redirect(route('advertisement.index'))
            ->with('message_type', 'success')
            ->with('message', 'You have successfully deleted advertisement.');
    }
}
