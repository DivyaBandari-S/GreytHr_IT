<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class VendorAsset extends Model
{
    use HasFactory;
    use Notifiable;

    protected $table = 'vendor_assets';
    protected $fillable = [
        'vendor_id',
        'asset_type',
        'asset_model',
        'asset_specification',
        'color',
        'delete_asset_reason',
        'version',
        'serial_number',
        'invoice_number',
        'taxable_amount',
        'invoice_amount',
        'gst_ig',
        'gst_state',
        'gst_central',
        'barcode',
        'manufacturer',
        'purchase_date',
        'warranty_expire_date',
        'end_of_life',
        'file_paths',
        'status',
        'is_active',
        'asset_id'
    ];


    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
    }

    public function assignAssetEmps()
    {
        return $this->hasMany(AssignAssetEmp::class, 'asset_id', 'asset_id');
    }


}
