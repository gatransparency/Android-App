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
            $query = PublicOfficial::with(['agency'])->select(sprintf('%s.*', (new PublicOfficial)->table));
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
            $table->addColumn('agency_agency_name', function ($row) {
                return $row->agency ? $row->agency->agency_name : '';
            });

            $table->editColumn('public_official_number', function ($row) {
                return $row->public_official_number ? $row->public_official_number : '';
            });
            $table->editColumn('first_name', function ($row) {
                return $row->first_name ? $row->first_name : '';
            });
            $table->editColumn('middle_name', function ($row) {
                return $row->middle_name ? $row->middle_name : '';
            });
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('badge_employee_number', function ($row) {
                return $row->badge_employee_number ? $row->badge_employee_number : '';
            });
            $table->editColumn('sex', function ($row) {
                return $row->sex ? $row->sex : '';
            });
            $table->editColumn('rank', function ($row) {
                return $row->rank ? $row->rank : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? PublicOfficial::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('officer_key_number', function ($row) {
                return $row->officer_key_number ? $row->officer_key_number : '';
            });

            $table->editColumn('years_in_profession', function ($row) {
                return $row->years_in_profession ? $row->years_in_profession : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('previous_agency', function ($row) {
                return $row->previous_agency ? $row->previous_agency : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });
            $table->editColumn('accuracy', function ($row) {
                return $row->accuracy ? $row->accuracy : '';
            });
            $table->editColumn('signature', function ($row) {
                return $row->signature ? $row->signature : '';
            });
            $table->editColumn('initials', function ($row) {
                return $row->initials ? $row->initials : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image', 'agency']);

            return $table->make(true);
        }

        $agencies_offices = AgenciesOffice::get();

        return view('admin.publicOfficials.index', compact('agencies_offices'));
    }

    public function create()
    {
        abort_if(Gate::denies('public_official_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencies = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.publicOfficials.create', compact('agencies'));
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

        $agencies = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $publicOfficial->load('agency');

        return view('admin.publicOfficials.edit', compact('agencies', 'publicOfficial'));
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

        $publicOfficial->load('agency', 'officialNumberReports', 'publicOfficialRecords', 'publicOfficialVehicles', 'publicOfficialInternalInvestigations');

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
