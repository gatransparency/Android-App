<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\AgenciesOffice;
use App\Models\PublicOfficial;
use App\Models\Report;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ReportsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Report::with(['gtnn_number', 'agency'])->select(sprintf('%s.*', (new Report)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'report_show';
                $editGate      = 'report_edit';
                $deleteGate    = 'report_delete';
                $crudRoutePart = 'reports';

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
            $table->addColumn('gtnn_number_gtnn_number', function ($row) {
                return $row->gtnn_number ? $row->gtnn_number->gtnn_number : '';
            });

            $table->addColumn('agency_agency_name', function ($row) {
                return $row->agency ? $row->agency->agency_name : '';
            });

            $table->editColumn('report_number', function ($row) {
                return $row->report_number ? $row->report_number : '';
            });

            $table->editColumn('full_name', function ($row) {
                return $row->full_name ? $row->full_name : '';
            });
            $table->editColumn('time', function ($row) {
                return $row->time ? $row->time : '';
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });
            $table->editColumn('narrative', function ($row) {
                return $row->narrative ? $row->narrative : '';
            });
            $table->editColumn('report_status', function ($row) {
                return $row->report_status ? Report::REPORT_STATUS_SELECT[$row->report_status] : '';
            });
            $table->editColumn('release', function ($row) {
                return $row->release ? Report::RELEASE_SELECT[$row->release] : '';
            });
            $table->editColumn('admin_signature', function ($row) {
                return $row->admin_signature ? $row->admin_signature : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'gtnn_number', 'agency']);

            return $table->make(true);
        }

        $public_officials = PublicOfficial::get();
        $agencies_offices = AgenciesOffice::get();

        return view('admin.reports.index', compact('public_officials', 'agencies_offices'));
    }

    public function create()
    {
        abort_if(Gate::denies('report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gtnn_numbers = PublicOfficial::pluck('gtnn_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $agencies = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.reports.create', compact('agencies', 'gtnn_numbers'));
    }

    public function store(StoreReportRequest $request)
    {
        $report = Report::create($request->all());

        return redirect()->route('admin.reports.index');
    }

    public function edit(Report $report)
    {
        abort_if(Gate::denies('report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gtnn_numbers = PublicOfficial::pluck('gtnn_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $agencies = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $report->load('gtnn_number', 'agency');

        return view('admin.reports.edit', compact('agencies', 'gtnn_numbers', 'report'));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        $report->update($request->all());

        return redirect()->route('admin.reports.index');
    }

    public function show(Report $report)
    {
        abort_if(Gate::denies('report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->load('gtnn_number', 'agency');

        return view('admin.reports.show', compact('report'));
    }

    public function destroy(Report $report)
    {
        abort_if(Gate::denies('report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $report->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportRequest $request)
    {
        $reports = Report::find(request('ids'));

        foreach ($reports as $report) {
            $report->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
