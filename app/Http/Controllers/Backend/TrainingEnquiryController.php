<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveTrainingEnquiryRequest;
use App\Models\TrainingEnquiry;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TrainingEnquiryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Backend/Program/Enquiries', ['enquiries' => TrainingEnquiry::with('programme:id,title')->latest('id')->paginate(15)]);
    }

    public function update(SaveTrainingEnquiryRequest $request, TrainingEnquiry $trainingEnquiry): RedirectResponse
    {
        $trainingEnquiry->update($request->validated());

        return to_route('backend.training-enquiries.index');
    }

    public function destroy(TrainingEnquiry $trainingEnquiry): RedirectResponse
    {
        $trainingEnquiry->delete();

        return to_route('backend.training-enquiries.index');
    }
}
