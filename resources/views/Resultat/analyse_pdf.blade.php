<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Ordonnance</title>
		<link rel="stylesheet" href="style.css">
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">

		<script>
        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
        
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    	</script>	
		<script src="script.js"></script>
		<style>
						/* reset */

			*
			{
				border: 0;
				box-sizing: content-box;
				color: inherit;
				font-family: inherit;
				font-size: inherit;
				font-style: inherit;
				font-weight: inherit;
				line-height: inherit;
				list-style: none;
				margin: 0;
				padding: 0;
				text-decoration: none;
				vertical-align: top;
			}

			/* content editable */

			*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

			*[contenteditable] { cursor: pointer; }

			*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

			span[contenteditable] { display: inline-block; }


			/* content edit */

			*[content] { border-radius: 0.25em; min-width: 1em; outline: 0; }

			*[content] { cursor: pointer; }

			*[content]:hover, *[content]:focus, td:hover *[content], td:focus *[content], img.hover { background: red; box-shadow: 0 0 1em 0.5em red; }

			span[content] { display: inline-block; }

			/* heading */

			
			/* page */

			html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
			html { background: #999; cursor: default; }

			body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
			body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

			/* header */
			footer { margin-bottom: 0 0 3em; margin-top: 470px }
			
			/* javascript */

			.add, .cut
			{
				border-width: 1px;
				display: block;
				font-size: .8rem;
				padding: 0.25em 0.5em;	
				float: left;
				text-align: center;
				width: 0.6em;
			}

			.add, .cut
			{
				background: #9AF;
				box-shadow: 0 1px 2px rgba(0,0,0,0.2);
				background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
				background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
				border-radius: 0.5em;
				border-color: #0076A3;
				color: #FFF;
				cursor: pointer;
				font-weight: bold;
				text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
			}

			.add { margin: -2.5em 0 0; }

			.add:hover { background: #00ADEE; }

			.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
			.cut { -webkit-transition: opacity 100ms ease-in; }

			tr:hover .cut { opacity: 1; }


			 .header {
		text-align: center;
		border-bottom: 2px solid #ccc;
		padding-bottom: 10px;
		}
	h1{
		font-size:25px;
	}
    .header .top-text {
      color: #0077cc;
      font-weight: bold;
      line-height: 1.5;
      text-align:left;
      width: 33%;
      font-size:12px
    }

    .header .zone {
      font-size: 12px;
    }

    .header .clinic-name {
      color: green;
      font-size: 24px;
      font-weight: bold;
      margin: 10px 0;
    }

    .header .authorization {
      color: red;
      font-style: italic;
      font-size: 14px;
      margin-bottom: 10px;
    }

    .header .contact {
      color: #005baa;
      font-size: 16px;
    }

    .left-icon,
    .right-icon {
      width: 40px;
      position: absolute;
      top: 150px;
      height:80px;
    }

    .top-text2 {
      position: absolute;
      top: 130px;
      left: 33%;
      font-size: 12px;
    }

    .left-icon {
      left: 18%;
    }

    .right-icon {
      right: 18%;
    }

    .logo {
      position: absolute;
      right: 300px;
      top: 130px;
      text-align: right;
    }

    .logo img {
      height: 60px;
    }


    .logo .bureau {
      font-size: 14px;
      color: #005baa;
    }
 	.page-break {
            page-break-before: always;
        }
			@media print {
				* { -webkit-print-color-adjust: exact; }
				html { background: none; padding: 0; }
				body { box-shadow: none; margin: 0; 
				footer{margin-top: 480px  }
				}
				span:empty { display: none; }
				.add, .cut { display: none; }

			}

			.print{
    
			   float: right;
			   margin-top: -8px;
			   margin-right: 10px;
			    
			}


			@page { margin: 0; }


		table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; text-align: right; }
        .no-print { text-align: center; margin-top: 20px; } /* Cache les boutons lors de l'impression */
        @media print {
            .no-print { display: none; }


			 .header {
					text-align: center;
					border-bottom: 2px solid #ccc;
					padding-bottom: 10px;
					}

				.header .top-text {
				color: #0077cc;
				font-weight: bold;
				line-height: 1.5;
				text-align:left;
				width: 33%;
				font-size:12px
				}

				.header .zone {
				font-size: 12px;
				}

				.header .clinic-name {
				color: green;
				font-size: 24px;
				font-weight: bold;
				margin: 10px 0;
				}

				.header .authorization {
				color: red;
				font-style: italic;
				font-size: 14px;
				margin-bottom: 10px;
				}

				.header .contact {
				color: #005baa;
				font-size: 16px;
				}

				.left-icon,
				.right-icon {
				width: 40px;
				position: absolute;
				top: 150px;
				height:80px;
				}

				.top-text2 {
				position: absolute;
				top: 40px;
				left: 33%;
				font-size: 12px;
				text-align:center;
				}

				.left-icon {
				left: 10px;
				}

				.right-icon {
				right: 10px;
				}

				.logo {
				position: absolute;
				right: 30px;
				top: 40px;
				text-align: right;
				}

				.logo img {
				height: 60px;
				}


				.logo .bureau {
				font-size: 14px;
				color: #005baa;
				}
        }
        .page-break {
            page-break-before: always;
        }


       

		</style>
	</head>

	
	

	<div class="btn btn-secondary" onclick="printDiv('printMe')"><button contenteditable class="btn btn-primary"> Imprimer </button>
    </div>

    <a class="print" href="{{URL::to('/gestion-analyses/'.$path)}}"><button content class="print btn btn-danger"> Fermer </button>
    </a>
    <br>
	<body>


	<div id='printMe'>
		@php
        use SimpleSoftwareIO\QrCode\Facades\QrCode;
        use Illuminate\Support\Facades\DB;
        use App\Models\User;

        $centre_id = session('centre_id');
        $user =User::where('user_id',session('user_id'))->first();
        $infos = DB::table('tbl_centre')
            ->join('tbl_entite', 'tbl_entite.id_entite', '=', 'tbl_centre.id_entite')
            ->where('id_centre', $centre_id)
            ->select('tbl_entite.*', 'tbl_centre.*')
            ->first();

            $userInfo=DB::table('personnel')
                ->where('email',$user->email)
                ->first(); 
    @endphp


    @include('Resultat.pdf-header')
    <hr>
	<br><br>


    <h1>Résultats des analyses</h1><br>
    <p><strong>Patient :</strong> {{ $patient }}</p><br>
    <p><strong>Date :</strong> {{ now()->format('d/m/Y H:i') }}</p><br>
    <p><strong>Laboratin :</strong> {{$userInfo->nom}} {{$userInfo->prenom}}</p><br>
			<table>
				<thead>
					<tr>
						<th>Catégorie</th>
						<th>Elément</th>
						<th>Résultat</th>
						<th>Référence</th>
						<!-- <th>Date Validité</th> -->
					</tr>
				</thead>
				<tbody>
					@foreach ($data1 as $d )
					<tr>
						<td>{{ $d['categorie'] }}</td>
						<td>{{ $d['element'] }}</td>
						<td>{{ $d['decision'] }}</td>
						<td>{{ $d['observation'] }}</td>
						<!-- <td>{{ $d['date_validite'] }}</td> -->
					</tr>
					@endforeach
				</tbody>
			</table>
		
			<br> <br>


		@foreach ($data2 as $d )
		
		<div class="page-break">
		@include('Resultat.pdf-header')
		<hr>
			<h1>Résultats des analyses</h1> <br>
			<p><strong>Patient :</strong> {{ $patient }}</p><br>
			<p><strong>Date :</strong> {{ now()->format('d/m/Y H:i') }}</p><br>
			<p><strong>Catégorie :</strong> {{$d['categorie']}}</p><br>
			<p><strong>Analyse :</strong> {{$d['element']}}</p><br>
			<p><strong>Laboratin :</strong> {{$userInfo->nom}} {{$userInfo->prenom}}</p><br>
			<p><strong>Date Validité :</strong> {{$d['date_validite']}}</p><br>

		<table>
				<thead>
					<tr>
						<th>Elément</th>
						<th>Résultat</th>
						<th>Norme</th>
					</tr>
				</thead>
				<tbody>
				@foreach($d['resultats'] as $group => $resultats2)
							<tr>
						<td style="text-align:center" colspan="3">
							<h4><strong>{{$group}}</strong> </h4>
						</td>
						</tr>
					@foreach($resultats2 as $resultat)

					<tr>
						<td>{{ $resultat->element }}</td>
						<td>{{ $resultat->result }}</td>
						<td>{{ $resultat->norme }}</td>
					</tr>
					@endforeach
					@endforeach
				</tbody>
			</table>

			<div class="">
			<h6>Référence</h6>
			<p>{{$d['observation']}}</p>
			</div>
		</div> 


				<!-- <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" style="width: 150px;"> -->
			</div>
			<br> <br>
		@endforeach
		<footer>
		
			<h1><span>Notre devise</span></h1>
			<h1 style="font-size : 10px">
				<p><strong> DUR </strong> avec la maladie, <strong> DOUX </strong> avec le malade . Prompt Guérison</p>
				
			</h1 style="font-size : 10px">
		
	</footer>
	</div>
	@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
	</body>
</html>