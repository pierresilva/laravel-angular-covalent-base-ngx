<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Exports\TagsExport;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @OA\Tag(
 *     name="Tags",
 *     description="API Endpoints of tags"
 * )
 */
class TagController extends ApiController
{

// generated section

   /**
    * @OA\GET(
    *   path="/api/tags",
    *   tags={"Tags"},
    *   summary="Get list of tags",
    *   description="Returns list of tags",
    *   @OA\Parameter(ref="#/components/parameters/query"),
    *   @OA\Parameter(ref="#/components/parameters/sort"),
    *   @OA\Parameter(ref="#/components/parameters/per-page"),
    *   @OA\Parameter(ref="#/components/parameters/page"),
    *   @OA\Response(
    *     response=200,
    *     description="Paginated tags list."
    *   ),
    *   @OA\Response(
    *    response=400,
    *    description="Reponse error."
    *   )
    * )
    */
   public function index(Request $request)
   {
       // user_can(['tag.index']);

    // $tags = new Tag;
    $tags = Tag::with(Tag::getRelationships());

    // (1)filltering
       $tags = $this->filtering($request, $tags);
       $tags = $tags->get();

       // (2)sort
       $tags = $this->sorting($request, $tags);

       // (3)paginate
       $tags = $tags->paginate($request->get('per-page') ?? 10);

       $resource = $tags->toArray();

       $resource['lists'] = Tag::getLists();

       return $this->responseSuccess(
         'Tags list obtained!',
         $resource,
         true,
         false
       );
   }

   /**
    * @OA\POST(
    *   path="/api/tags",
    *   summary="Create tag",
    *   tags={"Tags"},
    *   @OA\RequestBody(
    *     required=true,
    *     description="Returns created new tag",
    *     @OA\JsonContent(
    *       type="object",
    *       @OA\Property(
    *         property="model",
    *         type="object",
    *         ref="#/components/schemas/Tag",
    *       ),
    *     ),
    *   ),
    *   @OA\Response(
    *     response="201",
    *     description="Successful book created",
    *   ),
    *   @OA\Response(
    *     response="422",
    *     description="Validation error",
    *   ),
    * )
    */
   public function store(Request $request)
   {
       // user_can(['tag.store']);

       $this->varidate($request);

       $input = $request->input('model');

        $input['code'] = Str::slug($input['name']);

       DB::beginTransaction();
       try {
         //create data
         $tag = Tag::create( $input );

           if ($request->input('model.book_ids')) {
               $tag->books()->sync($request->input('model.book_ids'));
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
         'Tag stored!',
         $tag->toArray(),
         false,
         false,
         201
       );
   }

   /**
    * @OA\GET(
    *      path="/api/tags/{id}",
    *      tags={"Tags"},
    *      summary="Get tag data",
    *      description="Returns tag data",
    *      @OA\Parameter(
    *          name="id",
    *          description="Tag ID",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Successful get tag data"
    *       ),
    *      @OA\Response(
    *          response=400,
    *          description="Bad Request"
    *      ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Not Found"
    *      )
    * )
    */
   public function show($tagId)
   {
       // user_can(['tag.show']);

       $tag = Tag::with(Tag::getRelationships())->findOrFail($tagId);

       $tag->book_ids = collect($tag->books)->pluck('id');

       $resource = $tag->toArray();
       // $resource['lists'] = Tag::getLists();

       return $this->responseSuccess(
         'Tag data obtained!',
         $resource,
         false,
         false,
         200
       );
   }

   /**
    * @OA\PUT(
    *   path="/api/tags/{id}",
    *   tags={"Tags"},
    *   summary="Update tag",
    *   description="Returns updated tag data",
    *   @OA\Parameter(
    *     name="id",
    *     description="Tag ID",
    *     required=true,
    *     in="path",
    *     @OA\Schema(
    *       type="integer"
    *     )
    *   ),
    *   @OA\RequestBody(
    *     required=true,
    *     description="Returns updated new tag",
    *     @OA\JsonContent(
    *       type="object",
    *       @OA\Property(
    *         property="model",
    *         type="object",
    *         ref="#/components/schemas/Tag",
    *       ),
    *     ),
    *   ),
    *   @OA\Response(
    *     response="201",
    *     description="Successful book created",
    *   ),
    *   @OA\Response(
    *     response="422",
    *     description="Validation error",
    *   ),
    * )
    */
   public function update($tagId, Request $request)
   {

       // user_can(['tag.update']);

       $tag = Tag::findOrFail($tagId);

       $this->varidate($request, $tag);

       $input = $request->input('model');

       $input['code'] = Str::slug($input['name']);

       DB::beginTransaction();
       try {
         //update data
         $tag->update($input);

        $request->input('model.book_ids') ? $tag->books()->sync($request->input('model.book_ids')) : $tag->books()->detach();

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
         'Tag updated!',
         $tag->toArray(),
         false,
         false,
         202
       );
   }


   /**
    * @OA\DELETE(
    *      path="/api/tags/{id}",
    *      tags={"Tags"},
    *      summary="Delete existing tag",
    *      description="Delete a tag and returns it",
    *      @OA\Parameter(
    *          name="id",
    *          description="Tag ID",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=202,
    *          description="Successful operation",
    *          @OA\JsonContent()
    *       ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Resource Not Found"
    *      )
    * )
    */
   public function destroy($tagId)
   {

       // user_can(['tag.destroy']);

       $tag = Tag::findOrFail($tagId);
       $tag->delete();
       return $this->responseSuccess(
         'TAG deleted!',
         $tag->toArray(),
         false,
         false,
         203
       );
   }

   /**
    * @OA\PUT(
    *   path="/api/tags/delete-multiple",
    *   tags={"Tags"},
    *   summary="Delete tags",
    *   description="Returns tags deleted",
    *   @OA\RequestBody(
    *     required=true,
    *     description="Array of ids to delete tags",
    *     @OA\JsonContent(
    *       type="object",
    *       required={"tag_ids"},
    *       @OA\Property(
    *         property="tag_ids",
    *         type="array",
    *         example={0: 1, 1: 2},
    *         @OA\Items(
    *           type="number",
    *         ),
    *       ),
    *     ),
    *   ),
    *   @OA\Response(
    *     response="202",
    *     description="Successful tags deleted",
    *   ),
    *   @OA\Response(
    *     response="422",
    *     description="Validation error",
    *   ),
    * )
    */
   public function destroyMultiple(Request $request)
   {
       // user_can(['tag.destroy']);

       if (!$request->get('tag_ids') || !count($request->get('tag_ids'))) {
           return $this->responseError('Validation error', [
               'errors' => [
                   'tag_ids' => 'No tag IDs found'
               ]
           ], 422);
       }

       if (count($request->get('tag_ids'))) {
           foreach ($request->get('tag_ids') as $id) {
               $tag = Tag::findOrFail($id);
               $tag->delete();
           }
       }

       return $this->responseSuccess(
           'Tags deleted!',
           [],
           false,
           false,
           203
       );
   }

   /**
    * @OA\GET(
    *      path="/api/tags/export",
    *      tags={"Tags"},
    *      summary="Get xls file of all tags",
    *      description="Returns list of all tags in a excel file",
    *      @OA\Response(
    *          response=200,
    *          description="Successful get tags xls file"
    *       ),
    *      @OA\Response(
    *          response=400,
    *          description="Bad Request"
    *      ),
    *      @OA\Response(
    *          response=401,
    *          description="Unauthenticated",
    *      ),
    *      @OA\Response(
    *          response=403,
    *          description="Forbidden"
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Not Found"
    *      )
    * )
    */
   public function export()  {
       return \Maatwebsite\Excel\Facades\Excel::download(new TagsExport(), 'tags.xlsx');
   }

   /**
    * Varidate input data.
    *
    * @return array
    */
   public function varidate(Request $request, Tag $tag = null)
   {
       $request->validate(Tag::getValidateRule($tag));
   }


// end section

}
