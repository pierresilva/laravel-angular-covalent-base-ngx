<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AuthHelper;
use App\Http\Controllers\ApiController;
use App\Exports\AuthorsExport;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @OA\Tag(
 *     name="Authors",
 *     description="API Endpoints of authors"
 * )
 */
class AuthorController extends ApiController
{

// generated section

   /**
    * @OA\GET(
    *   path="/api/authors",
    *   tags={"Authors"},
    *   summary="Get list of authors",
    *   description="Returns list of authors",
    *   @OA\Parameter(ref="#/components/parameters/query"),
    *   @OA\Parameter(ref="#/components/parameters/sort"),
    *   @OA\Parameter(ref="#/components/parameters/per-page"),
    *   @OA\Parameter(ref="#/components/parameters/page"),
    *   @OA\Response(
    *     response=200,
    *     description="Paginated authors list."
    *   ),
    *   @OA\Response(
    *    response=400,
    *    description="Reponse error."
    *   )
    * )
    */
   public function index(Request $request)
   {
       // user_can(['author.index']);

    // $authors = new Author;
    $authors = Author::with(Author::getRelationships());

    // (1)filltering
       $authors = $this->filtering($request, $authors);
       $authors = $authors->get();

       // (2)sort
       $authors = $this->sorting($request, $authors);

       // (3)paginate
       $authors = $authors->paginate($request->get('per-page') ?? 10);

       $resource = $authors->toArray();

       $resource['lists'] = Author::getLists();

       return $this->responseSuccess(
         'Authors list obtained!',
         $resource,
         true,
         false
       );
   }

   /**
    * @OA\POST(
    *   path="/api/authors",
    *   summary="Create author",
    *   tags={"Authors"},
    *   @OA\RequestBody(
    *     required=true,
    *     description="Returns created new author",
    *     @OA\JsonContent(
    *       type="object",
    *       @OA\Property(
    *         property="model",
    *         type="object",
    *         ref="#/components/schemas/Author",
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
       // user_can(['author.store']);

       $this->varidate($request);

       $input = $request->input('model');

        $input['code'] = Str::slug($input['name']);

       DB::beginTransaction();
       try {
         //create data
         $author = Author::create( $input );

           if ($request->input('model.book_ids')) {
               $author->books()->sync($request->input('model.book_ids'));
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
         'Author stored!',
         $author->toArray(),
         false,
         false,
         201
       );
   }

   /**
    * @OA\GET(
    *      path="/api/authors/{id}",
    *      tags={"Authors"},
    *      summary="Get author data",
    *      description="Returns author data",
    *      @OA\Parameter(
    *          name="id",
    *          description="Author ID",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Successful get author data"
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
   public function show($authorId)
   {
       // user_can(['author.show']);

       $author = Author::with(Author::getRelationships())->findOrFail($authorId);

       $author->book_ids = collect($author->books)->pluck('id');

       $resource = $author->toArray();
       // $resource['lists'] = Author::getLists();

       return $this->responseSuccess(
         'Author data obtained!',
         $resource,
         false,
         false,
         200
       );
   }

   /**
    * @OA\PUT(
    *   path="/api/authors/{id}",
    *   tags={"Authors"},
    *   summary="Update author",
    *   description="Returns updated author data",
    *   @OA\Parameter(
    *     name="id",
    *     description="Author ID",
    *     required=true,
    *     in="path",
    *     @OA\Schema(
    *       type="integer"
    *     )
    *   ),
    *   @OA\RequestBody(
    *     required=true,
    *     description="Returns updated new author",
    *     @OA\JsonContent(
    *       type="object",
    *       @OA\Property(
    *         property="model",
    *         type="object",
    *         ref="#/components/schemas/Author",
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
   public function update($authorId, Request $request)
   {

       // user_can(['author.update']);

       $author = Author::findOrFail($authorId);

       $this->varidate($request, $author);

       $input = $request->input('model');

       $input['code'] = Str::slug($input['name']);

       DB::beginTransaction();
       try {
         //update data
         $author->update($input);

        $request->input('model.book_ids') ? $author->books()->sync($request->input('model.book_ids')) : $author->books()->detach();

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
         'Author updated!',
         $author->toArray(),
         false,
         false,
         202
       );
   }


   /**
    * @OA\DELETE(
    *      path="/api/authors/{id}",
    *      tags={"Authors"},
    *      summary="Delete existing author",
    *      description="Delete a author and returns it",
    *      @OA\Parameter(
    *          name="id",
    *          description="Author ID",
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
   public function destroy($authorId)
   {

       // user_can(['author.destroy']);

       $author = Author::findOrFail($authorId);
       $author->delete();
       return $this->responseSuccess(
         'AUTHOR deleted!',
         $author->toArray(),
         false,
         false,
         203
       );
   }

   /**
    * @OA\PUT(
    *   path="/api/authors/delete-multiple",
    *   tags={"Authors"},
    *   summary="Delete authors",
    *   description="Returns authors deleted",
    *   @OA\RequestBody(
    *     required=true,
    *     description="Array of ids to delete authors",
    *     @OA\JsonContent(
    *       type="object",
    *       required={"author_ids"},
    *       @OA\Property(
    *         property="author_ids",
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
    *     description="Successful authors deleted",
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

       if (!$request->get('author_ids') || !count($request->get('author_ids'))) {
           return $this->responseError('Validation error', [
               'errors' => [
                   'author_ids' => 'No author IDs found'
               ]
           ], 422);
       }

       if (count($request->get('author_ids'))) {
           foreach ($request->get('author_ids') as $id) {
               $tag = Author::findOrFail($id);
               $tag->delete();
           }
       }

       return $this->responseSuccess(
           'Authors deleted!',
           [],
           false,
           false,
           203
       );
   }

   /**
    * @OA\GET(
    *      path="/api/authors/export",
    *      tags={"Authors"},
    *      summary="Get xls file of all authors",
    *      description="Returns list of all authors in a excel file",
    *      @OA\Response(
    *          response=200,
    *          description="Successful get authors xls file"
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
       return \Maatwebsite\Excel\Facades\Excel::download(new AuthorsExport(), 'authors.xlsx');
   }

   /**
    * Varidate input data.
    *
    * @return array
    */
   public function varidate(Request $request, Author $author = null)
   {
       $request->validate(Author::getValidateRule($author));
   }


// end section

}
