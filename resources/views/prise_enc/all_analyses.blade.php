@extends('layout')
@section('user_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
 $centre_id=Session::get('centre_id');
?>
    <div class="app-body">
     <!-- Row starts -->
            
     <!-- Row starts -->
      <div class="row gx-3">
        <div class="col-sm-12">
          <div class="card mb-3">
          <div class="card-header">
              <h5 class="card-title">Analyses</h5>
          </div>
          
          <div class="card-body">
            <div class="custom-tabs-container">
              <ul class="nav nav-tabs justify-content-center" id="customTab4" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab"
                    aria-controls="oneAAA" aria-selected="true">Analyses non traités</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab"
                    aria-controls="twoAAA" aria-selected="false">Analyses traités</a>
                </li>
               
              </ul>
              <div class="tab-content" id="customTabContent">
                <div class="tab-pane fade show active" id="oneAAA" role="tabpanel">
                  <!-- Row starts -->
                  <div class="row gx-3">
                     <div class="col-sm-12">
                        <div class="card mb-3">
                          <div class="card-header">
                            <h5 class="card-title">Analyses en attente de traitement</h5>
                          </div>
                          <div class="card-body">
                            <div class="">
                              <div class="table-responsive">
                                <table class="table truncate align-middle" id="example">
                                  <thead>
                                    <tr>
                                    <th></th>
                                    <th>Patient</th>
                                    <th>Analyse</th>
                                    <th>Contact</th>
                                    <th>Spécialiste actuel</th>
                                    <th>Date Hospitalisation</th>
                                      <th width="100px">Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                   @foreach($all_analyse_nt as $v_analyse) 
                                    <tr>
                                      <td>
                                        @if($v_analyse->sexe_patient == 'F')
                                        <img style="width:30px; height:30px;" src="{{asset('frontend/F.png')}}" alt="sexe')}}" class="rounded-circle img-3x">
                                        @else
                                        <img style="width:30px; height:30px;" src="{{asset('frontend/M.png')}}" alt="sexe" class="rounded-circle img-3x">
                                        @endif
                                      </td>
                                      <td>{{$v_analyse->prenom_patient}} {{$v_analyse->nom_patient}}</td>
                                      <td><h4><span class="badge bg-danger">{{$v_analyse->analyse}}{{$v_analyse->libelle_analyse}}</span></h4></td>
                                      <td>{{$v_analyse->telephone}}</td>
                                      <?php 
                                      $all_specialiste=DB::table('users')
                                            ->join('personnel','users.email','=','personnel.email')
                                            ->join('user_roles','users.user_role_id','=','user_roles.user_role_id')
                                            ->join('tbl_analyse','users.user_id','=','tbl_analyse.user_id')
                                            ->select('users.*','personnel.*','user_roles.*','tbl_analyse.*')
                                            ->where('users.user_id',$v_analyse->user_id)
                                            ->get();
                                      ?>   
                                      <td>
                                        @foreach($all_specialiste as $v_specialist)
                                        {{$v_specialist->designation}}. {{$v_specialist->prenom}} {{$v_specialist->nom}}
                                        @endforeach
                                      </td>
                                      <td>{{$v_analyse->created_at}}</td>    
                                      <td>
                                        <button class="btn btn-outline-success btn-sm add-analysis">Procéder au paiement</button>
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
                  <!-- Row ends -->
                </div>
                <div class="tab-pane fade" id="twoAAA" role="tabpanel">
                  <!-- Row starts -->
                  <div class="row gx-3">
                  <div class="col-sm-12">
                    <div class="card mb-3">
                      <div class="card-header">
                        <h5 class="card-title">Analyses traitées</h5>
                      </div>
                      <div class="card-body">
                        <div class="table-outer">
                          <div class="table-responsive">
                            <table class="table table-striped truncate m-0">
                              <thead>
                                 <tr>
                                    <th></th>
                                    <th>Patient</th>
                                    <th>Analyse</th>
                                    <th>Contact</th>
                                    <th>Spécialiste actuel</th>
                                    <th>Date Hospitalisation</th>
                                      <th width="100px">Actions</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($all_analyse_t as $v_analys) 
                                <tr>
                                  <td>
                                        @if($v_analys->sexe_patient == 'F')
                                        <img style="width:30px; height:30px;" src="{{asset('frontend/F.png')}}" alt="sexe')}}" class="rounded-circle img-3x">
                                        @else
                                        <img style="width:30px; height:30px;" src="{{asset('frontend/M.png')}}" alt="sexe" class="rounded-circle img-3x">
                                        @endif
                                      </td>
                                      <td>{{$v_analys->prenom_patient}}{{$v_analys->nom_patient}}</td>
                                      <td><h4><span class="badge bg-danger">{{$v_analys->analyse}}{{$v_analyse->libelle_analyse}}</span></h4></td>
                                      <td>{{$v_analys->telephone}}</td>
                                      <?php 
                                      $all_specialiste=DB::table('users')
                                            ->join('personnel','users.email','=','personnel.email')
                                            ->join('user_roles','users.user_role_id','=','user_roles.user_role_id')
                                            ->join('tbl_analyse','users.user_id','=','tbl_analyse.user_id')
                                            ->select('users.*','personnel.*','user_roles.*','tbl_analyse.*')
                                            ->where('users.user_id',$v_analys->user_id)
                                            ->get();
                                      ?>   
                                      <td>
                                        @foreach($all_specialiste as $v_specialist)
                                        {{$v_specialist->designation}}. {{$v_specialist->prenom}} {{$v_specialist->nom}}
                                        @endforeach
                                      </td>
                                      <td>{{$v_analys->created_at}}</td>    
                                      <td></td>
                                
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
                  <!-- Row ends -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     </div>
    </div>
   <!-- Row ends -->








  


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

      <script>                                      
      var inputt = document.querySelector("#phone2");
      window.intlTelInput(inputt, {
        initialCountry: "BJ",
        separateDialCode: true,
        hiddenInput: "telephone",
        utilsScript: "intl/build/js/utils.js?1537727621611" // just for formatting/placeholders etc

      });

      var itii = window.intlTelInputGlobals.getInstance(inputt);

        inputt.addEventListener('input', function() {
          var fullNumberr = itii.getNumber();
          document.getElementById('lnaii').value = fullNumberr;
        });



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
         			console.log(request.responseText) 
                  let data = JSON.parse(request.responseText);

                    
                  let options = data.reduce(function (acc, option) {
                      return acc + '<option value="' + option.prix + ' " style="font-weight: bold; color:green;">' + option.prix + ' F CFA</option>'
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
                console.log(this.loader, this.target.parentNode.parentNode)
             

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

@section('Datatable')
    <script>
      $(document).ready(function() {
      $("#example").DataTable();
    });
      $(".drop").change(function(){
      if(confirm('Cliquez OK pour enregistrer l\'analyse demandée')){
          {this.form.submit()} 
      }
      else $(".drop option:selected").prop("selected", false);
    });
    </script>
@endsection

<script type="text/javascript">
          function THEFUNCTION2(i)
     {
          var enlever = document.getElementById('enleverR');
          switch(i) {
              case 1 : enlever.style.display = ''; break;
              default: enlever.style.display = ''; break;
       
          }
      var enleverE = document.getElementById('enleverEE');
          switch(i) {
              case 2 : enleverE.style.display = 'none'; break;
              default: enleverE.style.display = 'none'; break;
       
       
          }
      }
</script>
@endsection