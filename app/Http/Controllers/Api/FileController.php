<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FileController extends ApiController
{

// generated section

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // user_can(['file.index']);

		// $files = new File;
	    $files = File::with(File::getRelationships());

		// (1)filltering
        $files = $this->filtering($request, $files);
        $files = $files->get();

        // (2)sort
        $files = $this->sorting($request, $files);

        // (3)paginate
        $files = $files->paginate($request->get('per_page') ?? 10);

        $resource = $files->toArray();

        $resource['lists'] = File::getLists();

        return $this->responseSuccess(
          'JUNTASARCHIVOSDEAGENDA obtenidos!',
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
        // user_can(['file.create']);

            return response()->json([
              'message' => 'Formulario para crear JUNTASARCHIVOSDEAGENDA!',
              'data' => null,
              'lists' => File::getLists()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // user_can(['file.store']);

        $this->varidate($request);

        $input = $request->input('model');

                                                                                                                        
        DB::beginTransaction();
        try {
          //create data
          $file = File::create( $input );

          //sync(attach/detach)
          if ($request->input('pivots')) {
            $this->sync($request->input('pivots'), $file);
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
          'JUNTAS ARCHIVOSDEAGENDA almacenado!',
          $file->toArray(),
          false,
          false,
          201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file     * @return \Illuminate\Http\Response
     */
    public function show($fileId)
    {
        // user_can(['file.show']);

        $file = File::with(File::getRelationships())->findOrFail($fileId);

        
        $resource = $file->toArray();
        $resource['lists'] = File::getLists();

        return $this->responseSuccess(
          'JUNTASARCHIVOSDEAGENDA obtenido!',
          $resource,
          false,
          false,
          200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file     * @return \Illuminate\Http\Response
     */
    public function edit($fileId)
    {
        // user_can(['file.edit']);

        $file = File::with(File::getRelationships())->findOrFail($fileId);
        
        return $this->responseSuccess(
          'Formulario para editar JUNTASARCHIVOSDEAGENDA!',
          [
            'model' => $file,
            'lists' => File::getLists(),
          ],
          false
        );
    }

	/**
	 * Show the form for duplicating the specified resource.
	 *
	 * @param \App\File  $file	 * @return \Illuminate\Http\Response
	 */
	public function duplicate($fileId)
	{
        // user_can(['file.duplicate']);

        $file = File::with(File::getRelationships())->findOrFail($fileId);
        $file->id = null;
        
        return $this->responseSuccess(
          'Formulario para duplicar JUNTASARCHIVOSDEAGENDA!',
          [
            'model' => $file,
            'lists' => File::getLists(),
          ],
          false
        );
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file     * @return \Illuminate\Http\Response
     */
    public function update($fileId, Request $request)
    {

        // user_can(['file.update']);

        $file = File::findOrFail($fileId);

        $this->varidate($request, $file);

        $input = $request->input('model');

                                                                                                                        
        DB::beginTransaction();
        try {
          //update data
          $file->update($input);

          //sync(attach/detach)
          if ($request->get('pivots')) {
            $this->sync($request->get('pivots'), $file);
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
          'JUNTASARCHIVOSDEAGENDA actualizado!',
          $file->toArray(),
          false,
          false,
          202
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file     * @return \Illuminate\Http\Response
     */
    public function destroy($fileId)
    {

        // user_can(['file.destroy']);

        $file = File::findOrFail($fileId);
        $file->delete();
        return $this->responseSuccess(
          'JUNTASARCHIVOSDEAGENDA eliminado!',
          $file->toArray(),
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
    public function varidate(Request $request, File $file = null)
    {
        $request->validate(File::getValidateRule($file));
    }

    /**
     * sync pivot data
     *
     * @return void
     */
    public function sync($pivots_data, File $file)
    {
        foreach( $pivots_data as $pivot_child_model_name => $pivots ){

            $pivotIds = [];
            // remove 'id'
            foreach($pivots as &$value){
                if( array_key_exists('id', $value) ){
                    $pivotIds[] = $value['id'];
                    unset($value['id']);
                }
            }
            unset($value);

            $method = Str::camel( Str::plural($pivot_child_model_name) );
            $file->$method()->sync($pivotIds);
        }
    }


// end section

}
