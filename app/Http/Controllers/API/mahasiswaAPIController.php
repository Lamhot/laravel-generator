<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemahasiswaAPIRequest;
use App\Http\Requests\API\UpdatemahasiswaAPIRequest;
use App\Models\mahasiswa;
use App\Repositories\mahasiswaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class mahasiswaController
 * @package App\Http\Controllers\API
 */

class mahasiswaAPIController extends AppBaseController
{
    /** @var  mahasiswaRepository */
    private $mahasiswaRepository;

    public function __construct(mahasiswaRepository $mahasiswaRepo)
    {
        $this->mahasiswaRepository = $mahasiswaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/mahasiswas",
     *      summary="Get a listing of the mahasiswas.",
     *      tags={"mahasiswa"},
     *      description="Get all mahasiswas",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/mahasiswa")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->mahasiswaRepository->pushCriteria(new RequestCriteria($request));
        $this->mahasiswaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $mahasiswas = $this->mahasiswaRepository->all();

        return $this->sendResponse($mahasiswas->toArray(), 'mahasiswas retrieved successfully');
    }

    /**
     * @param CreatemahasiswaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/mahasiswas",
     *      summary="Store a newly created mahasiswa in storage",
     *      tags={"mahasiswa"},
     *      description="Store mahasiswa",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="mahasiswa that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/mahasiswa")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/mahasiswa"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatemahasiswaAPIRequest $request)
    {
        $input = $request->all();

        $mahasiswas = $this->mahasiswaRepository->create($input);

        return $this->sendResponse($mahasiswas->toArray(), 'mahasiswa saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/mahasiswas/{id}",
     *      summary="Display the specified mahasiswa",
     *      tags={"mahasiswa"},
     *      description="Get mahasiswa",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of mahasiswa",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/mahasiswa"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var mahasiswa $mahasiswa */
        $mahasiswa = $this->mahasiswaRepository->find($id);

        if (empty($mahasiswa)) {
            return Response::json(ResponseUtil::makeError('mahasiswa not found'), 400);
        }

        return $this->sendResponse($mahasiswa->toArray(), 'mahasiswa retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatemahasiswaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/mahasiswas/{id}",
     *      summary="Update the specified mahasiswa in storage",
     *      tags={"mahasiswa"},
     *      description="Update mahasiswa",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of mahasiswa",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="mahasiswa that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/mahasiswa")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/mahasiswa"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatemahasiswaAPIRequest $request)
    {
        $input = $request->all();

        /** @var mahasiswa $mahasiswa */
        $mahasiswa = $this->mahasiswaRepository->find($id);

        if (empty($mahasiswa)) {
            return Response::json(ResponseUtil::makeError('mahasiswa not found'), 400);
        }

        $mahasiswa = $this->mahasiswaRepository->update($input, $id);

        return $this->sendResponse($mahasiswa->toArray(), 'mahasiswa updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/mahasiswas/{id}",
     *      summary="Remove the specified mahasiswa from storage",
     *      tags={"mahasiswa"},
     *      description="Delete mahasiswa",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of mahasiswa",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var mahasiswa $mahasiswa */
        $mahasiswa = $this->mahasiswaRepository->find($id);

        if (empty($mahasiswa)) {
            return Response::json(ResponseUtil::makeError('mahasiswa not found'), 400);
        }

        $mahasiswa->delete();

        return $this->sendResponse($id, 'mahasiswa deleted successfully');
    }
}
