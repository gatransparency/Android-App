<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAgenciesOfficeRequest;
use App\Http\Requests\StoreAgenciesOfficeRequest;
use App\Http\Requests\UpdateAgenciesOfficeRequest;
use App\Models\AgenciesOffice;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AgenciesOfficesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('agencies_office_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AgenciesOffice::query()->select(sprintf('%s.*', (new AgenciesOffice)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'agencies_office_show';
                $editGate      = 'agencies_office_edit';
                $deleteGate    = 'agencies_office_delete';
                $crudRoutePart = 'agencies-offices';

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
            $table->editColumn('agency_name', function ($row) {
                return $row->agency_name ? $row->agency_name : '';
            });
            $table->editColumn('street_address', function ($row) {
                return $row->street_address ? $row->street_address : '';
            });
            $table->editColumn('street_address_additional', function ($row) {
                return $row->street_address_additional ? $row->street_address_additional : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : '';
            });
            $table->editColumn('zip', function ($row) {
                return $row->zip ? $row->zip : '';
            });
            $table->editColumn('website_url', function ($row) {
                return $row->website_url ? $row->website_url : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('agency_email', function ($row) {
                return $row->agency_email ? $row->agency_email : '';
            });
            $table->editColumn('fax', function ($row) {
                return $row->fax ? $row->fax : '';
            });
            $table->editColumn('agency_rating', function ($row) {
                return $row->agency_rating ? $row->agency_rating : '';
            });
            $table->editColumn('notes', function ($row) {
                return $row->notes ? $row->notes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'image']);

            return $table->make(true);
        }

        return view('admin.agenciesOffices.index');
    }

    public function create()
    {
        abort_if(Gate::denies('agencies_office_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agenciesOffices.create');
    }

    public function store(StoreAgenciesOfficeRequest $request)
    {
        $agenciesOffice = AgenciesOffice::create($request->all());

        if ($request->input('image', false)) {
            $agenciesOffice->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $agenciesOffice->id]);
        }

        return redirect()->route('admin.agencies-offices.index');
    }

    public function edit(AgenciesOffice $agenciesOffice)
    {
        abort_if(Gate::denies('agencies_office_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.agenciesOffices.edit', compact('agenciesOffice'));
    }

    public function update(UpdateAgenciesOfficeRequest $request, AgenciesOffice $agenciesOffice)
    {
        $agenciesOffice->update($request->all());

        if ($request->input('image', false)) {
            if (! $agenciesOffice->image || $request->input('image') !== $agenciesOffice->image->file_name) {
                if ($agenciesOffice->image) {
                    $agenciesOffice->image->delete();
                }
                $agenciesOffice->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($agenciesOffice->image) {
            $agenciesOffice->image->delete();
        }

        return redirect()->route('admin.agencies-offices.index');
    }

    public function show(AgenciesOffice $agenciesOffice)
    {
        abort_if(Gate::denies('agencies_office_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agenciesOffice->load('agencyReports', 'agencyRecords', 'agencyVehicles', 'agencyPublicOfficials', 'agencyInternalInvestigations');

        return view('admin.agenciesOffices.show', compact('agenciesOffice'));
    }

    public function destroy(AgenciesOffice $agenciesOffice)
    {
        abort_if(Gate::denies('agencies_office_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agenciesOffice->delete();

        return back();
    }

    public function massDestroy(MassDestroyAgenciesOfficeRequest $request)
    {
        $agenciesOffices = AgenciesOffice::find(request('ids'));

        foreach ($agenciesOffices as $agenciesOffice) {
            $agenciesOffice->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('agencies_office_create') && Gate::denies('agencies_office_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AgenciesOffice();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
