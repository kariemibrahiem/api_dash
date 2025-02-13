<?php

namespace App\Services;

use App\Models\User;
use App\Traits\PhotoTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserService extends BaseService
{
    use PhotoTrait;
    protected string $folder = 'admin/users';
    protected string $route = 'users';

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Display users list with DataTables.
     */
    public function index($request)
    {
        if ($request->ajax()) {
            $users = $this->getDataTable();
            return DataTables::of($users)
                ->addColumn('action', function ($users) {
                    return '
                        <button type="button" data-id="' . $users->id . '" class="btn btn-pill btn-info-light editBtn">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                            data-bs-target="#delete_modal" data-id="' . $users->id . '" data-title="' . $users->name . '">
                            <i class="fas fa-trash"></i>
                        </button>
                    ';
                })
                ->addIndexColumn()
                ->escapeColumns([])
                ->make(true);
        } else {
            return view($this->folder . '/index');
        }
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view($this->folder . '/parts/create');
    }

    /**
     * Store a newly created user.
     */
    public function store($data): \Illuminate\Http\JsonResponse
    {

        $data['password'] = Hash::make($data['password']);
        $model = $this->createData($data);


        if ($model) {
            return response()->json(['status' => 200 , "message" => "success"]);
        } else {
            return response()->json(['status' => 405 , "message" => "error"]);
        }
    }

    /**
     * Show the form for editing a user.
     */
    public function edit($user)
    {
        $roles = Role::all();
        return view($this->folder . '/parts/edit', compact('user', 'roles'));
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
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

    /**
     * Delete a user.
     */
//    public function delete($id)
//    {
//        return $this->deleteById($id);
//    }

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
