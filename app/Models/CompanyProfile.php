<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $table = 'company_profiles';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'company_profile_id';

    protected $fillable = [
        'comp_name',
        'comp_description',
        'comp_email',
        'comp_telephone',
        'comp_address',
        'vision',
        'mission',
    ];

    /**
     * Show profile (returns first row or by company_profile_id)
     */
    public static function ShowProfile(int $profileId = null): ?self
    {
        if ($profileId) {
            return self::find($profileId);
        }
        return self::query()->first();
    }

    /**
     * Edit profile
     */
    public function editProfile(array $data): bool
    {
        return $this->update($data);
    }

    /**
     * Get or create default company profile
     */
    public static function getDefault(): self
    {
        $profile = self::first();
        if (!$profile) {
            $profile = self::create([
                'comp_name' => 'Nama Perusahaan',
                'comp_description' => 'Deskripsi perusahaan',
                'comp_email' => 'info@company.com',
                'comp_telephone' => '(021) 123-4567',
                'comp_address' => 'Alamat perusahaan',
                'vision' => 'Visi perusahaan',
                'mission' => 'Misi perusahaan',
            ]);
        }
        return $profile;
    }
}
