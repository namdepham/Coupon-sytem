<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppStoreRequest;
use App\Models\App;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppController extends Controller
{
    private $app;

    public function __construct()
    {
        $this->middleware('system-admin-verified');
        $this->app = new App();
    }

    /**
     * View app lists.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('admin.app.index')->with(['data' => $this->app->getAllApps()]);
    }

    /**
     * Show form create app.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('admin.app.create');
    }

    /**
     * Store an app.
     *
     * @param AppStoreRequest $request
     * @return RedirectResponse
     */
    public function store(AppStoreRequest $request): RedirectResponse
    {
        if ($request->has('logo')) {
            $filePath = $request['logo']->storeAs('uploads', request('logo')->getClientOriginalName(), 'public');
        }
        $inputs = [
            'name' => $request->input('name'),
            'logo' => $filePath
        ];
        App::create($inputs);

        return redirect()->route('app.index');
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function show(int $id): Renderable
    {
        $data = App::findOrFail($id);

        return view('admin.app.edit')->with(compact('data'));
    }

    /**
     * Update app.
     *
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request): RedirectResponse
    {
        if ($request->has('logo')) {
            $filePath = $request['logo']->storeAs('uploads', request('logo')->getClientOriginalName(), 'public');
        }
        $app = App::findOrFail($id);
        $app->name = $request->get('name');
        $app->logo = $filePath;
        $app->save();

        return redirect()->route('app.index');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $app = App::findOrFail($id);
        $app->delete();

        return redirect()->route('app.index');
    }
}
