<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyFormRequest;
use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Models\Form;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FormsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Form::query()->select(sprintf('%s.*', (new Form)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'form_show';
                $editGate      = 'form_edit';
                $deleteGate    = 'form_delete';
                $crudRoutePart = 'forms';

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
            $table->editColumn('form_number', function ($row) {
                return $row->form_number ? $row->form_number : '';
            });
            $table->editColumn('form_name', function ($row) {
                return $row->form_name ? $row->form_name : '';
            });
            $table->editColumn('form_format', function ($row) {
                return $row->form_format ? Form::FORM_FORMAT_SELECT[$row->form_format] : '';
            });
            $table->editColumn('form', function ($row) {
                if (! $row->form) {
                    return '';
                }
                $links = [];
                foreach ($row->form as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'form']);

            return $table->make(true);
        }

        return view('admin.forms.index');
    }

    public function create()
    {
        abort_if(Gate::denies('form_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.forms.create');
    }

    public function store(StoreFormRequest $request)
    {
        $form = Form::create($request->all());

        foreach ($request->input('form', []) as $file) {
            $form->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('form');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $form->id]);
        }

        return redirect()->route('admin.forms.index');
    }

    public function edit(Form $form)
    {
        abort_if(Gate::denies('form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.forms.edit', compact('form'));
    }

    public function update(UpdateFormRequest $request, Form $form)
    {
        $form->update($request->all());

        if (count($form->form) > 0) {
            foreach ($form->form as $media) {
                if (! in_array($media->file_name, $request->input('form', []))) {
                    $media->delete();
                }
            }
        }
        $media = $form->form->pluck('file_name')->toArray();
        foreach ($request->input('form', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $form->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('form');
            }
        }

        return redirect()->route('admin.forms.index');
    }

    public function show(Form $form)
    {
        abort_if(Gate::denies('form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.forms.show', compact('form'));
    }

    public function destroy(Form $form)
    {
        abort_if(Gate::denies('form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $form->delete();

        return back();
    }

    public function massDestroy(MassDestroyFormRequest $request)
    {
        $forms = Form::find(request('ids'));

        foreach ($forms as $form) {
            $form->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('form_create') && Gate::denies('form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Form();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
