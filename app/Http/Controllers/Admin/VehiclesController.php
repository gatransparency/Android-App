<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVehicleRequest;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\AgenciesOffice;
use App\Models\PublicOfficial;
use App\Models\Vehicle;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VehiclesController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('vehicle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Vehicle::with(['agency', 'public_official'])->select(sprintf('%s.*', (new Vehicle)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'vehicle_show';
                $editGate      = 'vehicle_edit';
                $deleteGate    = 'vehicle_delete';
                $crudRoutePart = 'vehicles';

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
            $table->editColumn('make', function ($row) {
                return $row->make ? $row->make : '';
            });
            $table->editColumn('model', function ($row) {
                return $row->model ? $row->model : '';
            });
            $table->editColumn('year', function ($row) {
                return $row->year ? $row->year : '';
            });
            $table->editColumn('number', function ($row) {
                return $row->number ? $row->number : '';
            });
            $table->editColumn('marked', function ($row) {
                return $row->marked ? Vehicle::MARKED_SELECT[$row->marked] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'agency', 'public_official', 'image']);

            return $table->make(true);
        }

        return view('admin.vehicles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('vehicle_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencies = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $public_officials = PublicOfficial::pluck('public_official_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vehicles.create', compact('agencies', 'public_officials'));
    }

    public function store(StoreVehicleRequest $request)
    {
        $vehicle = Vehicle::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $vehicle->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $vehicle->id]);
        }

        return redirect()->route('admin.vehicles.index');
    }

    public function edit(Vehicle $vehicle)
    {
        abort_if(Gate::denies('vehicle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencies = AgenciesOffice::pluck('agency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $public_officials = PublicOfficial::pluck('public_official_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vehicle->load('agency', 'public_official');

        return view('admin.vehicles.edit', compact('agencies', 'public_officials', 'vehicle'));
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->all());

        if (count($vehicle->image) > 0) {
            foreach ($vehicle->image as $media) {
                if (! in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $vehicle->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $vehicle->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.vehicles.index');
    }

    public function show(Vehicle $vehicle)
    {
        abort_if(Gate::denies('vehicle_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicle->load('agency', 'public_official');

        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function destroy(Vehicle $vehicle)
    {
        abort_if(Gate::denies('vehicle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vehicle->delete();

        return back();
    }

    public function massDestroy(MassDestroyVehicleRequest $request)
    {
        $vehicles = Vehicle::find(request('ids'));

        foreach ($vehicles as $vehicle) {
            $vehicle->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('vehicle_create') && Gate::denies('vehicle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Vehicle();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
