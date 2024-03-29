<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCaseLawRequest;
use App\Http\Requests\StoreCaseLawRequest;
use App\Http\Requests\UpdateCaseLawRequest;
use App\Models\CaseLaw;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CaseLawController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('case_law_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CaseLaw::query()->select(sprintf('%s.*', (new CaseLaw)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'case_law_show';
                $editGate      = 'case_law_edit';
                $deleteGate    = 'case_law_delete';
                $crudRoutePart = 'case-laws';

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
            $table->editColumn('docket_number', function ($row) {
                return $row->docket_number ? $row->docket_number : '';
            });
            $table->editColumn('court', function ($row) {
                return $row->court ? $row->court : '';
            });
            $table->editColumn('case', function ($row) {
                return $row->case ? $row->case : '';
            });

            $table->editColumn('case_narrative', function ($row) {
                return $row->case_narrative ? $row->case_narrative : '';
            });
            $table->editColumn('judge', function ($row) {
                return $row->judge ? $row->judge : '';
            });
            $table->editColumn('case_file', function ($row) {
                if (! $row->case_file) {
                    return '';
                }
                $links = [];
                foreach ($row->case_file as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('added_by', function ($row) {
                return $row->added_by ? $row->added_by : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'case_file']);

            return $table->make(true);
        }

        return view('admin.caseLaws.index');
    }

    public function create()
    {
        abort_if(Gate::denies('case_law_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.caseLaws.create');
    }

    public function store(StoreCaseLawRequest $request)
    {
        $caseLaw = CaseLaw::create($request->all());

        foreach ($request->input('case_file', []) as $file) {
            $caseLaw->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('case_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $caseLaw->id]);
        }

        return redirect()->route('admin.case-laws.index');
    }

    public function edit(CaseLaw $caseLaw)
    {
        abort_if(Gate::denies('case_law_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.caseLaws.edit', compact('caseLaw'));
    }

    public function update(UpdateCaseLawRequest $request, CaseLaw $caseLaw)
    {
        $caseLaw->update($request->all());

        if (count($caseLaw->case_file) > 0) {
            foreach ($caseLaw->case_file as $media) {
                if (! in_array($media->file_name, $request->input('case_file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $caseLaw->case_file->pluck('file_name')->toArray();
        foreach ($request->input('case_file', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $caseLaw->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('case_file');
            }
        }

        return redirect()->route('admin.case-laws.index');
    }

    public function show(CaseLaw $caseLaw)
    {
        abort_if(Gate::denies('case_law_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.caseLaws.show', compact('caseLaw'));
    }

    public function destroy(CaseLaw $caseLaw)
    {
        abort_if(Gate::denies('case_law_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $caseLaw->delete();

        return back();
    }

    public function massDestroy(MassDestroyCaseLawRequest $request)
    {
        $caseLaws = CaseLaw::find(request('ids'));

        foreach ($caseLaws as $caseLaw) {
            $caseLaw->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('case_law_create') && Gate::denies('case_law_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CaseLaw();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
