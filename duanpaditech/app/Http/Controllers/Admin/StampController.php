<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StampStoreRequest;
use App\Models\App;
use App\Models\Stamp;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StampController extends Controller
{
    /**
     * @var Stamp
     */
    private $stamp;

    /**
     * Construct stamp.
     */
    public function __construct()
    {
        $this->stamp = new Stamp();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('admin.stamp.index')->with(['data' => $this->stamp->getStamps()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        $apps = App::all();

        return view('admin.stamp.create')->with(compact('apps'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StampStoreRequest $request
     * @return RedirectResponse
     */
    public function store(StampStoreRequest $request): RedirectResponse
    {
        $inputs = [
            'config_stamp' => $request->get('config_stamp'),
            'app_id' => $request->input('app_id'),
            'in_many_times' => $request->input('in_many_times'),
        ];
        Stamp::create($inputs);

        return redirect()->route('stamp.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Renderable
     */
    public function show(int $id): Renderable
    {
        $stamp = Stamp::findOrFail($id);

        return view('admin.stamp.edit')->with(['data' => $this->stamp->getStampApp($stamp->app->id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $stamp = Stamp::findOrFail($id);
        $stamp->config_stamp = $request->input('config_stamp');
        $stamp->in_many_times = $request->input('in_many_times');
        $stamp->app_id = $request->input('app_id');

        $stamp->save();

        return redirect()->route('stamp.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $stamp = Stamp::findOrFail($id);
        $stamp->delete();

        return redirect()->route('stamp.index');
    }
}
