@extends('user.shell')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">



    <form action="  " method="POST">

        @csrf
        <div class="container my-4">
            <div class="text-center mb-4">
                <img src="logo-placeholder.png" alt="Logo" class="img-fluid" style="height: 100px;">
                <h1 class="h4">BASIC EDUCATION ENROLLMENT FORM</h1>
                <p class="text-danger">THIS FORM IS NOT FOR SALE</p>
            </div>

            <!-- Learner Information -->
            <div class="border p-3 mb-4">
                <h5 class="mb-3">Learner Information</h5>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="last-name" class="form-label">Last Name</label>
                        <input type="text" id="last-name" name="last_name" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="first-name" class="form-label">First Name</label>
                        <input type="text" id="first-name" name="first_name" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="middle-name" class="form-label">Middle Name</label>
                        <input type="text" id="middle-name" name="middle_name" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="extension-name" class="form-label">Extension Name (e.g., Jr., III)</label>
                        <input type="text" id="extension-name" name="extension_name" class="form-control">
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <label for="birthdate" class="form-label">Birthdate</label>
                        <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" name="gender" class="form-select" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="place-of-birth" class="form-label">Place of Birth</label>
                        <input type="text" id="place-of-birth" name="place_of_birth" class="form-control" required>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <label for="learner-reference-number" class="form-label">Learner Reference Number</label>
                        <input type="text" id="learner-reference-number" name="learner_reference_number"
                            class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="psa-birth-certificate-number" class="form-label">PSA Birth Certificate
                            Number</label>
                        <input type="text" id="psa-birth-certificate-number" name="psa_birth_certificate_number"
                            class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="mother-tongue" class="form-label">Mother Tongue</label>
                        <input type="text" id="mother-tongue" name="mother_tongue" class="form-control">
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <label for="indigenous-status" class="form-label">Indigenous Status</label>
                        <select id="indigenous-status" name="indigenous_status" class="form-select">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="indigenous-community" class="form-label">Indigenous Community (Optional)</label>
                        <input type="text" id="indigenous-community" name="indigenous_community"
                            class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="disability-status" class="form-label">Disability Status</label>
                        <select id="disability-status" name="disability_status" class="form-select">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <label for="disability-type" class="form-label">Disability Type (Optional)</label>
                        <input type="text" id="disability-type" name="disability_type" class="form-control"
                            placeholder="e.g., Visual Impairment">
                    </div>
                    <div class="col-md-4">
                        <label for="4ps-beneficiary" class="form-label">4Ps Beneficiary</label>
                        <select id="4ps-beneficiary" name="4ps_beneficiary" class="form-select">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="4ps-household-id" class="form-label">4Ps Household ID (Optional)</label>
                        <input type="text" id="4ps-household-id" name="4ps_household_id" class="form-control">
                    </div>
                </div>
            </div>


            <!-- Address Information -->
            <div class="border p-3 mb-4">
                <h5 class="mb-3">Address Information</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="current-house-number" class="form-label">Current House Number</label>
                        <input type="text" id="current-house-number" name="current_house_number"
                            class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="current-street" class="form-label">Current Street</label>
                        <input type="text" id="current-street" name="current_street" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="current-barangay" class="form-label">Current Barangay</label>
                        <input type="text" id="current-barangay" name="current_barangay" class="form-control">
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <label for="current-city" class="form-label">Current City</label>
                        <input type="text" id="current-city" name="current_city" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="current-province" class="form-label">Current Province</label>
                        <input type="text" id="current-province" name="current_province" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="current-country" class="form-label">Current Country</label>
                        <input type="text" id="current-country" name="current_country" class="form-control">
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <label for="current-zip-code" class="form-label">Current ZIP Code</label>
                        <input type="text" id="current-zip-code" name="current_zip_code" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="same-as-current" class="form-label">Permanent Address Same as Current?</label>
                        <input type="checkbox" id="same-as-current" name="permanent_same_as_current"
                            class="form-check-input" onchange="togglePermanentAddressFields()">
                    </div>
                </div>

                <!-- Permanent Address -->
                <div id="permanent-address" class="mt-3">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="permanent-house-number" class="form-label">Permanent House Number</label>
                            <input type="text" id="permanent-house-number" name="permanent_house_number"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="permanent-street" class="form-label">Permanent Street</label>
                            <input type="text" id="permanent-street" name="permanent_street" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="permanent-barangay" class="form-label">Permanent Barangay</label>
                            <input type="text" id="permanent-barangay" name="permanent_barangay"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <label for="permanent-city" class="form-label">Permanent City</label>
                            <input type="text" id="permanent-city" name="permanent_city" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="permanent-province" class="form-label">Permanent Province</label>
                            <input type="text" id="permanent-province" name="permanent_province"
                                class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="permanent-country" class="form-label">Permanent Country</label>
                            <input type="text" id="permanent-country" name="permanent_country" class="form-control">
                        </div>
                    </div>
                    <div class="row g-3 mt-3">
                        <div class="col-md-4">
                            <label for="permanent-zip-code" class="form-label">Permanent ZIP Code</label>
                            <input type="text" id="permanent-zip-code" name="permanent_zip_code"
                                class="form-control">
                        </div>
                    </div>
                </div>


            </div>

            <script>
                function togglePermanentAddressFields() {
                    const isChecked = document.getElementById("same-as-current").checked;
                    const permanentAddressFields = document.getElementById("permanent-address");

                    permanentAddressFields.style.display = isChecked ? "none" : "block";
                }

                // Initialize the state based on the checkbox value on page load
                window.onload = togglePermanentAddressFields;
            </script>


            <!-- Guardian Information -->
            <div class="border p-3 mb-4">
                <h5 class="mb-3">Guardian Information</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="father-name" class="form-label">Father's Name</label>
                        <input type="text" id="father-name" name="father_name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="father-contact" class="form-label">Father's Contact Number</label>
                        <input type="text" id="father-contact" name="father_contact_number" class="form-control">
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="mother-name" class="form-label">Mother's Maiden Name</label>
                        <input type="text" id="mother-name" name="mother_maiden_name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="mother-contact" class="form-label">Mother's Contact Number</label>
                        <input type="text" id="mother-contact" name="mother_contact_number" class="form-control">
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="guardian-name" class="form-label">Legal Guardian's Name</label>
                        <input type="text" id="guardian-name" name="legal_guardian_name" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="guardian-contact" class="form-label">Guardian's Contact Number</label>
                        <input type="text" id="guardian-contact" name="guardian_contact_number" class="form-control">
                    </div>
                </div>
            </div>
            <!-- Enrollment Information -->
            <div class="border p-3 mb-4">
                <h5 class="mb-3">Enrollment Information</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="school-year" class="form-label">School Year</label>
                        <input type="text" id="school-year" name="school_year" class="form-control"
                            placeholder="YYYY" required>
                    </div>
                    <div class="col-md-4">
                        <label for="grade-level" class="form-label">Grade Level</label>
                        <input type="text" id="grade-level" name="grade_level" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="learning-modality" class="form-label">Preferred Learning Modality</label>
                        <select id="learning-modality" name="learning_modality" class="form-select">
                            <option value="Face-to-face">Face-to-face</option>
                            <option value="Modular (Print)">Modular (Print)</option>
                            <option value="Modular (Digital)">Modular (Digital)</option>
                            <option value="Online">Online</option>
                            <option value="Blended">Blended</option>
                            <option value="Radio-based Instruction">Radio-based Instruction</option>
                            <option value="Educational TV">Educational TV</option>
                            <option value="Homeschooling">Homeschooling</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <label for="last-grade-level-completed" class="form-label">Last Grade Level Completed
                            (Optional)</label>
                        <input type="text" id="last-grade-level-completed" name="last_grade_level_completed"
                            class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="last-school-year-completed" class="form-label">Last School Year Completed
                            (Optional)</label>
                        <input type="text" id="last-school-year-completed" name="last_school_year_completed"
                            class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="last-school-attended" class="form-label">Last School Attended (Optional)</label>
                        <input type="text" id="last-school-attended" name="last_school_attended"
                            class="form-control">
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-md-4">
                        <label for="last-school-id" class="form-label">Last School ID (Optional)</label>
                        <input type="text" id="last-school-id" name="last_school_id" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="track" class="form-label">Track (Optional, for SHS)</label>
                        <input type="text" id="track" name="track" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="strand" class="form-label">Strand (Optional, for SHS)</label>
                        <input type="text" id="strand" name="strand" class="form-control">
                    </div>
                </div>
            </div>


            <!-- Semester Information -->
            <div class="border p-3 mb-4">
                <h5 class="mb-3">Semester Information</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="semester" class="form-label">Semester</label>
                        <select id="semester" name="semester" class="form-select">
                            <option value="1st">1st Semester</option>
                            <option value="2nd">2nd Semester</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Signatures -->
            <div class="border p-3 mb-4">
                <h5 class="mb-3">Signatures</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="parent-signature" class="form-label">Parent/Guardian's Signature</label>
                        <input type="text" id="parent-signature" name="parent_signature" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="signature-date" class="form-label">Signature Date</label>
                        <input type="date" id="signature-date" name="signature_date" class="form-control">
                    </div>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">Submit Enrollment</button>
            </div>
        </div>
    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
