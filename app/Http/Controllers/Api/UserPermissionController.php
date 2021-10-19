<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserPermissionController extends ApiController
{

// generated section
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // user_can(['user_permission.index']);

        // $userPermissions = new UserPermission;
        $userPermissions = UserPermission::with(UserPermission::getRelationships());

        // (1)filltering
        $userPermissions = $this->filtering($request, $userPermissions);
        $userPermissions = $userPermissions->get();

        // (2)sort
        $userPermissions = $this->sorting($request, $userPermissions);

        // (3)paginate
        $userPermissions = $userPermissions->paginate($request->get('per-page') ?? 10);

        $resource = $userPermissions->toArray();

        $resource['lists'] = UserPermission::getLists();

        return $this->responseSuccess(
            'Permissions list obtained!',
            $resource,
            true,
            false
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // user_can(['user_permission.create']);

        return response()->json([
            'message' => 'Formulario para permisos obtenido!',
            'data' => null,
            'lists' => UserPermission::getLists()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // user_can(['user_permission.store']);

        $this->varidate($request);

        $input = $request->input('model');

        $input['code'] = Str::slug($input['name'], '_');

        DB::beginTransaction();
        try {
            //create data
            $userPermission = UserPermission::create($input);

            if (isset($input['user_role_ids']) && count($input['user_role_ids'])) {
                $userPermission->userRoles()->sync($input['user_role_ids']);
            }

            //sync(attach/detach)
            if ($request->input('pivots')) {
                $this->sync($request->input('pivots'), $userPermission);
            }


        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->responseError(
                '' . $exception->getMessage(),
                [
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                ]
            );
        }
        DB::commit();

        return $this->responseSuccess(
            'Permiso almacenado!',
            $userPermission->toArray(),
            false,
            false,
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\UserPermission $userPermission * @return \Illuminate\Http\Response
     */
    public function show($userPermissionId)
    {
        // user_can(['user_permission.show']);

        $userPermission = UserPermission::with(UserPermission::getRelationships())->findOrFail($userPermissionId);

        $userPermission->user_role_ids = collect($userPermission->userRoles)->pluck('id');

        $resource = $userPermission->toArray();
        $resource['lists'] = UserPermission::getLists();

        return $this->responseSuccess(
            'USUARIOSPERMISO obtenidos!',
            $resource,
            false,
            false,
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\UserPermission $userPermission * @return \Illuminate\Http\Response
     */
    public function edit($userPermissionId)
    {
        // user_can(['user_permission.edit']);

        $userPermission = UserPermission::with(UserPermission::getRelationships())->findOrFail($userPermissionId);
        $userPermission->user_role_ids = collect($userPermission->userRoles)->pluck('id');

        return $this->responseSuccess(
            'Formulario para USUARIOSPERMISO obtenidos!',
            [
                'model' => $userPermission,
                'lists' => UserPermission::getLists(),
            ],
            false
        );
    }

    /**
     * Show the form for duplicating the specified resource.
     *
     * @param \App\UserPermission $userPermission * @return \Illuminate\Http\Response
     */
    public function duplicate($userPermissionId)
    {
        // user_can(['user_permission.duplicate']);

        $userPermission = UserPermission::with(UserPermission::getRelationships())->findOrFail($userPermissionId);
        $userPermission->id = null;
        $userPermission->user_role_ids = collect($userPermission->userRoles)->pluck('id');

        return $this->responseSuccess(
            'Formulario para USUARIOSPERMISO obtenidos!',
            [
                'model' => $userPermission,
                'lists' => UserPermission::getLists(),
            ],
            false
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\UserPermission $userPermission * @return \Illuminate\Http\Response
     */
    public function update($userPermissionId, Request $request)
    {

        // user_can(['user_permission.update']);

        $userPermission = UserPermission::findOrFail($userPermissionId);

        $this->varidate($request, $userPermission);

        $input = $request->input('model');

        $input['code'] = Str::slug($input['name'], '_');

        DB::beginTransaction();
        try {
            //update data
            $userPermission->update($input);

            if (isset($input['user_role_ids']) && count($input['user_role_ids'])) {
                $userPermission->userRoles()->sync($input['user_role_ids']);
            }

            //sync(attach/detach)
            if ($request->get('pivots')) {
                $this->sync($request->get('pivots'), $userPermission);
            }


        } catch (Exception $exception) {
            DB::rollBack();
            return $this->responseError(
                '' . $exception->getMessage(),
                [
                    'message' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                ]
            );
        }
        DB::commit();

        return $this->responseSuccess(
            'Permiso actualizado!',
            $userPermission->toArray(),
            false,
            false,
            202
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\UserPermission $userPermission * @return \Illuminate\Http\Response
     */
    public function destroy($userPermissionId)
    {

        // user_can(['user_permission.destroy']);

        $userPermission = UserPermission::findOrFail($userPermissionId);
        $userPermission->delete();
        return $this->responseSuccess(
            'Permiso eliminado!',
            $userPermission->toArray(),
            false,
            false,
            203
        );
    }

    /**
     * Varidate input data.
     *
     * @return array
     */
    public function varidate(Request $request, UserPermission $userPermission = null)
    {
        $request->validate(UserPermission::getValidateRule($userPermission));
    }

    /**
     * sync pivot data
     *
     * @return void
     */
    public function sync($pivots_data, UserPermission $userPermission)
    {
        foreach ($pivots_data as $pivot_child_model_name => $pivots) {

            $pivotIds = [];
            // remove 'id'
            foreach ($pivots as &$value) {
                if (array_key_exists('id', $value)) {
                    $pivotIds[] = $value['id'];
                    unset($value['id']);
                }
            }
            unset($value);

            $method = Str::camel(Str::plural($pivot_child_model_name));
            $userPermission->$method()->sync($pivotIds);
        }
    }

// end section

    /**
     * Remove the specified resource from storage.
     *
     * @param  $tagId
     * @return JsonResponse|\Illuminate\Http\JsonResponse
     */
    public function destroyMultiple(Request $request)
    {
        // user_can(['tag.destroy']);
        if (count($request->get('ids'))) {
            foreach ($request->get('ids') as $id) {
                $tag = UserPermission::findOrFail($id);
                $tag->delete();
            }
        }

        return $this->responseSuccess(
            'Permisos eliminados!',
            [],
            false,
            false,
            203
        );
    }

}
