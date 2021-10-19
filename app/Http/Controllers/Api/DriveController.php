<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\ApiController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    class DriveController extends ApiController
    {

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function store(Request $request)
        {
            //

            $request->validate([
                'fileable_type' => 'required',
                'fileable_id' => 'required',
                // 'file' => 'required|file|mimes:jpeg,png,pdf,xls,xlsx,doc,docx|max:2048'
            ]);

            $requestData = $request->all();

            if (!$requestData['file']) {
                return response()->json([
                    'message' => __('No se enviaron archivos!')
                ], 422);
            }

            $extension = $requestData['file']->getClientOriginalExtension();
            $name = str_replace('.' . $extension, '', $requestData['file']->getClientOriginalName());
            $fileName = Str::slug($name) . '_' . time() . '.' . $extension;
            $mimeType = $request->file('file')->getMimeType();

            $saved = $requestData['file']->storeAs('/', $fileName, 'public');

            try {
                $file = \App\Models\File::create([
                    'name' => $name,
                    'file' => $fileName,
                    'extension' => $extension,
                    'mime' => $mimeType,
                    'url' => config('app.url') . '/storage/' . $saved,
                    'fileable_id' => $request->get('fileable_id'),
                    'fileable_type' => 'App\Models\\' . $request->get('fileable_type'),
                    'type' => $requestData['type'] ?? ''
                ]);
            } catch (\Exception $exception) {
                return $this->responseError($exception->getMessage());
            }

            return $this->responseSuccess('Archivo subido con éxito!', $file);

        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\JsonResponse
         */
        public function destroy($id)
        {
            //

            $file = \App\Models\File::find($id);

            try {
                Storage::disk('public')->delete($file->file);
                $file->forceDelete();
            } catch (\Exception $exception) {
                return $this->responseError($exception->getMessage());
            }

            return $this->responseSuccess('Archivo eliminado!');

        }
    }
