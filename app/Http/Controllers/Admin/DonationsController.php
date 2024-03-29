<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDonationRequest;
use App\Http\Requests\StoreDonationRequest;
use App\Http\Requests\UpdateDonationRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DonationsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('donation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.donations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('donation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.donations.create');
    }

    public function store(StoreDonationRequest $request)
    {
        $donation = Donation::create($request->all());

        return redirect()->route('admin.donations.index');
    }

    public function edit(Donation $donation)
    {
        abort_if(Gate::denies('donation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.donations.edit', compact('donation'));
    }

    public function update(UpdateDonationRequest $request, Donation $donation)
    {
        $donation->update($request->all());

        return redirect()->route('admin.donations.index');
    }

    public function show(Donation $donation)
    {
        abort_if(Gate::denies('donation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.donations.show', compact('donation'));
    }

    public function destroy(Donation $donation)
    {
        abort_if(Gate::denies('donation_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donation->delete();

        return back();
    }

    public function massDestroy(MassDestroyDonationRequest $request)
    {
        $donations = Donation::find(request('ids'));

        foreach ($donations as $donation) {
            $donation->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
