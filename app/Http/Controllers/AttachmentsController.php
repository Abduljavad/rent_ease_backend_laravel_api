<?php

namespace App\Http\Controllers;

use App\Entities\Attachment;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AttachmentCreateRequest;
use App\Http\Requests\AttachmentUpdateRequest;
use App\Repositories\AttachmentRepository;
use App\Repositories\AttachmentRepositoryEloquent;
use App\Validators\AttachmentValidator;

/**
 * Class AttachmentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class AttachmentsController extends Controller
{
    public $repository;

    public function __construct(AttachmentRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Collection|Attachment[]
     */
    public function index(Request $request)
    {
        return $this->repository->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AttachmentRequest $request
     * @return mixed
     * @throws ValidatorException
     */
    public function store(AttachmentCreateRequest $request)     
    {
        $urls = [];
        foreach ($request->attachment as $media) {
            $attachment = new Attachment;
            $attachment->save();
            $attachment->addMedia($media)->toMediaCollection();
            foreach ($attachment->getMedia() as $media) {
                if (strpos($media->mime_type, 'image/') !== false) {
                    $converted_url = [
                        'thumbnail' => $media->getUrl('thumbnail'),
                        'original' => $media->getUrl(),
                        'id' => $attachment->id
                    ];
                } else {
                    $converted_url = [
                        'thumbnail' => '',
                        'original' => $media->getUrl(),
                        'id' => $attachment->id
                    ];
                }
            }
            $urls[] = $converted_url;
        }
        return $urls;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return $this->repository->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AttachmentRequest $request
     * @param int $id
     * @return bool
     */
    public function update(AttachmentUpdateRequest $request, $id)
    {
        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        return $this->repository->findOrFail($id)->delete();
    }
}
