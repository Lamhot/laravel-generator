<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepenelitiAPIRequest;
use App\Http\Requests\API\UpdatepenelitiAPIRequest;
use App\Models\peneliti;
use App\Repositories\penelitiRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class penelitiController
 * @package App\Http\Controllers\API
 */

class penelitiAPIController extends AppBaseController
{
    /** @var  penelitiRepository */
    private $penelitiRepository;

    public function __construct(penelitiRepository $penelitiRepo)
    {
        $this->penelitiRepository = $penelitiRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/penelitis",
     *      summary="Get a listing of the penelitis.",
     *      tags={"peneliti"},
     *      description="Get all penelitis",
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
     *                  @SWG\Items(ref="#/definitions/peneliti")
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
        $this->penelitiRepository->pushCriteria(new RequestCriteria($request));
        $this->penelitiRepository->pushCriteria(new LimitOffsetCriteria($request));
        $penelitis = $this->penelitiRepository->all();

        return $this->sendResponse($penelitis->toArray(), 'penelitis retrieved successfully');
    }

    /**
     * @param CreatepenelitiAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/penelitis",
     *      summary="Store a newly created peneliti in storage",
     *      tags={"peneliti"},
     *      description="Store peneliti",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="peneliti that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/peneliti")
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
     *                  ref="#/definitions/peneliti"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatepenelitiAPIRequest $request)
    {
        $input = $request->all();

        $penelitis = $this->penelitiRepository->create($input);

        return $this->sendResponse($penelitis->toArray(), 'peneliti saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/penelitis/{id}",
     *      summary="Display the specified peneliti",
     *      tags={"peneliti"},
     *      description="Get peneliti",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of peneliti",
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
     *                  ref="#/definitions/peneliti"
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
        /** @var peneliti $peneliti */
        $peneliti = $this->penelitiRepository->find($id);

        if (empty($peneliti)) {
            return Response::json(ResponseUtil::makeError('peneliti not found'), 400);
        }

        return $this->sendResponse($peneliti->toArray(), 'peneliti retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatepenelitiAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/penelitis/{id}",
     *      summary="Update the specified peneliti in storage",
     *      tags={"peneliti"},
     *      description="Update peneliti",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of peneliti",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="peneliti that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/peneliti")
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
     *                  ref="#/definitions/peneliti"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatepenelitiAPIRequest $request)
    {
        $input = $request->all();

        /** @var peneliti $peneliti */
        $peneliti = $this->penelitiRepository->find($id);

        if (empty($peneliti)) {
            return Response::json(ResponseUtil::makeError('peneliti not found'), 400);
        }

        $peneliti = $this->penelitiRepository->update($input, $id);

        return $this->sendResponse($peneliti->toArray(), 'peneliti updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/penelitis/{id}",
     *      summary="Remove the specified peneliti from storage",
     *      tags={"peneliti"},
     *      description="Delete peneliti",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of peneliti",
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
        /** @var peneliti $peneliti */
        $peneliti = $this->penelitiRepository->find($id);

        if (empty($peneliti)) {
            return Response::json(ResponseUtil::makeError('peneliti not found'), 400);
        }

        $peneliti->delete();

        return $this->sendResponse($id, 'peneliti deleted successfully');
    }
}
