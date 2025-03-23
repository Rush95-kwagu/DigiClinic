@extends('layout')
@section('admin')
<?php $message=Session::get('message');
$user_role_id=Session::get('user_role_id'); 
$user_id=Session::get('user_id');
$guest_id=$client_info->guest_id; 
$centre_id=Session::get('centre_id');

$panier=DB::table('tbl_panier')
            ->where('user_id',$user_id)
            ->where('guest_id',$guest_id)
            ->count();
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
	
	<!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
               <div class="col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">

                <div class="card-body" style="height: auto;">
                  <h3>Panier du client  :  <span style="color:red;" id="panierTot"></span>  F</h3> 


                <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal"
                      data-bs-target="#staticBackdrop">
                      Passer au paiement
                </button>

                <br>
                <br>
                <br>


                <!--  -->   
                <table class="table table-striped table-responsive-md table-bordered" class="display mt-4" style="width:100%">
                <thead>
                    <tr>
                        <th style="display:none;">N°</th>
                        <th>PRODUIT</th>
                        <th>PRIX</th>
                        <th>QUANTITE</th>
                        <th>TOTAL</th>                         
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
                        <h2>Enregistrer une vente pour <span class="btn btn-info"> {{$client_info->guest_first_name}} {{$client_info->guest_last_name}} </span>  </h2>
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

             
				<form id="AddStudentForm">
					<ul id="save_msgList"></ul>
				  
					
				<div class="col-md-12 mb-3">
				<label class="control-label" for="selectError1">Produit </label>
				<div class="controls">
				  <select class="link-select form-select" id="product_id" name="product_id" data-target="#service" data-source="get-detail/id">
				  	 <?php 

                     $all_products=DB::table('tbl_products')
		                ->join('tbl_srayon','tbl_products.srayon_id','=','tbl_srayon.srayon_id')
		                ->join('tbl_rayon','tbl_srayon.rayon_id','tbl_rayon.rayon_id')
		                ->select('tbl_products.*','tbl_rayon.*')
		                ->get(); 

                           

                            foreach ($all_products as $v_product){ ?>  
							<option value="{{$v_product->product_id}}">[{{$v_product->rayon_name}}] {{$v_product->product_name}} - Prix de base : {{$v_product->product_price}} F</option>
					 <?php } ?>
				  </select>
				</div>
			  	</div>
         					


            <div id="service" class="link-select col-md-12 mb-3">
            
            </div>
             <input class="Value" name="prix" id="input-price" type="hidden" value="">
             <input name="user_id" id="user_id" type="hidden" value="{{$user_id}}">
             <input name="guest_id" id="guest_id" type="hidden" value="{{$guest_id}}">
             <input name="centre_id" id="centre_id" type="hidden" value="{{$centre_id}}">
            
          

            <div class="col-md-12 mb-3">
              <label for="validationServer07">Quantité</label>
              <input onclick="myFunction()" id="input-qty" type="number" class="form-control border-success" id="validationServer07" name="qty" required>
              <div class="text-success small mt-1">
                Looks good!
              </div>
            </div>


            <div class="col-md-12 mb-3">
              <label for="validationServer07">Total</label>
              <input id="input-total" type="text" class="form-control border-success" id="validationServer07" name="total" disabled>
              <div class="text-success small mt-1">
                Looks good!
              </div>
            </div>


            <div class="col-md-12 mb-3">
                <label class="control-label" for="selectError1">Taxe </label>
                <div class="controls">
                <select class="form-control" id="taxe_id" name="taxe_id">
                    <option>AUCUNE</option>
                    <option value="A">A-EXONERE</option>
                    <option value="B">B-TAXABLE 18%</option>
                    <option value="C">C-EXPORTATION</option>
                    <option value="D">D-TVA REGIME D'EXCEPTION 18%</option>
                    <option value="E">E-REGIME TPS</option>
                    <option value="F">F-RESERVE</option>
                </select>
                </div>
                </div>




							
			<div class="form-actions">
			   <button type="button" class="btn btn-primary add_student">Save</button>
			  <button type="reset" class="btn">Cancel</button>
			</div>
		 
		</form>   

	 </div>
    </div>
  </div>
</div>
</div>
</div>

 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                      tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Passer à la caisser</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modall" aria-label="Annuler"></button>
            </div>
            <form action="{{ url('/make-caisse') }}" method="POST">
                            {{csrf_field()}}
            <div class="modal-body">
            <h4>Voulez-vous passer à la caisse ?</h4>
            <br>
            <input type="hidden" name="guest_id" value="{{$guest_id}}">
            <input type="hidden" name="id_centre" value="{{$centre_id}}">

            <div class="control-group hidden-phone">
                <label class="control-label" for="textarea2">Facture normalisée ?</label>

                <div class="controls">
                <label for="non">Non</label>
                <input id="non" type="radio" name="receipt" value="0" checked>
                
                <input id="oui" type="radio" name="receipt" value="1">
                <label for="oui">Oui</label>
                </div> 
                </div>
            </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  Fermer
                </button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                  Oui, confirmer
                </button>
              </div>
            </form>
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
<script>
        class LinkedSelect {


          constructor (element){
              this.select = element
              this.onChange = this.onChange.bind(this)
              this.target = document.querySelector(this.select.getAttribute("data-target"))
              this.loader = null
              this.select.addEventListener('change', this.onChange);
          }

          onChange (e) {

              this.showLoader()
              let request = new XMLHttpRequest();
              request.open('GET', this.select.getAttribute("data-source").replace('id', e.target.value) , true);
              request.onload = () => {
                  if(request.status >= 200 && request.status < 400);
         			
                  let data = JSON.parse(request.responseText);

                    
                  let options = data.reduce(function (acc, option) {
                      return acc + '<label for="service">Prix par unité</label><input class="form-control border-success" type="number" value="'+option.prix+'" name="prix" id="idValue" onclick="myFunction()" /><div class="text-success small mt-1">Looks good!</div>'
                  }, '')
                  
                
                window.setTimeout( () => {
                    this.hideLoader();
                    let firs = this.target.firstElementChild
                      this.target.innerHTML = options;
                     
                      this.target.parentNode.style.display = null
                }, 100)


              }

              request.onerror = function() {
                alert('Impossible')
              }
              request.send();
          }


            showLoader(){
                this.loader = document.createTextNode('Chargement...')
                this.target.parentNode.parentNode.appendChild(this.loader)
                
             

            }

            hideLoader(){
                if(this.loader !==  null){
                    this.loader.parentNode.removeChild(this.loader)
                    this.loader = null;
                }
            }



        }


        let selects = document.querySelectorAll('.link-select');
        selects.forEach(function(selected) {
            new LinkedSelect(selected)
        })
</script>


<script>
    let input_qty = document.getElementById('input-qty');
    let input_price = document.getElementById('input-price');
    let input_total = document.getElementById('input-total');
    input_qty.addEventListener('input', updateTotal);
    input_price.addEventListener('input', updateTotal);
    function updateTotal () {
        input_total.value = (parseInt(input_qty.value) * parseInt(input_price.value))+" F";
    }

 console.log(input_qty);
</script>



<script>
function myFunction() {
  let text = document.getElementById("idValue").value;
  $(".Value").val(text);
  //document.getElementById("demo").innerHTML = "You wrote: " + text;
}
</script>



{{-- Delete Modal --}}
<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supprimer du tableau</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Confirmer la Supression ?</h4>
                <input type="hidden" id="deleteing_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary delete_student">Oui supprimer</button>
            </div>
        </div>
    </div>
</div>
{{-- End - Delete Modal --}}


@push('ajax')
<script>

    $(document).ready(function () {

        fetchtabpanier();

        function fetchtabpanier() {
            $.ajax({
                type: "GET",
                url: "{{url('get-panier/'.$guest_id)}}",
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                   $('tbody#tbodyId').html("");
                    $.each(response.tabpanier, function (key, item) {
                        $('tbody#tbodyId').append(
                        '<tr>\
                            <td class="edit_id" style="display:none;">' + item.panier_id + '</td>\
                            <td>' + item.product_name + '</td>\
                            <td>' + item.prix + '</td>\
                            <td>' + item.qty + '</td>\
                            <td>' + item.total + '</td>\
                            <td>\
                            <button type="button" value="' + item.panier_id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                        \</tr>');
                    });
                  $('span#panierTot').html("");
                  $('span#panierTot').append(response.total_panier);
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
                url: "delete-tabpanier/"+id,
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                   
                       
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#DeleteModal').modal('hide');
                        fetchtabpanier();
                   
                }
            });
        });


        $(document).on('click', '.add_student', function (e) {
            e.preventDefault();

            $(this).text('Envoie...');

            var data = {
                'product_id': $('#product_id').val(),
                'prix': $('#input-price').val(),
                'qty': $('#input-qty').val(),
                'total': $('#input-total').val(),
                'user_id': $('#user_id').val(),
                'guest_id': $('#guest_id').val(),
                'taxe_id': $('#taxe_id').val(),
                'centre_id': $('#centre_id').val(),
            }

            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{url('/store-tabpanier')}}",
                data: data,
                dataType: "json",
                success: function (response) {
                  if (response.status == 400) {
                        $('#save_msgList').html("");
                        $('#save_msgList').addClass('alert alert-danger');
                        $('#save_msgList').text(response.error);
                        $('.add_student').text('Save');
                    } else {
                        $('#save_msgList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#AddStudentForm').find('input').val();
                        $('.add_student').text('Save');
                        fetchtabpanier();
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



 
@endsection