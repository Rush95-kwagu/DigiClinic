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
                        <h2>Ventes</h2>
                      <footer class="border-top dropdown-notify-footer">
                        <div class="d-flex justify-content-between align-items-center py-2 px-4">
                          <span>Imprimer l'état journalier de la caisse </span>
                          <a id="refress-button" href="{{URL::to('etat-caisse')}}" class="btn mdi mdi-printer btn-refress"><i class="ri-file-pdf-2-fill"></i></a>
                        </div>
                      </footer>
                       
                         <div class="dropdown">
                          <a class="float-right btn btn-success btn-pill " href="{{URL::to('/choix-client')}}">Enregistrer une vente</a>

                          <!-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                          </div> -->
                        </div> 
                      </div>


        <div class="border p-6">
            <div class="card-body">
               <table class="table truncate align-middle" id="example">
                <thead>
                    <tr>
                    <th>N°Vente</th>
                    <th>Client</th>
                    <th>Contact</th>
                    <th>Contact</th>
                    <th>Total</th>
                    <th>Paiement</th>
                    <th>Date</th>
                    <th >Actions</th>
                    
                    </tr>
                </thead>
                <tbody>
                        
                   @foreach($all_ventes_info as $v_order) 
                  
                  <tr>
                    <td class="center">{{$v_order->transaction_id}}</td>
                    <td class="center">{{$v_order->guest_first_name}} {{$v_order->guest_last_name}}</td>
                    <td class="center">{{$v_order->guest_address}}</td>
                    <td class="center">{{$v_order->guest_mobile_number}}</td>
                    
                    <td class="center">{{$v_order->order_total}}</td>
                    <td class="center">{{$v_order->payment_method}}</td>

                    <td class="center">
                      {{\Carbon\Carbon::parse($v_order->created_at)->format('d-m-Y')}}  
                    </td>
                    <td class="center">
                      <a title="Détail" class="btn btn-info" href="" data-toggle="collapse" data-target="#{{$v_order->order_id}}" aria-expanded="false" aria-controls="{{$v_order->order_id}}">		
        								<i class="mdi mdi-eye-plus"></i>
        		          </a>

                      <a title="Facture" class="btn btn-success" href="{{URL::to('make-facture/'.$v_order->order_id)}}">    
                        <i class="mdi mdi-file"></i>
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
   

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

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
    </script>
@endsection

<script>
    let link = document.querySelectorAll('td a#affi')
    
    var affiche_nom = document.querySelector('span.affiche_nom')
    
    link.forEach(lin => {
    lin.addEventListener('click', () => {     
    affiche_nom.textContent = lin.parentNode.parentNode.querySelector('.order_id').textContent
        })
    })

 </script>
@endsection