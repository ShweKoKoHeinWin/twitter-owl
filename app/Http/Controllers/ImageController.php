<?php

namespace App\Http\Controllers;

use App\Helper\ImageHelper;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index() {
        $images = Image::all();
        return view('admin.image.index', compact('images'));
    }

    public function destroy(Image $image) {
        // noti for user image has deleted


        // delete image
        ImageHelper::delete($image);

        return redirect()->route('admin.image')->with('alert-success', 'Image has deleted.');
    }

    public function destroyMany() {
        $validated = request()->validate([
            'del-images' => ['required', 'array']
        ]);

        foreach($validated['del-images'] as $id) {
            $image = Image::where('id', $id)->first();
            $this->destroy($image);
        }

        return redirect()->route('admin.image')->with('alert-success', 'Deleted ' . $validated['del-images']->count() . ' images successfully.');
    }
}
