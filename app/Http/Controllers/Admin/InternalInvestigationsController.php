<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyInternalInvestigationRequest;
use App\Http\Requests\StoreInternalInvestigationRequest;
use App\Http\Requests\UpdateInternalInvestigationRequest;
use App\Models\AgenciesOffice;
use App\Models\InternalInvestigation;
use App\Models\PublicOfficial;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InternalInvestigationsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('internal_investigation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InternalInvestigation::with(['gtnn_number', 'agency_office'])->select(sprintf('%s.*', (new InternalInvestigation)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'internal_investigation_show';
                $editGate      = 'internal_investigation_edit';
                $deleteGate    = 'internal_investigation_delete';
                $crudRoutePart = 'internal-investigations';

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

            $table->addColumn('agency_office_agency_name', function ($row) {
                return $row->agency_office ? $row->agency_office->agency_name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('investigator', function ($row) {
                return $row->investigator ? $row->investigator : '';
            });
            $table->editColumn('narrative', function ($row) {
                return $row->narrative ? $row->narrative : '';
            });
            $table->editColumn('files', function ($row) {
                if (! $row->files) {
                    return '';
                }
                $links = [];
                foreach ($row->files as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('entered_by', function ($row) {
                return $row->entered_by ? $row->entered_by : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'gtnn_number', 'agency_office', 'files']);

            return $table->make(true);
        }

        $public_officials = PublicOfficial::get();
        $agencies_offices = AgenciesOffice::get();

        return view('admin.internalInvestigations.index', compact('public_officials', 'agencies_offices'));
    }

    public function create()
    {
        abort_if(Gate::denies('internal_investigation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gtnn_numbers = PublicOfficial::pluck('gtnn_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $agency_offices = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.internalInvestigations.create', compact('agency_offices', 'gtnn_numbers'));
    }

    public function store(StoreInternalInvestigationRequest $request)
    {
        $internalInvestigation = InternalInvestigation::create($request->all());

        foreach ($request->input('files', []) as $file) {
            $internalInvestigation->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $internalInvestigation->id]);
        }

        return redirect()->route('admin.internal-investigations.index');
    }

    public function edit(InternalInvestigation $internalInvestigation)
    {
        abort_if(Gate::denies('internal_investigation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gtnn_numbers = PublicOfficial::pluck('gtnn_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $agency_offices = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $internalInvestigation->load('gtnn_number', 'agency_office');

        return view('admin.internalInvestigations.edit', compact('agency_offices', 'gtnn_numbers', 'internalInvestigation'));
    }

    public function update(UpdateInternalInvestigationRequest $request, InternalInvestigation $internalInvestigation)
    {
        $internalInvestigation->update($request->all());

        if (count($internalInvestigation->files) > 0) {
            foreach ($internalInvestigation->files as $media) {
                if (! in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $internalInvestigation->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $internalInvestigation->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.internal-investigations.index');
    }

    public function show(InternalInvestigation $internalInvestigation)
    {
        abort_if(Gate::denies('internal_investigation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $internalInvestigation->load('gtnn_number', 'agency_office');

        return view('admin.internalInvestigations.show', compact('internalInvestigation'));
    }

    public function destroy(InternalInvestigation $internalInvestigation)
    {
        abort_if(Gate::denies('internal_investigation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $internalInvestigation->delete();

        return back();
    }

    public function massDestroy(MassDestroyInternalInvestigationRequest $request)
    {
        $internalInvestigations = InternalInvestigation::find(request('ids'));

        foreach ($internalInvestigations as $internalInvestigation) {
            $internalInvestigation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('internal_investigation_create') && Gate::denies('internal_investigation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new InternalInvestigation();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
