@include('home.header')
<div class="row">
	<div class="col col-lg">
	<div class="card">
                                    <div class="card-header">
                                        <strong>New Admission</strong>
                                    </div>
                                    <div class="card-body card-block">
                                        <form id="new-admission" action="" method="post" class="form-horizontal">
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-email" class=" form-control-label">Student's Name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
													<div class="row">
													<div class="col-lg-6">
                                                    <input type="text" name="student_first_name" placeholder="First Name" class="form-control">
													</div>
													<div class="col-lg-6">
                                                    <input type="text" name="student_last_name" placeholder="Last Name" class="form-control">
													</div>
													</div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Date of Birth</label>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <input type="date" id="hf-password" name="dob" class="form-control">
                                                </div>
												<div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Date of Admission</label>
                                                </div>
                                                <!--<div class="col-12 col-md-3">
                                                    <input type="date" id="hf-password" name="admission_date" class="form-control">
                                                </div>-->
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class="form-control-label">Father's Name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="hf-password" name="father_name" placeholder="Enter Father's Full Name" class="form-control">
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Mother's Name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="hf-password" name="mother_name" placeholder="Enter Mother's Full Name" class="form-control">
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Father's Mobile Number</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="tel" id="hf-password" name="father_mobile" placeholder="Enter Father's Mobile Number" class="form-control">
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Mother's Mobile Number</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="tel" id="hf-password" name="mother_mobile" placeholder="Enter Mother's Mobile Number" class="form-control">
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Home Address</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <textarea name="home_address" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
											<h5>Optional Fields</h5><br>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class="form-control-label">Enter Landline Number<br></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="tel" id="hf-password" name="landline_contact" placeholder="Enter Landline Telephone Number" class="form-control">
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class="form-control-label">Guardian Full Name<br></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="tel" id="hf-password" name="guardian_full_name" placeholder="Enter Guardian Full Name" class="form-control">
                                                </div>
                                            </div>
											<div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class="form-control-label">Guardian Mobile Number</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="tel" id="hf-password" name="guardian_mobile" placeholder="Enter Guardian Mobile Number" class="form-control">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success" onclick="addData()">
                                            <i class="fa fa-check-circle"></i> Submit
                                        </button>
                                    </div>
                                </div>
	</div>
</div>
<script>
function addData(){
jQuery.ajax({
      type: 'GET',
      url: "{{getHomeURL()}}/newAdmission",
      data: jQuery("#new-admission").serialize(),
      success: function(response) { alert(response); }
});
}
</script>
@include('home.footer')