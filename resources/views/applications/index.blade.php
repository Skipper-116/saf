@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-span-full">
            <div class="card container-fluid">
                <div class="card-header col-span-full">
                    <!-- left side should contain title while right side should have a button to add an application-->
                    <span class="float-start">{{ __('Applications') }}</span>
                    <a data-bs-toggle="modal" data-bs-target="#applicationModal" class="btn btn-link btn-primary float-end">Add Application</a>
                </div>

                <div class="card-body col-span-full">
                    <!-- echo the applications array here -->
                    <table class="table table-striped display compact wrap table-bordered col-span-full" id='applicationsTable' style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Applicant Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Village</th>
                                <th>Application Date</th>
                                <th>Social Assistance Programme</th>
                                <th>Information Collected By</th>
                                <th>Date Collected</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $application->applicant_name }}</td>
                                <td>{{ $application->age }}</td>
                                <td>{{ $application->gender }}</td>
                                <td>{{ $application->village }}</td>
                                <td>{{ $application->application_date }}</td>
                                <td>{{ $application->social_programmes }}</td>
                                <td>{{ $application->collected_by }}</td>
                                <td>{{ $application->collection_date }}</td>
                                <td> {{ $application-> approved }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                        <button type="button" class="btn btn-primary" onclick="viewApplication({{ json_encode($application) }})">View</button>
                                        @if($application->approved == "Pending Approval")
                                        <button type="button" class="btn btn-warning" onclick="editApplication({{ json_encode($application) }})">Edit</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="applicationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="applicationModal" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Application</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" novalidate onsubmit="submitForm(event)">
                        <!-- Applicant's Details -->
                        <h5>Applicant’s Details</h5>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label for="applicationDate" class="form-label">Application Date<span class="text-danger text-lg">*</span></label>
                                    <input type="date" class="form-control" id="applicationDate" required>
                                </div>
                                <div class="mb-2">
                                    <label for="fullName" class="form-label">Full Name<span class="text-danger text-lg">*</span></label>
                                    <input type="text" class="form-control" id="fullName" required>
                                </div>
                                <div class="mb-2">
                                    <label for="sex" class="form-label">Sex<span class="text-danger text-lg">*</span></label>
                                    <select class="form-select" id="sex_id" required>
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="age" class="form-label">Age<span class="text-danger text-lg">*</span></label>
                                    <input type="number" class="form-control" id="age" required>
                                </div>
                                <div class="mb-2">
                                    <label for="maritalStatus" class="form-label">Marital Status<span class="text-danger text-lg">*</span></label>
                                    <select class="form-select" id="maritalStatus" required>
                                        <option value="">Select Marital Status</option>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="idNumber" class="form-label">Identity Types<span class="text-danger text-lg">*</span></label>
                                    <select class="form-select" id="idType" required>
                                        <option value="">Select Identity Type</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="idNumber" class="form-label">Identity Number<span class="text-danger text-lg">*</span></label>
                                    <input type="text" class="form-control" id="idNumber" required />
                                </div>
                                <div class="mb-2">
                                    <label for="county" class="form-label">County<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="county" required>
                                        <option value="">Select County</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="subCounty" class="form-label">Sub-County<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="subCounty" disabled required>
                                        <option value="">Select Sub-County</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label for="location" class="form-label">Location<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="location" disabled required>
                                        <option value="">Select Location</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="subLocation" class="form-label">Sub-Location<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="subLocation" disabled required>
                                        <option value="">Select Sub-Location</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="village" class="form-label">Village<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="village" disabled required>
                                        <option value="">Select Village</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="postalAddress" class="form-label">Postal Address</label>
                                    <textarea class="form-control" id="postalAddress" rows="3"></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="physicalAddress" class="form-label">Physical Address</label>
                                    <textarea class="form-control" id="physicalAddress" rows="3"></textarea>
                                </div>
                                <div class="mb-2">
                                    <label for="telephoneContacts" class="form-label">Telephone Contacts</label>
                                    <textarea class="form-control" id="telephoneContacts" rows="3" placeholder="comma separated"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label for="socialAssistanceProgramme" class="form-label">Social Assistance Programme<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="socialAssistanceProgramme" required multiple>
                                        <option value="">Select Programme</option>
                                    </select>
                                </div>
                                <h5>Information collected by:<span class="text-danger text-lg">*</span></h5>
                                <div class="mb-2">
                                    <label for="nameOfOfficer" class="form-label">Name</label>
                                    <select class="form-control" id="nameOfOfficer" required>
                                        <option value="">Select Officer</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="dateCollected" class="form-label">Date Collected</label>
                                    <input type="date" class="form-control" id="dateCollected" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- View Application Modal -->
    <div class="modal fade" id="viewApplicationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewApplicationModal" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">View Application</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" id="applicationId">
                            <h5 class="fw-bold">Applicant’s Details</h5>
                            <h6 class="fw-semibold">Full Name: <span id="applicantName" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Age: <span id="applicantAge" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Marital Status: <span id="applicantMaritalStatus" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Gender: <span id="applicantGender" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Postal Address: <span id="applicantPostalAddress" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Physical Address: <span id="applicantPhysicalAddress" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Telephone Contacts: <span id="applicantTelephoneContacts" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Identity: <span id="applicantIdentity" class="fw-normal"></span></h6>
                        </div>
                        <div class="col-md-4">
                            <h5 class="fw-bold">Application Details</h5>
                            <h6 class="fw-semibold">Application Date: <span id="applicantApplicationDate" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">County: <span id="applicantCounty" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Sub-County: <span id="applicantSubCounty" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Location: <span id="applicantLocation" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Sub-Location: <span id="applicantSubLocation" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Village: <span id="applicantVillage" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Social Assistance Programme: <span id="applicantSocialAssistanceProgramme" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Information Collected By: <span id="applicantInformationCollectedBy" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Designation: <span id="applicantDesignation" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Date Collected: <span id="applicantDateCollected" class="fw-normal"></span></h6>
                        </div>
                        <div class="col-md-4" id="approverDetails">
                            <h5 class="fw-bold">Approver Details</h5>
                            <h6 class="fw-semibold">Approver: <span id="approverName" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Designation: <span id="approverDesignation" class="fw-normal"></span></h6>
                            <h6 class="fw-semibold">Approval Date: <span id="approvalDate" class="fw-normal"></span></h6>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="approvalFooter">
                    <button type="button" class="btn btn-danger float-start mr-10" onclick="alert('Not currently implemented plus it is too dangerous')">Delete</button>
                    <button type="button" class="btn btn-success float-end" onclick="approveApplication(event)">Approve</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Application Modal -->
    <div class="modal fade" id="editApplicationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editApplicationModal" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Application</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form autocomplete="off" novalidate onsubmit="updateForm(event)">
                        <!-- The only editable items will be the application_date, county, sub_county, location, sub_location, village, social_programmes, collected_by, collection_date -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div>
                                    <input type="hidden" name="applicationId">
                                </div>
                                <div class="mb-2">
                                    <label for="applicationDate" class="form-label">Application Date<span class="text-danger text-lg">*</span></label>
                                    <input type="date" class="form-control" id="applicationDate" required>
                                </div>
                                <div class="mb-2">
                                    <label for="county" class="form-label">County<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="county" required>
                                        <option value="">Select County</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="subCounty" class="form-label">Sub-County<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="subCounty" disabled required>
                                        <option value="">Select Sub-County</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="location" class="form-label">Location<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="location" disabled required>
                                        <option value="">Select Location</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="subLocation" class="form-label">Sub-Location<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="subLocation" disabled required>
                                        <option value="">Select Sub-Location</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="village" class="form-label">Village<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="village" disabled required>
                                        <option value="">Select Village</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="socialAssistanceProgramme" class="form-label">Social Assistance Programme<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="socialAssistanceProgramme" required multiple>
                                        <option value="">Select Programme</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="nameOfOfficer" class="form-label">Name of Collection Officer<span class="text-danger text-lg">*</span></label>
                                    <select class="form-control" id="nameOfOfficer" required>
                                        <option value="">Select Officer</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="dateCollected" class="form-label">Date Collected<span class="text-danger text-lg">*</span></label>
                                    <input type="date" class="form-control" id="dateCollected" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        new DataTable('#applicationsTable', {
            responsive: true
        });

        $('#applicationModal').on('show.bs.modal', function(e) {
            triggerDropdownOnChange('#applicationModal');
            triggerDropdowns('#applicationModal');
        });
        $('#editApplicationModal').on('show.bs.modal', function(e) {
            triggerDropdownOnChange('#editApplicationModal');
            triggerDropdowns('#editApplicationModal');
        });
    });

    function triggerDropdownOnChange(modalSelector) {
        populateDropdownOnChange('#county', '/sub_counties_by_county/:id', '#subCounty', 'Select Sub-County', modalSelector);
        populateDropdownOnChange('#subCounty', '/locations_by_sub_county/:id', '#location', 'Select Location', modalSelector);
        populateDropdownOnChange('#location', '/sub_locations_by_location/:id', '#subLocation', 'Select Sub-Location', modalSelector);
        populateDropdownOnChange('#subLocation', '/villages_by_sub_location/:id', '#village', 'Select Village', modalSelector);
    }

    function triggerDropdowns(modalSelector) {
        populateDropdown('/counties', '#county', 'Select County', modalSelector);
        populateDropdown('/genders', '#sex_id', 'Select', modalSelector);
        populateDropdown('/marital_statuses', '#maritalStatus', 'Select', modalSelector);
        populateDropdown('/indentifier_types', '#idType', 'Select', modalSelector);
        populateDropdown('/fetch_users', '#nameOfOfficer', 'Select Officer', modalSelector);
        populateDropdown('/fetch_social_programs', '#socialAssistanceProgramme', 'Select Programme', modalSelector);
    }

    function populateDropdown(url, dropdownSelector, defaultOption, modalSelector) {
        $.ajax({
            url: url,
            method: 'GET',
            success: function(data) {
                var dropdown = $(modalSelector).find(dropdownSelector);
                dropdown.empty();
                dropdown.append('<option value="">' + defaultOption + '</option>');
                $.each(data, function(key, item) {
                    if (item.designation !== undefined) {
                        dropdown.append('<option value="' + item.id + '">' + item.name + ' ~ ' + item.designation + '</option>');
                        return;
                    }
                    dropdown.append('<option value="' + item.id + '">' + item.name + '</option>');
                });
            },
            error: function(error) {
                console.log('Error fetching data from ' + url + ':', error);
            }
        });
    }

    function populateDropdownOnChange(sourceSelector, urlPattern, targetSelector, defaultOption, modalSelector) {
        $(modalSelector).find(sourceSelector).on('change', function() {
            var id = $(this).val();
            $.ajax({
                url: urlPattern.replace(':id', id),
                method: 'GET',
                success: function(data) {
                    var dropdown = $(modalSelector).find(targetSelector);
                    dropdown.empty();
                    dropdown.append('<option value="">' + defaultOption + '</option>');
                    $.each(data, function(key, item) {
                        dropdown.append('<option value="' + item.id + '">' + item.name + '</option>');
                    });
                    dropdown.prop('disabled', false);
                },
                error: function(error) {
                    console.log('Error fetching data:', error);
                }
            });
        });
    }

    function submitForm(event) {
        event.preventDefault(); // Prevent the default form submission

        // Validate required fields
        let isValid = true;
        $('#applicationForm .form-control').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (isValid) {
            // Gather form data
            let formData = {
                applicationDate: $('#applicationDate').val(),
                fullName: $('#fullName').val(),
                sex: $('#sex_id').val(),
                age: $('#age').val(),
                maritalStatus: $('#maritalStatus').val(),
                idType: $('#idType').val(),
                idNumber: $('#idNumber').val(),
                village: $('#village').val(),
                postalAddress: $('#postalAddress').val(),
                physicalAddress: $('#physicalAddress').val(),
                telephoneContacts: $('#telephoneContacts').val(),
                socialAssistanceProgramme: $('#socialAssistanceProgramme').val(),
                nameOfOfficer: $('#nameOfOfficer').val(),
                dateCollected: $('#dateCollected').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            // we need to ensure the dates are not in the future
            // we need to ensure application date is less or equal to date collected

            if (new Date(formData.applicationDate) > new Date()) {
                alert('Application date cannot be in the future.');
                return;
            }

            if (new Date(formData.dateCollected) > new Date()) {
                alert('Date collected cannot be in the future.');
                return;
            }

            if (new Date(formData.applicationDate) > new Date(formData.dateCollected)) {
                alert('Application date cannot be greater than date collected.');
                return;
            }

            // Send AJAX request
            $.ajax({
                url: '/submit_application', // Replace with your actual endpoint
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success
                    alert('Application submitted successfully!');
                    $('#applicationModal').modal('hide');
                    // refresh the page
                    location.reload();
                },
                error: function(error) {
                    // Handle error
                    alert('An error occurred. Please try again.');
                }
            });
        } else {
            alert('Please fill in all required fields.');
        }
    }

    function viewApplication(application) {
        $('#applicantName').text(application.applicant_name);
        $('#applicantAge').text(application.age);
        $('#applicantMaritalStatus').text(application.marital_status);
        $('#applicantGender').text(application.gender);
        $('#applicantCounty').text(application.county);
        $('#applicantSubCounty').text(application.sub_county);
        $('#applicantLocation').text(application.location);
        $('#applicantSubLocation').text(application.sub_location);
        $('#applicantVillage').text(application.village);
        $('#applicantPostalAddress').text(application.postal_address);
        $('#applicantPhysicalAddress').text(application.physical_address);
        $('#applicantTelephoneContacts').text(application.telephone_contacts);
        $('#applicantIdentity').text(application.identifiers);
        $('#applicantApplicationDate').text(application.application_date);
        $('#applicantSocialAssistanceProgramme').text(application.social_programmes);
        $('#applicantInformationCollectedBy').text(application.collected_by);
        $('#applicantDesignation').text(application.designation);
        $('#applicantDateCollected').text(application.collection_date);
        $('#approverName').text(application.approved_by);
        $('#approverDesignation').text(application.approver_designation);
        $('#approvalDate').text(application.approved_date);
        $('#viewApplicationModal').modal('show');
        //add application id to the hidden input field
        $('#applicationId').val(application.id);
        // hide the approval footer if the application has been approved
        if (application.approved_by !== '') {
            $('#approvalFooter').hide();
        } else {
            $('#approvalFooter').show();
        }
    }

    function approveApplication(event) {
        event.preventDefault();
        let applicationId = $('#applicationId').val();
        $.ajax({
            url: '/approve_application/' + applicationId,
            method: 'PUT',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Handle success
                alert('Application approved successfully!');
                $('#viewApplicationModal').modal('hide');
                // refresh the page
                location.reload();
            },
            error: function(error) {
                // Handle error
                alert('An error occurred. Please try again.');
            }
        });
    }

    function editApplication(application) {
        // update the visible fields with the application ID
        $('#editApplicationModal input[name="applicationId"]').val(application.id);
        $('#editApplicationModal').modal('show');
    }

    function updateForm(event) {
        event.preventDefault(); // Prevent the default form submission

        // Validate required fields
        let isValid = true;
        $('#editApplicationForm .form-control').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        // this will selcect values from editApplicationModal
        if (isValid) {
            // Gather form data
            let formData = {
                id: $('#editApplicationModal input[name="applicationId"]').val(),
                applicationDate: $('#editApplicationModal #applicationDate').val(),
                village: $('#editApplicationModal #village').val(),
                socialAssistanceProgramme: $('#editApplicationModal #socialAssistanceProgramme').val(),
                nameOfOfficer: $('#editApplicationModal #nameOfOfficer').val(),
                dateCollected: $('#editApplicationModal #dateCollected').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            if (new Date(formData.applicationDate) > new Date()) {
                alert('Application date cannot be in the future.');
                return;
            }

            if (new Date(formData.dateCollected) > new Date()) {
                alert('Date collected cannot be in the future.');
                return;
            }

            if (new Date(formData.applicationDate) > new Date(formData.dateCollected)) {
                alert('Application date cannot be greater than date collected.');
                return;
            }


            console.log(formData);

            // Send AJAX request
            $.ajax({
                url: '/update_application/' + formData.id,
                data: formData,
                method: 'PUT',
                success: function(response) {
                    // Handle success
                    $('#editApplicationModal').modal('hide');
                    // refresh the page
                    location.reload();
                },
                error: function(error) {
                    // Handle error
                    alert('An error occurred. Please try again.');
                }
            });
        } else {
            alert('Please fill in all required fields.');
        }
    }
</script>
@endsection