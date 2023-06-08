<?php

namespace App\Http\Controllers;

use App\Entities\Property;
use App\Http\Requests\PropertyCreateRequest;
use App\Http\Requests\PropertyUpdateRequest;
use App\Models\User;
use App\Repositories\PropertyRepository;
use App\Repositories\PropertyRepositoryEloquent;
use App\Validators\PropertyValidator;

/**
 * Class PropertiesController.
 *
 * @package namespace App\Http\Controllers;
 */
class PropertiesController extends Controller
{
    /**
     * @var PropertyRepository
     */
    protected $repository;

    /**
     * PropertiesController constructor.
     *
     * @param PropertyRepository $repository
     * @param PropertyValidator $validator
     */
    public function __construct(PropertyRepositoryEloquent $repository)
    {
        $this->repository = $repository;
        $this->middleware(['auth:sanctum'])->only('store', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $properties = $this->repository->with('category')->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $properties,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PropertyCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PropertyCreateRequest $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        $this->authorize('store', Property::class);

        $property = $user->properties()->create($request->all());

        $response = [
            'message' => 'Property created.',
            'data'    => $property->load('category')->toArray(),
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = $this->repository->with('category')->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $property,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $property = $this->repository->find($id);

        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PropertyUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PropertyUpdateRequest $request, $id)
    {
        $property = $this->repository->update($request->all(), $id);

        $response = [
            'message' => 'Property updated.',
            'data'    => $property->load('category')->toArray(),
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Property deleted.',
                'deleted' => $deleted,
            ]);
        }
    }
}
