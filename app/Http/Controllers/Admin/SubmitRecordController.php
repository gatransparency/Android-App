<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySubmitRecordRequest;
use App\Http\Requests\StoreSubmitRecordRequest;
use App\Http\Requests\UpdateSubmitRecordRequest;
use App\Models\SubmitRecord;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SubmitRecordController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('submit_record_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SubmitRecord::query()->select(sprintf('%s.*', (new SubmitRecord)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'submit_record_show';
                $editGate      = 'submit_record_edit';
                $deleteGate    = 'submit_record_delete';
                $crudRoutePart = 'submit-records';

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
            $table->editColumn('role', function ($row) {
                return $row->role ? $row->role : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('agency_affiliation', function ($row) {
                return $row->agency_affiliation ? $row->agency_affiliation : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('image', function ($row) {
                if (! $row->image) {
                    return '';
                }
                $links = [];
                foreach ($row->image as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
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
            $table->editColumn('narrative', function ($row) {
                return $row->narrative ? $row->narrative : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image', 'files']);

            return $table->make(true);
        }

        return view('admin.submitRecords.index');
    }

    public function create()
    {
        abort_if(Gate::denies('submit_record_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.submitRecords.create');
    }

    public function store(StoreSubmitRecordRequest $request)
    {
        $submitRecord = SubmitRecord::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $submitRecord->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        foreach ($request->input('files', []) as $file) {
            $submitRecord->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $submitRecord->id]);
        }

        return redirect()->route('admin.submit-records.index');
    }

    public function edit(SubmitRecord $submitRecord)
    {
        abort_if(Gate::denies('submit_record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.submitRecords.edit', compact('submitRecord'));
    }

    public function update(UpdateSubmitRecordRequest $request, SubmitRecord $submitRecord)
    {
        $submitRecord->update($request->all());

        if (count($submitRecord->image) > 0) {
            foreach ($submitRecord->image as $media) {
                if (! in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $submitRecord->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $submitRecord->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }

        if (count($submitRecord->files) > 0) {
            foreach ($submitRecord->files as $media) {
                if (! in_array($media->file_name, $request->input('files', []))) {
                    $media->delete();
                }
            }
        }
        $media = $submitRecord->files->pluck('file_name')->toArray();
        foreach ($request->input('files', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $submitRecord->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('files');
            }
        }

        return redirect()->route('admin.submit-records.index');
    }

    public function show(SubmitRecord $submitRecord)
    {
        abort_if(Gate::denies('submit_record_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.submitRecords.show', compact('submitRecord'));
    }

    public function destroy(SubmitRecord $submitRecord)
    {
        abort_if(Gate::denies('submit_record_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submitRecord->delete();

        return back();
    }

    public function massDestroy(MassDestroySubmitRecordRequest $request)
    {
        $submitRecords = SubmitRecord::find(request('ids'));

        foreach ($submitRecords as $submitRecord) {
            $submitRecord->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('submit_record_create') && Gate::denies('submit_record_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SubmitRecord();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
