<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPortalVersionRequest;
use App\Http\Requests\StorePortalVersionRequest;
use App\Http\Requests\UpdatePortalVersionRequest;
use App\Models\PortalVersion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PortalVersionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('portal_version_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PortalVersion::query()->select(sprintf('%s.*', (new PortalVersion)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'portal_version_show';
                $editGate      = 'portal_version_edit';
                $deleteGate    = 'portal_version_delete';
                $crudRoutePart = 'portal-versions';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('portal_version', function ($row) {
                return $row->portal_version ? $row->portal_version : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.portalVersions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('portal_version_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.portalVersions.create');
    }

    public function store(StorePortalVersionRequest $request)
    {
        $portalVersion = PortalVersion::create($request->all());

        return redirect()->route('admin.portal-versions.index');
    }

    public function edit(PortalVersion $portalVersion)
    {
        abort_if(Gate::denies('portal_version_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.portalVersions.edit', compact('portalVersion'));
    }

    public function update(UpdatePortalVersionRequest $request, PortalVersion $portalVersion)
    {
        $portalVersion->update($request->all());

        return redirect()->route('admin.portal-versions.index');
    }

    public function show(PortalVersion $portalVersion)
    {
        abort_if(Gate::denies('portal_version_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $portalVersion->load('versionBugs', 'portalVersionChangeLogs');

        return view('admin.portalVersions.show', compact('portalVersion'));
    }

    public function destroy(PortalVersion $portalVersion)
    {
        abort_if(Gate::denies('portal_version_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $portalVersion->delete();

        return back();
    }

    public function massDestroy(MassDestroyPortalVersionRequest $request)
    {
        $portalVersions = PortalVersion::find(request('ids'));

        foreach ($portalVersions as $portalVersion) {
            $portalVersion->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
