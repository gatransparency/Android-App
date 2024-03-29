<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyReportbugRequest;
use App\Http\Requests\StoreReportbugRequest;
use App\Http\Requests\UpdateReportbugRequest;
use App\Models\Reportbug;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReportbugController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('reportbug_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Reportbug::query()->select(sprintf('%s.*', (new Reportbug)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'reportbug_show';
                $editGate      = 'reportbug_edit';
                $deleteGate    = 'reportbug_delete';
                $crudRoutePart = 'reportbugs';

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
            $table->editColumn('synopsis', function ($row) {
                return $row->synopsis ? $row->synopsis : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.reportbugs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('reportbug_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reportbugs.create');
    }

    public function store(StoreReportbugRequest $request)
    {
        $reportbug = Reportbug::create($request->all());

        return redirect()->route('admin.reportbugs.index');
    }

    public function edit(Reportbug $reportbug)
    {
        abort_if(Gate::denies('reportbug_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reportbugs.edit', compact('reportbug'));
    }

    public function update(UpdateReportbugRequest $request, Reportbug $reportbug)
    {
        $reportbug->update($request->all());

        return redirect()->route('admin.reportbugs.index');
    }

    public function show(Reportbug $reportbug)
    {
        abort_if(Gate::denies('reportbug_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reportbugs.show', compact('reportbug'));
    }

    public function destroy(Reportbug $reportbug)
    {
        abort_if(Gate::denies('reportbug_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reportbug->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportbugRequest $request)
    {
        $reportbugs = Reportbug::find(request('ids'));

        foreach ($reportbugs as $reportbug) {
            $reportbug->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
