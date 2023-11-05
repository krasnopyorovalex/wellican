<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use Domain\Entities\Object\ObjectService;
use App\Http\Controllers\Controller;
use Domain\Entities\Object\Requests\IndexRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ObjectTypeController extends Controller
{
    public function __construct(private readonly ObjectService $objectService)
    {
    }

    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $query = $this->objectService->index(
            new IndexRequest(
                (int) config('database.per_page_admin'),
                (int) $request->get('offset', 0)
            )
        );

        return view('admin.objects.index', ['objects' => $query->getPayload()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
