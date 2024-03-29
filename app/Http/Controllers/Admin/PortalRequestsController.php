<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPortalRequestRequest;
use App\Http\Requests\StorePortalRequestRequest;
use App\Http\Requests\UpdatePortalRequestRequest;
use App\Models\PortalRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PortalRequestsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('portal_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PortalRequest::query()->select(sprintf('%s.*', (new PortalRequest)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'portal_request_show';
                $editGate      = 'portal_request_edit';
                $deleteGate    = 'portal_request_delete';
                $crudRoutePart = 'portal-requests';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('request', function ($row) {
                return $row->request ? $row->request : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.portalRequests.index');
    }

    public function create()
    {
        abort_if(Gate::denies('portal_request_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.portalRequests.create');
    }

    public function store(StorePortalRequestRequest $request)
    {
        $portalRequest = PortalRequest::create($request->all());

        return redirect()->route('admin.portal-requests.index');
    }

    public function edit(PortalRequest $portalRequest)
    {
        abort_if(Gate::denies('portal_request_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.portalRequests.edit', compact('portalRequest'));
    }

    public function update(UpdatePortalRequestRequest $request, PortalRequest $portalRequest)
    {
        $portalRequest->update($request->all());

        return redirect()->route('admin.portal-requests.index');
    }

    public function show(PortalRequest $portalRequest)
    {
        abort_if(Gate::denies('portal_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.portalRequests.show', compact('portalRequest'));
    }

    public function destroy(PortalRequest $portalRequest)
    {
        abort_if(Gate::denies('portal_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $portalRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyPortalRequestRequest $request)
    {
        $portalRequests = PortalRequest::find(request('ids'));

        foreach ($portalRequests as $portalRequest) {
            $portalRequest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
