<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoresStoreRequest;
use App\Imports\StoresImport;
use App\Models\Store;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class StoreController extends Controller
{
    /** @var Store $store */
    private $store;

    /**
     * Construct stores.
     */
    public function __construct()
    {
        $this->store = new Store();
    }

    /**
     * Show form imports.
     *
     * @return Renderable
     */
    public function importStores(): Renderable
    {
        return view('admin.store.import');
    }

    /**
     * Upload file imports.
     *
     */
    public function uploadStores(Request $request): RedirectResponse
    {
        Excel::import(new StoresImport, $request->file('file'));

        return redirect()->route('store.index')->with('success', 'Uploaded Successfully');
    }

    /**
     * List stores.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('admin.store.index')->with(['data' => $this->store->getAllStores()]);
    }
}
