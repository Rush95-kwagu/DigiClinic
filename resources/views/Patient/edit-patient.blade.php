@extends('layout')
@section('user_content')
@section('title')
Repertoire patient
@endsection
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
 $centre_id=Session::get('centre_id');
?>


          <!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Edit Patient Details</h5>
                  </div>
                  <div class="card-body">

                    <!-- Row starts -->
                    <div class="row gx-3">
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a1">Prénom du Patient</label>
                          <input type="text" class="form-control" id="a1" name="prenom_patient" value="{{ old ('prenom_patient', $patient_datas->prenom_patient) }}">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a2">Nom du Patient</label>
                          <input type="text" class="form-control" id="a2" name ="prenom_patient"value="{{ old('nom_patient', $patient_datas->nom_patient) }}">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label for="validationCustom05" class="form-label"><b>Date de naissance</b><span style="color:red">*</span></label>
                          <input type="date" name="datenais" class="form-control" value="{{ old('datenais', $patient_datas->datenais) }}" id="validationCustom05"/>
                          <div class="invalid-feedback">
                            Entrez la date de naissance du patient.
                          </div>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="selectGender1">Sexe</label>
                          <div class="m-0">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="sexe_patient" id="selectGender1"
                                value="M" checked="">
                              <label class="form-check-label" for="selectGender1">Homme</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="sexe_patient" id="selectGender2"
                                value="F">
                              <label class="form-check-label" for="selectGender2">Femme</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label for="phone1"><b>Nip / N°Pièce d'identité</b><span style="color: red">*</span></label><br>
			                   <input type="tel" value="{{ old('nip',$patient_datas->nip) }}" class="form-control" placeholder="Cip" name="nip" readonly>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a5">Adresse Mail</label>
                          <input type="email" class="form-control" id="a5" value="{{ old('email_patient', $patient_datas->email_patient) }}">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a6">Numéro de téléphone</label>
                          <input type="text" class="form-control" id="a6"  value="{{ old('telephone', $patient_datas->telephone) }}">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a7">Situation Matrimoniale</label>
                          <select class="form-select" id="a7" name="smatrimonial">
                            <option value="">Sélectionner la situation matrimoniale</option>
                            <option value="N/A">N/A</option>
                            <option value="Célibataire">Célibataire</option>
                            <option value="Marié(e)">Marié(e)</option>
                            <option value="Divorcé(e)">Divorcé(e)</option>
                            <option value="Veuf(ve)">Veuf(ve)</option>
                            <option value="Séparé(e)">Séparé(e)</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label for="validationCustomUsername" class="form-label"><b>Profession</b> <span style="color: red"></span></label>
                        <div class="input-group has-validation">
                       <input type="text" name="profession" value="{{ old('prefession', $patient_datas->profession) }}" class="form-control" id="validationCustomUsername"/>
                    </div>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a9">Group Sanguin</label>
                        <input type="text" name="gsang" value="{{ old('gsang', $patient_datas->gsang) }}" class="form-control" id="validationCustom03"readonly>
                          
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a10">Blood Presure</label>
                          <input type="text" class="form-control" id="a10" value="160">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a11">Sugar</label>
                          <input type="text" class="form-control" id="a11" value="130">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a12">Address</label>
                          <input type="text" class="form-control" id="a12" value="89 Markus Turnpike">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a13">City</label>
                          <input type="text" class="form-control" id="a13" placeholder="Nickville">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a14">State</label>
                          <select class="form-select" id="a14">
                            <option value="0">Arizona</option>
                            <option value="1">Alabama</option>
                            <option value="2">Alaska</option>
                            <option value="3">Arizona</option>
                            <option value="4">California</option>
                            <option value="5">Florida</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a15">Postal Code</label>
                          <input type="text" class="form-control" id="a15" value="98980">
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="bg-light rounded-3 p-3 mb-3">
                          <div class="table-outer">
                            <div class="table-responsive">
                              <table class="table align-middle truncate m-0">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>File</th>
                                    <th>Reports Link</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>1</td>
                                    <td>
                                      <div class="icon-box md bg-primary rounded-2">
                                        <i class="ri-file-excel-2-line"></i>
                                      </div>
                                    </td>
                                    <td><a href="#!" class="link-primary text-truncate">Reports 1 clinical
                                        documentation</a></td>
                                    <td>May-24, 2024</td>
                                    <td>
                                      <div class="d-inline-flex gap-1">
                                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                          data-bs-target="#delRow">
                                          <i class="ri-delete-bin-line"></i>
                                        </button>
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip"
                                          data-bs-placement="top" data-bs-title="Download Report">
                                          <i class="ri-file-download-line"></i>
                                        </button>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>2</td>
                                    <td>
                                      <div class="icon-box md bg-primary rounded-2">
                                        <i class="ri-file-excel-2-line"></i>
                                      </div>
                                    </td>
                                    <td>
                                      <a href="#!" class="link-primary text-truncate">Reports 2 random files
                                        documentation</a>
                                    </td>
                                    <td>Feb-20, 2024</td>
                                    <td>
                                      <div class="d-inline-flex gap-1">
                                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                          data-bs-target="#delRow">
                                          <i class="ri-delete-bin-line"></i>
                                        </button>
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip"
                                          data-bs-placement="top" data-bs-title="Download Report">
                                          <i class="ri-file-download-line"></i>
                                        </button>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div id="dropzone" class="dropzone-dark mb-3">
                          <form action="/upload" class="dropzone needsclick dz-clickable" id="demo-upload">
                            <div class="dz-message needsclick">
                              <button type="button" class="dz-button">
                                Click here to upload or Drop your reports here.</button>
                              <h5>Upload your health reports.</h5>
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="d-flex gap-2 justify-content-end">
                          <a href="patients-list.html" type="button" class="btn btn-outline-secondary">
                            Cancel
                          </a>
                          <a href="patients-list.html" type="button" class="btn btn-primary">
                            Updte Patient Details
                          </a>
                        </div>
                      </div>
                    </div>
                    <!-- Row ends -->

                  </div>
                </div>
              </div>
            </div>
            <!-- Row ends -->

            <!-- Modal Delete Row -->
            <div class="modal fade" id="delRow" tabindex="-1" aria-labelledby="delRowLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="delRowLabel">
                      Are you sure?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to delete this report?
                  </div>
                  <div class="modal-footer">
                    <div class="d-flex justify-content-end gap-2">
                      <button class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">No</button>
                      <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Yes</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- App body ends -->

          @section('Datatable')
          <script>
            $(document).ready(function() {
            $("#example").DataTable();
                      });
            $("select").change(function(){
            if(confirm('Cliquez OK pour envoyer le patient vers le spécialiste')){
                {this.form.submit()} 
            }
            else $("select option:selected").prop("selected", false);
          });
          </script>
          
          @endsection
       @endsection
