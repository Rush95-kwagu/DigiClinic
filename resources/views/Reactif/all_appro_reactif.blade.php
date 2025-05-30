@extends('layout')
@section('admin')
<?php $message=Session::get('message');
$user_role_id=Session::get('user_role_id'); 
?>

    @if($message)
           <div class="btn btn-info" id="toaster-success">
             <?php
                $message=Session::get('message'); 
                if ($message) {
                  echo $message;
                  Session::put('message',null);
                }
             ?>
           </div>
    @endif

      <?php $message=Session::get('error')?>
        @if($message)
           <div class="btn btn-danger" id="toaster-danger">
             <?php
               $message=Session::get('error'); 
               if ($message) {
                 echo $message;
                 Session::put('error',null);
               }

             ?>
            
           </div>
    @endif  
	
	<!-- Table Product -->


                <!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
               <div class="col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">
                        <h2>Appro Réactifs</h2>
                         <div class="dropdown">
                          <a class="btn btn-info" href="{{('/faire-appro-reactif')}}" role="button"
                            aria-expanded="false"> Faire un appro
                          </a>

                        <!--   <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                          </div> -->
                        </div>
                      </div>


      

            <div class="card-body">
						<div class="table-responsive">
            <table class="table truncate align-middle" id="example">
						  <thead>
							  <tr>
							  	 
								  <th>Réactif</th>
								  <th>Description</th>
						      	  <th>Stock</th>
					     	      <th>Défecteux</th>
								  <th>Date de L'appro</th>
								  <th>Actions</th>
							  </tr>
						  </thead>  
						  @foreach($all_appro as $v_reactif) 
						  <tbody>
							<tr>
								
								<td class="center">{{$v_reactif->reactif_nom}}</td>		
								<td class="center">{{$v_reactif->description}} F</td>
								<td class="center">{{$v_reactif->stock}}</td>
								<td class="center">{{$v_reactif->stock_defective}}</td>

								<td class="center">
										{{\Carbon\Carbon::parse($v_reactif->created_at)->format('d-m-Y')}}
								</td>
								<td class="center">
									<a title="Supprimer" class="btn btn-danger" href="{{URL::to('/delete-reactif/'.$v_reactif->reactif_id)}}" id="delete">
										<i class="mdi mdi-trash-can"></i>
									</a>
								</td>
							</tr>
							
						  </tbody>
						  @endforeach
					  </table>            
					 </div>
          </div>
        </div>
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