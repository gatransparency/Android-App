<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInvestigatingGovernmentRequest;
use App\Http\Requests\StoreInvestigatingGovernmentRequest;
use App\Http\Requests\UpdateInvestigatingGovernmentRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InvestigatingGovernmentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('investigating_government_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.investigatingGovernments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('investigating_government_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.investigatingGovernments.create');
    }

    public function store(StoreInvestigatingGovernmentRequest $request)
    {
        $investigatingGovernment = InvestigatingGovernment::create($request->all());

        return redirect()->route('admin.investigating-governments.index');
    }

    public function edit(InvestigatingGovernment $investigatingGovernment)
    {
        abort_if(Gate::denies('investigating_government_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.investigatingGovernments.edit', compact('investigatingGovernment'));
    }

    public function update(UpdateInvestigatingGovernmentRequest $request, InvestigatingGovernment $investigatingGovernment)
    {
        $investigatingGovernment->update($request->all());

        return redirect()->route('admin.investigating-governments.index');
    }

    public function show(InvestigatingGovernment $investigatingGovernment)
    {
        abort_if(Gate::denies('investigating_government_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.investigatingGovernments.show', compact('investigatingGovernment'));
    }

    public function destroy(InvestigatingGovernment $investigatingGovernment)
    {
        abort_if(Gate::denies('investigating_government_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $investigatingGovernment->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvestigatingGovernmentRequest $request)
    {
        $investigatingGovernments = InvestigatingGovernment::find(request('ids'));

        foreach ($investigatingGovernments as $investigatingGovernment) {
            $investigatingGovernment->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
