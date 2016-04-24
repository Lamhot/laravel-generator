<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreatestaffRequest;
use App\Http\Requests\UpdatestaffRequest;
use App\Repositories\staffRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class staffController extends AppBaseController
{
    /** @var  staffRepository */
    private $staffRepository;

    public function __construct(staffRepository $staffRepo)
    {
        $this->staffRepository = $staffRepo;
    }

    /**
     * Display a listing of the staff.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->staffRepository->pushCriteria(new RequestCriteria($request));
        $staff = $this->staffRepository->all();

        return view('staff.index')
            ->with('staff', $staff);
    }

    /**
     * Show the form for creating a new staff.
     *
     * @return Response
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created staff in storage.
     *
     * @param CreatestaffRequest $request
     *
     * @return Response
     */
    public function store(CreatestaffRequest $request)
    {
        $input = $request->all();

        $staff = $this->staffRepository->create($input);

        Flash::success('staff saved successfully.');

        return redirect(route('staff.index'));
    }

    /**
     * Display the specified staff.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $staff = $this->staffRepository->findWithoutFail($id);

        if (empty($staff)) {
            Flash::error('staff not found');

            return redirect(route('staff.index'));
        }

        return view('staff.show')->with('staff', $staff);
    }

    /**
     * Show the form for editing the specified staff.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $staff = $this->staffRepository->findWithoutFail($id);

        if (empty($staff)) {
            Flash::error('staff not found');

            return redirect(route('staff.index'));
        }

        return view('staff.edit')->with('staff', $staff);
    }

    /**
     * Update the specified staff in storage.
     *
     * @param  int              $id
     * @param UpdatestaffRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestaffRequest $request)
    {
        $staff = $this->staffRepository->findWithoutFail($id);

        if (empty($staff)) {
            Flash::error('staff not found');

            return redirect(route('staff.index'));
        }

        $staff = $this->staffRepository->update($request->all(), $id);

        Flash::success('staff updated successfully.');

        return redirect(route('staff.index'));
    }

    /**
     * Remove the specified staff from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $staff = $this->staffRepository->findWithoutFail($id);

        if (empty($staff)) {
            Flash::error('staff not found');

            return redirect(route('staff.index'));
        }

        $this->staffRepository->delete($id);

        Flash::success('staff deleted successfully.');

        return redirect(route('staff.index'));
    }
}
