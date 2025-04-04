@extends('layout')
@section('user_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
?>

<!-- App body starts -->
          <div class="app-body">
          <div class="row gx-3">
                             <div class="col-sm-12">
                                <div class="card mb-3">
                                  <div class="card-header">
                                    <h5 class="card-title">Liste des rendez vous  </h5>
                                    <div class="card-options">
                                      <a href="{{url('agendas/create')}}" class="btn btn-primary btn-sm">Ajouter un rendez-vous</a>
                                  </div>
                                  <div class="card-body">
                                    <div class="">
                                      <div class="table-responsive">
                                        <table class="table truncate align-middle" id="example">
                                          <thead>
                                            <tr>
                                              <th width="30px">&nbsp;</th>
                                              <th width="60px">Titre</th>
                                              <th width="100px">Description </th>
                                              <th width="100px">Date</th>                                          
                                              <th width="100px">Actions</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                           @foreach($agendas as $agenda) 
                                            <tr>
                                                <td><input type="checkbox" name="id[]" value="{{$agenda->id_agenda}}"></td>
                                                <td>{{$agenda->title}}</td>
                                                <td>{{$agenda->description}}</td>                                                
                                                <td>{{$agenda->date}}</td>                                                
                                                <td> 
                                                    <a href="{{url('agendas/'.$agenda->id.'/edit')}}" class="btn btn-primary btn-sm">Modifier</a>
                                                     <form action="{{url('agendas/'.$agenda->id)}}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                                    </form>
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
          <!-- App body ends -->

          
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

@section('Datatable')
    <script>
      $(document).ready(function() {
      $("#example").DataTable();
    });
      $(document).ready(function() {
      $("#example2").DataTable();
    });
      $(document).ready(function() {
      $("#example3").DataTable();
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
@endsection