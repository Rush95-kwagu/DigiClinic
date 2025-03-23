@extends('layout')
@section('admin')
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
      <div class="card mb-3">
        <div class="card-header">
        <h2>Le Patient</h2>
        
      </div>
      <div class="card-body" id="enleverE">
       	<form class="row" action="{{ url('/enregistrer-vente') }}" method="POST">
            {{csrf_field()}}
        <div class="col-md-10 mb-3">
				<label class="control-label" for="selectError1"> Patients  </label>
				<div class="controls">
				  <select class="form-control form-select" id="client_id" name="client_id" data-target="#service" data-source="get-detail/id">
				  	 <?php 

                     $all_clients=DB::table('tbl_patient')
                      ->where('id_centre',$centre_id) 
                      // ->orwhere('id_centre',1)
                     	->orderBy('patient_id','ASC')  
		                	->get(); 

                           

                            foreach ($all_clients as $v_client){ ?>  
							<option value="{{$v_client->patient_id}}">{{$v_client->telephone}} {{$v_client->prenom_patient}} {{$v_client->nom_patient}} </option>
					 <?php } ?>
				  </select>
				</div>
			</div> 
      <button type="submit" class="btn btn-success btn-pill">
        Poursuivre 
  </button>      
    </form>
    {{-- <a class="btn btn-warning btn-pill" href="#" onClick="THEFUNCTION(this.selectedIndex);">Nouvelle Achat</a> --}}
    </div>
     
    {{-- <div class="card-body" style="display:none; "id="enlever">
        <form action="{{ url('/enregistrer-vente') }}" method="POST">
            {{csrf_field()}}
          <input type="hidden" name="centre_id" value="{{$centre_id}}">
          <div class="form-group">
            <label for="exampleInputNom">Nom</label>
            <input type="text" name="guest_last_name" class="form-control" id="exampleInputNom" aria-describedby="Nom"
              placeholder="Nom">
            <small id="emailNom" class="form-text text-muted">Nom du client</small>
          </div>

          <div class="form-group">
            <label for="exampleInputPrenom">Prénom(s)</label>
            <input type="text" name="guest_first_name" class="form-control" id="exampleInputPrenom" aria-describedby="Prénom"
              placeholder="Prénom">
            <small id="emailPren" class="form-text text-muted">Prénom du client</small>
          </div>

          <div class="form-group">
            <label for="phone1">Télephone</label><br>
            <input type="tel" class="form-control" type="tel" placeholder="Contact Whatsapp/Appel" id="phone1" name="mobile_number" required="" />
            <input type="hidden" id='lnai' name="guest_mobile_number">
          </div>
          
          <div class="form-group">  
          <button type="submit" class="btn btn-success btn-pill">
            Continuer
          </button>
          </form>
          <a  class="btn btn-danger btn-pill" href="javascript:window.location.reload(history.go(-1))">Revenir à la sélection</a>
          </div> --}}
      </div>
    </div>
 
  </div>

@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
    </script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js" crossorigin="anonymous"></script>



      <script>                                      
      var input = document.querySelector("#phone1");
      window.intlTelInput(input, {
        initialCountry: "BJ",
        separateDialCode: true,
        hiddenInput: "telephone",
        utilsScript: "intl/build/js/utils.js?1537727621611" // just for formatting/placeholders etc

      });

      var iti = window.intlTelInputGlobals.getInstance(input);

        input.addEventListener('input', function() {
          var fullNumber = iti.getNumber();
          document.getElementById('lnai').value = fullNumber;
        });



      </script>
@endpush         
<script type="text/javascript">
          function THEFUNCTION(i)
     {
          var enlever = document.getElementById('enlever');
          switch(i) {
              case 1 : enlever.style.display = ''; break;
              default: enlever.style.display = ''; break;
       
          }
      var enleverE = document.getElementById('enleverE');
          switch(i) {
              case 2 : enleverE.style.display = 'none'; break;
              default: enleverE.style.display = 'none'; break;
       
       
          }
      }
</script>
@endsection











