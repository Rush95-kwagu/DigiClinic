@extends('layout')
@section('admin')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
?>


<!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
               <div class="col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Explorer</h5>
                  </div>
                  <div class="card-body">
                      </div>
                      <div class="card-body">
                        <div class="">
                          <div class="table-responsive">
                          <table class="table truncate align-middle" id="example">
                          <thead>
                            <tr>
                              <th>Catégorie libellé</th>
														  <th>Catégorie description</th>
														  <th>Statut</th>
														  <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                           @foreach($all_category_info as $v_category)
                            <tr>
                              <td class="py-0">
                                <a href="{{URL::to('/rayon-par-entite/'.$v_category->category_id)}}">{{$v_category->category_name}}</a>
                              </td>
                              <td>{{$v_category->category_description}}</td>
															<td>
																@if($v_category->publication_status==1)
																
																<span class="label label-success">Active</span>
																@else
																	<span class="label label-danger">Unactive</span>
																@endif
															</td>
															<td>
																@if($v_category->publication_status==1)
																<a title="Désactiver" class="btn btn-danger" href="{{URL::to('/unactive_category/'.$v_category->category_id)}}">
																	<i class="mdi mdi-thumb-down"></i>		
																	
																</a>
																@else
																<a title="Activer" class="btn btn-success" href="{{URL::to('/active_category/'.$v_category->category_id)}}">	
																	<i class="mdi mdi-thumb-up"></i>	 
																</a>
																@endif
																<a title="Modifier" class="btn btn-info" href="{{URL::to('/edit-category/'.$v_category->category_id)}}">
																	<i class="mdi mdi-folder-edit"></i>  
																</a>
																<a title="Supprimer" class="btn btn-danger" href="{{URL::to('/delete-category/'.$v_category->category_id)}}" id="delete">
																	<i class="mdi mdi-trash-can"></i> 
																</a>
															</td>                              
                            </tr>

													@endforeach

                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              </div>


<div class="app-body">

<div class="card card-default">
      <div class="card-header">
        <h2>Ajouter Catégorie</h2>
      </div>
      <div class="card-body">
        <div class="collapse" id="collapse-from-validation">
          
        </div>

       <form class="form-horizontal" method="post" action="{{url('/save-category')}}" enctype="multipart/form-data">
							{{csrf_field()}}
		
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationServer0">Catégorie libellé</label>
              <input type="text" class="form-control border-success" id="validationServer0" placeholder="libellé" name="category_name" required>
              <div class="text-success small mt-1">
                Looks good!
              </div>
            </div>
           

            <div class="col-md-12 mb-3">
              <label for="validationServer01">Catégorie description</label>
              <input type="text" class="form-control border-success" id="validationServer01" placeholder="description" name="category_description" required>
              <div class="text-success small mt-1">
                Looks good!
              </div>
            </div>
      
          </div>
          <button class="btn btn-primary btn-pill mr-2" type="submit">Submit</button>
          <button class="btn btn-light btn-pill" type="submit">Cancel</button>
        </form>

      </div>
    </div>
    </div>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

@section('Datatable')
    <script>
      $(document).ready(function() {
      $("#example").DataTable();
    });
      
    </script>
   
@endsection
@endsection