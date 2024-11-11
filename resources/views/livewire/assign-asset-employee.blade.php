<div class="main">

    <div wire:loading
        wire:target="cancel,backVendor,oldAssetlisting,toggleOverview,assignAsset,viewDetails,edit,selectedAsset,closeViewEmpAsset,viewOldAssetDetails,selectedEmployee,submit,createAssetType,showAddVendorMember,delete,clearFilters ,showEditAsset ,showViewVendor,showViewImage,showViewFile,showEditVendor,closeViewVendor,downloadImages,closeViewImage,closeViewFile,confirmDelete ,cancelLogout,restore">
        <div class="loader-overlay">
            <div>
                <div class="logo">

                    <img src="{{ asset('images/Screenshot 2024-10-15 120204.png') }}" width="58" height="50"
                        alt="">&nbsp;
                    <span>IT</span>&nbsp;&nbsp;
                    <span>EXPERT</span>
                </div>
            </div>
            <div class="loader-bouncing">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>


    <div class="container AssetEmployee mt-4">

        @if ($showEMployeeAssetBtn)
        <div class="col-11 d-flex justify-content-start mb-4" style="margin-left: 4%;">
            <button class="btn text-white" style="background-color: #02114f;" wire:click="backVendor"><i
                    class="fas fa-arrow-left"></i> Back
            </button>
        </div>
        @endif

        @if($assetEmpCreateUpdate)

        <div class="col-11 assetAddPage mb-3">
            <!-- Row for Dropdowns -->
            <div class="row mb-3 d-flex justify-content-around">

                <!-- Employee ID Dropdown -->
                <div class="col-md-5">
                    <label for="employeeSelect" class="form-label">Select Employee ID</label>
                    <select id="employeeSelect" class="form-select" wire:model="selectedEmployee"
                        wire:change="fetchEmployeeDetails" {{ $isUpdateMode ? 'disabled' : '' }}>
                        <option value="">Choose Employee</option>
                        @foreach ($assetSelectEmp as $employee)
                        <option value="{{ $employee->emp_id }}"
                            class=""
                            {{ $isUpdateMode && $employee->emp_id == $selectedEmployee ? 'selected' : '' }}>
                            {{ $employee->emp_id }} - {{ ucwords(strtolower($employee->first_name ))}} {{ ucwords(strtolower($employee->last_name ))}}
                        </option>
                        @endforeach

                    </select>


                    @error('selectedEmployee')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Asset Dropdown -->
                <div class="col-md-5">

                    <label for="assetSelect" class="form-label">Select Asset</label>
                    <select id="assetSelect" class="form-select" wire:model="selectedAsset"
                        wire:change="fetchAssetDetails">
                        <option value="">Choose Asset</option>
                        @foreach ($assetSelect as $asset)
                        <option value="{{ $asset->asset_id }}"
                            class="{{ in_array($asset->asset_id, $assignedAssetIds) ? 'inactive-option' : 'active-option' }}"
                            {{ (in_array($asset->asset_id, $assignedAssetIds) && $asset->asset_id !== $selectedAsset) ? 'disabled' : '' }}
                            {{ $isUpdateMode && $asset->asset_id == $selectedAsset ? 'selected' : '' }}>
                            {{ $asset->asset_id }} - {{ $asset->asset_names }}
                        </option>

                        @endforeach
                    </select>
                    @error('selectedAsset')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <!-- Row for Details Cards -->
            <div class="row mt-4 d-flex justify-content-around">
                <div class="col-md-5">
                    @if ($empDetails)
                    <div class="assetEmpDetailsCard p-3 mb-3">
                        <h5><u>Employee Details</u></h5>
                        <p><strong>Employee ID:</strong> {{ $empDetails->emp_id }}</p>
                        <p><strong>Employee Name:</strong> {{ $empDetails->first_name }} {{ $empDetails->last_name }}
                        </p>
                        <p><strong>Email:</strong> {{ $empDetails->email }}</p>
                        <p><strong>Department:</strong> {{ $empDetails->job_role }}</p>
                        <p><strong>Job Mode:</strong> {{ $empDetails->job_mode }}</p>
                    </div>
                    @endif

                </div>

                <div class="col-md-5">
                    @if ($assetDetails)
                    <div class="assetEmpDetailsCard p-3 mb-3">
                        <h5><u>Asset Details</u></h5>
                        <p><strong>Manufacturer:</strong> <span>{{ $assetDetails->manufacturer }}</span></p>
                        <p><strong>Asset Type:</strong> {{ $assetDetails->asset_type_name }}</p>
                        <p><strong>Asset Model:</strong> {{ $assetDetails->asset_model }}</p>
                        <p><strong>Serial Number:</strong> {{ $assetDetails->serial_number }}</p>
                        <p><strong>Specifications:</strong> {{ $assetDetails->asset_specification }}</p>
                    </div>
                    @endif
                </div>
            </div>


            <div class="mt-4" style="margin-left: 4%;">
                <div>
                    <button class="btn text-white d-flex align-items-center" style="background-color: #02114f;"
                        wire:click="toggleOverview">
                        System Updates
                        <!-- <i wire:click="toggleOverview" class="fas fa-caret-down req-pro-dropdown-arrow" style="margin-left: auto; cursor: pointer;"></i> -->
                        <i
                            class="fas fa-caret-down req-pro-dropdown-arrow {{ $showOverview ? 'rotated' : '' }} req-overview-icon"></i>

                    </button>
                </div>

            </div>

            <!-- Form for System Update Fields -->
            @if($showSystemUpdateForm)
            <div class="p-4 border mt-3">
                <h5 class="system-details-head">System Update Details</h5>


                <div class="row mb-5">
                    <div class="form-group col-md-4">
                        <label>Sophos Antivirus:</label>
                        <div class="input-group">
                            <div class="form-check form-check-inline mb-0 mx-2">
                                <input class="form-check-input" type="radio" wire:model="sophosAntivirus" value="Yes"
                                    id="sophosYes" name="sophosAntivirus">
                                <label class="form-check-label mb-0" for="sophosYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline mb-0 mx-2">
                                <input class="form-check-input" type="radio" wire:model="sophosAntivirus" value="No"
                                    id="sophosNo" name="sophosAntivirus">
                                <label class="form-check-label mb-0" for="sophosNo">No</label>
                            </div>
                        </div>

                    </div>

                    <div class="form-group col-md-4">
                        <label>VPN Creation:</label>
                        <div class="input-group">
                            <div class="form-check form-check-inline mb-0 mx-2">
                                <input class="form-check-input" type="radio" wire:model="vpnCreation" value="Yes"
                                    id="vpnYes" name="vpnCreation">
                                <label class="form-check-label mb-0" for="vpnYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline mb-0 mx-2">
                                <input class="form-check-input" type="radio" wire:model="vpnCreation" value="No"
                                    id="vpnNo" name="vpnCreation">
                                <label class="form-check-label mb-0" for="vpnNo">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Teramind:</label>
                        <div class="input-group">
                            <div class="form-check form-check-inline mb-0 mx-2">
                                <input class="form-check-input" type="radio" wire:model="teramind" value="Yes"
                                    id="teramindYes" name="teramind">
                                <label class="form-check-label mb-0" for="teramindYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline mb-0 mx-2">
                                <input class="form-check-input" type="radio" wire:model="teramind" value="No"
                                    id="teramindNo" name="teramind">
                                <label class="form-check-label mb-0" for="teramindNo">No</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="form-group col-md-4">
                        <label>System Upgradation:</label>
                        <div class="input-group">
                            <div class="form-check form-check-inline mb-0 mx-2">
                                <input class="form-check-input" type="radio" wire:model="systemUpgradation" value="Yes"
                                    id="upgradeYes" name="systemUpgradation">
                                <label class="form-check-label mb-0" for="upgradeYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline mb-0 mx-2">
                                <input class="form-check-input" type="radio" wire:model="systemUpgradation" value="No"
                                    id="upgradeNo" name="systemUpgradation">
                                <label class="form-check-label mb-0" for="upgradeNo">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>OneDrive:</label>
                        <div class="input-group">
                            <div class="form-check form-check-inline mb-0 mx-2">
                                <input class="form-check-input" type="radio" wire:model="oneDrive" value="Yes"
                                    id="oneDriveYes" name="oneDrive">
                                <label class="form-check-label mb-0" for="oneDriveYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline mb-0 mx-2">
                                <input class="form-check-input" type="radio" wire:model="oneDrive" value="No"
                                    id="oneDriveNo" name="oneDrive">
                                <label class="form-check-label mb-0" for="oneDriveNo">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Screenshot Programs:</label>
                        <div class="input-group">
                            <div class="form-check form-check-inline mb-0 mx-2">
                                <input class="form-check-input" type="radio" wire:model="screenshotPrograms" value="Yes"
                                    id="screenshotYes" name="screenshotPrograms">
                                <label class="form-check-label mb-0" for="screenshotYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline mb-0 mx-2">
                                <input class="form-check-input" type="radio" wire:model="screenshotPrograms" value="No"
                                    id="screenshotNo" name="screenshotPrograms">
                                <label class="form-check-label mb-0" for="screenshotNo">No</label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mb-5">
                    <div class="form-group col-md-4">

                        <label>Mac Address:</label>
                        <input type="text" class="form-control" wire:model="macAddress">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Laptop Received (Date):</label>
                        <input type="date" class="form-control" wire:model="laptopReceived">
                    </div>
                </div>


            </div>
            @endif




            <!-- Submit Button -->
            <div class="mt-4 text-center">

                <button class="btn text-white" style="background-color: #02114f;" wire:click="submit">
                    {{ $isUpdateMode ? 'Update Asset' : 'Assign' }}
                </button>

            </div>

        </div>
        @endif




        @if($employeeAssetListing)

        @if($searchFilters)

        <div class="row mb-3 mt-4 ml-4 employeeAssetList">
            <!-- Align items to the same row with space between -->
            <div class="col-11 col-md-11 mb-2 mb-md-0">
                <div class="row d-flex justify-content-between">
                    <!-- Employee ID Search Input -->
                    <div class="col-4">
                        <div class="input-group task-input-group-container">
                            <input type="text" class="form-control" placeholder="Search..." wire:model="searchEmp"
                                wire:input="filter">
                        </div>
                    </div>

                    <!-- Add Member Button aligned to the right -->
                    <div class="col-auto">
                        <div class="">

                            @if ($showOldEMployeeAssetBtn)
                            <button class="btn text-white mr-3" style="background-color: #02114f;"
                                wire:click="oldAssetlisting">Previous Owners </button>
                            @endif
                            @if ($showAssignAssetBtn)
                            <button class="btn text-white" style="background-color: #02114f;"
                                wire:click="assignAsset">Assign
                                Asset</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @endif
        @if($showEditDeleteEmployeeAsset)
        <div class="col-11 mt-4 ml-4">

            <div class="table-responsive it-add-table-res">

                <table class="custom-table">
                    <thead>
                        <tr>
                            <th class="req-table-head" scope="col">Employee ID
                                <span wire:click.debounce.500ms="toggleSortOrder('emp_id')" style="cursor: pointer;">
                                    @if($sortColumn == 'emp_id')
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                    <i class="fas fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="req-table-head">Employee Name
                                <span wire:click.debounce.500ms="toggleSortOrder('employee_name')"
                                    style="cursor: pointer;">
                                    @if($sortColumn == 'employee_name')
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                    <i class="fas fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="req-table-head">Asset ID
                                <span wire:click.debounce.500ms="toggleSortOrder('asset_id')" style="cursor: pointer;">
                                    @if($sortColumn == 'asset_id')
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                    <i class="fas fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="req-table-head">Manufacturer
                                <span wire:click.debounce.500ms="toggleSortOrder('manufacturer')"
                                    style="cursor: pointer;">
                                    @if($sortColumn == 'manufacturer')
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                    <i class="fas fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="req-table-head">Asset Type
                                <span wire:click.debounce.500ms="toggleSortOrder('asset_type')"
                                    style="cursor: pointer;">
                                    @if($sortColumn == 'asset_type')
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                    <i class="fas fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="req-table-head">Department
                                <span wire:click.debounce.500ms="toggleSortOrder('department')"
                                    style="cursor: pointer;">
                                    @if($sortColumn == 'department')
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                    <i class="fas fa-sort"></i>
                                    @endif
                                </span>
                            </th>


                            <th class="req-table-head d-flex justify-content-center">Actions</th>
                            <!-- Added Actions Column -->
                        </tr>
                    </thead>
                    <tbody>

                        {{-- Ensure $employeeAssetLists is initialized --}}
                        @php
                        $employeeAssetLists = $employeeAssetLists ?? collect(); // Initialize as an empty collection if
                        null
                        @endphp

                        @if($employeeAssetLists->count() > 0 && $employeeAssetLists->where('is_active', 1)->count() > 0)
                        @foreach($employeeAssetLists as $employeeAssetList)
                        @if($employeeAssetList->is_active == 1)
                        <tr>
                            <td>{{ $employeeAssetList->emp_id ?? 'N/A'}}</td>
                            <td>{{ ucwords(strtolower($employeeAssetList->employee_name)) ?? 'N/A' }}</td>
                            <td>{{ $employeeAssetList->asset_id ?? 'N/A'}}</td>
                            <td>{{ ucwords(strtolower($employeeAssetList->manufacturer)) ?? 'N/A'}}</td>
                            <td>{{ ucwords(strtolower($employeeAssetList['asset_type_name'])) ?? 'N/A' }}</td>
                            <td>{{ $employeeAssetList->department ?? 'N/A' }}</td>
                            <td class="d-flex ">
                                <!-- Action Buttons -->
                                <div class="col mx-1">
                                    <button class="btn btn-sm btn-white border-dark"
                                        wire:click="viewDetails({{ $employeeAssetList->id }})" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <!-- Edit Action -->
                                <div class="col mx-1">
                                    <button class="btn btn-sm btn-white border-dark"
                                        wire:click="edit({{ $employeeAssetList->id }})" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                                <!-- Delete Action -->
                                <div class="col mx-1">
                                    <button class="btn text-white btn-sm border-dark" style="background-color: #02114f;"
                                        wire:click="confirmDelete({{ $employeeAssetList->id }})" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endif

                        @endforeach
                        @else
                        <tr>
                            <td colspan="20">

                                <div class="req-td-norecords">
                                    <img src="{{ asset('images/Closed.webp') }}" alt="No Records"
                                        class="req-img-norecords">


                                    <h3 class="req-head-norecords">No data found</h3>
                                </div>
                            </td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        @endif


        <!-- View Vendor Details Modal -->
        @if($showViewEmployeeAsset && $currentVendorId)
        @php
        // Find the specific vendor by the currentVendorId
        $vendor = $employeeAssetLists->firstWhere('id', $currentVendorId);
        @endphp

        @if($vendor)
        <div class="col-10 mt-4 itadd-maincolumn">
            <div class="d-flex justify-content-between align-items-center">
                <h5>View Details</h5>
                <button class="btn text-white" style="background-color: #02114f;" wire:click="closeViewVendor"
                    aria-label="Close">
                    Close
                </button>
            </div>

            <table class="table table-bordered mt-3 req-pro-table">

                <tbody>
                    <tr>
                        <td>Employee ID</td>
                        <td class="view-td">{{ $vendor->emp_id ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Employee Name</td>
                        <td class="view-td">{{ucwords(strtolower($vendor->employee_name)) ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Vendor ID</td>
                        <td class="view-td">{{ $vendor->vendorAsset->vendor_id ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Vendor Name</td>
                        <td class="view-td">{{ $vendor->vendorAsset->vendor->vendor_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Asset ID</td>
                        <td class="view-td">{{ $vendor->asset_id ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Manufacturer</td>
                        <td class="view-td">{{ ucwords(strtolower($vendor->manufacturer)) ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Asset Type</td>
                        <td class="view-td">{{ ucwords(strtolower($vendor['asset_type_name'])) ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Asset Model</td>
                        <td class="view-td">{{ ucwords(strtolower($vendor->vendorAsset->asset_model)) ?? 'N/A' }}</td>
                    </tr>

                    <tr>
                        <td>Department</td>
                        <td class="view-td">{{ $vendor->department ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Color</td>
                        <td class="view-td">{{ ucwords(strtolower($vendor->vendorAsset->color)) ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Invoice Amount</td>
                        <td class="view-td">Rs. {{ $vendor->vendorAsset->invoice_amount ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Invoice Number</td>
                        <td class="view-td">{{ $vendor->vendorAsset->invoice_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Serial Number</td>
                        <td class="view-td">{{ $vendor->vendorAsset->serial_number ?? 'N/A' }}</td>
                    </tr>




                    <tr>
                        <td>Sophos Antivirus</td>
                        <td class="view-td">{{ $vendor->sophos_antivirus ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>VPN Creation</td>
                        <td class="view-td">{{ $vendor->vpn_creation ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Teramind</td>
                        <td class="view-td">{{ $vendor->teramind ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>System Upgradation</td>
                        <td class="view-td">{{ $vendor->system_upgradation ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>System Name</td>
                        <td class="view-td">{{ $vendor->system_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>One Drive</td>
                        <td class="view-td">{{ $vendor->one_drive ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Screenshot Of Programs</td>
                        <td class="view-td">{{ $vendor->screenshot_programs ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>MAC Address</td>
                        <td class="view-td">{{ $vendor->mac_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Laptop Received Date</td>
                        <td class="view-td">{{ \Carbon\Carbon::parse($vendor->laptop_received)->format('d-M-Y') ?? 'N/A' }}</td>
                    </tr>




                    <tr>
                        <td>Asset Purchase Date</td>
                        <td class="view-td">
                            {{ $vendor->vendorAsset->purchase_date ? \Carbon\Carbon::parse($vendor->vendorAsset->purchase_date)->format('d-M-Y') : 'N/A' }}
                        </td>
                    </tr>

                    <tr>
                        <td>No of Days</td>
                        <td class="view-td">
                            {{ $vendor->created_at ? \Carbon\Carbon::parse($vendor->created_at)->diffInDays(\Carbon\Carbon::now()) . ' days' : 'N/A' }}
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        @else
        <div class="col-10 mt-4 itadd-maincolumn">
            <p>No details available.</p>
        </div>
        @endif

        @endif
        @endif

        @if($oldAssetEmp)



        @if($searchFilters)
        <!-- Search Filters -->
        <div class="row mb-3 mt-4 ml-4 employeeAssetList">
            <!-- Align items to the same row with space between -->
            <div class="col-11 col-md-11 mb-2 mb-md-0">
                <div class="row d-flex justify-content-between">
                    <!-- Employee ID Search Input -->
                    <div class="col-4">
                        @if($oldAssetBackButton)

                        <button class="btn text-white" style="background-color: #02114f;" wire:click="closeViewVendor"
                            aria-label="Close">
                            <i class="fas fa-arrow-left"></i> Back
                        </button>

                        @endif
                    </div>

                    <!-- Add Member Button aligned to the right -->
                    <div class="col-4">

                        <input type="text" class="form-control" placeholder="Search..." wire:model="searchEmp"
                            wire:input="filter">
                    </div>
                </div>
            </div>
        </div>



        @endif
        @if($showEditDeleteEmployeeAsset)
        <div class="col-11 mt-4 ml-4">
            <div class="table-responsive it-add-table-res">

                <table class="custom-table">
                    <thead>
                        <tr>
                            <th class="req-table-head" scope="col">Employee ID
                                <span wire:click.debounce.500ms="toggleSortOrder('emp_id')" style="cursor: pointer;">
                                    @if($sortColumn == 'emp_id')
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                    <i class="fas fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="req-table-head">Employee Name
                                <span wire:click.debounce.500ms="toggleSortOrder('employee_name')"
                                    style="cursor: pointer;">
                                    @if($sortColumn == 'employee_name')
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                    <i class="fas fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="req-table-head">Asset ID
                                <span wire:click.debounce.500ms="toggleSortOrder('asset_id')" style="cursor: pointer;">
                                    @if($sortColumn == 'asset_id')
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                    <i class="fas fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="req-table-head">Manufacturer
                                <span wire:click.debounce.500ms="toggleSortOrder('manufacturer')"
                                    style="cursor: pointer;">
                                    @if($sortColumn == 'manufacturer')
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                    <i class="fas fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="req-table-head">Asset Type
                                <span wire:click.debounce.500ms="toggleSortOrder('asset_type')"
                                    style="cursor: pointer;">
                                    @if($sortColumn == 'asset_type')
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                    <i class="fas fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="req-table-head">Department
                                <span wire:click.debounce.500ms="toggleSortOrder('department')"
                                    style="cursor: pointer;">
                                    @if($sortColumn == 'department')
                                    <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @else
                                    <i class="fas fa-sort"></i>
                                    @endif
                                </span>
                            </th>
                            <th class="req-table-head">Actions</th>


                        </tr>
                    </thead>
                    <tbody>

                        @if($employeeAssetLists->count() > 0 && $employeeAssetLists->where('is_active', 0)->count() > 0)
                        @foreach($employeeAssetLists as $employeeAssetList)
                        @if($employeeAssetList->is_active == 0)
                        <tr>
                            <td>{{ $employeeAssetList->emp_id ?? 'N/A'}}</td>
                            <td>{{ucwords(strtolower($employeeAssetList->employee_name)) ?? 'N/A'}}</td>
                            <!-- <td>{{ $employeeAssetList->vendorAsset->vendor_id }}</td> -->
                            <td>{{ $employeeAssetList->asset_id ?? 'N/A'}}</td>
                            <td>{{ ucwords(strtolower($employeeAssetList->manufacturer)) ?? 'N/A'}}</td>
                            <td>{{ ucwords(strtolower($employeeAssetList['asset_type_name'])) ?? 'N/A'}}</td>

                            <td>{{ $employeeAssetList->department ?? 'N/A'}}</td>
                            <td class="d-flex ">
                                <!-- Action Buttons -->
                                <div class="col">
                                    <button class="btn btn-sm btn-white border-dark"
                                        wire:click="viewOldAssetDetails({{ $employeeAssetList->id }})" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        @endif

                        @endforeach
                        @else
                        <tr>
                            <td colspan="20">

                                <div class="req-td-norecords">
                                    <img src="{{ asset('images/Closed.webp') }}" alt="No Records"
                                        class="req-img-norecords">


                                    <h3 class="req-head-norecords">No data found</h3>
                                </div>
                            </td>
                        </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
        @endif


        <!-- View Vendor Details Modal -->
        @if($showViewEmployeeAsset && $currentVendorId)
        @php
        // Find the specific vendor by the currentVendorId
        $vendor = $employeeAssetLists->firstWhere('id', $currentVendorId);
        @endphp

        @if($vendor)
        <div class="col-10 mt-4 itadd-maincolumn">
            <div class="d-flex justify-content-between align-items-center">
                <h5>View Details</h5>
                <button class="btn text-white" style="background-color: #02114f;" wire:click="closeViewEmpAsset"
                    aria-label="Close">
                    Close
                </button>
            </div>

            <table class="table table-bordered mt-3 req-pro-table">

                <tbody>
                    <tr>
                        <td>Employee ID</td>
                        <td class="view-td">{{ $vendor->emp_id ?? 'N/A' }}</td>
                    </tr>

                    <tr>
                        <td>Employee Name</td>
                        <td class="view-td">{{ ucwords(strtolower($vendor->employee_name)) ?? 'N/A' }}</td>
                    </tr>

                    <tr>
                        <td>Vendor Id</td>
                        <td class="view-td">{{ $vendor->vendorAsset->vendor_id ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Asset ID</td>
                        <td class="view-td">{{ $vendor->asset_id ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Manufacturer</td>
                        <td class="view-td">{{ ucwords(strtolower($vendor->manufacturer)) ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Asset Type</td>
                        <td class="view-td">{{ ucwords(strtolower($vendor['asset_type_name'])) ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Asset Model</td>
                        <td class="view-td">{{ ucwords(strtolower($vendor->vendorAsset->asset_model)) ?? 'N/A' }}</td>
                    </tr>

                    <tr>
                        <td>Department</td>
                        <td class="view-td">{{$vendor->department ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Color</td>
                        <td class="view-td">{{ ucwords(strtolower($vendor->vendorAsset->color)) ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Invoice Amount</td>
                        <td class="view-td">Rs. {{$vendor->vendorAsset->invoice_amount ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Invoice Number</td>
                        <td class="view-td">{{ $vendor->vendorAsset->invoice_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Serial Number</td>
                        <td class="view-td">{{ $vendor->vendorAsset->serial_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Sophos Antivirus</td>
                        <td class="view-td">{{ $vendor->sophos_antivirus ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>VPN Creation</td>
                        <td class="view-td">{{ $vendor->vpn_creation ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Teramind</td>
                        <td class="view-td">{{ $vendor->teramind ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>System Upgradation</td>
                        <td class="view-td">{{ $vendor->system_upgradation ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>System Name</td>
                        <td class="view-td">{{ $vendor->system_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>One Drive</td>
                        <td class="view-td">{{ $vendor->one_drive ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Screenshot Of Programs</td>
                        <td class="view-td">{{ $vendor->screenshot_programs ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>MAC Address</td>
                        <td class="view-td">{{ $vendor->mac_address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Laptop Received Date</td>
                        <td class="view-td">{{ \Carbon\Carbon::parse($vendor->laptop_received)->format('d-M-Y') ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td>Purchase Date</td>
                        <td class="view-td">
                            {{ $vendor->vendorAsset->purchase_date ? \Carbon\Carbon::parse($vendor->vendorAsset->purchase_date)->format('d-M-Y') : 'N/A' }}
                        </td>
                    </tr>


                    <tr>
                        <td>No of Days</td>
                        <td class="view-td">
                            @if($vendor->deleted_at)
                            {{ $vendor->created_at ? \Carbon\Carbon::parse($vendor->created_at)->diffInDays(\Carbon\Carbon::parse($vendor->deleted_at)) . ' days' : 'N/A' }}
                            @else
                            N/A
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @else
        <div class="col-10 mt-4 itadd-maincolumn">
            <p>No details available.</p>
        </div>
        @endif

        @endif
        @endif
    </div>


    @if ($showLogoutModal)
    <div class="modal logout1" id="logoutModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-white logout2">
                    <h6 class="modal-title logout3" id="logoutModalLabel">Confirm Delete</h6>
                </div>
                <div class="modal-body text-center logout4">
                    Are you sure you want to delete?
                </div>
                <div class="modal-body text-center">
                    <form wire:submit.prevent="delete">
                        <span class="text-danger d-flex align-start">*</span>
                        <div class="row">
                            <div class="col-12 req-remarks-div">

                                <textarea wire:model.lazy="reason" class="form-control req-remarks-textarea logout4"
                                    placeholder="Reason for deactivation"></textarea>

                            </div>
                        </div>
                        @error('reason') <span class="text-danger d-flex align-start">{{ $message }}</span>@enderror
                        <div class="d-flex justify-content-center p-3">
                            <button type="submit" class="submit-btn mr-3"
                                wire:click="delete({{ $employeeAssetList->id }})">Delete</button>
                            <button type="button" class="cancel-btn1 ml-3" wire:click="cancel">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
    @endif






</div>
