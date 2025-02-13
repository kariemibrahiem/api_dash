<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
class UserApiService extends BaseService
{

    protected string $folder = 'admin/users';
    protected string $route = 'users';

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Display users list with DataTables.
     */
    public function index()
    {
        return response()->json([
            "status"=>200,
            "message" => "success",
            "data" => $this->getDataTable()
        ]);

    }


    public function show($user)
    {
        return response()->json([
            "status"=>200,
            "message" => "success",
            "data" => $user
        ]);
    }
    /**
     * Store a newly created user.
     */
    public function store($data): \Illuminate\Http\JsonResponse
    {
        $data['password'] = Hash::make($data['password']);
        $model = $this->createData($data);



        if ($model) {
            return response()->json([
                'status' => 200,
                "message"=>"stored successfully"
                ]);
        } else {
            return response()->json([
                'status' => 405,
                "message"=>"stored field"
            ]);
        }
    }

    /**
     * Update a user's data.
     */
    public function update($id, $data)
    {
        $user = $this->getById($id);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($this->updateData($id, $data)) {
            return response()->json([
                'status' => 200,
                "message"=>"updated successfully"
            ]);
        } else {
            return response()->json([
                'status' => 405,
                "message"=>"updated field"
            ]);
        }
    }




    /**
     * Generate a unique user code.
     */
    protected function generateCode(): string
    {
        do {
            $code = 'USR-' . Str::upper(Str::random(6));
        } while ($this->firstWhere(['user_code' => $code]));

        return $code;
    }
}
