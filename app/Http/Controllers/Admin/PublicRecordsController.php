<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPublicRecordRequest;
use App\Http\Requests\StorePublicRecordRequest;
use App\Http\Requests\UpdatePublicRecordRequest;
use App\Models\PublicRecord;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PublicRecordsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('public_record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PublicRecord::query()->select(sprintf('%s.*', (new PublicRecord)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'public_record_show';
                $editGate      = 'public_record_edit';
                $deleteGate    = 'public_record_delete';
                $crudRoutePart = 'public-records';

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
            $table->editColumn('request_number', function ($row) {
                return $row->request_number ? $row->request_number : '';
            });
            $table->editColumn('agency', function ($row) {
                return $row->agency ? $row->agency : '';
            });

            $table->editColumn('county', function ($row) {
                return $row->county ? $row->county : '';
            });
            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : '';
            });
            $table->editColumn('records_requested', function ($row) {
                return $row->records_requested ? $row->records_requested : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? PublicRecord::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('estimated_amount', function ($row) {
                return $row->estimated_amount ? $row->estimated_amount : '';
            });
            $table->editColumn('amount_paid', function ($row) {
                return $row->amount_paid ? $row->amount_paid : '';
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

            $table->rawColumns(['actions', 'placeholder', 'file']);

            return $table->make(true);
        }

        return view('admin.publicRecords.index');
    }

    public function create()
    {
        abort_if(Gate::denies('public_record_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.publicRecords.create');
    }

    public function store(StorePublicRecordRequest $request)
    {
        $publicRecord = PublicRecord::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $publicRecord->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $publicRecord->id]);
        }

        return redirect()->route('admin.public-records.index');
    }

    public function edit(PublicRecord $publicRecord)
    {
        abort_if(Gate::denies('public_record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.publicRecords.edit', compact('publicRecord'));
    }

    public function update(UpdatePublicRecordRequest $request, PublicRecord $publicRecord)
    {
        $publicRecord->update($request->all());

        if (count($publicRecord->file) > 0) {
            foreach ($publicRecord->file as $media) {
                if (! in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $publicRecord->file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $publicRecord->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
            }
        }

        return redirect()->route('admin.public-records.index');
    }

    public function show(PublicRecord $publicRecord)
    {
        abort_if(Gate::denies('public_record_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.publicRecords.show', compact('publicRecord'));
    }

    public function destroy(PublicRecord $publicRecord)
    {
        abort_if(Gate::denies('public_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publicRecord->delete();

        return back();
    }

    public function massDestroy(MassDestroyPublicRecordRequest $request)
    {
        $publicRecords = PublicRecord::find(request('ids'));

        foreach ($publicRecords as $publicRecord) {
            $publicRecord->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('public_record_create') && Gate::denies('public_record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PublicRecord();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
