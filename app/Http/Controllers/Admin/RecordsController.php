<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRecordRequest;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use App\Models\AgenciesOffice;
use App\Models\PublicOfficial;
use App\Models\Record;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RecordsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Record::with(['agency', 'public_official'])->select(sprintf('%s.*', (new Record)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'record_show';
                $editGate      = 'record_edit';
                $deleteGate    = 'record_delete';
                $crudRoutePart = 'records';

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

            $table->editColumn('full_name', function ($row) {
                return $row->full_name ? $row->full_name : '';
            });
            $table->editColumn('record_type', function ($row) {
                return $row->record_type ? $row->record_type : '';
            });
            $table->editColumn('record', function ($row) {
                if (! $row->record) {
                    return '';
                }
                $links = [];
                foreach ($row->record as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('entered_by', function ($row) {
                return $row->entered_by ? $row->entered_by : '';
            });
            $table->addColumn('agency_agency_name', function ($row) {
                return $row->agency ? $row->agency->agency_name : '';
            });

            $table->addColumn('public_official_public_official_number', function ($row) {
                return $row->public_official ? $row->public_official->public_official_number : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'record', 'agency', 'public_official']);

            return $table->make(true);
        }

        return view('admin.records.index');
    }

    public function create()
    {
        abort_if(Gate::denies('record_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencies = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $public_officials = PublicOfficial::pluck('public_official_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.records.create', compact('agencies', 'public_officials'));
    }

    public function store(StoreRecordRequest $request)
    {
        $record = Record::create($request->all());

        foreach ($request->input('record', []) as $file) {
            $record->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('record');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $record->id]);
        }

        return redirect()->route('admin.records.index');
    }

    public function edit(Record $record)
    {
        abort_if(Gate::denies('record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencies = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $public_officials = PublicOfficial::pluck('public_official_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $record->load('agency', 'public_official');

        return view('admin.records.edit', compact('agencies', 'public_officials', 'record'));
    }

    public function update(UpdateRecordRequest $request, Record $record)
    {
        $record->update($request->all());

        if (count($record->record) > 0) {
            foreach ($record->record as $media) {
                if (! in_array($media->file_name, $request->input('record', []))) {
                    $media->delete();
                }
            }
        }
        $media = $record->record->pluck('file_name')->toArray();
        foreach ($request->input('record', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $record->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('record');
            }
        }

        return redirect()->route('admin.records.index');
    }

    public function show(Record $record)
    {
        abort_if(Gate::denies('record_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $record->load('agency', 'public_official');

        return view('admin.records.show', compact('record'));
    }

    public function destroy(Record $record)
    {
        abort_if(Gate::denies('record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $record->delete();

        return back();
    }

    public function massDestroy(MassDestroyRecordRequest $request)
    {
        $records = Record::find(request('ids'));

        foreach ($records as $record) {
            $record->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('record_create') && Gate::denies('record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Record();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
