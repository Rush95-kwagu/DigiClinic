@extends('layout')
@section('admin_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
 $centre_id=Session::get('centre_id');
 $reactifs=DB::table('tbl_reactif_used')
 			->join('tbl_reactif','tbl_reactif.reactif_id','=','tbl_reactif_used.reactif_id')
            ->select('tbl_reactif_used.*','tbl_reactif.*')
 			->where('id_analyse',$id_analyse)
 			->groupby('tbl_reactif_used.reactif_id')
 			->get();


?>

<!-- App body starts -->
          <div class="app-body">
@foreach ($all_details as $patient)
@endforeach
            <!-- Row starts -->
            <div class="row gx-3">
               <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Gestion des analyses de <span style="color: green;"> {{$patient->prenom_patient}} {{$patient->nom_patient}}</span><br>
                      <span class="badge bg-danger">{{$patient->libelle_analyse}}</span> 

                    </h5>
                  </div>
                  <div class="card-body">
                    <div class="custom-tabs-container">
                      <ul class="nav nav-tabs justify-content-end" id="customTab5" role="tablist">
                      @if($patient->statut_analyse == 1)
                         <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-threeAAAA" data-bs-toggle="tab" href="#threeAAAA" role="tab"
                            aria-controls="threeAAAA" aria-selected="false">
                            <span class="badge bg-primary">Résultat</span>
                          </a>
                        </li>
                      @endif

                      @if($patient->statut_analyse == 0)
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="tab-oneAAAA" data-bs-toggle="tab" href="#oneAAAA" role="tab"
                            aria-controls="oneAAAA" aria-selected="true">
                            <span class="badge bg-primary">Prise en charge</span>
                          </a>
                        </li>
                      @endif
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-twoAAAA" data-bs-toggle="tab" href="#twoAAAA" role="tab"
                            aria-controls="twoAAAA" aria-selected="false">
                            <span class="badge bg-primary">Dossier Médical</span>
                          </a>
                        </li>
                        

                      </ul>


        @if($patient->statut_analyse == 1)
        <div class="tab-content" id="customTabContent">
           <div class="tab-pane fade show active" id="oneAAAA" role="tabpanel">
            <div class="row gx-3">
               <div class="col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">

                <div class="card-body" style="height: auto;">

                

                 <br>

                <h3>Résultats de l'analyse </h3>   <span class="feed-date pb-1" data-bs-toggle="tooltip" data-bs-title="{{\Carbon\Carbon::parse($patient->created_at)->diffForHumans() }}">{{\Carbon\Carbon::parse($patient->created_at)->diffForHumans()}} 
                 </span> 

                <h3>
                   <span class="badge bg-danger">{{$patient->analyse_resultat}}</span>
                </h3>

                <br>
                <br>

                <h4>Réactifs de l'analyse </h4>
                @foreach($reactifs as $v_reactif)
                <h5>
                 <span class="badge bg-warning">{{$v_reactif->reactif_nom}}</span>
                </h5>

                @endforeach
                <br>
                <br>


                @if($patient->analyse_fichier)
                <h5>Document analyse joint </h5>

                <h3>
                   <span class="badge bg-secondary"><a href="{{$patient->analyse_fichier}}" class="" download="">Fichier joint</a></span>
                </h3>
                          
                @endif

                  </div>
              </div>
          	</div>
          </div>
         </div>
        </div>
      </div>
      @endif

            @if($patient->statut_analyse == 0)
           <div class="tab-content" id="customTabContent">
            <div class="tab-pane fade show active" id="oneAAAA" role="tabpanel">

            <div class="row gx-3">
               <div class="col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">

                <div class="card-body" style="height: auto;">
                  <h3>Vous avez  :  <span style="color:red;" id="reactifTot"></span> réactif(s) prêt à l'emploi </h3> 


           

                <br>
                <br>
                <br>


                <!--  -->   
                <table class="table table-striped table-responsive-md table-bordered" class="display mt-4" style="width:100%">
                <thead>
                    <tr>
                        <th style="display:none;">N°</th>
                        <th>REACTIF</th>
                        <th>DESCRIPTION</th>
                        <th>QUANTITE</th>
                        <th>ID ANALYSE</th>                         
                        <th></th>                                                        
                    </tr>
                </thead>
                    <tbody id="tbodyId">
                    
                    </tbody>
                </table>   
                </div>
                </div>
                </div>
                </div>
                <br>
                <br>

                <div id="success_message">
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="card card-default">
                      <div class="card-header">
                        <h2> Sélection des réactifs pour :  <span class="btn btn-info"> {{$patient->libelle_analyse}}</span>  </h2>
                        
                      </div>
					         <div class="card-body">
									<form id="AddStudentForm">
										<ul id="save_msgList"></ul>
									  
									<div class="col-md-12 mb-3">
									<label class="control-label" for="selectError1">Réactif </label>
									<div class="controls">
									  <select class="link-select form-select" id="product_id" name="product_id" data-target="#service" data-source="get-detail/id">
									  	 <?php 

					                     $all_products=DB::table('tbl_reactif')
                                                  ->where('id_centre', $centre_id)
							              			                ->get(); 

					                            foreach ($all_products as $v_product){ ?>  
												<option value="{{$v_product->reactif_id}}">[{{$v_product->reactif_nom}}] ... {{$v_product->description}} </option>
										 <?php } ?>
									  </select>
									</div>
								  	</div>
					             <input name="user_id" id="user_id" type="hidden" value="{{$user_id}}">
					             <input name="centre_id" id="centre_id" type="hidden" value="{{$centre_id}}">

					             <input name="id_analyse" id="id_analys" type="hidden" value="{{$id_analyse}}">
					            

					            <div class="col-md-12 mb-3">
					              <label for="validationServer07">Quantité</label>
					              <input id="input-qty" type="number" class="form-control border-success" id="validationServer07" name="qty" required>
					              <div class="text-success small mt-1">
					                </div>
					            </div>												
								<div class="form-actions">
								   <button type="button" class="btn btn-primary add_student">Ajouter</button>
								  <button type="reset" class="btn">Annuler</button>
								</div>
							 
							</form>   

						 </div>
					    </div>
					  </div>
					</div>
				</div>

				<br>
				<br>
				<br>

				<div class="row">
                  <div class="col-12">
                    <div class="card card-default">
                      <div class="card-header">
                        <h2> Interpretation des analyses :  <span class="btn btn-info"> {{$patient->libelle_analyse}}</span>  </h2>
                        
                      </div>

							<div class="card-body">
                             

                             <form onsubmit="confirm('Cliquez ok pour cloturer le traitement')" class="form-horizontal" method="post" action="{{url('/save-analyse-traitement')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                           		<input type="hidden" name="user_id" value="{{$user_id}}">
           						<input type="hidden" name="id_centre" value="{{$centre_id}}">
                                <div class="form-row">

                                  <div class="col-md-12 mb-3">
                                  <label class="control-label">Résultats analyses</label>
                                  <div class="controls">
                                  <textarea class="form-control" name="analyse_resultat" rows="3" required></textarea>
                                  </div>
                                  </div>


                               
                                

                                  <div class="col-md-12 mb-3">
                                    <label for="validationServer03">Pièce jointe</label>
                                    <input type="file" class="form-control border-success" id="validationServer03" placeholder="description" name="analyse_fichier" accept="application/pdf" />
                                    <div class="text-success small mt-1">
                                      Pdf supporté
                                    </div>
                                  </div>

                                  

                                  

                                   <div class="form-check form-switch">
                                    <input required class="checkbox form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    <label class="checkbox form-check-label" for="flexSwitchCheckDefault">Cloturer l'analyse</label>
                                    
                                   
                                    <input id="idpa" type="hidden" value="{{$patient->id_analyse}}" name="id_analyse" value="">
                                  </div>

                                </div>
                                <button class="btn btn-primary btn-pill mr-2" type="submit">Valider</button>
                                <button class="btn btn-light btn-pill" type="submit">Cancel</button>
                              </form>

                            </div>
                            </div>
                          </div>
                        </div>
                       </div>
                      </div>
                      

                      @endif

                        <div class="tab-pane fade" id="twoAAAA" role="tabpanel">
                          <div class="row">
                          <div class="col-xl-6 col-sm-6">
                            <div class="card mb-3">
                              <div class="card-header">
                                <h5 class="card-title">Antécédents Médicaux</h5>
                              </div>
                              <!-- Activity starts -->
                              <div class="card-body">
                                <div class="scroll350">
                                  <div class="activity-feed">
                                    @foreach($all_details as $v_detail)
                                    <div class="feed-item">
                                      
                                      <span class="feed-date pb-1" data-bs-toggle="tooltip" data-bs-title="{{\Carbon\Carbon::parse($v_detail->created_at)->diffForHumans() }}">{{\Carbon\Carbon::parse($v_detail->created_at)->diffForHumans()}} <span class="badge bg-danger">{{$v_detail->libelle_analyse}}</span></span> 

                                      <?php 
                                        $consults=DB::table('tbl_consultation')
                                      ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')              
                                      ->join('users','tbl_consultation.user_id','=','users.user_id')              
                                      ->join('personnel','users.email','=','personnel.email')              
                                      ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                                      ->where('tbl_prise_en_charge.patient_id',$v_detail->patient_id)
                                      ->select('tbl_prise_en_charge.*','tbl_patient.*','tbl_consultation.*','users.*','personnel.*')
                                      ->orderBy('conslt_created_at','DESC')
                                      ->get();

                                      
                                      ?>

                                      @foreach($consults as $v_consult)

              <div class="col-sm-6">
                <div class="accordion mb-3" id="{{$v_consult->id_consultation}}">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSpecialTitleOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSpecialTitleOne" aria-expanded="false"
                        aria-controls="collapseSpecialTitleOne">
                        <div class="d-flex flex-column">
                          <h5 class="m-0"><strong><em class="text-primary"><i class="ri-calendar-line"></i> {{$v_consult->conslt_created_at}}</em> </strong></h5>
                        </div>
                      </button>
                    </h2>
                    <div id="collapseSpecialTitleOne" class="accordion-collapse collapse show"
                      aria-labelledby="headingSpecialTitleOne" data-bs-parent="#{{$v_consult->id_consultation}}">
                      <div class="accordion-body">
                        <p class="mb-3">
                           <code><strong> Dr. {{$v_consult->prenom}} {{$v_consult->nom}}</strong></code>
                        </p>

                        <p class="mb-3">
                          {!!$v_consult->diagnostic!!}
                        </p>

                        <p class="mb-3">
                          <strong>{{$v_consult->observation}} </strong>
                        </p>

                        <div class="d-flex gap-2">
                         
                         @if($v_consult->fichier_joint)
                          <a href="{{$v_consult->fichier_joint}}" class="btn btn-primary" download="">Fichier joint</a>
                        @endif

                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  </div>


                                      

                                      

                                      
                                      @endforeach
                                     <?php  ?>
                                    </div>
                                    @endforeach
                                  </div>
                                </div>
                              </div>
                              <!-- Activity ends -->
                            </div>
                          </div>

                          <div class="col-xl-6 col-sm-6">
                            <div class="card mb-3">
                              <div class="card-header">
                                <h5 class="card-title">Ordonnances Antérieures</h5>
                              </div>
                              <!-- Activity starts -->
                              <div class="card-body">
                                <div class="scroll350">
                                  <div class="activity-feed">
                                    @foreach($all_details as $v_detail)

             
                                    <div class="feed-item">
                                      
                                      <span class="feed-date pb-1" data-bs-toggle="tooltip" data-bs-title="{{\Carbon\Carbon::parse($v_detail->created_at)->diffForHumans() }}">{{\Carbon\Carbon::parse($v_detail->created_at)->diffForHumans()}} <span class="badge bg-danger">{{$v_detail->libelle_analyse}}</span></span> 

                                      <div class="mb-1">
                                        <span class="text-primary">{!!$v_detail->ordonnance!!}</span>
                                      </div>
                                      
                                      
                                     <?php  ?>
                                    </div>
                                    @endforeach
                                  </div>
                                </div>
                              </div>
                              <!-- Activity ends -->
                            </div>
                          </div>
                        </div>
                        </div>

                        <!-- <div class="tab-pane fade" id="threeAAAA" role="tabpanel">
                          <h1 class="display-1 text-center text-primary p-5">
                            Selected Tab Three
                          </h1>
                        </div> -->
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


<script>
    document.querySelector('input#sign').value = 0
    document.querySelector('.affect').style.display = ''
    document.querySelector('.ordo').style.display = 'none'
    let check = document.querySelector('.checkbox')
    check.addEventListener('click', () => {
        check.classList.toggle('active');

            if(check.classList.contains('active')){
                document.querySelector('.affect').style.display = 'none'
                document.querySelector('.ordo').style.display = ''
                document.querySelector('input#sign').value = 1

            }else{                
                document.querySelector('.affect').style.display = ''
                document.querySelector('.ordo').style.display = 'none'
                document.querySelector('input#sign').value = 0
                
            }
        })
  

</script>


              
              
              
            
              
            
              
            
           

          
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@section('Datatable')
    <script>
      $(document).ready(function() {
      $("#example").DataTable();
    });
     
    </script>






    
@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
    </script>     
@endpush
{{-- Delete Modal --}}
<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Retirer du tableau</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Le réactif sera retiré pour l'analyse <span class="badge bg-danger"> {{$patient->libelle_analyse}} </span> </h4> 
                <input type="hidden" id="deleteing_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary delete_student">Oui retirer</button>
            </div>
        </div>
    </div>
</div>
{{-- End - Delete Modal --}}


@push('ajax')
<script>

    $(document).ready(function () {

        fetchtabreactif();

        function fetchtabreactif() {
            $.ajax({
                type: "GET",
                url: "{{url('get-reactif/'.$user_id.'/'.$id_analyse)}}",
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                   $('tbody#tbodyId').html("");
                    $.each(response.tabreactif, function (key, item) {
                        $('tbody#tbodyId').append(
                        '<tr>\
                            <td class="edit_id" style="display:none;">' + item.reactif_id + '</td>\
                            <td>' + item.reactif_nom + '</td>\
                            <td>' + item.description + '</td>\
                            <td>' + item.qty + '</td>\
                            <td>' + item.id_analyse + '</td>\
                            <td>\
                            <button type="button" value="' + item.reactif_id + '" class="btn btn-danger deletebtn btn-sm">Retirer</button></td>\
                        \</tr>');
                    });
                  $('span#reactifTot').html("");
                  $('span#reactifTot').append(response.total_reactif);
                }
            });
        }

        $(document).on('click', '.deletebtn', function () {
            var stud_id = $(this).val();
            $('#DeleteModal').modal('show');
            $('#deleteing_id').val(stud_id);
        });
        $(document).on('click', '.delete_student', function (e) {
            e.preventDefault();

            $(this).text('Deleting..');
            var id = $('#deleteing_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "GET",

                url: "/2/delete-tabreactif/"+id,

                dataType: "json",
                success: function (response) {
                     console.log(response);
                   
                       
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteModal').modal('hide');
                        fetchtabreactif();
                   
                }
            });
        });


        $(document).on('click', '.add_student', function (e) {
            e.preventDefault();

            $(this).text('Envoie...');

            var data = {
                'product_id': $('#product_id').val(),
                
                'qty': $('#input-qty').val(),

                'id_analyse': $('#id_analys').val(),
               
                'user_id': $('#user_id').val(),
                
                'centre_id': $('#centre_id').val(),
            }

            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{url('/store-tabreactif')}}",
                data: data,
                dataType: "json",
                success: function (response) {
                  if (response.status == 400) {
                        $('#save_msgList').html("");
                        $('#save_msgList').addClass('alert alert-danger');
                        $('#save_msgList').text(response.error);
                        $('.add_student').text('Ajouter');
                    } else {
                        $('#save_msgList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#AddStudentForm').find('input').val();
                        $('.add_student').text('Ajouter');
                        fetchtabreactif();
                    }
                   
                }
            });



        $(document).on('click', '.update_amuter', function (e) {
            e.preventDefault();

            $(this).text('Updating..');
            var id = $('#edit_id').val();
            // alert(id);

            var data = {
                'id_a_muter': $('#edit_id').val(),
                'e_fonction': $('#edit_fonction').val(),
                'e_qualif': $('#edit_qualif').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.status == 200) {
                        $('#update_msgList').html("");
                        $('#update_msgList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_value) {
                            $('#update_msgList').append('<li>' + err_value +
                                '</li>');
                        });
                        $('.update_amuter').text('Update');
                    } else {
                        $('#update_msgList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#edit_form').find('input').val('');
                        $('.update_amuter').text('Update');
                        $('#edit_form').modal('hide');
                        fetchstudent();
                    }
                }
            });

        });

        });


    });

</script>
@endpush

    </script>




@endsection
@endsection