<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignAssetEmp extends Model
{
    use HasFactory;
    protected $table = 'assign_asset_emps';
    protected $primaryKey = 'id';
    protected $fillable = [
        'asset_id',
        'emp_id',
        'manufacturer',
        'asset_type',
        'employee_name',
        'asset_assign_file_path',
        'asset_deactivate_file_path',
        'department',
        'sophos_antivirus',
        'vpn_creation',
        'teramind',
        'system_upgradation',
        'system_name',
        'one_drive',
        'screenshot_programs',
        'mac_address',
        'laptop_received',
        'deleted_at',
        'delete_reason',
        'is_active'
    ];


    public function vendorAsset()
    {
        return $this->belongsTo(VendorAsset::class, 'asset_id', 'asset_id');
    }

    public function employee()
    {
        return $this->belongsTo(EmployeeDetails::class, 'emp_id', 'emp_id');
    }

    public function vendor()
    {
        return $this->hasOneThrough(
            Vendor::class,
            VendorAsset::class,
            'asset_id', // Foreign key on the vendor_assets table
            'vendor_id', // Foreign key on the vendors table
            'asset_id', // Local key on the assign_asset_emps table
            'vendor_id' // Local key on the vendor_assets table
        );
    }




}
