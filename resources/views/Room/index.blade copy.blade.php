@extends('layout')
@section('title')
    Admin
@endsection
@section('user_content')
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
                    <h5 class="card-title">Rooms by Department</h5>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-outer">
                      <div class="table-responsive">
                        <table class="table truncate align-middle m-0">
                          <thead>
                            <tr>
                              <th width="60px">N° de chambre</th>
                              <th width="100px">Type de chambre</th>
                              <th width="100px">Total</th>
                              <th width="100px">Nombre de lits </th>
                              <th width="100px">Occupées</th>
                              <th width="100px">Réservées</th>
                              <th width="100px">Disponibles</th>
                              <th width="100px">LIbérées</th>
                              <th width="100px">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                                  $chambres = DB::table('tbl_chambre')
                                        ->join('tbl_lits', 'tbl_chambre.id_chambre', '=', 'tbl_lits.id_chambre')
                                        ->select('tbl_chambre.libelle_chambre as libelle_chambre', 'tbl_chambre.type_chambre as type_chambre','tbl_chambre.is_vip as is_vip', DB::raw('count(tbl_lits.id_lit) as total_lits'))
                                        ->groupBy('tbl_chambre.id_chambre', 'tbl_chambre.libelle_chambre', 'tbl_chambre.type_chambre', 'tbl_chambre.is_vip')
                                        ->get();
                            @endphp
                            @foreach ($chambres as $chambre)
                            <tr>
                              <td>
                                {{$chambre->libelle_chambre}}
                              </td>

                              <td>
                                  @if ($chambre->is_vip== '0')
                                Ordinaire

                                @else
                                    VIP
                                @endif
                              </td>
                              <td>
                                <span class="badge bg-primary text-white">25</span>
                              </td>
                              <td>
                                <span class="badge border border-primary text-primary"><i class="ri-circle-fill"></i>
                                  {{ $chambre->total_lits }}</span>
                              </td>
                              <td>
                                <a href="{{route('allotted-room')}}"><span class="badge border border-danger text-danger"><i class="ri-circle-fill"></i>
                                  3</span></a>
                              </td>
                              <td>
                                <span class="badge border border-info text-info"><i class="ri-circle-fill"></i>
                                  7</span>
                              </td>
                              <td>
                                <span class="badge border border-warning text-warning"><i class="ri-circle-fill"></i>
                                  2</span>
                              </td>
                              <td>
                                <span class="badge border border-secondary text-dark"><i class="ri-circle-fill"></i>
                                  4</span>
                              </td>
                              <td>
                                <a href="{{route('available-room')}}" class="btn btn-primary">Voir les détails</a>
                              </td>
                            </tr>
                             @endforeach
                           {{--  <tr>
                              <td>
                                <img src="{{asset('frontend/images/products/3.jpg')}}" alt="Bootstrap Themes" class="rounded-2 img-3x">
                              </td>
                              <td>Ordinaire</td>
                              <td>
                                <span class="badge bg-primary text-white">21</span>
                              </td>
                              <td>
                                <span class="badge border border-primary text-primary"><i class="ri-circle-fill"></i>
                                  6</span>
                              </td>
                              <td>
                                <a href="{{route('allotted-room')}}"><span class="badge border border-danger text-danger"><i class="ri-circle-fill"></i>
                                  5</span></a>
                              </td>
                              <td>
                                <span class="badge border border-info text-info"><i class="ri-circle-fill"></i>
                                  2</span>
                              </td>
                              <td>
                                <span class="badge border border-warning text-warning"><i class="ri-circle-fill"></i>
                                  5</span>
                              </td>
                              <td>
                                <span class="badge border border-secondary text-dark"><i class="ri-circle-fill"></i>
                                  3</span>
                              </td>
                              <td>
                                <a href="{{route('available-room')}}" class="btn btn-primary">Voir les détails</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <img src="{{asset('frontend/images/products/4.jpg')}}" alt="Bootstrap Themes" class="rounded-2 img-3x">
                              </td>
                              <td>Neurology</td>
                              <td>
                                <span class="badge bg-primary text-white">15</span>
                              </td>
                              <td>
                                <span class="badge border border-primary text-primary"><i class="ri-circle-fill"></i>
                                  2</span>
                              </td>
                              <td>
                                <span class="badge border border-danger text-danger"><i class="ri-circle-fill"></i>
                                  4</span>
                              </td>
                              <td>
                                <span class="badge border border-info text-info"><i class="ri-circle-fill"></i>
                                  3</span>
                              </td>
                              <td>
                                <span class="badge border border-warning text-warning"><i class="ri-circle-fill"></i>
                                  4</span>
                              </td>
                              <td>
                                <span class="badge border border-secondary text-dark"><i class="ri-circle-fill"></i>
                                  2</span>
                              </td>
                              <td>
                                <a href="available-rooms.html" class="btn btn-primary">Voir les détails</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <img src="{{asset('frontend/images/products/6.jpg')}}" alt="Bootstrap Themes" class="rounded-2 img-3x">
                              </td>
                              <td>Gastroenterology</td>
                              <td>
                                <span class="badge bg-primary text-white">19</span>
                              </td>
                              <td>
                                <span class="badge border border-primary text-primary"><i class="ri-circle-fill"></i>
                                  1</span>
                              </td>
                              <td>
                                <span class="badge border border-danger text-danger"><i class="ri-circle-fill"></i>
                                  5</span>
                              </td>
                              <td>
                                <span class="badge border border-info text-info"><i class="ri-circle-fill"></i>
                                  3</span>
                              </td>
                              <td>
                                <span class="badge border border-warning text-warning"><i class="ri-circle-fill"></i>
                                  3</span>
                              </td>
                              <td>
                                <span class="badge border border-secondary text-dark"><i class="ri-circle-fill"></i>
                                  7</span>
                              </td>
                              <td>
                                <a href="available-rooms.html" class="btn btn-primary">Voir les détails</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <img src="{{asset('frontend/images/products/2.jpg')}}" alt="Bootstrap Themes" class="rounded-2 img-3x">
                              </td>
                              <td>Anatomy</td>
                              <td>
                                <span class="badge bg-primary text-white">13</span>
                              </td>
                              <td>
                                <span class="badge border border-primary text-primary"><i class="ri-circle-fill"></i>
                                  2</span>
                              </td>
                              <td>
                                <span class="badge border border-danger text-danger"><i class="ri-circle-fill"></i>
                                  2</span>
                              </td>
                              <td>
                                <span class="badge border border-info text-info"><i class="ri-circle-fill"></i>
                                  1</span>
                              </td>
                              <td>
                                <span class="badge border border-warning text-warning"><i class="ri-circle-fill"></i>
                                  5</span>
                              </td>
                              <td>
                                <span class="badge border border-secondary text-dark"><i class="ri-circle-fill"></i>
                                  3</span>
                              </td>
                              <td>
                                <a href="available-rooms.html" class="btn btn-primary">Voir les détails</a>
                              </td>
                            </tr> --}}
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- Table ends -->

                  </div>
                </div>
              </div>
            </div>
            <!-- Row ends -->

          </div>
          <!-- App body ends -->
@endsection
