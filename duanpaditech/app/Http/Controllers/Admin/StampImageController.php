<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StampImageStoreRequest;
use App\Models\Stamp;
use App\Models\StampImage;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StampImageController extends Controller
{
    private $image;
    private $stamp;

    public function __construct()
    {
        $this->image = new StampImage();
        $this->stamp = new Stamp();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('admin.stampimage.index')->with(['data' => $this->image->getAllImages()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.stampimage.create')->with(['data' => $this->stamp->getStamp($_GET['stamp_id'])]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StampImageStoreRequest $request
     * @return RedirectResponse
     */
    public function store(StampImageStoreRequest $request): RedirectResponse
    {
        if ($request->has('image_before_ticked') && $request->has('image_after_ticked')) {
            $imageBefore = $request['image_before_ticked']->storeAs('uploads', request('image_before_ticked')->getClientOriginalName(), 'public');
            $imageAfter = $request['image_after_ticked']->storeAs('uploads', request('image_after_ticked')->getClientOriginalName(), 'public');
        }
        $inputs = [
            'image_before_ticked' => $imageBefore,
            'image_after_ticked' => $imageAfter,
            'stamp_id' => $request->input('stamp_id')
        ];
        StampImage::create($inputs);

        return redirect()->route('image.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Renderable
     */
    public function show($id): Renderable
    {
        return view('admin.stampimage.edit')->with(['data' => $this->image->getAImage($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StampImageStoreRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(StampImageStoreRequest $request, int $id): RedirectResponse
    {
        $stamp_image = StampImage::find($id);

        if ($request->has('image_before_ticked') && $request->has('image_after_ticked')) {
            $imageBefore = $request['image_before_ticked']->storeAs('uploads', request('image_before_ticked')->getClientOriginalName(), 'public');
            $imageAfter = $request['image_after_ticked']->storeAs('uploads', request('image_after_ticked')->getClientOriginalName(), 'public');
        }
        $stamp_image->stamp_id = $request->input('stamp_id');
        $stamp_image->image_before_ticked = $imageBefore;
        $stamp_image->image_after_ticked = $imageAfter;

        $stamp_image->save();

        return redirect()->route('image.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $stamp = StampImage::findOrFail($id);
        $stamp->delete();

        return redirect()->route('image.index');
    }
}
