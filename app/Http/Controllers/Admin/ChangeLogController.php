<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyChangeLogRequest;
use App\Http\Requests\StoreChangeLogRequest;
use App\Http\Requests\UpdateChangeLogRequest;
use App\Models\ChangeLog;
use App\Models\PortalVersion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ChangeLogController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('change_log_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ChangeLog::with(['portal_version'])->select(sprintf('%s.*', (new ChangeLog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'change_log_show';
                $editGate      = 'change_log_edit';
                $deleteGate    = 'change_log_delete';
                $crudRoutePart = 'change-logs';

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
            $table->addColumn('portal_version_portal_version', function ($row) {
                return $row->portal_version ? $row->portal_version->portal_version : '';
            });

            $table->editColumn('change', function ($row) {
                return $row->change ? ChangeLog::CHANGE_SELECT[$row->change] : '';
            });
            $table->editColumn('log', function ($row) {
                return $row->log ? $row->log : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'portal_version']);

            return $table->make(true);
        }

        $portal_versions = PortalVersion::get();

        return view('admin.changeLogs.index', compact('portal_versions'));
    }

    public function create()
    {
        abort_if(Gate::denies('change_log_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $portal_versions = PortalVersion::pluck('portal_version', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.changeLogs.create', compact('portal_versions'));
    }

    public function store(StoreChangeLogRequest $request)
    {
        $changeLog = ChangeLog::create($request->all());

        return redirect()->route('admin.change-logs.index');
    }

    public function edit(ChangeLog $changeLog)
    {
        abort_if(Gate::denies('change_log_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $portal_versions = PortalVersion::pluck('portal_version', 'id')->prepend(trans('global.pleaseSelect'), '');

        $changeLog->load('portal_version');

        return view('admin.changeLogs.edit', compact('changeLog', 'portal_versions'));
    }

    public function update(UpdateChangeLogRequest $request, ChangeLog $changeLog)
    {
        $changeLog->update($request->all());

        return redirect()->route('admin.change-logs.index');
    }

    public function show(ChangeLog $changeLog)
    {
        abort_if(Gate::denies('change_log_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $changeLog->load('portal_version');

        return view('admin.changeLogs.show', compact('changeLog'));
    }

    public function destroy(ChangeLog $changeLog)
    {
        abort_if(Gate::denies('change_log_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $changeLog->delete();

        return back();
    }

    public function massDestroy(MassDestroyChangeLogRequest $request)
    {
        $changeLogs = ChangeLog::find(request('ids'));

        foreach ($changeLogs as $changeLog) {
            $changeLog->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
