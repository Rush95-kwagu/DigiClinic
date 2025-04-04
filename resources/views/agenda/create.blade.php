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
                        <h5 class="card-title">Ajouter un rendez vous </h5>
                        </div>
                        <div class="card-body">
                        <div class="">
                            <form action="{{url('agendas')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                <label for="title" class="form-label">Titre</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                                </div>
                                <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </form>
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