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
use App\Models\User;
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
            $query = InternalInvestigation::with(['agency', 'public_official', 'entered_by'])->select(sprintf('%s.*', (new InternalInvestigation)->table));
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
            $table->addColumn('agency_agency_name', function ($row) {
                return $row->agency ? $row->agency->agency_name : '';
            });

            $table->addColumn('public_official_public_official_number', function ($row) {
                return $row->public_official ? $row->public_official->public_official_number : '';
            });

            $table->editColumn('narrative', function ($row) {
                return $row->narrative ? $row->narrative : '';
            });
            $table->editColumn('file', function ($row) {
                if (! $row->file) {
                    return '';
                }
                $links = [];
                foreach ($row->file as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? InternalInvestigation::STATUS_SELECT[$row->status] : '';
            });
            $table->addColumn('entered_by_name', function ($row) {
                return $row->entered_by ? $row->entered_by->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'agency', 'public_official', 'file', 'entered_by']);

            return $table->make(true);
        }

        $agencies_offices = AgenciesOffice::get();
        $public_officials = PublicOfficial::get();
        $users            = User::get();

        return view('admin.internalInvestigations.index', compact('agencies_offices', 'public_officials', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('internal_investigation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencies = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $public_officials = PublicOfficial::pluck('public_official_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entered_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.internalInvestigations.create', compact('agencies', 'entered_bies', 'public_officials'));
    }

    public function store(StoreInternalInvestigationRequest $request)
    {
        $internalInvestigation = InternalInvestigation::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $internalInvestigation->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $internalInvestigation->id]);
        }

        return redirect()->route('admin.internal-investigations.index');
    }

    public function edit(InternalInvestigation $internalInvestigation)
    {
        abort_if(Gate::denies('internal_investigation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencies = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $public_officials = PublicOfficial::pluck('public_official_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $entered_bies = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $internalInvestigation->load('agency', 'public_official', 'entered_by');

        return view('admin.internalInvestigations.edit', compact('agencies', 'entered_bies', 'internalInvestigation', 'public_officials'));
    }

    public function update(UpdateInternalInvestigationRequest $request, InternalInvestigation $internalInvestigation)
    {
        $internalInvestigation->update($request->all());

        if (count($internalInvestigation->file) > 0) {
            foreach ($internalInvestigation->file as $media) {
                if (! in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $internalInvestigation->file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $internalInvestigation->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
            }
        }

        return redirect()->route('admin.internal-investigations.index');
    }

    public function show(InternalInvestigation $internalInvestigation)
    {
        abort_if(Gate::denies('internal_investigation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $internalInvestigation->load('agency', 'public_official', 'entered_by');

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
