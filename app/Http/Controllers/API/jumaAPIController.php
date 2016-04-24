<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatejumaAPIRequest;
use App\Http\Requests\API\UpdatejumaAPIRequest;
use App\Models\juma;
use App\Repositories\jumaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class jumaController
 * @package App\Http\Controllers\API
 */

class jumaAPIController extends AppBaseController
{
    /** @var  jumaRepository */
    private $jumaRepository;

    public function __construct(jumaRepository $jumaRepo)
    {
        $this->jumaRepository = $jumaRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/jumas",
     *      summary="Get a listing of the jumas.",
     *      tags={"juma"},
     *      description="Get all jumas",
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
     *                  @SWG\Items(ref="#/definitions/juma")
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
        $this->jumaRepository->pushCriteria(new RequestCriteria($request));
        $this->jumaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $jumas = $this->jumaRepository->all();

        return $this->sendResponse($jumas->toArray(), 'jumas retrieved successfully');
    }

    /**
     * @param CreatejumaAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/jumas",
     *      summary="Store a newly created juma in storage",
     *      tags={"juma"},
     *      description="Store juma",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="juma that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/juma")
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
     *                  ref="#/definitions/juma"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatejumaAPIRequest $request)
    {
        $input = $request->all();

        $jumas = $this->jumaRepository->create($input);

        return $this->sendResponse($jumas->toArray(), 'juma saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/jumas/{id}",
     *      summary="Display the specified juma",
     *      tags={"juma"},
     *      description="Get juma",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of juma",
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
     *                  ref="#/definitions/juma"
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
        /** @var juma $juma */
        $juma = $this->jumaRepository->find($id);

        if (empty($juma)) {
            return Response::json(ResponseUtil::makeError('juma not found'), 400);
        }

        return $this->sendResponse($juma->toArray(), 'juma retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatejumaAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/jumas/{id}",
     *      summary="Update the specified juma in storage",
     *      tags={"juma"},
     *      description="Update juma",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of juma",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="juma that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/juma")
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
     *                  ref="#/definitions/juma"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatejumaAPIRequest $request)
    {
        $input = $request->all();

        /** @var juma $juma */
        $juma = $this->jumaRepository->find($id);

        if (empty($juma)) {
            return Response::json(ResponseUtil::makeError('juma not found'), 400);
        }

        $juma = $this->jumaRepository->update($input, $id);

        return $this->sendResponse($juma->toArray(), 'juma updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/jumas/{id}",
     *      summary="Remove the specified juma from storage",
     *      tags={"juma"},
     *      description="Delete juma",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of juma",
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
        /** @var juma $juma */
        $juma = $this->jumaRepository->find($id);

        if (empty($juma)) {
            return Response::json(ResponseUtil::makeError('juma not found'), 400);
        }

        $juma->delete();

        return $this->sendResponse($id, 'juma deleted successfully');
    }
}
