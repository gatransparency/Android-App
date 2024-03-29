<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGettingStartedRequest;
use App\Http\Requests\StoreGettingStartedRequest;
use App\Http\Requests\UpdateGettingStartedRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GettingStartedController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('getting_started_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gettingStarteds.index');
    }

    public function create()
    {
        abort_if(Gate::denies('getting_started_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gettingStarteds.create');
    }

    public function store(StoreGettingStartedRequest $request)
    {
        $gettingStarted = GettingStarted::create($request->all());

        return redirect()->route('admin.getting-starteds.index');
    }

    public function edit(GettingStarted $gettingStarted)
    {
        abort_if(Gate::denies('getting_started_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gettingStarteds.edit', compact('gettingStarted'));
    }

    public function update(UpdateGettingStartedRequest $request, GettingStarted $gettingStarted)
    {
        $gettingStarted->update($request->all());

        return redirect()->route('admin.getting-starteds.index');
    }

    public function show(GettingStarted $gettingStarted)
    {
        abort_if(Gate::denies('getting_started_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gettingStarteds.show', compact('gettingStarted'));
    }

    public function destroy(GettingStarted $gettingStarted)
    {
        abort_if(Gate::denies('getting_started_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gettingStarted->delete();

        return back();
    }

    public function massDestroy(MassDestroyGettingStartedRequest $request)
    {
        $gettingStarteds = GettingStarted::find(request('ids'));

        foreach ($gettingStarteds as $gettingStarted) {
            $gettingStarted->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
