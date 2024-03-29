<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOpenRecordsInfoRequest;
use App\Http\Requests\StoreOpenRecordsInfoRequest;
use App\Http\Requests\UpdateOpenRecordsInfoRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OpenRecordsInfoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('open_records_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.openRecordsInfos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('open_records_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.openRecordsInfos.create');
    }

    public function store(StoreOpenRecordsInfoRequest $request)
    {
        $openRecordsInfo = OpenRecordsInfo::create($request->all());

        return redirect()->route('admin.open-records-infos.index');
    }

    public function edit(OpenRecordsInfo $openRecordsInfo)
    {
        abort_if(Gate::denies('open_records_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.openRecordsInfos.edit', compact('openRecordsInfo'));
    }

    public function update(UpdateOpenRecordsInfoRequest $request, OpenRecordsInfo $openRecordsInfo)
    {
        $openRecordsInfo->update($request->all());

        return redirect()->route('admin.open-records-infos.index');
    }

    public function show(OpenRecordsInfo $openRecordsInfo)
    {
        abort_if(Gate::denies('open_records_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.openRecordsInfos.show', compact('openRecordsInfo'));
    }

    public function destroy(OpenRecordsInfo $openRecordsInfo)
    {
        abort_if(Gate::denies('open_records_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $openRecordsInfo->delete();

        return back();
    }

    public function massDestroy(MassDestroyOpenRecordsInfoRequest $request)
    {
        $openRecordsInfos = OpenRecordsInfo::find(request('ids'));

        foreach ($openRecordsInfos as $openRecordsInfo) {
            $openRecordsInfo->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
