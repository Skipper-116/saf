@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <!-- left side should contain title while right side should have a button to add an application-->
                    <span class="float-start">{{ __('Applications') }}</span>
                    <a data-bs-toggle="modal" data-bs-target="#applicationModal" class="btn btn-link btn-primary float-end">Add Application</a>
                </div>

                <div class="card-body">
                    <table></table>
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
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        function populateDropdown(url, dropdownSelector, defaultOption) {
            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    var dropdown = $(dropdownSelector);
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

        function populateDropdownOnChange(sourceSelector, urlPattern, targetSelector, defaultOption) {
            $(sourceSelector).on('change', function() {
                var id = $(this).val();
                $.ajax({
                    url: urlPattern.replace(':id', id),
                    method: 'GET',
                    success: function(data) {
                        var dropdown = $(targetSelector);
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

        populateDropdownOnChange('#county', '/sub_counties_by_county/:id', '#subCounty', 'Select Sub-County');
        populateDropdownOnChange('#subCounty', '/locations_by_sub_county/:id', '#location', 'Select Location');
        populateDropdownOnChange('#location', '/sub_locations_by_location/:id', '#subLocation', 'Select Sub-Location');
        populateDropdownOnChange('#subLocation', '/villages_by_sub_location/:id', '#village', 'Select Village');

        $('#applicationModal').on('show.bs.modal', function(e) {
            populateDropdown('/counties', '#county', 'Select County');
            populateDropdown('/genders', '#sex_id', 'Select');
            populateDropdown('/marital_statuses', '#maritalStatus', 'Select');
            populateDropdown('/indentifier_types', '#idType', 'Select');
            populateDropdown('/fetch_users', '#nameOfOfficer', 'Select Officer');
            populateDropdown('/fetch_social_programs', '#socialAssistanceProgramme', 'Select Programme');
        });
    });

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

            // Send AJAX request
            $.ajax({
                url: '/submit_application', // Replace with your actual endpoint
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success
                    alert('Application submitted successfully!');
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