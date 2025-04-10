<div class="header">
   
   <div class="top-text">
    <div class="" style="text-align:center">
    REPUBLIQUE DU BENIN<br>
     **********<br>
     MINISTERE DE LA SANTE<br>
     **********<br>
     Direction Départementale de la Santé du Littoral<br>
     **********<br>
     <span class="zone">Zone Sanitaire Cotonou VI</span>
    </div>
   </div>
   <div class="top-text2" style="text-align-center; width:33%">
   <p>QR CODE ICI</p>
       <!-- <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" style="width: 150px;"> -->
   </div>
   <div class="logo">
   <img src="{{ public_path('logo.jpg') }}" alt="logo directaid">
     <div class="bureau">BUREAU DU BENIN</div>
   </div>

   <div class="">
   <img src="{{ public_path('medical_icon.jpg') }}" alt="medical icon" class="left-icon">
   <img src="{{ public_path('medical_icon.jpg') }}" alt="medical icon" class="right-icon">

   <div class="clinic-name">
     {{$infos->nom_centre}}
   </div>

   <div class="authorization">
     Autorisation: {{$infos->Autorisation_decret}}
   </div>

   <div class="contact">
   {{$infos->adresse_centre}} &nbsp;&nbsp; Tél.: {{$infos->tel_centre}}
   </div>
   </div>
  

  
 </div>
