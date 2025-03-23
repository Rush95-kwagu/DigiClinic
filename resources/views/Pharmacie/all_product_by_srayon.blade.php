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
                    <h5 class="card-title">Produits {{$get_category}}</h5>
                  </div>
                  <div class="card-body">
                      </div>
                      <div class="card-body">
                        
                          <div class="table-responsive">
                          <table class="table truncate align-middle" id="example">
                          <thead>
                            <tr>
                              <th>Article Libellé</th>
              							  <th>Article Image</th>
              							  <th>Article Prix</th>
              						    <th>Nom Categorie</th>
              					     	 <th>Nom Marque</th>
              							  <th>Statut</th>
              							  <th>Actions</th>
                            
                            </tr>
                          </thead>
                          <tbody>
                    
							 @foreach($all_sproduit as $v_product) 
						  
							<tr>
								
								<td class="center">{{$v_product->product_name}}</td>
					
								<td> <img src="{{URL::to($v_product->product_image)}}" style="height: 80px; width:80px;"></td>
								<td class="center">{{$v_product->product_price}}</td>
								<td class="center">{{$v_product->category_name}}</td>
								<td class="center">{{$v_product->manufacture_name}}</td>

								<td class="center">
									@if($v_product->publication_status==1)
									
									<span class="label label-success">Active</span>
									@else
										<span class="label label-danger">Unactive</span>
									@endif
								</td>
								<td class="center">
									@if($v_product->publication_status==1)
									<a title="Désactiver" class="btn btn-danger" href="{{URL::to('/unactive_product/'.$v_product->product_id)}}">		
										<i class="mdi mdi-thumb-down"></i>
									</a>
									@else
									<a title="Activer" class="btn btn-success" href="{{URL::to('/active_product/'.$v_product->product_id)}}">		
										<i class="mdi mdi-thumb-up"></i>
									</a>
									@endif
									<a title="Modifier" class="btn btn-info" href="{{URL::to('/edit-product/'.$v_product->product_id)}}">
										<i class="mdi mdi-folder-edit"></i> 
									</a>
									<a title="Supprimer" class="btn btn-danger" href="{{URL::to('/delete-product/'.$v_product->product_id)}}" id="delete">
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





    <div class="card card-default">
      <div class="card-header">
        <h2>Ajouter Article</h2>
      </div>
      <div class="card-body">
        <div class="collapse" id="collapse-from-validation">
          
        </div>

       <form class="form-horizontal" method="post" action="{{url('/save-product')}}" enctype="multipart/form-data">
							{{csrf_field()}}
		 <input type="hidden" name="srayon_id" value="{{$get_srayon_id}}" />

		<input type="hidden" name="category_id" value="{{$get_category_id}}" />
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationServer0">Nom de l'Article</label>
              <input type="text" class="form-control border-success" id="validationServer0" placeholder="libellé" name="product_name" required>
              <div class="text-success small mt-1">
                Looks good!
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationServer02">Nom de la Marque</label>
					<select class="form-control"  name="manufacture_id">
						<?php 

                                $all_published_manufacture=DB::table('tbl_manufacture')
                                                             ->get();

                                foreach ($all_published_manufacture as $v_manufacture){ ?>
							<option value="{{$v_manufacture->manufacture_id}}">{{$v_manufacture->manufacture_name}}</option>
						<?php } ?>
					</select>
              
              <div class="text-info small mt-1">
                Looks good!
              </div>
            </div>

            <div class="col-md-12 mb-3">
              <label for="validationServer01">Article description</label>
              <input type="text" class="form-control border-success" id="validationServer01" placeholder="description" name="product_description" required>
              <div class="text-success small mt-1">
                Looks good!
              </div>
            </div>


            <div class="col-md-12 mb-3">
              <label for="validationServer02">Article Prix</label>
              <input type="number" class="form-control border-success" id="validationServer02" placeholder="Prix" name="product_price" required>
              <div class="text-success small mt-1">
                Looks good!
              </div>
            </div>

            <div class="col-md-12 mb-3">
              <label for="validationServer03">Image vitrine</label>
              <input type="file" class="form-control border-success" id="validationServer03" placeholder="description" name="product_image" required>
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

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

@section('Datatable')
    <script>
      $(document).ready(function() {
      $("#example").DataTable();
    });
      
    </script>
   
@endsection
@endsection