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


                <div class="row">
                  <div class="col-12">
                    <div class="card card-default">
                      <div class="card-header">
                        <h2>Enregistrer un approvisionnement</h2>
                        <!-- <div class="dropdown">
                          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> Yearly Chart
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                          </div>
                        </div> -->
                      </div>


      

              <div class="card-body">

             
				<form onsubmit="confirm('Cliquez OK pour confirmer l\'appro')" class="form-horizontal" method="post" action="{{url('/post-appro-reactif')}}" enctype="multipart/form-data">
					{{csrf_field()}}
				  <fieldset>
					
         					
    				<div class="col-md-12 mb-3">
    				<label class="control-label" for="selectError1">Réactif à approvisionner </label>
    				<div class="controls">
    				  <select class="link-select form-select" id="reactif_id" name="reactif_id">
                 <?php 

                         $all_reactif=DB::table('tbl_reactif')
                   
                        ->get(); 
                        foreach ($all_reactif as $v_reactif){ ?>  
                  <option value="{{$v_reactif->reactif_id}}">{{$v_reactif->reactif_nom}}</option>
               <?php } ?>
              </select>
    				</div>
    			  </div>

			 
             <div class="col-md-12 mb-3">
              <label for="validationServer07">Stock</label>
              <input type="number" class="form-control border-success" id="validationServer07" name="stock" required>
              <div class="text-success small mt-1">
                
              </div>
            </div>

            <div class="col-md-12 mb-3">
              <label for="validationServer07">Stock Défectueux</label>
              <input type="number" class="form-control border-danger" id="validationServer07" name="stock_defective" required>
              <div class="text-danger small mt-1">
                
              </div>
            </div>

            <div class="col-md-12 mb-3">
              <label for="validationServer01">Commentaires</label>
              <input type="text" class="form-control border-success" id="validationServer01" placeholder="note facultative" name="comments">
              <div class="text-success small mt-1">
                
              </div>
            </div>
			<div class="form-actions">
			  <button type="submit" class="btn btn-primary">Approvisionner</button>
			  <button type="reset" class="btn">Annuler</button>
			</div>
		  </fieldset>
		</form>   

	 </div>
    </div>
  </div>
</div>


@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
    </script>
@endpush
 
@endsection