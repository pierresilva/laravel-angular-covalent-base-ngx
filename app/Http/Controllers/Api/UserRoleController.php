<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserRoleController extends ApiController
{

// generated section
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // user_can(['user_role.index']);

        // $userRoles = new UserRole;
        $userRoles = UserRole::with(UserRole::getRelationships());

        // (1)filltering
        $userRoles = $this->filtering($request, $userRoles);
        $userRoles = $userRoles->get();

        // (2)sort
        $userRoles = $this->sorting($request, $userRoles);

        // (3)paginate
        $userRoles = $userRoles->paginate($request->get('per-page') ?? 10);

        $resource = $userRoles->toArray();

        $resource['lists'] = UserRole::getLists();

        return $this->responseSuccess(
            'Roles obtenidos!',
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
        // user_can(['user_role.create']);

        return response()->json([
            'message' => 'Formulario para roles obtenido!',
            'data' => null,
            'lists' => UserRole::getLists()
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
        // user_can(['user_role.store']);

        $this->varidate($request);

        $input = $request->input('model');

        $input['code'] = Str::slug($input['name'], '_');


        DB::beginTransaction();
        try {
            //create data
            $userRole = UserRole::create($input);

            if(isset($input['user_permission_ids']) && count($input['user_permission_ids'])) {
                $userRole->userPermissions()->sync($input['user_permission_ids']);
            }

            if(isset($input['user_ids']) && count($input['user_ids'])) {
                $userRole->users()->sync($input['user_ids']);
            }

            //sync(attach/detach)
            if ($request->input('pivots')) {
                $this->sync($request->input('pivots'), $userRole);
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
            'Rol almacenado!',
            $userRole->toArray(),
            false,
            false,
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\UserRole $userRole * @return \Illuminate\Http\Response
     */
    public function show($userRoleId)
    {
        // user_can(['user_role.show']);

        $userRole = UserRole::with(UserRole::getRelationships())->findOrFail($userRoleId);

        $userRole->user_ids = collect($userRole->users)->pluck('id');
        $userRole->user_permission_ids = collect($userRole->userPermissions)->pluck('id');

        $resource = $userRole->toArray();
        $resource['lists'] = UserRole::getLists();

        return $this->responseSuccess(
            'Rol obtenido!',
            $resource,
            false,
            false,
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\UserRole $userRole * @return \Illuminate\Http\Response
     */
    public function edit($userRoleId)
    {
        // user_can(['user_role.edit']);

        $userRole = UserRole::with(UserRole::getRelationships())->findOrFail($userRoleId);
        $userRole->user_ids = collect($userRole->users)->pluck('id');
        $userRole->user_permission_ids = collect($userRole->userPermissions)->pluck('id');

        return $this->responseSuccess(
            'Formulario para USUARIOSROLE obtenidos!',
            [
                'model' => $userRole,
                'lists' => UserRole::getLists(),
            ],
            false
        );
    }

    /**
     * Show the form for duplicating the specified resource.
     *
     * @param \App\UserRole $userRole * @return \Illuminate\Http\Response
     */
    public function duplicate($userRoleId)
    {
        // user_can(['user_role.duplicate']);

        $userRole = UserRole::with(UserRole::getRelationships())->findOrFail($userRoleId);
        $userRole->id = null;
        $userRole->user_ids = collect($userRole->users)->pluck('id');
        $userRole->user_permission_ids = collect($userRole->userPermissions)->pluck('id');

        return $this->responseSuccess(
            'Formulario para USUARIOSROLE obtenidos!',
            [
                'model' => $userRole,
                'lists' => UserRole::getLists(),
            ],
            false
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\UserRole $userRole * @return \Illuminate\Http\Response
     */
    public function update($userRoleId, Request $request)
    {

        // user_can(['user_role.update']);

        $userRole = UserRole::findOrFail($userRoleId);

        $this->varidate($request, $userRole);

        $input = $request->input('model');

        $input['code'] = Str::slug($input['name'], '_');


        DB::beginTransaction();
        try {
            //update data
            $userRole->update($input);

            $userRole->userPermissions()->sync($input['user_permission_ids']);

            $userRole->users()->sync($input['user_ids']);

            //sync(attach/detach)
            if ($request->get('pivots')) {
                $this->sync($request->get('pivots'), $userRole);
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
            'Rol actualizado!',
            $userRole->toArray(),
            false,
            false,
            202
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\UserRole $userRole * @return \Illuminate\Http\Response
     */
    public function destroy($userRoleId)
    {

        // user_can(['user_role.destroy']);

        $userRole = UserRole::findOrFail($userRoleId);
        $userRole->delete();
        return $this->responseSuccess(
            'USUARIOSROLE eliminado!',
            $userRole->toArray(),
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
    public function varidate(Request $request, UserRole $userRole = null)
    {
        $request->validate(UserRole::getValidateRule($userRole));
    }

    /**
     * sync pivot data
     *
     * @return void
     */
    public function sync($pivots_data, UserRole $userRole)
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
            $userRole->$method()->sync($pivotIds);
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
                $tag = UserRole::findOrFail($id);
                $tag->delete();
            }
        }

        return $this->responseSuccess(
            'Roles eliminados!',
            [],
            false,
            false,
            203
        );
    }

}
