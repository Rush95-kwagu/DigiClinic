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
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Répertoire des prestations</h5>
                    <a href="{{url('add-form')}}" class="btn btn-primary ms-auto">Ajouter une prestation</a>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-responsive">
                      <table id="example" class="table truncate m-0 align-middle">
                        <thead>
                          <tr>
                            {{-- <th>N°.</th> --}}
                            <th>Référence</th>
                            <th>Type de prestation</th>
                            <th>Coût de la prestation</th>
                            @if ($user_role_id == 11)
                               <th>Actions</th>
                            @endif
                          </tr>
                        </thead>
                        @php
                             $centre_id=Session::get('centre_id');
                             $prestation=DB::table('tbl_prestation')
                                            ->where('centre_id', $centre_id)
                                            ->get();
                        @endphp
                        <tbody>
                          @foreach ($prestation as $all_prestation)
                              
                         
                          <tr>
                            {{-- <td>{{$all_prestation->prestation_id}} °)</td> --}}
                            <td>{{$all_prestation->reference}}</td>
                         
                            <td>{{$all_prestation->nom_prestation}}</td>
                            <td>{{$all_prestation->tarif}}  FCFA</td>
                            @if ($user_role_id == 11)
                                
                            <td>
                              <div class="d-inline-flex gap-1">
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                  data-bs-target="#delRow">
                                  <i class="ri-delete-bin-line"></i>
                                </button>
                                <a href="{{URL::to('edit-analyse-form/'.$all_prestation->prestation_id)}}" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modifier la prestation">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                                </div>
                            </td>
                            @endif

                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- Table ends -->

                    <!-- Modal Delete Row -->
                    <div class="modal fade" id="delRow" tabindex="-1" aria-labelledby="delRowLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="delRowLabel">
                              Confirm
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete the patient?
                          </div>
                          <div class="modal-footer">
                            <div class="d-flex justify-content-end gap-2">
                              <button class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">No</button>
                              <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Yes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <!-- Row ends -->

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
    