    <div class="main">

        <div wire:loading
            wire:target="exportRequests,clearFilters,approveBulkNewRqsStatus,rejectionBulkRqsModal,bulkSubmitStatusReason,applyBulkActions,bulkSelectedInprogress,closeBulkInprogressModal,bulkSubmitReason,handleBulkInprogressStatus,closeBulkPendingModal,closeBulkClosedModal,bulkPendingForDesks,bulkCloseForDesks,submit,setActiveTab,rejectionModal,selectPriority,closePopup,showRejectedRequest,loadClosedRecordsByAssigne,loadInprogessRecordsByAssigne,loadPendingRecordsByAssigne,selectedInprogress,closePendingModal,closeClosedModal,selectedClosed,selectedPending,closeInprogressModal,inprogressForDesks,loadLogs,pendingForDesks,closeModal,rejectStatus,cancelModal,cancelStatus,viewRecord,Cancel,viewRejectDetails,closeRejectDetails,closeDetails,closeDetailsBack,selectedStatus,viewApproveDetails,showAllRequest,showRecentRequest,approveStatus,updateStatus,postComment,updateAssigne,redirectBasedOnStatus,viewDetails,openForDesks,postInprogressRemarks,postPendingRemarks,postRemarks,closeForDesks,showViewImage,showViewFile,closeViewFile,downloadImages,closeViewImage,selectedAssigne,SelectedStatus,closeStatusModal,submitStatusReason,activeCatalogSubmit,showViewEmpImage,showViewEmpFile,closeViewEmpImage,closeViewEmpFile,downloadITImages">
            <div class="loader-overlay">
                <div>
                    <div class="logo">
                        <!-- <i class="fas fa-user-headset"></i> -->
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

        <div class="d-flex req-pro-main-page">


            @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin')))

            @if($viewRecentRequests)
            <div class="col-lg-9 col-md-10 col-xs-12 " style="margin-left: 4%;">

                <div class="row mb-4">
                    <div class="col-12 col-md-6 d-flex flex-column align-items-start justify-content-center">
                        <h3 class="d-flex justify-content-start mb-5 headingForAllModules1">New Requests</h3>

                    </div>

                    <div class="col-12 col-md-6 d-flex align-items-start justify-content-end">
                        <button class="btn btn-success headingForAllModules"
                            style="background-color: #02114f;color:white;white-space: nowrap;font-size:13px;"
                            wire:click="showRejectedRequest">Rejected
                            Requests</button>

                        <button class="btn btn-success  ml-2"
                            style="background-color: #02114f;color:white;font-size:13px;margin-left:3px;white-space: nowrap;"
                            wire:click="showAllRequest">Approved Requests</button>
                    </div>

                </div>

                <div class="container export-main">
                    <h5 class="mb-4">Export Catalog</h5>

                    <div class="row" style="display: flex;justify-content: space-evenly;align-items: center;">
                        <!-- Export Format -->
                        <div class="col-md-4 mb-3">
                            <label for="format" class="form-label">Export Format:</label>
                            <select id="format" wire:model="exportFormat" class="form-select">
                                <option value="" selected disabled hidden>Select Export Format</option>
                                <option value="excel">Excel</option>
                                <option value="csv">CSV</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>

                        <!-- Request ID -->
                        <div class="col-md-4 mb-3">
                            <label for="requestId" class="form-label">Catalog ID:</label>
                            <input id="requestId" type="text" wire:model="requestId" class="form-control"
                                placeholder="Enter Request ID (Optional)">
                        </div>


                        <div class="col-md-3 mb-3 d-flex justify-content-center">
                            <button wire:click.prevent="clearFilters" class="btn btn-secondary mt-3 me-2">Clear</button>

                            <button wire:click.prevent="exportRequests(8)"
                                class="btn btn-primary mt-3">Download</button>
                        </div>
                    </div>

                </div>


                @if($recentrequestDetails && $recentRequest)

                @if($recentrequestDetails)
                <button class="btn text-white float:right mb-3" style="background-color: #02114f;"
                    wire:click="closeDetails" @if($loading) disabled @endif>
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                @endif
                <div class="req-pro-tablediv">

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-2">View Details</h5>

                    </div>
                    <table class="table table-bordered mt-3 req-pro-table">



                        <tbody>

                            <tr>

                                <td>Request ID</td>

                                <td class="view-td">{{$recentRequest->request_id ?? 'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Requested By</td>

                                <td class="view-td">{{$recentRequest->emp->first_name }}
                                    {{$recentRequest->emp->last_name }}
                                </td>

                            </tr>

                            <tr>

                                <td>Catalog Request</td>

                                <td class="view-td">{{$recentRequest->category ?? 'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Subject</td>

                                <td class="view-td">{{$recentRequest->subject??'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Description</td>

                                <td class="view-td">{{$recentRequest->description ??'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Distributor</td>

                                <td class="view-td">{{$recentRequest->distributor_name ??'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Phone</td>

                                <td class="view-td">{{$recentRequest->mobile ??'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>MailBox</td>

                                <td class="view-td">{{$recentRequest->mail ??'N/A' }}</td>

                            </tr>


                            <tr>

                                <td>CC To</td>

                                <td class="view-td">{{$recentRequest->cc_to ??'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Priority</td>

                                <td class="view-td">
                                    <!-- Dropdown for Priority -->
                                    <select
                                        wire:change="selectPriority('{{ $recentRequest->id }}', $event.target.value)"
                                        class="form-control">
                                        <option value="high" @if($recentRequest->priority == 'high') selected
                                            @endif>High</option>
                                        <option value="medium" @if($recentRequest->priority == 'medium') selected
                                            @endif>Medium</option>
                                        <option value="low" @if($recentRequest->priority == 'low') selected @endif>Low
                                        </option>
                                    </select>
                                </td>


                            </tr>

                            <tr>

                                <td>Select Equipment</td>

                                <td class="view-td">{{$recentRequest->selected_equipment ??'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Created At</td>

                                <td class="view-td">
                                    {{ \Carbon\Carbon::parse($recentRequest->created_at)->format('d-M-Y') ?? 'N/A' }}
                                </td>

                            </tr>


                            <tr>
                                <td class="fs-6 fs-md-3 fs-lg-2">Attachments</td>

                                <td>
                                    @php
                                    $empImages = [];
                                    $empFiles = [];

                                    // Check if $recentRequest->file_paths is a string, array, or null
                                    $fileDataArray = null;

                                    if (isset($recentRequest->file_paths) &&
                                    is_string($recentRequest->file_paths))
                                    {
                                    $fileDataArray = json_decode($recentRequest->file_paths, true);
                                    } elseif (isset($recentRequest->file_paths) &&
                                    is_array($recentRequest->file_paths)) {
                                    $fileDataArray = $recentRequest->file_paths;
                                    }

                                    // Ensure $fileDataArray is a valid array before looping
                                    if (is_array($fileDataArray)) {
                                    // Separate empImages and files
                                    foreach ($fileDataArray as $fileData) {
                                    if (isset($fileData['mime_type'])) {
                                    if (strpos($fileData['mime_type'], 'image/') === 0) {
                                    $empImages[] = $fileData;
                                    } else {
                                    $empFiles[] = $fileData;
                                    }
                                    }
                                    }
                                    }
                                    @endphp




                                    @php
                                    // Initialize $images and $files as empty arrays to avoid null issues
                                    $empImages = $empImages ?? [];
                                    $empFiles = $empFiles ?? [];
                                    @endphp
                                    <!-- Trigger Links -->
                                    @if (count($empImages) > 1)
                                    <a href="#" wire:click.prevent="showViewEmpImage({{ $recentRequest->id }})"
                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                        View Images
                                    </a>
                                    @elseif (count($empImages) == 1)
                                    <a href="#" wire:click.prevent="showViewEmpImage({{ $recentRequest->id }})"
                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                        View Image
                                    </a>
                                    @endif

                                    @if (count($empFiles) > 1)
                                    <a href="#" wire:click.prevent="showViewEmpFile({{ $recentRequest->id }})"
                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                        View Files
                                    </a>
                                    @elseif (count($empFiles) == 1)
                                    <a href="#" wire:click.prevent="showViewEmpFile({{ $recentRequest->id }})"
                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                        View File
                                    </a>
                                    @endif

                                    @if (count($empImages) == 0 && count($empFiles) == 0)
                                    <label for="">N/A</label>
                                    @endif


                                    {{-- view file popup --}}
                                    @if ($showViewEmpImageDialog && $currentImageRequesId === $recentRequest->id)
                                    <div class="modal custom-modal" tabindex="-1" role="dialog" style="display: block;">
                                        <div class="modal-dialog custom-modal-dialog custom-modal-dialog-centered modal-lg"
                                            role="document">
                                            <div class="modal-content custom-modal-content">
                                                <div class="modal-header custom-modal-header">
                                                    <h5 class="modal-title view-file">Attached Images</h5>
                                                </div>
                                                <div class="modal-body custom-modal-body">

                                                    <div class="swiper-container">

                                                        <div class="swiper-wrapper">
                                                            @foreach ($empImages as $eImage)
                                                            @php
                                                            $base64FileE = $eImage['data'];
                                                            $mimeTypeE = $eImage['mime_type'];
                                                            @endphp
                                                            <div class="swiper-slide">
                                                                <img src="data:{{ $mimeTypeE }};base64,{{ $base64FileE }}"
                                                                    class="img-fluid" alt="Image">
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer custom-modal-footer">
                                                    <button type="button" class="submit-btn"
                                                        wire:click.prevent="downloadImages({{ $recentRequest->id }})">Download</button>
                                                    <button type="button" class="cancel-btn1"
                                                        wire:click="closeViewEmpImage">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop fade show blurred-backdrop"></div>
                                    @endif


                                    @if ($showViewEmpFileDialog && $currentImageRequesId === $recentRequest->id)
                                    <div class="modal" tabindex="-1" role="dialog" style="display: block;">
                                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title viewfile">View Files</h5>
                                                </div>
                                                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                                    <ul class="list-group list-group-flush">

                                                        @foreach ($empFiles as $fileE)

                                                        @php

                                                        $base64FileE = $fileE['data'];

                                                        $mimeTypeE = $fileE['mime_type'];

                                                        $originalNameE = $fileE['original_name'];

                                                        @endphp

                                                        <li>

                                                            <a href="data:{{ $mimeTypeE }};base64,{{ $base64FileE }}"
                                                                download="{{ $originalNameE }}"
                                                                style="text-decoration: none; color: #007BFF; margin: 10px;">

                                                                {{ $originalNameE}} <i class="fas fa-download"
                                                                    style="margin-left:5px"></i>

                                                            </a>

                                                        </li>

                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="cancel-btn1"
                                                        wire:click="closeViewEmpFile">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop fade show blurred-backdrop"></div>
                                    @endif

                                </td>

                            </tr>



                            <tr>
                                <td class="fs-6 fs-md-3 fs-lg-2">File Upload</td>


                                <td>
                                    <!-- Attachments -->
                                    <div class="row mb-3">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-4">
                                                    <p class="text-primary">
                                                        <label for="file" class="vendor-asset-label">Attachments</label>

                                                    </p>
                                                </div>
                                                <div class="col-8">
                                                    <!-- File input hidden -->
                                                    <input id="fileInput-{{ $recentRequest->id }}" type="file"
                                                        wire:model="cat_file_paths.{{ $recentRequest->id }}"
                                                        class="form-control-file" multiple
                                                        style="font-size: 12px; display: none;" />

                                                    <!-- Label triggers file input -->
                                                    <div class="d-flex"
                                                        style="align-items: baseline; gap: 5px;margin-top: 0%;">
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            for="fileInput-{{ $recentRequest->id }}"
                                                            onclick="document.getElementById('fileInput-{{ $recentRequest->id }}').click();">
                                                            <i class="fa-solid fa-paperclip"></i>
                                                        </button>
                                                    </div>


                                                    <div wire:loading
                                                        wire:target="cat_file_paths.{{ $recentRequest->id }}"
                                                        class="mt-2">
                                                        <i class="fas fa-spinner fa-spin"></i>
                                                        Uploading...
                                                    </div>

                                                    @error('cat_file_paths.' . $recentRequest->id . '.*')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </td>



                                <!-- File Preview Modal -->
                                @if($showFilePreviewModal)

                                <div class="modal fade show d-block" tabindex="-1" role="dialog"
                                    style="background-color: rgba(0, 0, 0, 0.5);">
                                    <div class="modal-dialog modal-dialog-centered  modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="filePreviewModalLabel">File
                                                    Preview</h5>
                                                <button type="button" class="btn-close"
                                                    wire:click="hideFilePreviewModal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex flex-column align-items-center">
                                                    <h6>Selected Files</h6>
                                                    <div class="d-flex flex-wrap gap-3">
                                                        <!-- Loop through files and display previews -->
                                                        @foreach ($previews as $index => $preview)
                                                        <div class="file-preview-container text-center"
                                                            style="padding: 5px; border: 1px solid black; width: 120px; height: 120px; border-radius: 5px; position: relative; overflow: hidden;">
                                                            @if ($preview['type'] == 'image')
                                                            <img src="{{ $preview['url'] }}" alt="Preview"
                                                                class="img-thumbnail"
                                                                style="width: 75px; height: 75px;" />
                                                            <span class="mt-1 uploaded-file-name"
                                                                style="display: block; width: 100%;">{{ $preview['name'] }}</span>
                                                            @else
                                                            <div class="d-flex flex-column align-items-center">
                                                                <i class="fas fa-file fa-3x"
                                                                    style="width: 75px; height: 75px;"></i>
                                                                <span class="mt-1 uploaded-file-name"
                                                                    style="display: block; width: 100%;">{{ $preview['name'] }}</span>
                                                            </div>
                                                            @endif

                                                            <!-- Delete icon -->
                                                            <button type="button" class="delete-icon btn btn-danger"
                                                                wire:click="removeFile({{ $index }})"
                                                                style="position: absolute; top: 5%; right: 5%; z-index: 5; font-size: 12px;">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    wire:click="hideFilePreviewModal">Close</button>
                                                <button type="button" class="btn btn-primary"
                                                    wire:click="uploadFiles({{ $selectedRecordId }})">Upload
                                                    Files</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                @endif


                            </tr>


                            <tr>
                                <td class="fs-6 fs-md-3 fs-lg-2">IT Uploaded Files</td>


                                <td>
                                    @php
                                    $images = [];
                                    $files = [];


                                    // Check if $recentRequest->cat_file_paths is a string, array, or null
                                    $fileDataArray = null;

                                    if (isset($recentRequest->cat_file_paths) &&
                                    is_string($recentRequest->cat_file_paths))
                                    {
                                    $fileDataArray = json_decode($recentRequest->cat_file_paths, true);
                                    } elseif (isset($recentRequest->cat_file_paths) &&
                                    is_array($recentRequest->cat_file_paths)) {
                                    $fileDataArray = $recentRequest->cat_file_paths;
                                    }

                                    // Ensure $fileDataArray is a valid array before looping
                                    if (is_array($fileDataArray)) {
                                    // Separate images and files
                                    foreach ($fileDataArray as $fileData) {
                                    if (isset($fileData['mime_type'])) {
                                    if (strpos($fileData['mime_type'], 'image/') === 0) {
                                    $images[] = $fileData;
                                    } else {
                                    $files[] = $fileData;
                                    }
                                    }
                                    }
                                    }
                                    @endphp




                                    @php
                                    // Initialize $images and $files as empty arrays to avoid null issues
                                    $images = $images ?? [];
                                    $files = $files ?? [];
                                    @endphp
                                    <!-- Trigger Links -->
                                    @if (count($images) > 1)
                                    <a href="#" wire:click.prevent="showViewImage({{ $recentRequest->id }})"
                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                        View Images
                                    </a>
                                    @elseif (count($images) == 1)
                                    <a href="#" wire:click.prevent="showViewImage({{ $recentRequest->id }})"
                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                        View Image
                                    </a>
                                    @endif

                                    @if (count($files) > 1)
                                    <a href="#" wire:click.prevent="showViewFile({{ $recentRequest->id }})"
                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;margin-left:2px;">
                                        View Files
                                    </a>
                                    @elseif (count($files) == 1)
                                    <a href="#" wire:click.prevent="showViewFile({{ $recentRequest->id }})"
                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                        View File
                                    </a>
                                    @endif

                                    @if (count($images) == 0 && count($files) == 0)
                                    <label for="">N/A</label>
                                    @endif

                                    {{-- view file popup --}}
                                    @if ($showViewImageDialog && $currentImageRequesId === $recentRequest->id)
                                    <div class="modal custom-modal" tabindex="-1" role="dialog" style="display: block;">
                                        <div class="modal-dialog custom-modal-dialog custom-modal-dialog-centered modal-lg"
                                            role="document">
                                            <div class="modal-content custom-modal-content">
                                                <div class="modal-header custom-modal-header">
                                                    <h5 class="modal-title view-file">Attached Images</h5>
                                                </div>
                                                <div class="modal-body custom-modal-body">
                                                    <div class="swiper-container">
                                                        <div class="swiper-wrapper">
                                                            @foreach ($images as $image)
                                                            @php
                                                            $base64File = $image['data'];
                                                            $mimeType = $image['mime_type'];
                                                            @endphp
                                                            <div class="swiper-slide">
                                                                <img src="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                                    class="img-fluid" alt="Image">
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer custom-modal-footer">
                                                    <button type="button" class="submit-btn"
                                                        wire:click.prevent="downloadITImages({{ $recentRequest->id }})">Download</button>
                                                    <button type="button" class="cancel-btn1"
                                                        wire:click="closeViewImage">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop fade show blurred-backdrop"></div>
                                    @endif


                                    @if ($showViewFileDialog && $currentImageRequesId === $recentRequest->id)
                                    <div class="modal" tabindex="-1" role="dialog" style="display: block;">
                                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title viewfile">View Files</h5>
                                                </div>
                                                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                                    <ul class="list-group list-group-flush">

                                                        @foreach ($files as $file)

                                                        @php

                                                        $base64File = $file['data'];

                                                        $mimeType = $file['mime_type'];

                                                        $originalName = $file['original_name'];

                                                        @endphp

                                                        <li>

                                                            <a href="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                                download="{{ $originalName }}"
                                                                style="text-decoration: none; color: #007BFF; margin: 10px;">

                                                                {{ $originalName }} <i class="fas fa-download"
                                                                    style="margin-left:5px"></i>

                                                            </a>

                                                        </li>

                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="cancel-btn1"
                                                        wire:click="closeViewFile">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop fade show blurred-backdrop"></div>
                                    @endif

                                </td>


                            </tr>



                        </tbody>

                    </table>

                </div>



                @else

                <!-- <div class="search-container">
                <input type="text" class="form-control" placeholder="Search..." wire:model="searchEmp"
                wire:input="filter">
                </div> -->
                @if($recentDetails && $recentDetails->where('status_code', '8')->count() > 0)

                <div class="scrollable-container">
                    @if($checkboxNewRqsModal)
                    <div class="d-flex justify-content-between mb-5">
                        <!-- Bulk Status Dropdown -->
                        <div class="col-md-4">
                            <select wire:model="selectedStatus" class="req-selected-status"
                                wire:change="handleBulkNewRqsStatusChange">
                                <option value="" disabled hidden>Select Status</option>
                                <option value="10">Approve</option>
                                <option value="3">Reject</option>
                            </select>
                            @error('selectedStatus')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    @endif
                    @if ($showRejectionBulkRqsModal)
                    <div class="modal logout1" id="logoutModal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header text-white logout2">
                                    <h6 class="modal-title logout3" id="logoutModalLabel">Confirm Rejection</h6>
                                </div>
                                <div class="modal-body text-center logout4">
                                    Are you sure you want to Reject?
                                </div>
                                <div class="modal-body text-center">
                                    <form wire:submit.prevent="rejectBulkRqsStatus">
                                        <span class="text-danger d-flex align-start">*</span>
                                        <div class="row">
                                            <div class="col-12 req-remarks-div">
                                                <textarea wire:model.lazy="reason"
                                                    class="form-control req-remarks-textarea logout5"
                                                    placeholder="Reason for Rejection"></textarea>
                                            </div>
                                        </div>
                                        @error('reason')
                                        <span class="text-danger d-flex align-start">{{ $message }}</span>
                                        @enderror
                                        <div class="d-flex justify-content-center p-3">
                                            <button type="submit" class="submit-btn mr-3">Reject</button>
                                            <button type="button" class="cancel-btn1 ml-3"
                                                wire:click="Cancel">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                    @endif

                    <div class="req-pro-card">

                        @foreach ($recentDetails->where('status_code', '8') as $index => $request)

                        <div class="request-card">

                            <div class="req-pro-card-body d-flex align-items-center justify-content-between">

                                <!-- Checkbox for Selection -->
                                <div>
                                    <input type="checkbox" wire:model="selectedRequests"
                                        wire:click="checkboxNewRqsMultiSelection" value="{{ $request->id }}"
                                        wire:key=reqstID-{{ $request->id}}>
                                </div>
                                <div>

                                    <p class="req-reqBy-Dep">Request ID:
                                        <span class="req-res-depart1">
                                            {{ $request->request_id }}

                                        </span>
                                    </p>

                                    <p class="req-reqBy-Dep">Requested By:
                                        <span class="req-res-depart1">
                                            {{ $request->emp->first_name }}
                                            {{ $request->emp->last_name }}
                                        </span>
                                    </p>

                                    <p title="{{ $request['category'] }}" class="req-reqBy-ser">
                                        Category <span class="req-res-depart">{{ $request->category ?? 'N/A' }}</span>
                                    </p>

                                </div>

                                <div class="p-2">
                                    <button wire:click="$set('currentCatalogId', {{ $request->id }})"
                                        class="req-pro-view-details-btn" @if($loading) disabled @endif>
                                        View
                                    </button>

                                    <button wire:click="approveStatus('{{ $request->id }}')" class="req-pro-approve-btn"
                                        @if($loading) disabled @endif>Approve</button>

                                    <button wire:click="rejectionModal('{{ $request->id }}')"
                                        class="req-pro-approve-btn" @if($loading) disabled @endif>Reject</button>


                                </div>


                            </div>

                        </div>

                        @endforeach

                    </div>
                </div>

                @else
                <div class="req-requestnotfound">
                    <td colspan="20">

                        <div class="req-td-norecords">
                            <img src="{{ asset('images/Closed.webp') }}" alt="No Records" class="req-img-norecords">

                            <h3 class="req-head-norecords">No requests found
                            </h3>
                        </div>
                    </td>
                </div>
                @endif
                @endif




            </div>



            <div class="col-lg-2 col-md-5 col-xs-12 " style="margin-top:10% ;">

                <div class="req-pro-overview-container">

                    <div class="card text-white shadow-sm border-0 d-flex align-items-center justify-content-center"
                        style="width: 85px; height: 85px; border-radius: 50%;  background-color: #02114f;">
                        <div class="text-center p-3">
                            <h5 class="card-title mb-2"> Total</h5>
                            <p class="card-text mb-0">

                                <span class="d-block mt-2 fs-4">
                                    <strong>{{$newRequestCount}}</strong>
                                </span>
                            </p>
                        </div>
                    </div>



                </div>
            </div>

            @endif

            @endif


            @if ($showRejectionModal)
            <div class="modal logout1" id="logoutModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header text-white logout2">
                            <h6 class="modal-title logout3" id="logoutModalLabel">Confirm Rejection</h6>
                        </div>
                        <div class="modal-body text-center logout4">
                            Are you sure you want to Reject?
                        </div>
                        <div class="modal-body text-center">
                            <form wire:submit.prevent="rejectStatus">
                                <span class="text-danger d-flex align-start">*</span>
                                <div class="row">
                                    <div class="col-12 req-remarks-div">
                                        <textarea wire:model.lazy="reason"
                                            class="form-control req-remarks-textarea logout5"
                                            placeholder="Reason for Rejection"></textarea>
                                    </div>
                                </div>
                                @error('reason')
                                <span class="text-danger d-flex align-start">{{ $message }}</span>
                                @enderror
                                <div class="d-flex justify-content-center p-3">
                                    <button type="submit" class="submit-btn mr-3">Reject</button>
                                    <button type="button" class="cancel-btn1 ml-3" wire:click="Cancel">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
            @endif



            @if ($showCancelModal)
            <div class="modal logout1" id="logoutModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header text-white logout2">
                            <h6 class="modal-title logout3" id="logoutModalLabel">Confirm Cancel</h6>
                        </div>
                        <div class="modal-body text-center logout4">
                            Are you sure you want to Cancel?
                        </div>
                        <div class="modal-body text-center">
                            <form wire:submit.prevent="cancelStatus">
                                <span class="text-danger d-flex align-start">*</span>
                                <div class="row">
                                    <div class="col-12 req-remarks-div">
                                        <textarea wire:model.lazy="reason"
                                            class="form-control req-remarks-textarea logout5"
                                            placeholder="Reason for Cancel"></textarea>
                                    </div>
                                </div>
                                @error('reason')
                                <span class="text-danger d-flex align-start">{{ $message }}</span>
                                @enderror
                                <div class="d-flex justify-content-center p-3">
                                    <button type="submit" class="submit-btn mr-3">Cancel Request</button>
                                    <button type="button" class="cancel-btn1 ml-3" wire:click="Cancel">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
            @endif

            <!-- Rejection details -->



            @if(auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin')))

            @if($viewRejectedRequests)
            <div class="col-lg-9 col-md-10 col-xs-12 " style="margin-left: 4%;">

                <div class="d-flex  justify-content-between mb-4">
                    <div>
                        <h3 class="d-flex justify-content-start mb-5 headingForAllModules1">Rejected Requests</h3>

                    </div>
                    <div>
                        <button class="btn btn-success" style="background-color: #02114f;color:white;font-size:13px"
                            wire:click="showRecentRequest">Recent Requests</button>
                    </div>

                </div>

                <div class="container export-main">
                    <h5 class="mb-4">Export Catalog</h5>

                    <div class="row" style="display: flex;justify-content: space-evenly;align-items: center;">
                        <!-- Export Format -->
                        <div class="col-md-4 mb-3">
                            <label for="format" class="form-label">Export Format:</label>
                            <select id="format" wire:model="exportFormat" class="form-select">
                                <option value="" selected disabled hidden>Select Export Format</option>
                                <option value="excel">Excel</option>
                                <option value="csv">CSV</option>
                                <option value="pdf">PDF</option>
                            </select>
                        </div>

                        <!-- Request ID -->
                        <div class="col-md-4 mb-3">
                            <label for="requestId" class="form-label">Catalog ID:</label>
                            <input id="requestId" type="text" wire:model="requestId" class="form-control"
                                placeholder="Enter Request ID (Optional)">
                        </div>


                        <div class="col-md-3 mb-3 d-flex justify-content-center">
                            <button wire:click.prevent="clearFilters" class="btn btn-secondary mt-3 me-2">Clear</button>

                            <button wire:click.prevent="exportRequests(3)"
                                class="btn btn-primary mt-3">Download</button>
                        </div>
                    </div>

                </div>

                @if($rejectedrequestDetails && $rejectedRequest)

                @if($rejectedrequestDetails)
                <button class="btn text-white float:right mb-3" style="background-color: #02114f;"
                    wire:click="closeRejectDetails" @if($loading) disabled @endif>
                    <i class="fas fa-arrow-left"></i> Back
                </button>
                @endif
                <div class="req-pro-tablediv">

                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="m-2">View Details</h5>

                    </div>

                    <table class="table table-bordered mt-3 req-pro-table">



                        <tbody>
                            <tr>

                                <td>Request ID</td>

                                <td class="view-td">{{$rejectedRequest->request_id ?? 'N/A' }}</td>

                            </tr>


                            <tr>

                                <td>Requested By</td>

                                <td class="view-td">{{$rejectedRequest->emp->first_name }}
                                    {{$rejectedRequest->emp->last_name }}
                                </td>

                            </tr>

                            <tr>

                                <td>Catalog Request</td>

                                <td class="view-td">{{$rejectedRequest->category ?? 'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Subject</td>

                                <td class="view-td">{{$rejectedRequest->subject??'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Description</td>

                                <td class="view-td">{{$rejectedRequest->description ??'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Distributor</td>

                                <td class="view-td">{{$rejectedRequest->distributor_name ??'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Phone</td>

                                <td class="view-td">{{$rejectedRequest->mobile ??'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>MailBox</td>

                                <td class="view-td">{{$rejectedRequest->mail ??'N/A' }}</td>

                            </tr>


                            <tr>
                                <td class="fs-6 fs-md-3 fs-lg-2">Attachments</td>
                                <td>
                                    @if (!empty($rejectedRequest->file_paths))
                                    @php
                                    // Check if $rejectedRequest->file_paths is a string or an array
                                    $fileDataArray = is_string($rejectedRequest->file_paths)
                                    ? json_decode($rejectedRequest->file_paths, true)
                                    : $rejectedRequest->file_paths;

                                    // Separate images and files
                                    foreach ($fileDataArray as $fileData) {
                                    if (isset($fileData['mime_type'])) {
                                    if (strpos($fileData['mime_type'], 'image') !== false) {
                                    $images[] = $fileData;
                                    } else {
                                    $files[] = $fileData;
                                    }
                                    }
                                    }
                                    @endphp


                                    {{-- view file popup --}}
                                    @if ($showViewImageDialog && $currentImageRequesId === $rejectedRequest->id)
                                    <div class="modal custom-modal" tabindex="-1" role="dialog" style="display: block;">
                                        <div class="modal-dialog custom-modal-dialog custom-modal-dialog-centered modal-lg"
                                            role="document">
                                            <div class="modal-content custom-modal-content">
                                                <div class="modal-header custom-modal-header">
                                                    <h5 class="modal-title view-file">Attached Images</h5>
                                                </div>
                                                <div class="modal-body custom-modal-body">
                                                    <div class="swiper-container">
                                                        <div class="swiper-wrapper">
                                                            @foreach ($images as $image)
                                                            @php
                                                            $base64File = $image['data'];
                                                            $mimeType = $image['mime_type'];
                                                            @endphp
                                                            <div class="swiper-slide">
                                                                <img src="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                                    class="img-fluid" alt="Image">
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer custom-modal-footer">
                                                    <button type="button" class="submit-btn"
                                                        wire:click.prevent="downloadImages({{ $rejectedRequest->id }})">Download</button>
                                                    <button type="button" class="cancel-btn1"
                                                        wire:click="closeViewImage">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop fade show blurred-backdrop"></div>
                                    @endif


                                    @if ($showViewFileDialog && $currentImageRequesId === $rejectedRequest->id)
                                    <div class="modal" tabindex="-1" role="dialog" style="display: block;">
                                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title viewfile">View Files</h5>
                                                </div>
                                                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                                    <ul class="list-group list-group-flush">

                                                        @foreach ($files as $file)

                                                        @php

                                                        $base64File = $file['data'];

                                                        $mimeType = $file['mime_type'];

                                                        $originalName = $file['original_name'];

                                                        @endphp

                                                        <li>

                                                            <a href="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                                download="{{ $originalName }}"
                                                                style="text-decoration: none; color: #007BFF; margin: 10px;">

                                                                {{ $originalName }} <i class="fas fa-download"
                                                                    style="margin-left:5px"></i>

                                                            </a>

                                                        </li>

                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="cancel-btn1"
                                                        wire:click="closeViewFile">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-backdrop fade show blurred-backdrop"></div>
                                    @endif


                                    @php
                                    // Initialize $images and $files as empty arrays to avoid null issues
                                    $images = $images ?? [];
                                    $files = $files ?? [];
                                    @endphp
                                    <!-- Trigger Links -->
                                    @if (count($images) > 1)
                                    <a href="#" wire:click.prevent="showViewImage({{ $rejectedRequest->id }})"
                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                        View Images
                                    </a>
                                    @elseif (count($images) == 1)
                                    <a href="#" wire:click.prevent="showViewImage({{ $rejectedRequest->id }})"
                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                        View Image
                                    </a>
                                    @endif

                                    @if (count($files) > 1)
                                    <a href="#" wire:click.prevent="showViewFile({{ $rejectedRequest->id }})"
                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;margin-left:2px;">
                                        View Files
                                    </a>
                                    @elseif (count($files) == 1)
                                    <a href="#" wire:click.prevent="showViewFile({{ $rejectedRequest->id }})"
                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                        View File
                                    </a>
                                    @endif

                                    @if (count($images) == 0 && count($files) == 0)
                                    <label for="">N/A</label>
                                    @endif


                                    @endif

                                </td>

                            </tr>





                            <tr>

                                <td>CC To</td>

                                <td class="view-td">{{$rejectedRequest->cc_to ??'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Priority</td>

                                <td class="view-td">{{$rejectedRequest->priority ??'N/A' }}</td>

                            </tr>

                            <tr>

                                <td>Select Equipment</td>

                                <td class="view-td">{{$rejectedRequest->selected_equipment ??'N/A' }}</td>

                            </tr>


                            <tr>

                                <td>Created At</td>

                                <td class="view-td">
                                    {{ \Carbon\Carbon::parse($rejectedRequest->created_at)->format('d-M-Y') ?? 'N/A' }}
                                </td>

                            </tr>



                        </tbody>

                    </table>

                </div>



                @else

                @if($rejectDetails->where('status_code', '3')->count() > 0)

                <div class="scrollable-container">

                    <div class="req-pro-card">

                        @foreach ($rejectDetails->where('status_code', '3') as $index => $request)

                        <div class="request-card">

                            <div class="req-pro-card-body">

                                <div>
                                    <p class="req-reqBy-Dep">Request ID:
                                        <span class="req-res-depart1">

                                            {{ $request->request_id }}

                                        </span>
                                    </p>

                                    <p class="req-reqBy-Dep">Requested By:
                                        <span class="req-res-depart1">
                                            {{ $request->emp->first_name }}
                                            {{ $request->emp->last_name }}
                                        </span>
                                    </p>

                                    <p title="{{ $request['category'] }}" class="req-reqBy-ser">
                                        Category <span class="req-res-depart">{{ $request->category ?? 'N/A' }}</span>
                                    </p>

                                </div>

                                <div class="p-3">
                                    <button wire:click="viewRejectDetails({{ $index }})"
                                        class="req-pro-view-details-btn" @if($loading) disabled @endif>View</button>
                                </div>


                            </div>

                        </div>

                        @endforeach

                    </div>
                </div>

                @else
                <div class="req-requestnotfound">
                    <td colspan="20">

                        <div class="req-td-norecords">
                            <img src="{{ asset('images/Closed.webp') }}" alt="No Records" class="req-img-norecords">

                            <h3 class="req-head-norecords">No requests found
                            </h3>
                        </div>
                    </td>
                </div>
                @endif
                @endif




            </div>



            <div class="col-lg-2 col-md-5 col-xs-12 " style="margin-top:10% ;">

                <div class="req-pro-overview-container">

                    <div class="card text-white shadow-sm border-0 d-flex align-items-center justify-content-center"
                        style="width: 85px; height: 85px; border-radius: 50%;  background-color: #02114f;">
                        <div class="text-center p-3">
                            <h5 class="card-title mb-2"> Total</h5>
                            <p class="card-text mb-0">

                                <span class="d-block mt-2 fs-4">
                                    <strong>{{$newRejectionCount}}</strong>
                                </span>
                            </p>
                        </div>
                    </div>



                </div>
            </div>

            @endif

            @endif



            <!-- End rejection details -->





            @if($viewEmpRequest)

            <div class="col-lg-10 col-md-7 col-xs-12">
                <div class="req-pro-head">

                    <req-pro-nav class="req-pro-req-pro-nav mb-4">

                        <ul class="tabss">

                            <li class="tab text-white" wire:click="setActiveTab('active')">

                                <i class="fas fa-check"></i> Active

                                @if($activeTab === 'active')
                                <img class="req-active-tick"
                                    src="https://png.pngtree.com/png-vector/20221215/ourmid/pngtree-green-check-mark-png-image_6525691.png"
                                    alt="">
                                @endif
                            </li>

                            <li class="tab text-white" wire:click="setActiveTab('pending')">

                                <i class="fas fa-clock"></i> Pending

                                @if($activeTab === 'pending')
                                <img class="req-active-tick"
                                    src="https://png.pngtree.com/png-vector/20221215/ourmid/pngtree-green-check-mark-png-image_6525691.png"
                                    alt="">
                                @endif

                            </li>

                            <li class="tab text-white" wire:click="setActiveTab('inprogress')">

                                <i class="fas fa-clock"></i> Inprogress

                                @if($activeTab === 'inprogress')
                                <img class="req-active-tick"
                                    src="https://png.pngtree.com/png-vector/20221215/ourmid/pngtree-green-check-mark-png-image_6525691.png"
                                    alt="">
                                @endif

                            </li>

                            <li class="tab text-white" wire:click="setActiveTab('closed')">

                                <i class="fas fa-times"></i> Closed

                                @if($activeTab === 'closed')
                                <img class="req-active-tick"
                                    src="https://png.pngtree.com/png-vector/20221215/ourmid/pngtree-green-check-mark-png-image_6525691.png"
                                    alt="">
                                @endif

                            </li>

                        </ul>

                    </req-pro-nav>



                </div>



                <div class="mt-2">

                    <div class="req-main-page">
                        <div id="active" class="req-pro-tab-content"
                            style="display: {{ $activeTab === 'active' ? 'block' : 'none' }};">

                            <div
                                class="req-pro-details mb-5 ml-4 {{ auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin')) ? '' : 'd-flex justify-content-center' }}">
                                <div>
                                    <h3 class=" headingForAllModules">Request Details</h3>
                                </div>

                                @if(auth()->check() && (auth()->user()->hasRole('admin') ||
                                auth()->user()->hasRole('super_admin')))
                                <div>
                                    <button class="btn" style="background-color: #02114f; color: white;font-size:13px;"
                                        wire:click="showRecentRequest">Recent Requests</button>
                                </div>
                                @endif
                            </div>


                            <div class="container export-main">
                                <h5 class="mb-4">Export Catalog</h5>

                                <div class="row"
                                    style="display: flex;justify-content: space-evenly;align-items: center;">
                                    <!-- Export Format -->
                                    <div class="col-md-4 mb-3">
                                        <label for="format" class="form-label">Export Format:</label>
                                        <select id="format" wire:model="exportFormat" class="form-select">
                                            <option value="" selected disabled hidden>Select Export Format</option>
                                            <option value="excel">Excel</option>
                                            <option value="csv">CSV</option>
                                            <option value="pdf">PDF</option>
                                        </select>
                                    </div>

                                    <!-- Request ID -->
                                    <div class="col-md-4 mb-3">
                                        <label for="requestId" class="form-label">Catalog ID:</label>
                                        <input id="requestId" type="text" wire:model="requestId" class="form-control"
                                            placeholder="Enter Request ID (Optional)">
                                    </div>


                                    <div class="col-md-3 mb-3 d-flex justify-content-center">
                                        <button wire:click.prevent="clearFilters"
                                            class="btn btn-secondary mt-3 me-2">Clear</button>

                                        <button wire:click.prevent="exportRequests(10)"
                                            class="btn btn-primary mt-3">Download</button>
                                    </div>
                                </div>

                            </div>

                            @if($viewingDetails && $selectedRequest)

                            @if($viewingDetails)
                            <button class="btn text-white float:right mb-3" style="background-color: #02114f;"
                                wire:click="closeDetailsBack" @if($loading) disabled @endif>
                                <i class="fas fa-arrow-left"></i> Back
                            </button>
                            @endif
                            <div class="req-pro-tablediv">

                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="m-2">View Details</h5>

                                </div>

                                <table class="table table-bordered mt-3 req-pro-table">



                                    <tbody>

                                        <tr>

                                            <td>Request ID</td>

                                            <td class="view-td">{{$selectedRequest->request_id ?? 'N/A' }}</td>

                                        </tr>


                                        <tr>

                                            <td>Requested By</td>

                                            <td class="view-td">{{$selectedRequest->emp->first_name }}
                                                {{$selectedRequest->emp->last_name }}
                                            </td>

                                        </tr>

                                        <tr>

                                            <td>Catalog Request</td>

                                            <td class="view-td">{{$selectedRequest->category ?? 'N/A' }}</td>

                                        </tr>

                                        <tr>

                                            <td>Subject</td>

                                            <td class="view-td">{{$selectedRequest->subject??'N/A' }}</td>

                                        </tr>

                                        <tr>

                                            <td>Description</td>

                                            <td class="view-td">{{$selectedRequest->description ??'N/A' }}</td>

                                        </tr>

                                        <tr>

                                            <td>Distributor</td>

                                            <td class="view-td">{{$selectedRequest->distributor_name ??'N/A' }}</td>

                                        </tr>

                                        <tr>

                                            <td>Phone</td>

                                            <td class="view-td">{{$selectedRequest->mobile ??'N/A' }}</td>

                                        </tr>

                                        <tr>

                                            <td>MailBox</td>

                                            <td class="view-td">{{$selectedRequest->mail ??'N/A' }}</td>

                                        </tr>


                                        <tr>

                                            <td>CC To</td>

                                            <td class="view-td">{{$selectedRequest->cc_to ??'N/A' }}</td>

                                        </tr>

                                        <tr>

                                            <td>Priority</td>

                                            <td class="view-td">{{$selectedRequest->priority ??'N/A' }}</td>

                                        </tr>

                                        <tr>

                                            <td>Select Equipment</td>

                                            <td class="view-td">{{$selectedRequest->selected_equipment ??'N/A' }}</td>

                                        </tr>


                                        <tr>
                                            <td>Assign to <span class="text-danger">*</span></td>
                                            <td class="view-td">
                                                <select class="req-selected-status" wire:model="selectedAssigne"
                                                    wire:change="handleSelectedAssigneChange">
                                                    <option value="" disabled hidden>Select Assignee</option>
                                                    @foreach($itData as $itName)
                                                    <option
                                                        value="{{ $itName->empIt->first_name }} {{ $itName->empIt->last_name }} {{ $itName->empIt->emp_id }}">
                                                        {{ ucwords(strtolower($itName->empIt->first_name)) }}
                                                        {{ ucwords(strtolower($itName->empIt->last_name)) }}
                                                        {{ ucwords(strtolower($itName->empIt->emp_id)) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('selectedAssigne') <span
                                                    class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </td>

                                        </tr>

                                        <tr>
                                            <td>Status <span class="text-danger">*</span></td>

                                            <td class="view-td">
                                                <select wire:model="selectedStatus" class="req-selected-status"
                                                    wire:change="handleSelectedStatusChange">
                                                    <option value="" disabled hidden>Select Status </option>
                                                    <option value="5">Pending</option>
                                                    <option value="16">Inprogress</option>
                                                    <option value="11">Completed</option>
                                                    <option value="15">Cancel</option>
                                                    <!-- Add other status options as needed -->
                                                </select>
                                                @error('selectedStatus') <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </td>
                                        </tr>

                                        @if($showStatusModal)
                                        <div class="modal fade show d-block" tabindex="-1" role="dialog"
                                            style="background-color: rgba(0, 0, 0, 0.5);">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            Reason for {{ $modalPurpose }}
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            wire:click="closeStatusModal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body flex-column">
                                                        <label for="reason" class="form-label">Reason <span
                                                                class="text-danger">*</span></label>
                                                        <textarea id="reason" class="form-control"
                                                            wire:model.defer="pendingReason" rows="3"></textarea>
                                                        @error('pendingReason')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            wire:click="closeStatusModal">Close</button>
                                                        <button type="button" class="btn btn-primary"
                                                            wire:click="submitStatusReason({{ $selectedRequest->id }})">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif



                                        <tr>
                                            <td>Comments</td>
                                            <td>

                                                <div>
                                                    <div class="row req-comments">
                                                        <div class="col-10">
                                                            <textarea wire:model.lazy="comments"
                                                                class="form-control"></textarea>
                                                        </div>
                                                        <div class="col-2 d-flex align-items-center">
                                                            <button class="btn text-white"
                                                                style="background-color: #02114f;"
                                                                wire:click="postComment('{{ $selectedRequest->id }}')"
                                                                @if($loading) disabled @endif>Post</button>
                                                        </div>
                                                    </div>


                                                </div>
                                            </td>
                                        </tr>




                                        <tr>
                                            <td class="fs-6 fs-md-3 fs-lg-2">Attachments</td>

                                            <td>
                                                @php
                                                $empImages = [];
                                                $empFiles = [];

                                                // Check if $selectedRequest->file_paths is a string, array, or null
                                                $fileDataArray = null;

                                                if (isset($selectedRequest->file_paths) &&
                                                is_string($selectedRequest->file_paths))
                                                {
                                                $fileDataArray = json_decode($selectedRequest->file_paths, true);
                                                } elseif (isset($selectedRequest->file_paths) &&
                                                is_array($selectedRequest->file_paths)) {
                                                $fileDataArray = $selectedRequest->file_paths;
                                                }

                                                // Ensure $fileDataArray is a valid array before looping
                                                if (is_array($fileDataArray)) {
                                                // Separate empImages and files
                                                foreach ($fileDataArray as $fileData) {
                                                if (isset($fileData['mime_type'])) {
                                                if (strpos($fileData['mime_type'], 'image/') === 0) {
                                                $empImages[] = $fileData;
                                                } else {
                                                $empFiles[] = $fileData;
                                                }
                                                }
                                                }
                                                }
                                                @endphp




                                                @php
                                                // Initialize $images and $files as empty arrays to avoid null issues
                                                $empImages = $empImages ?? [];
                                                $empFiles = $empFiles ?? [];
                                                @endphp
                                                <!-- Trigger Links -->
                                                @if (count($empImages) > 1)
                                                <a href="#"
                                                    wire:click.prevent="showViewEmpImage({{ $selectedRequest->id }})"
                                                    style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                    View Images
                                                </a>
                                                @elseif (count($empImages) == 1)
                                                <a href="#"
                                                    wire:click.prevent="showViewEmpImage({{ $selectedRequest->id }})"
                                                    style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                    View Image
                                                </a>
                                                @endif

                                                @if (count($empFiles) > 1)
                                                <a href="#"
                                                    wire:click.prevent="showViewEmpFile({{ $selectedRequest->id }})"
                                                    style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                    View Files
                                                </a>
                                                @elseif (count($empFiles) == 1)
                                                <a href="#"
                                                    wire:click.prevent="showViewEmpFile({{ $selectedRequest->id }})"
                                                    style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                    View File
                                                </a>
                                                @endif

                                                @if (count($empImages) == 0 && count($empFiles) == 0)
                                                <label for="">N/A</label>
                                                @endif


                                                {{-- view file popup --}}
                                                @if ($showViewEmpImageDialog && $currentImageRequesId ===
                                                $selectedRequest->id)
                                                <div class="modal custom-modal" tabindex="-1" role="dialog"
                                                    style="display: block;">
                                                    <div class="modal-dialog custom-modal-dialog custom-modal-dialog-centered modal-lg"
                                                        role="document">
                                                        <div class="modal-content custom-modal-content">
                                                            <div class="modal-header custom-modal-header">
                                                                <h5 class="modal-title view-file">Attached Images</h5>
                                                            </div>
                                                            <div class="modal-body custom-modal-body">

                                                                <div class="swiper-container">

                                                                    <div class="swiper-wrapper">
                                                                        @foreach ($empImages as $eImage)
                                                                        @php
                                                                        $base64FileE = $eImage['data'];
                                                                        $mimeTypeE = $eImage['mime_type'];
                                                                        @endphp
                                                                        <div class="swiper-slide">
                                                                            <img src="data:{{ $mimeTypeE }};base64,{{ $base64FileE }}"
                                                                                class="img-fluid" alt="Image">
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer custom-modal-footer">
                                                                <button type="button" class="submit-btn"
                                                                    wire:click.prevent="downloadImages({{ $selectedRequest->id }})">Download</button>
                                                                <button type="button" class="cancel-btn1"
                                                                    wire:click="closeViewEmpImage">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-backdrop fade show blurred-backdrop"></div>
                                                @endif


                                                @if ($showViewEmpFileDialog && $currentImageRequesId ===
                                                $selectedRequest->id)
                                                <div class="modal" tabindex="-1" role="dialog" style="display: block;">
                                                    <div class="modal-dialog modal-dialog-centered modal-md"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title viewfile">View Files</h5>
                                                            </div>
                                                            <div class="modal-body"
                                                                style="max-height: 400px; overflow-y: auto;">
                                                                <ul class="list-group list-group-flush">

                                                                    @foreach ($empFiles as $fileE)

                                                                    @php

                                                                    $base64FileE = $fileE['data'];

                                                                    $mimeTypeE = $fileE['mime_type'];

                                                                    $originalNameE = $fileE['original_name'];

                                                                    @endphp

                                                                    <li>

                                                                        <a href="data:{{ $mimeTypeE }};base64,{{ $base64FileE }}"
                                                                            download="{{ $originalNameE }}"
                                                                            style="text-decoration: none; color: #007BFF; margin: 10px;">

                                                                            {{ $originalNameE}} <i
                                                                                class="fas fa-download"
                                                                                style="margin-left:5px"></i>

                                                                        </a>

                                                                    </li>

                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="cancel-btn1"
                                                                    wire:click="closeViewEmpFile">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-backdrop fade show blurred-backdrop"></div>
                                                @endif

                                            </td>

                                        </tr>



                                        <tr>
                                            <td class="fs-6 fs-md-3 fs-lg-2">File Upload</td>


                                            <td>
                                                <!-- Attachments -->
                                                <div class="row mb-3">
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <p class="text-primary">
                                                                    <label for="file"
                                                                        class="vendor-asset-label">Attachments</label>

                                                                </p>
                                                            </div>
                                                            <div class="col-8">
                                                                <!-- File input hidden -->
                                                                <input id="fileInput-{{ $selectedRequest->id }}"
                                                                    type="file"
                                                                    wire:model="cat_file_paths.{{ $selectedRequest->id }}"
                                                                    class="form-control-file" multiple
                                                                    style="font-size: 12px; display: none;" />

                                                                <!-- Label triggers file input -->
                                                                <div class="req-attachmentsIcon d-flex"
                                                                    style="align-items: baseline; gap: 5px;">
                                                                    <button class="btn btn-outline-secondary"
                                                                        type="button"
                                                                        for="fileInput-{{ $selectedRequest->id }}"
                                                                        onclick="document.getElementById('fileInput-{{ $selectedRequest->id }}').click();">
                                                                        <i class="fa-solid fa-paperclip"></i>
                                                                    </button>
                                                                </div>


                                                                <div wire:loading
                                                                    wire:target="cat_file_paths.{{ $selectedRequest->id }}"
                                                                    class="mt-2">
                                                                    <i class="fas fa-spinner fa-spin"></i>
                                                                    Uploading...
                                                                </div>

                                                                @error('cat_file_paths.' . $selectedRequest->id . '.*')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </td>



                                            <!-- File Preview Modal -->
                                            @if($showFilePreviewModal)

                                            <div class="modal fade show d-block" tabindex="-1" role="dialog"
                                                style="background-color: rgba(0, 0, 0, 0.5);">
                                                <div class="modal-dialog modal-dialog-centered  modal-lg">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="filePreviewModalLabel">File
                                                                Preview</h5>
                                                            <button type="button" class="btn-close"
                                                                wire:click="hideFilePreviewModal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <h6>Selected Files</h6>
                                                                <div class="d-flex flex-wrap gap-3">
                                                                    <!-- Loop through files and display previews -->
                                                                    @foreach ($previews as $index => $preview)
                                                                    <div class="file-preview-container text-center"
                                                                        style="padding: 5px; border: 1px solid black; width: 120px; height: 120px; border-radius: 5px; position: relative; overflow: hidden;">
                                                                        @if ($preview['type'] == 'image')
                                                                        <img src="{{ $preview['url'] }}" alt="Preview"
                                                                            class="img-thumbnail"
                                                                            style="width: 75px; height: 75px;" />
                                                                        <span class="mt-1 uploaded-file-name"
                                                                            style="display: block; width: 100%;">{{ $preview['name'] }}</span>
                                                                        @else
                                                                        <div
                                                                            class="d-flex flex-column align-items-center">
                                                                            <i class="fas fa-file fa-3x"
                                                                                style="width: 75px; height: 75px;"></i>
                                                                            <span class="mt-1 uploaded-file-name"
                                                                                style="display: block; width: 100%;">{{ $preview['name'] }}</span>
                                                                        </div>
                                                                        @endif

                                                                        <!-- Delete icon -->
                                                                        <button type="button"
                                                                            class="delete-icon btn btn-danger"
                                                                            wire:click="removeFile({{ $index }})"
                                                                            style="position: absolute; top: 5%; right: 5%; z-index: 5; font-size: 12px;">
                                                                            <i class="fas fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                wire:click="hideFilePreviewModal">Close</button>
                                                            <button type="button" class="btn btn-primary"
                                                                wire:click="uploadFiles({{ $selectedRecordId }})">Upload
                                                                Files</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            @endif


                                        </tr>


                                        <tr>
                                            <td class="fs-6 fs-md-3 fs-lg-2">IT Uploaded Files</td>


                                            <td>
                                                @php
                                                $images = [];
                                                $files = [];


                                                // Check if $selectedRequest->cat_file_paths is a string, array, or null
                                                $fileDataArray = null;

                                                if (isset($selectedRequest->cat_file_paths) &&
                                                is_string($selectedRequest->cat_file_paths))
                                                {
                                                $fileDataArray = json_decode($selectedRequest->cat_file_paths, true);
                                                } elseif (isset($selectedRequest->cat_file_paths) &&
                                                is_array($selectedRequest->cat_file_paths)) {
                                                $fileDataArray = $selectedRequest->cat_file_paths;
                                                }

                                                // Ensure $fileDataArray is a valid array before looping
                                                if (is_array($fileDataArray)) {
                                                // Separate images and files
                                                foreach ($fileDataArray as $fileData) {
                                                if (isset($fileData['mime_type'])) {
                                                if (strpos($fileData['mime_type'], 'image/') === 0) {
                                                $images[] = $fileData;
                                                } else {
                                                $files[] = $fileData;
                                                }
                                                }
                                                }
                                                }
                                                @endphp




                                                @php
                                                // Initialize $images and $files as empty arrays to avoid null issues
                                                $images = $images ?? [];
                                                $files = $files ?? [];
                                                @endphp
                                                <!-- Trigger Links -->
                                                @if (count($images) > 1)
                                                <a href="#"
                                                    wire:click.prevent="showViewImage({{ $selectedRequest->id }})"
                                                    style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                    View Images
                                                </a>
                                                @elseif (count($images) == 1)
                                                <a href="#"
                                                    wire:click.prevent="showViewImage({{ $selectedRequest->id }})"
                                                    style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                    View Image
                                                </a>
                                                @endif

                                                @if (count($files) > 1)
                                                <a href="#"
                                                    wire:click.prevent="showViewFile({{ $selectedRequest->id }})"
                                                    style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;margin-left:2px;">
                                                    View Files
                                                </a>
                                                @elseif (count($files) == 1)
                                                <a href="#"
                                                    wire:click.prevent="showViewFile({{ $selectedRequest->id }})"
                                                    style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                    View File
                                                </a>
                                                @endif

                                                @if (count($images) == 0 && count($files) == 0)
                                                <label for="">N/A</label>
                                                @endif

                                                {{-- view file popup --}}
                                                @if ($showViewImageDialog && $currentImageRequesId ===
                                                $selectedRequest->id)
                                                <div class="modal custom-modal" tabindex="-1" role="dialog"
                                                    style="display: block;">
                                                    <div class="modal-dialog custom-modal-dialog custom-modal-dialog-centered modal-lg"
                                                        role="document">
                                                        <div class="modal-content custom-modal-content">
                                                            <div class="modal-header custom-modal-header">
                                                                <h5 class="modal-title view-file">Attached Images</h5>
                                                            </div>
                                                            <div class="modal-body custom-modal-body">
                                                                <div class="swiper-container">
                                                                    <div class="swiper-wrapper">
                                                                        @foreach ($images as $image)
                                                                        @php
                                                                        $base64File = $image['data'];
                                                                        $mimeType = $image['mime_type'];
                                                                        @endphp
                                                                        <div class="swiper-slide">
                                                                            <img src="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                                                class="img-fluid" alt="Image">
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer custom-modal-footer">
                                                                <button type="button" class="submit-btn"
                                                                    wire:click.prevent="downloadITImages({{ $selectedRequest->id }})">Download</button>
                                                                <button type="button" class="cancel-btn1"
                                                                    wire:click="closeViewImage">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-backdrop fade show blurred-backdrop"></div>
                                                @endif


                                                @if ($showViewFileDialog && $currentImageRequesId ===
                                                $selectedRequest->id)
                                                <div class="modal" tabindex="-1" role="dialog" style="display: block;">
                                                    <div class="modal-dialog modal-dialog-centered modal-md"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title viewfile">View Files</h5>
                                                            </div>
                                                            <div class="modal-body"
                                                                style="max-height: 400px; overflow-y: auto;">
                                                                <ul class="list-group list-group-flush">

                                                                    @foreach ($files as $file)

                                                                    @php

                                                                    $base64File = $file['data'];

                                                                    $mimeType = $file['mime_type'];

                                                                    $originalName = $file['original_name'];

                                                                    @endphp

                                                                    <li>

                                                                        <a href="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                                            download="{{ $originalName }}"
                                                                            style="text-decoration: none; color: #007BFF; margin: 10px;">

                                                                            {{ $originalName }} <i
                                                                                class="fas fa-download"
                                                                                style="margin-left:5px"></i>

                                                                        </a>

                                                                    </li>

                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="cancel-btn1"
                                                                    wire:click="closeViewFile">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-backdrop fade show blurred-backdrop"></div>
                                                @endif

                                            </td>


                                        </tr>

                                        <tr>

                                            <td>Created At</td>

                                            <td class="view-td">
                                                {{ \Carbon\Carbon::parse($selectedRequest->created_at)->format('d-M-Y') ?? 'N/A' }}
                                            </td>

                                        </tr>



                                    </tbody>

                                </table>

                                <div class="d-flex justify-content-center align-items-center">
                                    <button class="btn text-white mb-3" style="background-color: #02114f;"
                                        wire:click="activeCatalogSubmit('{{ $selectedRequest->id }}')" @if($loading)
                                        disabled @endif>Submit</button>
                                </div>


                            </div>



                            @else

                            @if($forIT->where('status_code', '10')->count() > 0)
                            <div class="scrollable-container">
                                @if($checkboxModal)
                                <div class="d-flex justify-content-between mb-3">
                                    <!-- Bulk Assign Dropdown -->
                                    <div class="col-md-4">
                                        <select class="req-selected-status" wire:model="bulkAssignee"
                                            wire:change="handleSelectedAssigneChange">
                                            <option value="" disabled hidden>Select Assignee</option>
                                            @foreach($itData as $itName)
                                            <option
                                                value="{{ $itName->empIt->first_name }} {{ $itName->empIt->last_name }} {{ $itName->empIt->emp_id }}">
                                                {{ ucwords(strtolower($itName->empIt->first_name)) }}
                                                {{ ucwords(strtolower($itName->empIt->last_name)) }}
                                                ({{ ucwords(strtolower($itName->empIt->emp_id)) }})
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Bulk Status Dropdown -->
                                    <div class="col-md-4">
                                        <select wire:model="selectedStatus" class="req-selected-status"
                                            wire:change="handleSelectedStatusChange">
                                            <option value="" disabled hidden>Select Status</option>
                                            <option value="5">Pending</option>
                                            <option value="16">Inprogress</option>
                                            <option value="11">Completed</option>
                                            <option value="15">Cancel</option>
                                        </select>
                                        @error('selectedStatus')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Apply Button -->
                                    <button class="btn text-white" style="background-color: #02114f;"
                                        wire:click="applyBulkActions">
                                        Apply
                                    </button>
                                </div>

                                @endif
                                <div class="req-pro-card">

                                    @foreach ($forIT->where('status_code', '10') as $index => $request)

                                    <div class="request-card">

                                        <div
                                            class="req-pro-card-body d-flex align-items-center justify-content-between">

                                            <!-- Checkbox for Selection -->
                                            <div>
                                                <input type="checkbox" wire:model="selectedRequests"
                                                    wire:click="checkboxMultiSelection" value="{{ $request->id }}"
                                                    wire:key=reqstID-{{ $request->id}}>
                                            </div>

                                            <div>

                                                <p class="req-reqBy-Dep">Request ID:
                                                    <span class="req-res-depart1">
                                                        {{ $request->request_id }}

                                                    </span>
                                                </p>

                                                <p class="req-reqBy-Dep">Requested By:
                                                    <span class="req-res-depart1">
                                                        {{ $request->emp->first_name }}
                                                        {{ $request->emp->last_name }}
                                                    </span>
                                                </p>

                                                <p title="{{ $request['category'] }}" class="req-reqBy-ser">
                                                    Category <span
                                                        class="req-res-depart">{{ $request->category ?? 'N/A' }}</span>
                                                </p>

                                            </div>

                                            <button wire:click="viewDetails({{ $index }})"
                                                class="req-pro-view-details-btn" @if($loading) disabled
                                                @endif>View</button>

                                        </div>

                                    </div>

                                    @endforeach

                                </div>

                                <!-- Modal for Reason -->
                                @if($showStatusModal)
                                <div class="modal fade show d-block" tabindex="-1" role="dialog"
                                    style="background-color: rgba(0, 0, 0, 0.5);">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Reason for {{ $modalPurpose }}</h5>
                                                <button type="button" class="btn-close" wire:click="closeStatusModal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="d-flex justify-content-center flex-column m-3">
                                                <label for="reason" class="form-label">Reason <span
                                                        class="text-danger">*</span></label>
                                                <textarea id="reason" class="form-control"
                                                    wire:model.defer="pendingReason" rows="3"></textarea>
                                                @error('pendingReason')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    wire:click="closeStatusModal">Close</button>
                                                <button type="button" class="btn btn-primary"
                                                    wire:click="bulkSubmitStatusReason">
                                                    Submit
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            @else
                            <div class="req-requestnotfound">
                                <td colspan="20">

                                    <div class="req-td-norecords">
                                        <img src="{{ asset('images/Closed.webp') }}" alt="No Records"
                                            class="req-img-norecords">

                                        <h3 class="req-head-norecords">No requests found
                                        </h3>
                                    </div>
                                </td>
                            </div>
                            @endif
                            @endif

                        </div>


                        <div id="pending" class="req-pro-tab-content"
                            style="display: {{ $activeTab === 'pending' ? 'block' : 'none' }};">

                            <div>
                                <h3 class="req-inprogress-heading">
                                    Pending Requests</h3>
                            </div>

                            <div class="row ">

                                <div class="col-12 mt-2">

                                    <div class="container export-main">
                                        <h5 class="mb-4">Export Catalog</h5>

                                        <div class="row"
                                            style="display: flex;justify-content: space-evenly;align-items: center;">
                                            <!-- Export Format -->
                                            <div class="col-md-4 mb-3">
                                                <label for="format" class="form-label">Export Format:</label>
                                                <select id="format" wire:model="exportFormat" class="form-select">
                                                    <option value="" selected disabled hidden>Select Export Format
                                                    </option>
                                                    <option value="excel">Excel</option>
                                                    <option value="csv">CSV</option>
                                                    <option value="pdf">PDF</option>
                                                </select>
                                            </div>

                                            <!-- Request ID -->
                                            <div class="col-md-4 mb-3">
                                                <label for="requestId" class="form-label">Catalog ID:</label>
                                                <input id="requestId" type="text" wire:model="requestId"
                                                    class="form-control" placeholder="Enter Request ID (Optional)">
                                            </div>

                                            <!-- Assignee -->
                                            <div class="col-md-4 mb-3">
                                                <label for="assignee" class="form-label">Select Assignee:</label>
                                                <select class="form-select" wire:model="assignee">
                                                    <!-- Default option with empty value (shown when no selection is made) -->
                                                    <option value="" disabled hidden>Select Assignee (Optional)
                                                    </option>

                                                    <!-- Loop through IT data -->
                                                    @foreach($itData as $itName)
                                                    <option
                                                        value="{{ ucwords(strtolower($itName->empIt->first_name)) }} {{ ucwords(strtolower($itName->empIt->last_name)) }} {{ $itName->empIt->emp_id }}">
                                                        {{ ucwords(strtolower($itName->empIt->first_name)) }}
                                                        {{ ucwords(strtolower($itName->empIt->last_name)) }}
                                                        ({{ $itName->empIt->emp_id }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3 d-flex justify-content-center">
                                                <button wire:click.prevent="clearFilters"
                                                    class="btn btn-secondary mt-3 me-2">Clear</button>

                                                <button wire:click.prevent="exportRequests(5)"
                                                    class="btn btn-primary mt-3">Download</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        @if($checkboxPendingModal)

                                        <div class="d-flex justify-content-between mb-3">

                                            <!-- Bulk Status Dropdown -->
                                            <div class="col-md-4">
                                                <label for="" class="" style="white-space: nowrap;"> Please select the
                                                    status for multi selection</label>
                                                <select wire:model="selectedStatus" class="req-selected-status"
                                                    wire:click="bulkSelectedInprogress">
                                                    <option value="" disabled hidden>Select Status</option>
                                                    <option value="16">Inprogress</option>
                                                </select>
                                                @error('selectedStatus')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endif

                                        @if($showBulkInprogressModal)
                                        <div class="modal fade show d-block" tabindex="-1" role="dialog"
                                            style="background-color: rgba(0, 0, 0, 0.5);">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            Reason for Inprogress
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            wire:click="closeBulkInprogressModal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body flex-column">
                                                        <label for="reason" class="form-label">Reason <span
                                                                class="text-danger">*</span></label>
                                                        <textarea id="reason" class="form-control"
                                                            wire:model.defer="pendingReason" rows="3"></textarea>
                                                        @error('pendingReason')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            wire:click="closeBulkInprogressModal">Close</button>
                                                        <button type="button" class="btn btn-primary"
                                                            wire:click="bulkSubmitReason">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>


                                    <div class="col-lg-3 col-md-3 col-5 mb-5">
                                        <div>
                                            <label for="assignee" class="form-label">Select Assignee</label>
                                            <select id="assignee" class="form-control"
                                                wire:model="statusPenFilterAssigne"
                                                wire:change="loadPendingRecordsByAssigne">
                                                <option value="" disabled selected>-- Select Assignee --</option>
                                                <option value="">All</option>
                                                @foreach ($itAssigneMemebers as $member)
                                                <option
                                                    value="{{ $member['first_name'] }} {{ $member['last_name'] }} {{ $member['emp_id'] }}">
                                                    {{ $member['first_name'] }} {{ $member['last_name'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="table-responsive req-table-res">

                                        <table class="custom-table">
                                            @if($catalogPendingDetails->count() > 0)
                                            <thead>

                                                <tr>

                                                    <th class="req-table-head">Select
                                                    </th>
                                                    <th scope="col" class="req-table-head">Employee ID
                                                        <span wire:click.debounce.500ms="toggleSortOrder('emp_id')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'emp_id')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Requested By

                                                    </th>

                                                    <th class="req-table-head">Catalog Request
                                                        <span wire:click.debounce.500ms="toggleSortOrder('category')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'category')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Subject
                                                        <span wire:click.debounce.500ms="toggleSortOrder('subject')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'subject')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Description</th>

                                                    <th class="req-table-head">Distributor
                                                        <span
                                                            wire:click.debounce.500ms="toggleSortOrder('distributor_name')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'distributor_name')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Phone
                                                        <span wire:click.debounce.500ms="toggleSortOrder('mobile')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'mobile')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">MailBox
                                                        <span wire:click.debounce.500ms="toggleSortOrder('mail')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'mail')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Attach Files</th>



                                                    <th class="req-table-head">Priority
                                                        <span wire:click.debounce.500ms="toggleSortOrder('priority')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'priority')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Select Equipment
                                                        <span
                                                            wire:click.debounce.500ms="toggleSortOrder('selected_equipment')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'selected_equipment')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Status

                                                    </th>

                                                    <th class="req-table-head">Assigned to
                                                        <span wire:click.debounce.500ms="toggleSortOrder('assign_to')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'assign_to')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>



                                                    <th class="req-table-head">Response Time</th>
                                                    <th class="req-table-head">Change Status</th>
                                                    <th class="req-table-head"> Files Upload</th>
                                                    <th class="req-table-head">IT Uploaded Files</th>
                                                    <th class="req-table-head">Created At</th>
                                                    <th class="req-table-head">Logs</th>

                                                </tr>

                                            </thead>
                                            @endif
                                            <tbody>

                                                @if($catalogPendingDetails->count() > 0)
                                                @foreach ($catalogPendingDetails as $index =>$record)
                                                @php
                                                $ccToArray = explode(',', $record->cc_to);
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" wire:model="selectedRequests"
                                                            wire:click='checkboxPendingMultiSelection'
                                                            value="{{ $record->id }}" wire:key=rcdID-{{ $record->id}}>
                                                    </td>

                                                    <td scope="row">{{ $record->emp_id }}</td>

                                                    <td>{{ $record->emp->first_name }} {{ $record->emp->last_name }}
                                                        <br>
                                                        <strong class="req-res-emp_id">({{$record->emp_id}})
                                                    </td>

                                                    <td>{{ $record->category ?? 'N/A'}}</td>

                                                    <td>{{ $record->subject ?? 'N/A' }}</td>

                                                    <td>{{ $record->description?? 'N/A' }}</td>

                                                    <td>{{ $record->distributor_name?? 'N/A' }}</td>

                                                    <td>{{ $record->mobile?? 'N/A' }}</td>

                                                    <td>{{ $record->mail ??'N/A' }}</td>


                                                    <!-- emp file paths -->

                                                    <td>
                                                        @php
                                                        $empImages = [];
                                                        $empFiles = [];

                                                        // Check if $record->file_paths is a string, array, or null
                                                        $fileDataArray = null;

                                                        if (isset($record->file_paths) &&
                                                        is_string($record->file_paths))
                                                        {
                                                        $fileDataArray = json_decode($record->file_paths, true);
                                                        } elseif (isset($record->file_paths) &&
                                                        is_array($record->file_paths)) {
                                                        $fileDataArray = $record->file_paths;
                                                        }

                                                        // Ensure $fileDataArray is a valid array before looping
                                                        if (is_array($fileDataArray)) {
                                                        // Separate empImages and files
                                                        foreach ($fileDataArray as $fileData) {
                                                        if (isset($fileData['mime_type'])) {
                                                        if (strpos($fileData['mime_type'], 'image/') === 0) {
                                                        $empImages[] = $fileData;
                                                        } else {
                                                        $empFiles[] = $fileData;
                                                        }
                                                        }
                                                        }
                                                        }
                                                        @endphp




                                                        @php

                                                        $empImages = $empImages ?? [];
                                                        $empFiles = $empFiles ?? [];
                                                        @endphp
                                                        <!-- Trigger Links -->
                                                        @if (count($empImages) > 1)
                                                        <a href="#"
                                                            wire:click.prevent="showViewEmpImage({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View Images
                                                        </a>
                                                        @elseif (count($empImages) == 1)
                                                        <a href="#"
                                                            wire:click.prevent="showViewEmpImage({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View Image
                                                        </a>
                                                        @endif

                                                        @if (count($empFiles) > 1)
                                                        <a href="#"
                                                            wire:click.prevent="showViewEmpFile({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View Files
                                                        </a>
                                                        @elseif (count($empFiles) == 1)
                                                        <a href="#"
                                                            wire:click.prevent="showViewEmpFile({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View File
                                                        </a>
                                                        @endif

                                                        @if (count($empImages) == 0 && count($empFiles) == 0)
                                                        <label for="">N/A</label>
                                                        @endif


                                                        {{-- view file popup --}}
                                                        @if ($showViewEmpImageDialog && $currentImageRequesId ===
                                                        $record->id)
                                                        <div class="modal custom-modal" tabindex="-1" role="dialog"
                                                            style="display: block;">
                                                            <div class="modal-dialog custom-modal-dialog custom-modal-dialog-centered modal-lg"
                                                                role="document">
                                                                <div class="modal-content custom-modal-content">
                                                                    <div class="modal-header custom-modal-header">
                                                                        <h5 class="modal-title view-file">Attached
                                                                            Images</h5>
                                                                    </div>
                                                                    <div class="modal-body custom-modal-body">

                                                                        <div class="swiper-container">

                                                                            <div class="swiper-wrapper">
                                                                                @foreach ($empImages as $eImage)
                                                                                @php
                                                                                $base64FileE = $eImage['data'];
                                                                                $mimeTypeE = $eImage['mime_type'];
                                                                                @endphp
                                                                                <div class="swiper-slide">
                                                                                    <img src="data:{{ $mimeTypeE }};base64,{{ $base64FileE }}"
                                                                                        class="img-fluid" alt="Image">
                                                                                </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer custom-modal-footer">
                                                                        <button type="button" class="submit-btn"
                                                                            wire:click.prevent="downloadImages({{ $record->id }})">Download</button>
                                                                        <button type="button" class="cancel-btn1"
                                                                            wire:click="closeViewEmpImage">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-backdrop fade show blurred-backdrop"></div>
                                                        @endif


                                                        @if ($showViewEmpFileDialog && $currentImageRequesId ===
                                                        $record->id)
                                                        <div class="modal" tabindex="-1" role="dialog"
                                                            style="display: block;">
                                                            <div class="modal-dialog modal-dialog-centered modal-md"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title viewfile">View Files</h5>
                                                                    </div>
                                                                    <div class="modal-body"
                                                                        style="max-height: 400px; overflow-y: auto;">
                                                                        <ul class="list-group list-group-flush">

                                                                            @foreach ($empFiles as $fileE)

                                                                            @php

                                                                            $base64FileE = $fileE['data'];

                                                                            $mimeTypeE = $fileE['mime_type'];

                                                                            $originalNameE = $fileE['original_name'];

                                                                            @endphp

                                                                            <li>

                                                                                <a href="data:{{ $mimeTypeE }};base64,{{ $base64FileE }}"
                                                                                    download="{{ $originalNameE }}"
                                                                                    style="text-decoration: none; color: #007BFF; margin: 10px;">

                                                                                    {{ $originalNameE}} <i
                                                                                        class="fas fa-download"
                                                                                        style="margin-left:5px"></i>

                                                                                </a>

                                                                            </li>

                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="cancel-btn1"
                                                                            wire:click="closeViewEmpFile">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-backdrop fade show blurred-backdrop"></div>
                                                        @endif

                                                    </td>



                                                    <td>{{ $record->priority?? 'N/A' }}</td>

                                                    <td>{{ $record->selected_equipment?? 'N/A' }}</td>

                                                    <td>
                                                        <div class="req-status">
                                                            @if($record->status_code == 5) Pending

                                                            @endif
                                                        </div>
                                                    </td>

                                                    <td>{{ $record['assign_to'] }}</td>

                                                    <td>
                                                        <div class="req-timebar">
                                                            @if($record->created_at)
                                                            @php
                                                            // Parse the start and end dates
                                                            $startDate = \Carbon\Carbon::parse($record->created_at);

                                                            // If 'req_end_date' exists, use it; otherwise, use current

                                                            $endDate = $record->req_end_date ?
                                                            \Carbon\Carbon::parse($record->req_end_date) :
                                                            \Carbon\Carbon::now();

                                                            // Calculate total elapsed time in minutes
                                                            $totalElapsedMinutes = $startDate->diffInMinutes($endDate);

                                                            // If there is additional service progress time, add it
                                                            if (isset($record->total_ser_progress_time)) {
                                                            $totalElapsedMinutes += $record->total_ser_progress_time;
                                                            }

                                                            // Calculate years, days, hours, and minutes from the

                                                            $years = floor($totalElapsedMinutes / 525600);

                                                            $remainingMinutes = $totalElapsedMinutes % 525600;

                                                            $days = floor($remainingMinutes / 1440);
                                                            $remainingMinutes %= 1440;

                                                            $hours = floor($remainingMinutes / 60);
                                                            $minutes = $remainingMinutes % 60;

                                                            $maxTime = 30 * 1440; // 30 days * 1440 minutes
                                                            $percentage = min(($totalElapsedMinutes / $maxTime) * 100,
                                                            100);
                                                            @endphp

                                                            <!-- Display elapsed time with conditions -->
                                                            @if ($totalElapsedMinutes < 60) <span>{{ $minutes }}
                                                                minute{{ $minutes != 1 ? 's' : '' }}</span>
                                                                @elseif ($totalElapsedMinutes < 1440) <span>{{ $hours }}
                                                                    hour{{ $hours != 1 ? 's' : '' }} {{ $minutes }}
                                                                    minute{{ $minutes != 1 ? 's' : '' }}</span>
                                                                    @elseif ($totalElapsedMinutes < 525600) <span>
                                                                        {{ $days }}
                                                                        day{{ $days != 1 ? 's' : '' }} {{ $hours }}
                                                                        hour{{ $hours != 1 ? 's' : '' }} {{ $minutes }}
                                                                        minute{{ $minutes != 1 ? 's' : '' }}</span>
                                                                        @else
                                                                        <span>{{ $years }}
                                                                            year{{ $years != 1 ? 's' : '' }}
                                                                            {{ $days }} day{{ $days != 1 ? 's' : '' }}
                                                                            {{ $hours }}
                                                                            hour{{ $hours != 1 ? 's' : '' }}
                                                                            {{ $minutes }}
                                                                            minute{{ $minutes != 1 ? 's' : '' }}</span>
                                                                        @endif

                                                                        @else
                                                                        <span>No time tracked</span>
                                                                        @endif
                                                        </div>
                                                    </td>


                                                    <td>
                                                        <button wire:click="selectedInprogress('{{ $record->id }}')"
                                                            wire:key="inprogress-desks-{{ $record->id }}"
                                                            class="btn btn-white border-black text-black" @if($loading)
                                                            disabled @endif>Inprogress</button>
                                                    </td>


                                                    @if($showInprogressModal)
                                                    <div class="modal fade show d-block" tabindex="-1" role="dialog"
                                                        style="background-color: rgba(0, 0, 0, 0.5);">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        Reason for Inprogress
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        wire:click="closeInprogressModal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body flex-column">
                                                                    <label for="reason" class="form-label">Reason <span
                                                                            class="text-danger">*</span></label>
                                                                    <textarea id="reason" class="form-control"
                                                                        wire:model.defer="pendingReason"
                                                                        rows="3"></textarea>
                                                                    @error('pendingReason')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        wire:click="closeInprogressModal">Close</button>
                                                                    <button type="button" class="btn btn-primary"
                                                                        wire:click="inprogressForDesks({{  $selectedTaskId}})">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif



                                                    <td>
                                                        <!-- Attachments -->
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <p class="text-primary">
                                                                            <label for="file"
                                                                                class="vendor-asset-label">Attachments</label>

                                                                        </p>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <!-- File input hidden -->
                                                                        <input id="fileInput-{{ $record->id }}"
                                                                            type="file"
                                                                            wire:model="cat_file_paths.{{ $record->id }}"
                                                                            class="form-control-file" multiple
                                                                            style="font-size: 12px; display: none;" />

                                                                        <!-- Label triggers file input -->
                                                                        <div class="d-flex"
                                                                            style="align-items: baseline; gap: 5px;">
                                                                            <button class="btn btn-outline-secondary"
                                                                                type="button"
                                                                                for="fileInput-{{ $record->id }}"
                                                                                onclick="document.getElementById('fileInput-{{ $record->id }}').click();">
                                                                                <i class="fa-solid fa-paperclip"></i>
                                                                            </button>
                                                                        </div>


                                                                        <div wire:loading
                                                                            wire:target="cat_file_paths.{{ $record->id }}"
                                                                            class="mt-2">
                                                                            <i class="fas fa-spinner fa-spin"></i>
                                                                            Uploading...
                                                                        </div>

                                                                        @error('cat_file_paths.' . $record->id . '.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </td>

                                                    <!-- File Preview Modal -->
                                                    @if($showFilePreviewModal)

                                                    <div class="modal fade show d-block" tabindex="-1" role="dialog"
                                                        style="background-color: rgba(0, 0, 0, 0.5);">
                                                        <div class="modal-dialog modal-dialog-centered  modal-lg">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="filePreviewModalLabel">
                                                                        File
                                                                        Preview</h5>
                                                                    <button type="button" class="btn-close"
                                                                        wire:click="hideFilePreviewModal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="d-flex flex-column align-items-center">
                                                                        <h6>Selected Files</h6>
                                                                        <div class="d-flex flex-wrap gap-3">
                                                                            <!-- Loop through files and display previews -->
                                                                            @foreach ($previews as $index => $preview)
                                                                            <div class="file-preview-container text-center"
                                                                                style="padding: 5px; border: 1px solid black; width: 120px; height: 120px; border-radius: 5px; position: relative; overflow: hidden;">
                                                                                @if ($preview['type'] == 'image')
                                                                                <img src="{{ $preview['url'] }}"
                                                                                    alt="Preview" class="img-thumbnail"
                                                                                    style="width: 75px; height: 75px;" />
                                                                                <span class="mt-1 uploaded-file-name"
                                                                                    style="display: block; width: 100%;">{{ $preview['name'] }}</span>
                                                                                @else
                                                                                <div
                                                                                    class="d-flex flex-column align-items-center">
                                                                                    <i class="fas fa-file fa-3x"
                                                                                        style="width: 75px; height: 75px;"></i>
                                                                                    <span
                                                                                        class="mt-1 uploaded-file-name"
                                                                                        style="display: block; width: 100%;">{{ $preview['name'] }}</span>
                                                                                </div>
                                                                                @endif

                                                                                <!-- Delete icon -->
                                                                                <button type="button"
                                                                                    class="delete-icon btn btn-danger"
                                                                                    wire:click="removeFile({{ $index }})"
                                                                                    style="position: absolute; top: 5%; right: 5%; z-index: 5; font-size: 12px;">
                                                                                    <i class="fas fa-times"></i>
                                                                                </button>
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        wire:click="hideFilePreviewModal">Close</button>
                                                                    <button type="button" class="btn btn-primary"
                                                                        wire:click="uploadFiles({{ $selectedRecordId }})">Upload
                                                                        Files</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    @endif

                                                    <!-- it file Paths -->

                                                    <td>
                                                        @php
                                                        $images = [];
                                                        $files = [];


                                                        // Check if $record->cat_file_paths is a string, array, or null
                                                        $fileDataArray = null;

                                                        if (isset($record->cat_file_paths) &&
                                                        is_string($record->cat_file_paths))
                                                        {
                                                        $fileDataArray = json_decode($record->cat_file_paths, true);
                                                        } elseif (isset($record->cat_file_paths) &&
                                                        is_array($record->cat_file_paths)) {
                                                        $fileDataArray = $record->cat_file_paths;
                                                        }

                                                        // Ensure $fileDataArray is a valid array before looping
                                                        if (is_array($fileDataArray)) {
                                                        // Separate images and files
                                                        foreach ($fileDataArray as $fileData) {
                                                        if (isset($fileData['mime_type'])) {
                                                        if (strpos($fileData['mime_type'], 'image/') === 0) {
                                                        $images[] = $fileData;
                                                        } else {
                                                        $files[] = $fileData;
                                                        }
                                                        }
                                                        }
                                                        }
                                                        @endphp




                                                        @php

                                                        $images = $images ?? [];
                                                        $files = $files ?? [];
                                                        @endphp
                                                        <!-- Trigger Links -->
                                                        @if (count($images) > 1)
                                                        <a href="#"
                                                            wire:click.prevent="showViewImage({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View Images
                                                        </a>
                                                        @elseif (count($images) == 1)
                                                        <a href="#"
                                                            wire:click.prevent="showViewImage({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View Image
                                                        </a>
                                                        @endif

                                                        @if (count($files) > 1)
                                                        <a href="#" wire:click.prevent="showViewFile({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;margin-left:2px;">
                                                            View Files
                                                        </a>
                                                        @elseif (count($files) == 1)
                                                        <a href="#" wire:click.prevent="showViewFile({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View File
                                                        </a>
                                                        @endif

                                                        @if (count($images) == 0 && count($files) == 0)
                                                        <label for="">N/A</label>
                                                        @endif

                                                        {{-- view file popup --}}
                                                        @if ($showViewImageDialog && $currentImageRequesId ===
                                                        $record->id)
                                                        <div class="modal custom-modal" tabindex="-1" role="dialog"
                                                            style="display: block;">
                                                            <div class="modal-dialog custom-modal-dialog custom-modal-dialog-centered modal-lg"
                                                                role="document">
                                                                <div class="modal-content custom-modal-content">
                                                                    <div class="modal-header custom-modal-header">
                                                                        <h5 class="modal-title view-file">Attached
                                                                            Images</h5>
                                                                    </div>
                                                                    <div class="modal-body custom-modal-body">
                                                                        <div class="swiper-container">
                                                                            <div class="swiper-wrapper">
                                                                                @foreach ($images as $image)
                                                                                @php
                                                                                $base64File = $image['data'];
                                                                                $mimeType = $image['mime_type'];
                                                                                @endphp
                                                                                <div class="swiper-slide">
                                                                                    <img src="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                                                        class="img-fluid" alt="Image">
                                                                                </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer custom-modal-footer">
                                                                        <button type="button" class="submit-btn"
                                                                            wire:click.prevent="downloadITImages({{ $record->id }})">Download</button>
                                                                        <button type="button" class="cancel-btn1"
                                                                            wire:click="closeViewImage">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-backdrop fade show blurred-backdrop"></div>
                                                        @endif


                                                        @if ($showViewFileDialog && $currentImageRequesId ===
                                                        $record->id)
                                                        <div class="modal" tabindex="-1" role="dialog"
                                                            style="display: block;">
                                                            <div class="modal-dialog modal-dialog-centered modal-md"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title viewfile">View Files</h5>
                                                                    </div>
                                                                    <div class="modal-body"
                                                                        style="max-height: 400px; overflow-y: auto;">
                                                                        <ul class="list-group list-group-flush">

                                                                            @foreach ($files as $file)

                                                                            @php

                                                                            $base64File = $file['data'];

                                                                            $mimeType = $file['mime_type'];

                                                                            $originalName = $file['original_name'];

                                                                            @endphp

                                                                            <li>

                                                                                <a href="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                                                    download="{{ $originalName }}"
                                                                                    style="text-decoration: none; color: #007BFF; margin: 10px;">

                                                                                    {{ $originalName }} <i
                                                                                        class="fas fa-download"
                                                                                        style="margin-left:5px"></i>

                                                                                </a>

                                                                            </li>

                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="cancel-btn1"
                                                                            wire:click="closeViewFile">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-backdrop fade show blurred-backdrop"></div>
                                                        @endif

                                                    </td>

                                                    <td class="text-nowrap">
                                                        {{ \Carbon\Carbon::parse($record->created_at)->format('d-M-Y') ?? 'N/A' }}
                                                    </td>


                                                    <td>
                                                        <i wire:click="loadLogs('{{ $record->request_id }}')"
                                                            class="fas fa-clock-rotate-left"
                                                            style="cursor: pointer; padding: 8px;background-color: #4A90E2;border-radius: 20px;color:white;"></i>
                                                    </td>
                                                </tr>



                                                <tr class="req-cc-tr">
                                                    <td colspan="20" class="req-cc-td">
                                                        <div class="req-cc-div">
                                                            <strong style="margin-left: 5px;">CC TO: </strong>
                                                            {{ (empty($ccToArray) || (count($ccToArray) === 1 && $ccToArray[0] === '-')) ? 'N/A' : implode(', ', $ccToArray) }}
                                                        </div>
                                                    </td>
                                                </tr>

                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="20">

                                                        <div class="req-td-norecords">
                                                            <img src="{{ asset('images/Closed.webp') }}"
                                                                alt="No Records" class="req-img-norecords">

                                                            <h3 class="req-head-norecords">No records found
                                                            </h3>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div id="inprogress" class="req-pro-tab-content"
                            style="display: {{ $activeTab === 'inprogress' ? 'block' : 'none' }};">

                            <div>
                                <h3 class="req-inprogress-heading">
                                    InProgress Requests</h3>
                            </div>

                            <div class="row ">

                                <div class="col-12 mt-2">

                                    <div class="container export-main">
                                        <h5 class="mb-4">Export Catalog</h5>

                                        <div class="row"
                                            style="display: flex;justify-content: space-evenly;align-items: center;">
                                            <!-- Export Format -->
                                            <div class="col-md-4 mb-3">
                                                <label for="format" class="form-label">Export Format:</label>
                                                <select id="format" wire:model="exportFormat" class="form-select">
                                                    <option value="" selected disabled hidden>Select Export Format
                                                    </option>
                                                    <option value="excel">Excel</option>
                                                    <option value="csv">CSV</option>
                                                    <option value="pdf">PDF</option>
                                                </select>
                                            </div>

                                            <!-- Request ID -->
                                            <div class="col-md-4 mb-3">
                                                <label for="requestId" class="form-label">Catalog ID:</label>
                                                <input id="requestId" type="text" wire:model="requestId"
                                                    class="form-control" placeholder="Enter Request ID (Optional)">
                                            </div>

                                            <!-- Assignee -->
                                            <div class="col-md-4 mb-3">
                                                <label for="assignee" class="form-label">Select Assignee:</label>
                                                <select class="form-select" wire:model="assignee">
                                                    <!-- Default option with empty value (shown when no selection is made) -->
                                                    <option value="" disabled hidden>Select Assignee (Optional)</option>

                                                    <!-- Loop through IT data -->
                                                    @foreach($itData as $itName)
                                                    <option
                                                        value="{{ ucwords(strtolower($itName->empIt->first_name)) }} {{ ucwords(strtolower($itName->empIt->last_name)) }} {{ $itName->empIt->emp_id }}">
                                                        {{ ucwords(strtolower($itName->empIt->first_name)) }}
                                                        {{ ucwords(strtolower($itName->empIt->last_name)) }}
                                                        ({{ $itName->empIt->emp_id }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3 d-flex justify-content-center">
                                                <button wire:click.prevent="clearFilters"
                                                    class="btn btn-secondary mt-3 me-2">Clear</button>

                                                <button wire:click.prevent="exportRequests(16)"
                                                    class="btn btn-primary mt-3">Download</button>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        @if($checkboxClosingModal)

                                        <div class="d-flex justify-content-between mb-3">

                                            <!-- Bulk Status Dropdown -->
                                            <div class="col-md-4">
                                                <label for="" class="" style="white-space: nowrap;"> Please select the
                                                    status for multi-selection</label>
                                                <select wire:change="handleBulkInprogressStatus($event.target.value)"
                                                    class="req-selected-status">
                                                    <option value="" selected disabled hidden>Select Status</option>
                                                    <option value="5">Pending</option>
                                                    <option value="11">Completed</option>
                                                </select>
                                                @error('selectedStatus')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        @endif
                                    </div>

                                    @if($showBulkPendingModal)
                                    <div class="modal fade show d-block" tabindex="-1" role="dialog"
                                        style="background-color: rgba(0, 0, 0, 0.5);">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Reason for Pending
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        wire:click="closeBulkPendingModal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body flex-column">
                                                    <label for="reason" class="form-label">Reason <span
                                                            class="text-danger">*</span></label>
                                                    <textarea id="reason" class="form-control"
                                                        wire:model.defer="pendingReason" rows="3"></textarea>
                                                    @error('pendingReason')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        wire:click="closeBulkPendingModal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        wire:click="bulkPendingForDesks">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if($showBulkClosedModal)
                                    <div class="modal fade show d-block" tabindex="-1" role="dialog"
                                        style="background-color: rgba(0, 0, 0, 0.5);">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Reason for Closed
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        wire:click="closeBulkClosedModal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body flex-column">
                                                    <label for="reason" class="form-label">Reason <span
                                                            class="text-danger">*</span></label>
                                                    <textarea id="reason" class="form-control"
                                                        wire:model.defer="pendingReason" rows="3"></textarea>
                                                    @error('pendingReason')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="modal-body flex-column">
                                                    <label for="reason" class="form-label">Reason
                                                        (Customer Visible) <span class="text-danger">*</span></label>
                                                    <textarea id="reason" class="form-control"
                                                        wire:model.defer="customerVisibleNotes" rows="3"></textarea>
                                                    @error('customerVisibleNotes')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        wire:click="closeBulkClosedModal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        wire:click="bulkCloseForDesks">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif


                                    <div class="col-lg-3 col-md-3 col-5 mb-5">
                                        <div>
                                            <label for="assignee" class="form-label">Select Assignee</label>
                                            <select id="assignee" class="form-control"
                                                wire:model="statusInproFilterAssigne"
                                                wire:change="loadInprogessRecordsByAssigne">
                                                <option value="" disabled selected>-- Select Assignee --</option>
                                                <option value="">All</option>
                                                @foreach ($itAssigneMemebers as $member)
                                                <option
                                                    value="{{ $member['first_name'] }} {{ $member['last_name'] }} {{ $member['emp_id'] }}">
                                                    {{ $member['first_name'] }} {{ $member['last_name'] }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="table-responsive req-table-res">

                                        <table class="custom-table">
                                            @if($catalogInprogressDetails->count() > 0)
                                            <thead>

                                                <tr>
                                                    <th class="req-table-head">Select</th>
                                                    <th scope="col" class="req-table-head">Employee ID
                                                        <span wire:click.debounce.500ms="toggleSortOrder('emp_id')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'emp_id')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Requested By

                                                    </th>

                                                    <th class="req-table-head">Catalog Request
                                                        <span wire:click.debounce.500ms="toggleSortOrder('category')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'category')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Subject
                                                        <span wire:click.debounce.500ms="toggleSortOrder('subject')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'subject')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Description</th>

                                                    <th class="req-table-head">Distributor
                                                        <span
                                                            wire:click.debounce.500ms="toggleSortOrder('distributor_name')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'distributor_name')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Phone
                                                        <span wire:click.debounce.500ms="toggleSortOrder('mobile')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'mobile')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">MailBox
                                                        <span wire:click.debounce.500ms="toggleSortOrder('mail')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'mail')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Attach Files</th>



                                                    <th class="req-table-head">Priority
                                                        <span wire:click.debounce.500ms="toggleSortOrder('priority')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'priority')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Select Equipment
                                                        <span
                                                            wire:click.debounce.500ms="toggleSortOrder('selected_equipment')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'selected_equipment')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-table-head">Status

                                                    </th>

                                                    <th class="req-table-head">Assigned to
                                                        <span wire:click.debounce.500ms="toggleSortOrder('assign_to')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'assign_to')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>


                                                    <th class="req-table-head">Time tracker</th>
                                                    <th class="req-table-head">Response time</th>
                                                    <th class="req-table-head">Change Status</th>
                                                    <th class="req-table-head"> Files Upload</th>
                                                    <th class="req-table-head">IT Uploaded Files</th>
                                                    <th class="req-table-head">Created At</th>
                                                    <th class="req-table-head">Logs</th>

                                                </tr>

                                            </thead>
                                            @endif
                                            <tbody>

                                                @if($catalogInprogressDetails->count() > 0)
                                                @foreach ($catalogInprogressDetails as $index =>$record)
                                                @php
                                                $ccToArray = explode(',', $record->cc_to);
                                                @endphp
                                                <tr>

                                                    <td>
                                                        <input type="checkbox" wire:model="selectedRequests"
                                                            wire:click='checkboxClosingMultiSelection'
                                                            value="{{ $record->id }}" wire:key=rcrdID-{{ $record->id}}>
                                                    </td>
                                                    <td scope="row">{{ $record->emp_id }}</td>

                                                    <td>{{ $record->emp->first_name }} {{ $record->emp->last_name }}
                                                        <br>
                                                        <strong class="req-res-emp_id">({{$record->emp_id}})
                                                    </td>

                                                    <td>{{ $record->category ?? 'N/A'}}</td>

                                                    <td>{{ $record->subject ?? 'N/A' }}</td>

                                                    <td>{{ $record->description?? 'N/A' }}</td>

                                                    <td>{{ $record->distributor_name?? 'N/A' }}</td>

                                                    <td>{{ $record->mobile?? 'N/A' }}</td>

                                                    <td>{{ $record->mail ??'N/A' }}</td>




                                                    <!-- emp file paths -->

                                                    <td>
                                                        @php
                                                        $empImages = [];
                                                        $empFiles = [];

                                                        // Check if $record->file_paths is a string, array, or null
                                                        $fileDataArray = null;

                                                        if (isset($record->file_paths) &&
                                                        is_string($record->file_paths))
                                                        {
                                                        $fileDataArray = json_decode($record->file_paths, true);
                                                        } elseif (isset($record->file_paths) &&
                                                        is_array($record->file_paths)) {
                                                        $fileDataArray = $record->file_paths;
                                                        }

                                                        // Ensure $fileDataArray is a valid array before looping
                                                        if (is_array($fileDataArray)) {
                                                        // Separate empImages and files
                                                        foreach ($fileDataArray as $fileData) {
                                                        if (isset($fileData['mime_type'])) {
                                                        if (strpos($fileData['mime_type'], 'image/') === 0) {
                                                        $empImages[] = $fileData;
                                                        } else {
                                                        $empFiles[] = $fileData;
                                                        }
                                                        }
                                                        }
                                                        }
                                                        @endphp




                                                        @php

                                                        $empImages = $empImages ?? [];
                                                        $empFiles = $empFiles ?? [];
                                                        @endphp
                                                        <!-- Trigger Links -->
                                                        @if (count($empImages) > 1)
                                                        <a href="#"
                                                            wire:click.prevent="showViewEmpImage({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View Images
                                                        </a>
                                                        @elseif (count($empImages) == 1)
                                                        <a href="#"
                                                            wire:click.prevent="showViewEmpImage({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View Image
                                                        </a>
                                                        @endif

                                                        @if (count($empFiles) > 1)
                                                        <a href="#"
                                                            wire:click.prevent="showViewEmpFile({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View Files
                                                        </a>
                                                        @elseif (count($empFiles) == 1)
                                                        <a href="#"
                                                            wire:click.prevent="showViewEmpFile({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View File
                                                        </a>
                                                        @endif

                                                        @if (count($empImages) == 0 && count($empFiles) == 0)
                                                        <label for="">N/A</label>
                                                        @endif


                                                        {{-- view file popup --}}
                                                        @if ($showViewEmpImageDialog && $currentImageRequesId ===
                                                        $record->id)
                                                        <div class="modal custom-modal" tabindex="-1" role="dialog"
                                                            style="display: block;">
                                                            <div class="modal-dialog custom-modal-dialog custom-modal-dialog-centered modal-lg"
                                                                role="document">
                                                                <div class="modal-content custom-modal-content">
                                                                    <div class="modal-header custom-modal-header">
                                                                        <h5 class="modal-title view-file">Attached
                                                                            Images</h5>
                                                                    </div>
                                                                    <div class="modal-body custom-modal-body">

                                                                        <div class="swiper-container">

                                                                            <div class="swiper-wrapper">
                                                                                @foreach ($empImages as $eImage)
                                                                                @php
                                                                                $base64FileE = $eImage['data'];
                                                                                $mimeTypeE = $eImage['mime_type'];
                                                                                @endphp
                                                                                <div class="swiper-slide">
                                                                                    <img src="data:{{ $mimeTypeE }};base64,{{ $base64FileE }}"
                                                                                        class="img-fluid" alt="Image">
                                                                                </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer custom-modal-footer">
                                                                        <button type="button" class="submit-btn"
                                                                            wire:click.prevent="downloadImages({{ $record->id }})">Download</button>
                                                                        <button type="button" class="cancel-btn1"
                                                                            wire:click="closeViewEmpImage">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-backdrop fade show blurred-backdrop"></div>
                                                        @endif


                                                        @if ($showViewEmpFileDialog && $currentImageRequesId ===
                                                        $record->id)
                                                        <div class="modal" tabindex="-1" role="dialog"
                                                            style="display: block;">
                                                            <div class="modal-dialog modal-dialog-centered modal-md"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title viewfile">View Files</h5>
                                                                    </div>
                                                                    <div class="modal-body"
                                                                        style="max-height: 400px; overflow-y: auto;">
                                                                        <ul class="list-group list-group-flush">

                                                                            @foreach ($empFiles as $fileE)

                                                                            @php

                                                                            $base64FileE = $fileE['data'];

                                                                            $mimeTypeE = $fileE['mime_type'];

                                                                            $originalNameE = $fileE['original_name'];

                                                                            @endphp

                                                                            <li>

                                                                                <a href="data:{{ $mimeTypeE }};base64,{{ $base64FileE }}"
                                                                                    download="{{ $originalNameE }}"
                                                                                    style="text-decoration: none; color: #007BFF; margin: 10px;">

                                                                                    {{ $originalNameE}} <i
                                                                                        class="fas fa-download"
                                                                                        style="margin-left:5px"></i>

                                                                                </a>

                                                                            </li>

                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="cancel-btn1"
                                                                            wire:click="closeViewEmpFile">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-backdrop fade show blurred-backdrop"></div>
                                                        @endif

                                                    </td>




                                                    <td>{{ $record->priority?? 'N/A' }}</td>

                                                    <td>{{ $record->selected_equipment?? 'N/A' }}</td>

                                                    <td>
                                                        <div class="req-status"> @if($record->status_code == 16)
                                                            Inprogress

                                                            @endif
                                                        </div>
                                                    </td>

                                                    <td>{{ $record['assign_to'] }}</td>




                                                    <td>

                                                        <div class="req-timebar">


                                                            @if($record->status_code == '16' &&
                                                            $record->cat_progress_since)
                                                            @php

                                                            $totalElapsedMinutes =
                                                            \Carbon\Carbon::parse($record->cat_progress_since)->diffInMinutes(now());

                                                            if (isset($record->total_cat_progress_time)) {
                                                            $totalElapsedMinutes += $record->total_cat_progress_time;
                                                            }

                                                            $days = floor($totalElapsedMinutes / 1440);
                                                            $remainingHours = floor(($totalElapsedMinutes % 1440) / 60);
                                                            $minutes = $totalElapsedMinutes % 60;


                                                            $maxTime = 7 * 1440;
                                                            $percentage = min(($totalElapsedMinutes / $maxTime) * 100,
                                                            100);


                                                            @endphp

                                                            <!-- Display elapsed time based on the total elapsed time -->
                                                            @if ($totalElapsedMinutes < 60) <span>{{ $minutes }}
                                                                minutes</span>
                                                                @elseif ($totalElapsedMinutes < 1440) <span>
                                                                    {{ $remainingHours }} hours {{ $minutes }}
                                                                    minutes</span>
                                                                    @else
                                                                    <span>{{ $days }} days {{ $remainingHours }} hours
                                                                        {{ $minutes }} minutes</span>
                                                                    @endif

                                                                    <!-- Custom Progress Bar -->
                                                                    <div class="custom-progress">
                                                                        <div class="custom-progress-bar"
                                                                            style="width: {{ $percentage }}%"
                                                                            aria-valuenow="{{ $percentage }}"
                                                                            aria-valuemin="0" aria-valuemax="100">
                                                                            <span
                                                                                class="progress-text">{{ round($percentage) }}%</span>
                                                                        </div>
                                                                    </div>

                                                                    @else
                                                                    <span>No time tracked</span>
                                                                    @endif

                                                        </div>
                                                    </td>


                                                    <td>
                                                        <div class="req-timebar">
                                                            @if($record->created_at)
                                                            @php
                                                            // Parse the start and end dates
                                                            $startDate = \Carbon\Carbon::parse($record->created_at);

                                                            // If 'req_end_date' exists, use it; otherwise, use current

                                                            $endDate = $record->req_end_date ?
                                                            \Carbon\Carbon::parse($record->req_end_date) :
                                                            \Carbon\Carbon::now();

                                                            // Calculate total elapsed time in minutes
                                                            $totalElapsedMinutes = $startDate->diffInMinutes($endDate);

                                                            // If there is additional service progress time, add it
                                                            if (isset($record->total_ser_progress_time)) {
                                                            $totalElapsedMinutes += $record->total_ser_progress_time;
                                                            }

                                                            // Calculate years, days, hours, and minutes from the

                                                            $years = floor($totalElapsedMinutes / 525600);


                                                            $remainingMinutes = $totalElapsedMinutes % 525600;

                                                            $days = floor($remainingMinutes / 1440);
                                                            $remainingMinutes %= 1440;

                                                            $hours = floor($remainingMinutes / 60);
                                                            $minutes = $remainingMinutes % 60;

                                                            $maxTime = 30 * 1440; // 30 days * 1440 minutes
                                                            $percentage = min(($totalElapsedMinutes / $maxTime) * 100,
                                                            100);
                                                            @endphp

                                                            <!-- Display elapsed time with conditions -->
                                                            @if ($totalElapsedMinutes < 60) <span>{{ $minutes }}
                                                                minute{{ $minutes != 1 ? 's' : '' }}</span>
                                                                @elseif ($totalElapsedMinutes < 1440) <span>{{ $hours }}
                                                                    hour{{ $hours != 1 ? 's' : '' }} {{ $minutes }}
                                                                    minute{{ $minutes != 1 ? 's' : '' }}</span>
                                                                    @elseif ($totalElapsedMinutes < 525600) <span>
                                                                        {{ $days }}
                                                                        day{{ $days != 1 ? 's' : '' }} {{ $hours }}
                                                                        hour{{ $hours != 1 ? 's' : '' }} {{ $minutes }}
                                                                        minute{{ $minutes != 1 ? 's' : '' }}</span>
                                                                        @else
                                                                        <span>{{ $years }}
                                                                            year{{ $years != 1 ? 's' : '' }}
                                                                            {{ $days }} day{{ $days != 1 ? 's' : '' }}
                                                                            {{ $hours }}
                                                                            hour{{ $hours != 1 ? 's' : '' }}
                                                                            {{ $minutes }}
                                                                            minute{{ $minutes != 1 ? 's' : '' }}</span>
                                                                        @endif



                                                                        @else
                                                                        <span>No time tracked</span>
                                                                        @endif
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="req-changeStatus ">
                                                            <button wire:click="selectedPending('{{ $record->id }}')"
                                                                wire:key="pending-desks-{{ $record->id}}"
                                                                class="btn btn-white border-black text-black"
                                                                @if($loading) disabled @endif>Pending</button>


                                                            @if($showPendingModal)
                                                            <div class="modal fade show d-block" tabindex="-1"
                                                                role="dialog"
                                                                style="background-color: rgba(0, 0, 0, 0.5);">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">
                                                                                Reason for Pending
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                wire:click="closePendingModal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body flex-column">
                                                                            <label for="reason"
                                                                                class="form-label">Reason <span
                                                                                    class="text-danger">*</span></label>
                                                                            <textarea id="reason" class="form-control"
                                                                                wire:model.defer="pendingReason"
                                                                                rows="3"></textarea>
                                                                            @error('pendingReason')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                wire:click="closePendingModal">Close</button>
                                                                            <button type="button"
                                                                                class="btn btn-primary"
                                                                                wire:click="pendingForDesks({{ $selectedTaskId }})">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif


                                                            <button wire:click="selectedClosed('{{ $record->id }}')"
                                                                wire:key="close-desks-{{ $record->id}}"
                                                                class="btn btn-white border-black text-black"
                                                                @if($loading) disabled @endif>Close</button>


                                                            @if($showClosedModal)
                                                            <div class="modal fade show d-block" tabindex="-1"
                                                                role="dialog"
                                                                style="background-color: rgba(0, 0, 0, 0.5);">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">
                                                                                Reason for Closed
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                wire:click="closeClosedModal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body flex-column">
                                                                            <label for="reason"
                                                                                class="form-label">Reason <span
                                                                                    class="text-danger">*</span></label>
                                                                            <textarea id="reason" class="form-control"
                                                                                wire:model.defer="pendingReason"
                                                                                rows="3"></textarea>
                                                                            @error('pendingReason')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="modal-body flex-column">
                                                                            <label for="reason"
                                                                                class="form-label">Reason
                                                                                (Customer Visible) <span
                                                                                    class="text-danger">*</span></label>
                                                                            <textarea id="reason" class="form-control"
                                                                                wire:model.defer="customerVisibleNotes"
                                                                                rows="3"></textarea>
                                                                            @error('customerVisibleNotes')
                                                                            <span
                                                                                class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </div>

                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                wire:click="closeClosedModal">Close</button>
                                                                            <button type="button"
                                                                                class="btn btn-primary"
                                                                                wire:click="closeForDesks({{ $selectedTaskId }})">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif

                                                        </div>

                                                    </td>



                                                    <td>
                                                        <!-- Attachments -->
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <p class="text-primary">
                                                                            <label for="file"
                                                                                class="vendor-asset-label">Attachments</label>

                                                                        </p>
                                                                    </div>
                                                                    <div class="col-8">
                                                                        <!-- File input hidden -->
                                                                        <input id="fileInput-{{ $record->id }}"
                                                                            type="file"
                                                                            wire:model="cat_file_paths.{{ $record->id }}"
                                                                            class="form-control-file" multiple
                                                                            style="font-size: 12px; display: none;" />

                                                                        <!-- Label triggers file input -->
                                                                        <div class="d-flex"
                                                                            style="align-items: baseline; gap: 5px;">
                                                                            <button class="btn btn-outline-secondary"
                                                                                type="button"
                                                                                for="fileInput-{{ $record->id }}"
                                                                                onclick="document.getElementById('fileInput-{{ $record->id }}').click();">
                                                                                <i class="fa-solid fa-paperclip"></i>
                                                                            </button>
                                                                        </div>


                                                                        <div wire:loading
                                                                            wire:target="cat_file_paths.{{ $record->id }}"
                                                                            class="mt-2">
                                                                            <i class="fas fa-spinner fa-spin"></i>
                                                                            Uploading...
                                                                        </div>

                                                                        @error('cat_file_paths.' . $record->id . '.*')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </td>

                                                    <!-- File Preview Modal -->
                                                    @if($showFilePreviewModal)

                                                    <div class="modal fade show d-block" tabindex="-1" role="dialog"
                                                        style="background-color: rgba(0, 0, 0, 0.5);">
                                                        <div class="modal-dialog modal-dialog-centered  modal-lg">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="filePreviewModalLabel">
                                                                        File
                                                                        Preview</h5>
                                                                    <button type="button" class="btn-close"
                                                                        wire:click="hideFilePreviewModal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="d-flex flex-column align-items-center">
                                                                        <h6>Selected Files</h6>
                                                                        <div class="d-flex flex-wrap gap-3">
                                                                            <!-- Loop through files and display previews -->
                                                                            @foreach ($previews as $index => $preview)
                                                                            <div class="file-preview-container text-center"
                                                                                style="padding: 5px; border: 1px solid black; width: 120px; height: 120px; border-radius: 5px; position: relative; overflow: hidden;">
                                                                                @if ($preview['type'] == 'image')
                                                                                <img src="{{ $preview['url'] }}"
                                                                                    alt="Preview" class="img-thumbnail"
                                                                                    style="width: 75px; height: 75px;" />
                                                                                <span class="mt-1 uploaded-file-name"
                                                                                    style="display: block; width: 100%;">{{ $preview['name'] }}</span>
                                                                                @else
                                                                                <div
                                                                                    class="d-flex flex-column align-items-center">
                                                                                    <i class="fas fa-file fa-3x"
                                                                                        style="width: 75px; height: 75px;"></i>
                                                                                    <span
                                                                                        class="mt-1 uploaded-file-name"
                                                                                        style="display: block; width: 100%;">{{ $preview['name'] }}</span>
                                                                                </div>
                                                                                @endif

                                                                                <!-- Delete icon -->
                                                                                <button type="button"
                                                                                    class="delete-icon btn btn-danger"
                                                                                    wire:click="removeFile({{ $index }})"
                                                                                    style="position: absolute; top: 5%; right: 5%; z-index: 5; font-size: 12px;">
                                                                                    <i class="fas fa-times"></i>
                                                                                </button>
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        wire:click="hideFilePreviewModal">Close</button>
                                                                    <button type="button" class="btn btn-primary"
                                                                        wire:click="uploadFiles({{ $selectedRecordId }})">Upload
                                                                        Files</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    @endif

                                                    <!-- it file Paths -->

                                                    <td>
                                                        @php
                                                        $images = [];
                                                        $files = [];


                                                        // Check if $record->cat_file_paths is a string, array, or null
                                                        $fileDataArray = null;

                                                        if (isset($record->cat_file_paths) &&
                                                        is_string($record->cat_file_paths))
                                                        {
                                                        $fileDataArray = json_decode($record->cat_file_paths, true);
                                                        } elseif (isset($record->cat_file_paths) &&
                                                        is_array($record->cat_file_paths)) {
                                                        $fileDataArray = $record->cat_file_paths;
                                                        }

                                                        // Ensure $fileDataArray is a valid array before looping
                                                        if (is_array($fileDataArray)) {
                                                        // Separate images and files
                                                        foreach ($fileDataArray as $fileData) {
                                                        if (isset($fileData['mime_type'])) {
                                                        if (strpos($fileData['mime_type'], 'image/') === 0) {
                                                        $images[] = $fileData;
                                                        } else {
                                                        $files[] = $fileData;
                                                        }
                                                        }
                                                        }
                                                        }
                                                        @endphp




                                                        @php

                                                        $images = $images ?? [];
                                                        $files = $files ?? [];
                                                        @endphp
                                                        <!-- Trigger Links -->
                                                        @if (count($images) > 1)
                                                        <a href="#"
                                                            wire:click.prevent="showViewImage({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View Images
                                                        </a>
                                                        @elseif (count($images) == 1)
                                                        <a href="#"
                                                            wire:click.prevent="showViewImage({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View Image
                                                        </a>
                                                        @endif

                                                        @if (count($files) > 1)
                                                        <a href="#" wire:click.prevent="showViewFile({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;margin-left:2px;">
                                                            View Files
                                                        </a>
                                                        @elseif (count($files) == 1)
                                                        <a href="#" wire:click.prevent="showViewFile({{ $record->id }})"
                                                            style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                            View File
                                                        </a>
                                                        @endif

                                                        @if (count($images) == 0 && count($files) == 0)
                                                        <label for="">N/A</label>
                                                        @endif

                                                        {{-- view file popup --}}
                                                        @if ($showViewImageDialog && $currentImageRequesId ===
                                                        $record->id)
                                                        <div class="modal custom-modal" tabindex="-1" role="dialog"
                                                            style="display: block;">
                                                            <div class="modal-dialog custom-modal-dialog custom-modal-dialog-centered modal-lg"
                                                                role="document">
                                                                <div class="modal-content custom-modal-content">
                                                                    <div class="modal-header custom-modal-header">
                                                                        <h5 class="modal-title view-file">Attached
                                                                            Images</h5>
                                                                    </div>
                                                                    <div class="modal-body custom-modal-body">
                                                                        <div class="swiper-container">
                                                                            <div class="swiper-wrapper">
                                                                                @foreach ($images as $image)
                                                                                @php
                                                                                $base64File = $image['data'];
                                                                                $mimeType = $image['mime_type'];
                                                                                @endphp
                                                                                <div class="swiper-slide">
                                                                                    <img src="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                                                        class="img-fluid" alt="Image">
                                                                                </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer custom-modal-footer">
                                                                        <button type="button" class="submit-btn"
                                                                            wire:click.prevent="downloadITImages({{ $record->id }})">Download</button>
                                                                        <button type="button" class="cancel-btn1"
                                                                            wire:click="closeViewImage">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-backdrop fade show blurred-backdrop"></div>
                                                        @endif


                                                        @if ($showViewFileDialog && $currentImageRequesId ===
                                                        $record->id)
                                                        <div class="modal" tabindex="-1" role="dialog"
                                                            style="display: block;">
                                                            <div class="modal-dialog modal-dialog-centered modal-md"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title viewfile">View Files</h5>
                                                                    </div>
                                                                    <div class="modal-body"
                                                                        style="max-height: 400px; overflow-y: auto;">
                                                                        <ul class="list-group list-group-flush">

                                                                            @foreach ($files as $file)

                                                                            @php

                                                                            $base64File = $file['data'];

                                                                            $mimeType = $file['mime_type'];

                                                                            $originalName = $file['original_name'];

                                                                            @endphp

                                                                            <li>

                                                                                <a href="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                                                    download="{{ $originalName }}"
                                                                                    style="text-decoration: none; color: #007BFF; margin: 10px;">

                                                                                    {{ $originalName }} <i
                                                                                        class="fas fa-download"
                                                                                        style="margin-left:5px"></i>

                                                                                </a>

                                                                            </li>

                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="cancel-btn1"
                                                                            wire:click="closeViewFile">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-backdrop fade show blurred-backdrop"></div>
                                                        @endif

                                                    </td>

                                                    <td class="text-nowrap">
                                                        {{ \Carbon\Carbon::parse($record->created_at)->format('d-M-Y') ?? 'N/A' }}

                                                    </td>

                                                    <td>
                                                        <i wire:click="loadLogs('{{ $record->request_id }}')"
                                                            class="fas fa-clock-rotate-left"
                                                            style="cursor: pointer; padding: 8px;background-color: #4A90E2;border-radius: 20px;color:white;"></i>
                                                    </td>


                                                </tr>



                                                <tr class="req-cc-tr">
                                                    <td colspan="20" class="req-cc-td">
                                                        <div class="req-cc-div">
                                                            <strong style="margin-left: 5px;">CC TO: </strong>
                                                            {{ (empty($ccToArray) || (count($ccToArray) === 1 && $ccToArray[0] === '-')) ? 'N/A' : implode(', ', $ccToArray) }}
                                                        </div>
                                                    </td>
                                                </tr>

                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="20">

                                                        <div class="req-td-norecords">
                                                            <img src="{{ asset('images/Closed.webp') }}"
                                                                alt="No Records" class="req-img-norecords">

                                                            <h3 class="req-head-norecords">No records found
                                                            </h3>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div id="closed" class="req-pro-tab-content"
                            style="display: {{ $activeTab === 'closed' ? 'block' : 'none' }};">
                            <div>
                                <h3 class="req-closed-head">
                                    Closed Requests</h3>
                            </div>
                            <div class="row">

                                <div class="col-12 mt-2">

                                    <div class="container export-main">
                                        <h5 class="mb-4">Export Catalog</h5>

                                        <div class="row"
                                            style="display: flex;justify-content: space-evenly;align-items: center;">
                                            <!-- Export Format -->
                                            <div class="col-md-4 mb-3">
                                                <label for="format" class="form-label">Export Format:</label>
                                                <select id="format" wire:model="exportFormat" class="form-select">
                                                    <option value="" selected disabled hidden>Select Export Format
                                                    </option>
                                                    <option value="excel">Excel</option>
                                                    <option value="csv">CSV</option>
                                                    <option value="pdf">PDF</option>
                                                </select>
                                            </div>

                                            <!-- Request ID -->
                                            <div class="col-md-4 mb-3">
                                                <label for="requestId" class="form-label">Catalog ID:</label>
                                                <input id="requestId" type="text" wire:model="requestId"
                                                    class="form-control" placeholder="Enter Request ID (Optional)">
                                            </div>

                                            <!-- Assignee -->
                                            <div class="col-md-4 mb-3">
                                                <label for="assignee" class="form-label">Select Assignee:</label>
                                                <select class="form-select" wire:model="assignee">
                                                    <!-- Default option with empty value (shown when no selection is made) -->
                                                    <option value="" disabled hidden>Select Assignee (Optional)</option>

                                                    <!-- Loop through IT data -->
                                                    @foreach($itData as $itName)
                                                    <option
                                                        value="{{ ucwords(strtolower($itName->empIt->first_name)) }} {{ ucwords(strtolower($itName->empIt->last_name)) }} {{ $itName->empIt->emp_id }}">
                                                        {{ ucwords(strtolower($itName->empIt->first_name)) }}
                                                        {{ ucwords(strtolower($itName->empIt->last_name)) }}
                                                        ({{ $itName->empIt->emp_id }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-12 d-flex justify-content-between align-items-center">

                                                <button wire:click.prevent="clearFilters"
                                                    class="btn btn-secondary mt-3 me-2"
                                                    style="font-size: 11px;">Clear</button>
                                                <button wire:click.prevent="exportRequests('11')"
                                                    class="btn btn-primary mt-3" style="font-size: 11px;">Download
                                                    Completed Requests</button>
                                                <button wire:click.prevent="exportRequests('15')"
                                                    class="btn btn-primary mt-3" style="font-size: 11px;">Download
                                                    Cancelled Requests</button>
                                                <button wire:click.prevent="exportRequests('11,15')"
                                                    class="btn btn-primary mt-3" style="font-size: 11px;">Download
                                                    All</button>

                                            </div>


                                        </div>

                                    </div>


                                    <div class="row d-flex">
                                        <!-- Assignee Filter -->
                                        <div class="col-lg-3 col-md-3 col-5 mb-5">
                                            <div>
                                                <label for="assignee" class="form-label">Select Assignee</label>
                                                <select id="assignee" class="form-control"
                                                    wire:model="statusClsdFilterAssigne"
                                                    wire:change="loadClosedRecordsByAssigne">
                                                    <option value="" disabled selected>-- Select Assignee --</option>
                                                    <option value="">All</option>
                                                    @foreach ($itAssigneMemebers as $member)
                                                    <option
                                                        value="{{ $member['first_name'] }} {{ $member['last_name'] }} {{ $member['emp_id'] }}">
                                                        {{ $member['first_name'] }} {{ $member['last_name'] }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Status Filter -->
                                        <div class="col-lg-3 col-md-3 col-5 mb-5">
                                            <label for="statusFilter" class="form-label">Filter by Status</label>
                                            <select wire:model="statusFilter" wire:change="loadClosedRecordsByAssigne"
                                                id="statusFilter" class="form-select">
                                                <option value="">All</option>
                                                <option value="15">Cancelled</option>
                                                <option value="11">Completed</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="table-responsive  req-closed-table-res">


                                        <table class="custom-table">
                                            @if($catalogClosedDetails->count() > 0)
                                            <thead>

                                                <tr>

                                                    <th scope="col" class="req-closed-th">Employee ID
                                                        <span wire:click.debounce.500ms="toggleSortOrder('emp_id')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'emp_id')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>

                                                    <th class="req-closed-th">Requested By</th>

                                                    <th class="req-closed-th">Catalog Request
                                                        <span wire:click.debounce.500ms="toggleSortOrder('category')"
                                                            style="cursor: pointer;">
                                                            @if($sortColumn == 'category')
                                                            <i
                                                                class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                                            @else
                                                            <i class="fas fa-sort"></i>
                                                            @endif
                                                        </span>
                                                    </th>
                                                    <th class="req-closed-th">Status</th>
                                                    <th class="req-closed-th">Response time</th>
                                                    <th class="req-closed-th">View</th>
                                                    <th class="req-table-head">Created At</th>
                                                    <th class="req-closed-th">Logs</th>

                                                </tr>

                                            </thead>
                                            @endif
                                            <tbody>

                                                @if($catalogClosedDetails->count() > 0)
                                                @foreach ($catalogClosedDetails as $record)
                                                @php
                                                $ccToArray = explode(',', $record->cc_to);
                                                @endphp
                                                <tr>

                                                    <td scope="row">{{ $record->emp_id }}</td>

                                                    <td>{{ $record->emp->first_name }} {{ $record->emp->last_name }}
                                                        <br>
                                                        <strong class="req-res-emp_id">({{$record->emp_id}})
                                                    </td>

                                                    <td>{{ $record->category ?? 'N/A'}}</td>
                                                    <td>
                                                        <div class="req-status-closed
                                                @if($record['status_code'] == 11)
                                                    status-completed
                                                @elseif($record['status_code'] == 15)
                                                    status-cancelled
                                                @else
                                                    status-default
                                                @endif">
                                                            {{
                                                    $record['status_code'] == 11 ? 'Completed' :
                                                    ($record['status_code'] == 15 ? 'Cancelled' : 'N/A')
                                                }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="req-timebar">
                                                            @if($record->created_at)
                                                            @php
                                                            // Parse the start and end dates
                                                            $startDate = \Carbon\Carbon::parse($record->created_at);

                                                            // If 'req_end_date' exists, use it; otherwise, use current

                                                            $endDate = $record->req_end_date ?
                                                            \Carbon\Carbon::parse($record->req_end_date) :
                                                            \Carbon\Carbon::now();

                                                            // Calculate total elapsed time in minutes
                                                            $totalElapsedMinutes = $startDate->diffInMinutes($endDate);

                                                            // If there is additional service progress time, add it
                                                            if (isset($record->total_ser_progress_time)) {
                                                            $totalElapsedMinutes += $record->total_ser_progress_time;
                                                            }

                                                            // Calculate years, days, hours, and minutes from the

                                                            $years = floor($totalElapsedMinutes / 525600);

                                                            $remainingMinutes = $totalElapsedMinutes % 525600;

                                                            $days = floor($remainingMinutes / 1440);
                                                            $remainingMinutes %= 1440;

                                                            $hours = floor($remainingMinutes / 60);
                                                            $minutes = $remainingMinutes % 60;

                                                            $maxTime = 30 * 1440; // 30 days * 1440 minutes
                                                            $percentage = min(($totalElapsedMinutes / $maxTime) * 100,
                                                            100);
                                                            @endphp

                                                            <!-- Display elapsed time with conditions -->
                                                            @if ($totalElapsedMinutes < 60) <span>{{ $minutes }}
                                                                minute{{ $minutes != 1 ? 's' : '' }}</span>
                                                                @elseif ($totalElapsedMinutes < 1440) <span>{{ $hours }}
                                                                    hour{{ $hours != 1 ? 's' : '' }} {{ $minutes }}
                                                                    minute{{ $minutes != 1 ? 's' : '' }}</span>
                                                                    @elseif ($totalElapsedMinutes < 525600) <span>
                                                                        {{ $days }}
                                                                        day{{ $days != 1 ? 's' : '' }} {{ $hours }}
                                                                        hour{{ $hours != 1 ? 's' : '' }} {{ $minutes }}
                                                                        minute{{ $minutes != 1 ? 's' : '' }}</span>
                                                                        @else
                                                                        <span>{{ $years }}
                                                                            year{{ $years != 1 ? 's' : '' }}
                                                                            {{ $days }} day{{ $days != 1 ? 's' : '' }}
                                                                            {{ $hours }}
                                                                            hour{{ $hours != 1 ? 's' : '' }}
                                                                            {{ $minutes }}
                                                                            minute{{ $minutes != 1 ? 's' : '' }}</span>
                                                                        @endif


                                                                        @else
                                                                        <span>No time tracked</span>
                                                                        @endif
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <button class="btn"
                                                            style="background-color: #02114f;color:white"
                                                            wire:click="viewRecord({{ $record->id }})">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </td>

                                                    <td class="text-nowrap">
                                                        {{ \Carbon\Carbon::parse($record->created_at)->format('d-M-Y') ?? 'N/A' }}

                                                    </td>

                                                    <td>
                                                        <i wire:click="loadLogs('{{ $record->request_id }}')"
                                                            class="fas fa-clock-rotate-left"
                                                            style="cursor: pointer; padding: 8px;background-color: #4A90E2;border-radius: 20px;color:white;"></i>
                                                    </td>

                                                </tr>


                                                <tr class="req-cc-tr">

                                                    <td colspan="20" class="req-cc-td">
                                                        <div class="req-cc-div">
                                                            <strong style="margin-left: 5px;">CC TO: </strong>
                                                            {{ (empty($ccToArray) || (count($ccToArray) === 1 && $ccToArray[0] === '-')) ? 'N/A' : implode(', ', $ccToArray) }}</u>

                                                        </div>
                                                    </td>
                                                </tr>


                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="20">

                                                        <div class="req-td-norecords">
                                                            <img src="{{ asset('images/Closed.webp') }}"
                                                                alt="No Records" class="req-img-norecords">

                                                            <h3 class="req-head-norecords">No records found
                                                            </h3>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        <!-- Modal for displaying record details -->
                                        @if($showModal)
                                        <div class="modal fade show" id="catologueModal" tabindex="-1" role="dialog"
                                            aria-labelledby="catologueModalLabel" style="display: block;"
                                            aria-hidden="false">

                                            <div class="modal-content" style="margin: 4% 0px;">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="catologueModalLabel">Closed Request
                                                        Details
                                                    </h5>
                                                    <button type="button" class="close p-2" wire:click="closeModal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="service-details">
                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>Employee ID:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>{{ $selectedRecord->emp_id ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>Requested By:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>
                                                                    {{ $selectedRecord->emp->first_name ?? 'N/A' }}
                                                                    {{ $selectedRecord->emp->last_name ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>Catalog Request:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>{{ $selectedRecord->category ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>Subject:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>{{ $selectedRecord->subject ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>Description:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>{{ $selectedRecord->description ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>Distributor:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>{{ $selectedRecord->distributor_name ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>Phone:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>{{ $selectedRecord->mobile ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>MailBox:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>{{ $selectedRecord->mail ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>Priority:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>{{ $selectedRecord->priority ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>Selected Equipment:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>{{ $selectedRecord->selected_equipment ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>Status:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>{{ $selectedRecord->status_code ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>Assigned to:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>{{ $selectedRecord->assign_to ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>

                                                        <div class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>CC to:</strong>
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                                <span>{{ $selectedRecord->cc_to ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>


                                                        <!-- Display files if available -->



                                                        <div id="modalFiles" class="row service-detail-item">
                                                            <div class="col-6">
                                                                <strong>Attachments:</strong>
                                                            </div>

                                                            <div class="col-6">
                                                                @php
                                                                $empImages = [];
                                                                $empFiles = [];

                                                                $fileDataArray = null;

                                                                if (isset($selectedRecord->file_paths) &&
                                                                is_string($selectedRecord->file_paths)) {
                                                                $fileDataArray =
                                                                json_decode($selectedRecord->file_paths, true);
                                                                } elseif (isset($selectedRecord->file_paths) &&
                                                                is_array($selectedRecord->file_paths)) {
                                                                $fileDataArray = $selectedRecord->file_paths;
                                                                }

                                                                // Separate empImages and files
                                                                if (is_array($fileDataArray)) {
                                                                foreach ($fileDataArray as $fileData) {
                                                                if (isset($fileData['mime_type'])) {
                                                                if (strpos($fileData['mime_type'], 'image/') === 0) {
                                                                $empImages[] = $fileData;
                                                                } else {
                                                                $empFiles[] = $fileData;
                                                                }
                                                                }
                                                                }
                                                                }
                                                                @endphp

                                                                <!-- Trigger Links -->
                                                                @if (count($empImages) > 1)
                                                                <a href="#"
                                                                    wire:click.prevent="showViewEmpImage({{ $selectedRecord->id }})"
                                                                    style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                                    View Images
                                                                </a>
                                                                @elseif (count($empImages) === 1)
                                                                <a href="#"
                                                                    wire:click.prevent="showViewEmpImage({{ $selectedRecord->id }})"
                                                                    style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                                    View Image
                                                                </a>
                                                                @endif

                                                                @if (count($empFiles) > 1)
                                                                <a href="#"
                                                                    wire:click.prevent="showViewEmpFile({{ $selectedRecord->id }})"
                                                                    style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                                    View Files
                                                                </a>
                                                                @elseif (count($empFiles) === 1)
                                                                <a href="#"
                                                                    wire:click.prevent="showViewEmpFile({{ $selectedRecord->id }})"
                                                                    style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                                    View File
                                                                </a>
                                                                @endif

                                                                @if (count($empImages) === 0 && count($empFiles) === 0)
                                                                <label for="">N/A</label>
                                                                @endif

                                                                {{-- View Images Modal --}}
                                                                @if ($showViewEmpImageDialog && $currentImageRequesId
                                                                === $selectedRecord->id)
                                                                <div class="modal custom-modal" tabindex="-1"
                                                                    role="dialog" style="display: block;">
                                                                    <div class="modal-dialog custom-modal-dialog custom-modal-dialog-centered modal-lg"
                                                                        role="document">
                                                                        <div class="modal-content custom-modal-content">
                                                                            <div
                                                                                class="modal-header custom-modal-header">
                                                                                <h5 class="modal-title view-file">
                                                                                    Attached Images</h5>
                                                                            </div>
                                                                            <div class="modal-body custom-modal-body">
                                                                                <div class="swiper-container">
                                                                                    <div class="swiper-wrapper">
                                                                                        @foreach ($empImages as $eImage)
                                                                                        <div class="swiper-slide">
                                                                                            <img src="data:{{ $eImage['mime_type'] }};base64,{{ $eImage['data'] }}"
                                                                                                class="img-fluid"
                                                                                                alt="Image">
                                                                                        </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="modal-footer custom-modal-footer">
                                                                                <button type="button" class="submit-btn"
                                                                                    wire:click.prevent="downloadImages({{ $selectedRecord->id }})">Download</button>
                                                                                <button type="button"
                                                                                    class="cancel-btn1"
                                                                                    wire:click="closeViewEmpImage">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-backdrop fade show blurred-backdrop">
                                                                </div>
                                                                @endif

                                                                {{-- View Files Modal --}}
                                                                @if ($showViewEmpFileDialog && $currentImageRequesId ===
                                                                $selectedRecord->id)
                                                                <div class="modal" tabindex="-1" role="dialog"
                                                                    style="display: block;">
                                                                    <div class="modal-dialog modal-dialog-centered modal-md"
                                                                        role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title viewfile">View
                                                                                    Files</h5>
                                                                            </div>
                                                                            <div class="modal-body"
                                                                                style="max-height: 400px; overflow-y: auto;">
                                                                                <ul class="list-group list-group-flush">
                                                                                    @foreach ($empFiles as $fileE)
                                                                                    <li>
                                                                                        <a href="data:{{ $fileE['mime_type'] }};base64,{{ $fileE['data'] }}"
                                                                                            download="{{ $fileE['original_name'] }}"
                                                                                            style="text-decoration: none; color: #007BFF; margin: 10px;font-size:13px">
                                                                                            {{ $fileE['original_name'] }}
                                                                                            <i class="fas fa-download"
                                                                                                style="margin-left:5px"></i>
                                                                                        </a>
                                                                                    </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                    class="cancel-btn1"
                                                                                    wire:click="closeViewEmpFile">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-backdrop fade show blurred-backdrop">
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>




                                                        <div id="modalFiles" class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                                <strong>IT Uploaded Files:</strong>
                                                            </div>


                                                            <div class="col-12 col-sm-6">
                                                                <!-- it file Paths -->
                                                                <td>
                                                                    @php
                                                                    $images = [];
                                                                    $files = [];



                                                                    $fileDataArray = null;

                                                                    if (isset($selectedRecord->cat_file_paths) &&
                                                                    is_string($selectedRecord->cat_file_paths))
                                                                    {
                                                                    $fileDataArray =
                                                                    json_decode($selectedRecord->cat_file_paths,
                                                                    true);
                                                                    } elseif (isset($selectedRecord->cat_file_paths) &&
                                                                    is_array($selectedRecord->cat_file_paths)) {
                                                                    $fileDataArray = $selectedRecord->cat_file_paths;
                                                                    }


                                                                    if (is_array($fileDataArray)) {
                                                                    foreach ($fileDataArray as $fileData) {
                                                                    if (isset($fileData['mime_type'])) {
                                                                    if (strpos($fileData['mime_type'], 'image/') === 0)
                                                                    {
                                                                    $images[] = $fileData;
                                                                    } else {
                                                                    $files[] = $fileData;
                                                                    }
                                                                    }
                                                                    }
                                                                    }
                                                                    @endphp




                                                                    @php

                                                                    $images = $images ?? [];
                                                                    $files = $files ?? [];
                                                                    @endphp
                                                                    <!-- Trigger Links -->
                                                                    @if (count($images) > 1)
                                                                    <a href="#"
                                                                        wire:click.prevent="showViewImage({{ $selectedRecord->id }})"
                                                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                                        View Images
                                                                    </a>
                                                                    @elseif (count($images) == 1)
                                                                    <a href="#"
                                                                        wire:click.prevent="showViewImage({{ $selectedRecord->id }})"
                                                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                                        View Image
                                                                    </a>
                                                                    @endif

                                                                    @if (count($files) > 1)
                                                                    <a href="#"
                                                                        wire:click.prevent="showViewFile({{ $selectedRecord->id }})"
                                                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;margin-left:15px;">
                                                                        View Files
                                                                    </a>
                                                                    @elseif (count($files) == 1)
                                                                    <a href="#"
                                                                        wire:click.prevent="showViewFile({{ $selectedRecord->id }})"
                                                                        style="text-decoration: none; color: #007BFF; font-size: 12px; text-transform: capitalize;">
                                                                        View File
                                                                    </a>
                                                                    @endif

                                                                    @if (count($images) == 0 && count($files) == 0)
                                                                    <label for="">N/A</label>
                                                                    @endif

                                                                    {{-- view file popup --}}
                                                                    @if ($showViewImageDialog && $currentImageRequesId
                                                                    ===
                                                                    $selectedRecord->id)
                                                                    <div class="modal custom-modal" tabindex="-1"
                                                                        role="dialog" style="display: block;">
                                                                        <div class="modal-dialog custom-modal-dialog custom-modal-dialog-centered modal-lg"
                                                                            role="document">
                                                                            <div
                                                                                class="modal-content custom-modal-content">
                                                                                <div
                                                                                    class="modal-header custom-modal-header">
                                                                                    <h5 class="modal-title view-file">
                                                                                        Attached
                                                                                        Images</h5>
                                                                                </div>
                                                                                <div
                                                                                    class="modal-body custom-modal-body">
                                                                                    <div class="swiper-container">
                                                                                        <div class="swiper-wrapper">
                                                                                            @foreach ($images as $image)
                                                                                            @php
                                                                                            $base64File =
                                                                                            $image['data'];
                                                                                            $mimeType =
                                                                                            $image['mime_type'];
                                                                                            @endphp
                                                                                            <div class="swiper-slide">
                                                                                                <img src="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                                                                    class="img-fluid"
                                                                                                    alt="Image">
                                                                                            </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div
                                                                                    class="modal-footer custom-modal-footer">
                                                                                    <button type="button"
                                                                                        class="submit-btn"
                                                                                        wire:click.prevent="downloadITImages({{ $selectedRecord->id }})">Download</button>
                                                                                    <button type="button"
                                                                                        class="cancel-btn1"
                                                                                        wire:click="closeViewImage">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="modal-backdrop fade show blurred-backdrop">
                                                                    </div>
                                                                    @endif


                                                                    @if ($showViewFileDialog && $currentImageRequesId
                                                                    ===
                                                                    $selectedRecord->id)
                                                                    <div class="modal" tabindex="-1" role="dialog"
                                                                        style="display: block;">
                                                                        <div class="modal-dialog modal-dialog-centered modal-md"
                                                                            role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title viewfile">
                                                                                        View Files
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="modal-body"
                                                                                    style="max-height: 400px; overflow-y: auto;">
                                                                                    <ul
                                                                                        class="list-group list-group-flush">

                                                                                        @foreach ($files as $file)

                                                                                        @php

                                                                                        $base64File = $file['data'];

                                                                                        $mimeType = $file['mime_type'];

                                                                                        $originalName =
                                                                                        $file['original_name'];

                                                                                        @endphp

                                                                                        <li>

                                                                                            <a href="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                                                                download="{{ $originalName }}"
                                                                                                style="text-decoration: none; color: #007BFF; margin: 10px;">

                                                                                                {{ $originalName }} <i
                                                                                                    class="fas fa-download"
                                                                                                    style="margin-left:5px"></i>

                                                                                            </a>

                                                                                        </li>

                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="cancel-btn1"
                                                                                        wire:click="closeViewFile">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="modal-backdrop fade show blurred-backdrop">
                                                                    </div>
                                                                    @endif

                                                                </td>


                                                            </div>
                                                        </div>



                                                        <div id="modalFiles" class="row service-detail-item">
                                                            <div class="col-12 col-sm-6">
                                                            </div>
                                                            <div class="col-12 col-sm-6">
                                                            </div>
                                                        </div>





                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        @endif
                                        @if($selectedRecord)
                                        <div class="modal-backdrop fade show"
                                            style="background-color: rgba(0, 0, 0, 0.7);"></div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-2 col-md-5 col-xs-12 ">

                <div class="row req-overview-main">
                    <div class="col-12">
                        <h5 class="mb-3 req-overview-head">
                            Overview</h5>
                    </div>

                </div>

                <div class="req-pro-overview-container">
                    <div class="req-pro-overview-card">

                        <div class="card text-white shadow-sm border-0 d-flex align-items-center justify-content-center"
                            style="width: 85px; height: 85px; border-radius: 50%;  background-color: #02114f;">
                            <div class="text-center p-3">
                                <h5 class="card-title mb-2 mt-5" style="font-size: 12px;"> Open</h5>
                                <p class="card-text mb-0">

                                    <span class="d-block mt-2 fs-4">
                                        <strong>{{$activeCount}}</strong>
                                    </span>
                                </p>
                            </div>
                        </div>

                        <i class="fas fa-arrow-down req-pro-arrow"></i>

                    </div>

                    <div class="req-pro-overview-card">

                        <div class="card text-white shadow-sm border-0 d-flex align-items-center justify-content-center"
                            style="width:85px; height: 85px; border-radius: 50%;  background-color: #02114f;">
                            <div class="text-center p-3">
                                <h5 class="card-title mb-2  mt-5" style="font-size: 12px;"> Pending</h5>
                                <p class="card-text mb-0">

                                    <span class="d-block mt-2 fs-4">
                                        <strong>{{$pendingCount}}</strong>
                                    </span>
                                </p>
                            </div>
                        </div>

                        <i class="fas fa-arrow-down req-pro-arrow"></i>

                    </div>

                    <div class="req-pro-overview-card">

                        <div class="card text-white shadow-sm border-0 d-flex align-items-center justify-content-center"
                            style="width: 85px; height: 85px; border-radius: 50%;  background-color: #02114f;">
                            <div class="text-center p-3">
                                <h5 class="card-title mb-2  mt-5" style="font-size: 12px;"> Inprogress</h5>
                                <p class="card-text mb-0">

                                    <span class="d-block mt-2 fs-4">
                                        <strong>{{$inprogressCount}}</strong>
                                    </span>
                                </p>
                            </div>
                        </div>

                        <i class="fas fa-arrow-down req-pro-arrow"></i>

                    </div>

                    <div class="req-pro-overview-card">

                        <div class="card text-white shadow-sm border-0 d-flex align-items-center justify-content-center"
                            style="width: 85px; height: 85px; border-radius: 50%;  background-color: #02114f;">
                            <div class="text-center p-3">
                                <h5 class="card-title mb-2  mt-5" style="font-size: 12px;"> Closed</h5>
                                <p class="card-text mb-0">

                                    <span class="d-block mt-2 fs-4">
                                        <strong>{{$closedCount}}</strong>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            @endif









            @if ($showPopup)
            @if ($activityLogs)
            <div class="popup-overlay">
                <div class="popup-content col-11 mx-auto">
                    <!-- Popup Header -->
                    <div class="popup-header d-flex justify-content-between align-items-center">
                        <h5 class="popup-title">Activity Logs -
                            @if ($catologueIDHeader)
                            <span style="color: #4A90E2;font-size: 12px;">{{ $catologueIDHeader }}</span>
                            <!-- Display the request ID of the first log -->
                            @else
                            <span>No Request ID</span> <!-- Fallback if no logs are present -->
                            @endif
                        </h5>
                        <button class="close-popup" wire:click="closePopup">×</button>
                    </div>

                    <!-- Popup Body -->
                    <div class="popup-body">
                        @if (is_countable($activityLogs) && count($activityLogs) > 0)

                        <!-- Header with Activity Count -->
                        <div class="activity-header d-flex justify-content-between mb-4">
                            <h5 class="text-lg font-semibold">Activities: {{ count($activityLogs) }}</h5>
                            <button wire:click="filterLogs('field-change')" class="filter-btn text-sm text-gray-500"
                                style="font-size: 13px;">
                                <i class="fas fa-filter"></i> Filter by Field Change
                            </button>

                        </div>

                        <!-- Activity Log Entries -->
                        <div class="d-flex flex-column">
                            @foreach ($activityLogs as $index => $log)
                            <div class="activity-entry bg-white p-4 rounded-lg shadow-md mb-4">
                                <div class="log-header">
                                    <div class="log-user d-flex align-items-center">
                                        <!-- Display initials -->
                                        <span class="initials text-lg font-bold">
                                            {{ $employeeInitials[$index] ?? '' }}
                                        </span>
                                        <span class="user-name ms-4 text-sm text-gray-600">
                                            {{ ucwords(strtolower( $log->performed_by ?? 'Unknown')) }}
                                        </span>
                                    </div>
                                    <div class="timestamp text-sm text-gray-500">
                                        Field changes <span style="font-size: 15px;">&#8226;</span>
                                        {{ $log->created_at ? $log->created_at->format('d-m-Y H:i:s') : 'N/A' }}
                                    </div>
                                </div>

                                <!-- Log Details -->
                                <div class="log-details mt-2">
                                    @if ($log->action && $log->details)
                                    <div class="logAction text-sm text-gray-800">
                                        <div class="logLabel">
                                            {{ $log->action }}
                                        </div>
                                        <div class="logValue">
                                            {{ $log->details }}
                                        </div>
                                    </div>
                                    @endif
                                    @if ($log->assigned_to)
                                    <div class="log-sub-details mt-2 text-sm">
                                        <div class="logLabel">Assigned to
                                        </div>
                                        <div class="logValue">
                                            {{ $log->assigned_to }}
                                        </div>
                                    </div>
                                    @endif

                                    @if ($log->impact)
                                    <div class="log-sub-details mt-2 text-sm">
                                        <div class="logLabel">Impact</div>
                                        <div class="logValue">
                                            {{ $log->impact }}
                                        </div>
                                    </div>
                                    @endif

                                    @if ($log->opened_by)
                                    <div class="log-sub-details mt-2 text-sm">
                                        <div class="logLabel">Opened by</div>
                                        <div class="logValue">
                                            {{ $log->opened_by }}
                                        </div>
                                    </div>
                                    @endif

                                    @if ($log->priority)
                                    <div class="log-sub-details mt-2 text-sm">
                                        <div class="logLabel">Priority</div>
                                        <div class="logValue">
                                            {{ $log->priority }}
                                        </div>
                                    </div>
                                    @endif

                                    @if ($log->state)
                                    <div class="log-sub-details mt-2 text-sm">
                                        <div class="logLabel">State</div>
                                        <div class="logValue">
                                            {{ $log->state }}
                                        </div>
                                    </div>
                                    @endif



                                    @if (!empty($log->attachments))
                                    <div class="mt-2 text-sm">
                                        @php
                                        $images = [];
                                        $files = [];
                                        $fileDataArray = null;

                                        // Check if attachments are a JSON string or an array
                                        if (is_string($log->attachments)) {
                                        $fileDataArray = json_decode($log->attachments, true);
                                        } elseif (is_array($log->attachments)) {
                                        $fileDataArray = $log->attachments;
                                        }

                                        // Ensure it's an array before processing
                                        if (is_array($fileDataArray)) {
                                        // Separate images and files
                                        foreach ($fileDataArray as $fileData) {
                                        if (isset($fileData['mime_type'])) {
                                        if (strpos($fileData['mime_type'], 'image/') === 0) {
                                        $images[] = $fileData;
                                        } else {
                                        $files[] = $fileData;
                                        }
                                        }
                                        }
                                        }
                                        @endphp

                                        <!-- Display Images in 3 per row -->
                                        <div class="row">
                                            @foreach ($images as $image)
                                            @php
                                            $base64File = $image['data'];
                                            $mimeType = $image['mime_type'];
                                            @endphp
                                            <div class="col-4 mb-3">
                                                <img src="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                    class="img-fluid" alt="Image" style="width: 100%; height: auto;">
                                            </div>
                                            @endforeach
                                        </div>

                                        <!-- Display Files in 3 per row -->
                                        <div class="row mt-4">
                                            @foreach ($files as $file)
                                            @php
                                            $base64File = $file['data'];
                                            $mimeType = $file['mime_type'];
                                            $originalName = $file['original_name'];
                                            @endphp
                                            <div class="col-4 mb-3">
                                                <a href="data:{{ $mimeType }};base64,{{ $base64File }}"
                                                    download="{{ $originalName }}"
                                                    style="text-decoration: none; color: #007BFF; display: block;">
                                                    {{ $originalName }} <i class="fas fa-download"
                                                        style="margin-left: 5px;"></i>
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>

                                        <!-- Display N/A if no images or files -->
                                        @if (count($images) == 0 && count($files) == 0)
                                        <label for="">N/A</label>
                                        @endif
                                    </div>
                                    @endif
                                    <!-- Add more log details as needed -->
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-center text-gray-500">No activity logs found.</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endif

        </div>









        <!-- jQuery and Bootstrap Bundle (includes Popper) -->

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



        <script>
        function showTab(tab) {

            document.querySelectorAll('.req-pro-tab-content').forEach(el => el.style.display = 'none');

            document.getElementById(tab).style.display = 'block';

        }



        document.addEventListener("DOMContentLoaded", () => {
            showTab('{{ $activeTab }}'); // Show the initially active tab
        });

        Livewire.on('tabSwitched', tab => {
            showTab(tab);
        });




        document.addEventListener('livewire:load', function() {
            var swiper = new Swiper('.swiper-container', {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });

        //for to remove the space after session message
        </script>

    </div>
