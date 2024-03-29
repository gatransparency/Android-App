<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPublicOfficialRequest;
use App\Http\Requests\StorePublicOfficialRequest;
use App\Http\Requests\UpdatePublicOfficialRequest;
use App\Models\AgenciesOffice;
use App\Models\PublicOfficial;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PublicOfficialsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('public_official_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PublicOfficial::with(['current_agency'])->select(sprintf('%s.*', (new PublicOfficial)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'public_official_show';
                $editGate      = 'public_official_edit';
                $deleteGate    = 'public_official_delete';
                $crudRoutePart = 'public-officials';

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
            $table->editColumn('gtnn_number', function ($row) {
                return $row->gtnn_number ? $row->gtnn_number : '';
            });
            $table->editColumn('image', function ($row) {
                if ($photo = $row->image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->addColumn('current_agency_agency_name', function ($row) {
                return $row->current_agency ? $row->current_agency->agency_name : '';
            });

            $table->editColumn('badge_number', function ($row) {
                return $row->badge_number ? $row->badge_number : '';
            });
            $table->editColumn('rank_position', function ($row) {
                return $row->rank_position ? $row->rank_position : '';
            });
            $table->editColumn('hourly_rate', function ($row) {
                return $row->hourly_rate ? $row->hourly_rate : '';
            });
            $table->editColumn('annual_salary', function ($row) {
                return $row->annual_salary ? $row->annual_salary : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? PublicOfficial::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('okey_number', function ($row) {
                return $row->okey_number ? $row->okey_number : '';
            });
            $table->editColumn('years', function ($row) {
                return $row->years ? $row->years : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('previous_employment', function ($row) {
                return $row->previous_employment ? $row->previous_employment : '';
            });
            $table->editColumn('professionalism', function ($row) {
                return $row->professionalism ? $row->professionalism : '';
            });
            $table->editColumn('appearance', function ($row) {
                return $row->appearance ? $row->appearance : '';
            });
            $table->editColumn('uniform', function ($row) {
                return $row->uniform ? $row->uniform : '';
            });
            $table->editColumn('attitude', function ($row) {
                return $row->attitude ? $row->attitude : '';
            });
            $table->editColumn('law_knowledge', function ($row) {
                return $row->law_knowledge ? $row->law_knowledge : '';
            });
            $table->editColumn('rights_violations', function ($row) {
                return $row->rights_violations ? $row->rights_violations : '';
            });
            $table->editColumn('if_yes', function ($row) {
                return $row->if_yes ? $row->if_yes : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('signature', function ($row) {
                return $row->signature ? $row->signature : '';
            });
            $table->editColumn('initials', function ($row) {
                return $row->initials ? $row->initials : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image', 'current_agency']);

            return $table->make(true);
        }

        $agencies_offices = AgenciesOffice::get();

        return view('admin.publicOfficials.index', compact('agencies_offices'));
    }

    public function create()
    {
        abort_if(Gate::denies('public_official_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $current_agencies = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.publicOfficials.create', compact('current_agencies'));
    }

    public function store(StorePublicOfficialRequest $request)
    {
        $publicOfficial = PublicOfficial::create($request->all());

        if ($request->input('image', false)) {
            $publicOfficial->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $publicOfficial->id]);
        }

        return redirect()->route('admin.public-officials.index');
    }

    public function edit(PublicOfficial $publicOfficial)
    {
        abort_if(Gate::denies('public_official_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $current_agencies = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $publicOfficial->load('current_agency');

        return view('admin.publicOfficials.edit', compact('current_agencies', 'publicOfficial'));
    }

    public function update(UpdatePublicOfficialRequest $request, PublicOfficial $publicOfficial)
    {
        $publicOfficial->update($request->all());

        if ($request->input('image', false)) {
            if (! $publicOfficial->image || $request->input('image') !== $publicOfficial->image->file_name) {
                if ($publicOfficial->image) {
                    $publicOfficial->image->delete();
                }
                $publicOfficial->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($publicOfficial->image) {
            $publicOfficial->image->delete();
        }

        return redirect()->route('admin.public-officials.index');
    }

    public function show(PublicOfficial $publicOfficial)
    {
        abort_if(Gate::denies('public_official_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publicOfficial->load('current_agency', 'gtnnNumberReports', 'gtnnNumberVehicles', 'gtnnNumberInternalInvestigations', 'gtnnNumberRecords');

        return view('admin.publicOfficials.show', compact('publicOfficial'));
    }

    public function destroy(PublicOfficial $publicOfficial)
    {
        abort_if(Gate::denies('public_official_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $publicOfficial->delete();

        return back();
    }

    public function massDestroy(MassDestroyPublicOfficialRequest $request)
    {
        $publicOfficials = PublicOfficial::find(request('ids'));

        foreach ($publicOfficials as $publicOfficial) {
            $publicOfficial->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('public_official_create') && Gate::denies('public_official_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PublicOfficial();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
