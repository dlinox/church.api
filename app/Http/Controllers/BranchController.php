<?php

namespace App\Http\Controllers;

use App\Http\Responses\ApiResponse;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    protected $branch;

    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
    }

    //general-information
    public function getGeneralInformation(Request $request, $id)
    {

        $response = $this->branch->find($id)->select('id','name', 'address', 'phone_number as phoneNumber')->first();
        return ApiResponse::success($response);
    }


    public function save(Request $request)
    {
        try {
            if ($request->id != null) {
                $item = $this->branch->find($request->id);
                $item->update([
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone_number' => $request->phoneNumber,
                ]);
                return ApiResponse::success(null, 'Datos actualizados con éxito');
            }
            $this->branch->create($request->all());
            return ApiResponse::success(null, 'Datos creados con éxito', 201);
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 'Error al crear la sede');
        }
    }
}
