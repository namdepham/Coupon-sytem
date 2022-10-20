<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Models\Admin;
use App\Models\App;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppAdminController extends Controller
{
    /**
     * Restrict admins view
     */
    public function __construct()
    {
        $this->middleware('system-admin-verified');
    }

    /**
     * View app lists.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $apps = App::all();
        $data = Admin::query()->whereNotNull('app_id')->orderBy('id', 'desc')->paginate(5);

        return view('admin.appadmin.index')->with(compact('data', 'apps'));

    }

    /**
     * Filter admins.
     *
     * @param Request $request
     * @return JsonResponse|Renderable
     */
    public function filterAdmins(Request $request)
    {
        $app = App::all();
        $query = Admin::query();
        if ($request->ajax()) {
            if (isset($request->app)) {
                $admins = $query->where(['app_id' => $request->app])->get();
            } else {
                $admins = $query->whereNotNull('app_id')->orderBy('id', 'desc')->get();
            }

            return response()->json(['admins' => $admins]);
        }

        return view('admin.appadmin.index')->with(compact('app'));
    }

    /**
     * Show form create admin.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        $data = App::all();

        return view('admin.appadmin.create')->with(compact('data'));
    }

    /**
     * Store an admin.
     *
     * @param AdminStoreRequest $request
     * @return RedirectResponse
     */
    public function store(AdminStoreRequest $request): RedirectResponse
    {
        if ($request->has('image')) {
            $filePath = $request['image']->storeAs('uploads', request('image')->getClientOriginalName(), 'public');
        }
        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->image = $filePath;
        $admin->password = bcrypt($request->input('password'));
        $admin->app_id = $request->input('app_id');
        $admin->save();

        return redirect()->route('appAdmin.index');
    }

    /**
     * @param int $id
     * @return Renderable
     */
    public function show(int $id): Renderable
    {
        $data = Admin::findOrFail($id);
        $app_id = $data->app->id;
        $app = App::query()->where('id', $app_id)->get();

        return view('Admin.AppAdmin.edit')->with(compact('data', 'app'));
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
        if ($request->has('image')) {
            $filePath = $request['image']->storeAs('uploads', request('image')->getClientOriginalName(), 'public');
        }
        $admin = Admin::findOrFail($id);
        $admin->name = $request->get('name');
        $admin->app_id = $request->get('app_id');
        $admin->email = $request->get('email');
        $admin->password = bcrypt($request->input('password'));
        $admin->image = $filePath;
        $admin->save();

        return redirect()->route('appAdmin.index');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('appAdmin.index');
    }
}
