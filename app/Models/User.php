<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'nip';

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nip',
        'role', 
        'department',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }    /*
     * Domain methods (stubs) related to the User interface requested by the
     * project: login, getUser, getAllUser, deleteUser, createUser, updateUser,
     * changePass. These are thin wrappers / docblocks so controllers/services
     * can call them; implement business rules in services or controllers.
     */

    /**
     * Attempt to authenticate a user by NIP and password.
     * Input: string $nip, string $password
     * Output: User|null (authenticated user)
     */
    public static function login(string $nip, string $password): ?self
    {
        // Implement password verification in controller/service
        return self::where('nip', $nip)->first();
    }

    /**
     * Get a single user by NIP.
     */
    public static function getUser(string $nip): ?self
    {
        return self::find($nip);
    }

    /**
     * Get all users (simple wrapper, can be paginated in controllers).
     * Returns: \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllUser()
    {
        return self::query()->get();
    }

    /**
     * Create a new user. $data should contain nip, role, department, password
     */
    public static function createUser(array $data): self
    {
        return self::create($data);
    }

    /**
     * Update an existing user.
     */
    public function updateUser(array $data): bool
    {
        return $this->update($data);
    }

    /**
     * Delete a user.
     */
    public function deleteUser(): ?bool
    {
        return $this->delete();
    }

    /**
     * Change password helper.
     */
    public function changePass(string $newPassword): bool
    {
        $this->password = $newPassword;
        return $this->save();
    }
}
