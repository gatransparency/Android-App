<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyBugRequest;
use App\Http\Requests\StoreBugRequest;
use App\Http\Requests\UpdateBugRequest;
use App\Models\Bug;
use App\Models\PortalVersion;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BugsController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bug_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Bug::with(['version'])->select(sprintf('%s.*', (new Bug)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'bug_show';
                $editGate      = 'bug_edit';
                $deleteGate    = 'bug_delete';
                $crudRoutePart = 'bugs';

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
            $table->addColumn('version_portal_version', function ($row) {
                return $row->version ? $row->version->portal_version : '';
            });

            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });
            $table->editColumn('synopsis', function ($row) {
                return $row->synopsis ? $row->synopsis : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'version']);

            return $table->make(true);
        }

        return view('admin.bugs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bug_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $versions = PortalVersion::pluck('portal_version', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bugs.create', compact('versions'));
    }

    public function store(StoreBugRequest $request)
    {
        $bug = Bug::create($request->all());

        return redirect()->route('admin.bugs.index');
    }

    public function edit(Bug $bug)
    {
        abort_if(Gate::denies('bug_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $versions = PortalVersion::pluck('portal_version', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bug->load('version');

        return view('admin.bugs.edit', compact('bug', 'versions'));
    }

    public function update(UpdateBugRequest $request, Bug $bug)
    {
        $bug->update($request->all());

        return redirect()->route('admin.bugs.index');
    }

    public function show(Bug $bug)
    {
        abort_if(Gate::denies('bug_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bug->load('version');

        return view('admin.bugs.show', compact('bug'));
    }

    public function destroy(Bug $bug)
    {
        abort_if(Gate::denies('bug_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bug->delete();

        return back();
    }

    public function massDestroy(MassDestroyBugRequest $request)
    {
        $bugs = Bug::find(request('ids'));

        foreach ($bugs as $bug) {
            $bug->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
