<x-mail::message>
# Merci pour votre abonnement <br>

La newsletter TOPSYSTEM est le meilleur moyen de connaître nos offres en cours ainsi que les développements de produits <br>

Une à deux fois par mois, vous recevrez une newsletter contenant des informations sur nos dernières mises à jour majeures, nos offres spéciales et/ou intéressantes et bien plus encore.<br>

Nous sommes heureux de vous avoir à bord !<br>

Bien à vous,<br>
<x-mail::button :url="\URL::to('/unsubscribe/'.$mailData['subscriber_mail'])">
Se désabonner
</x-mail::button>

Cordialement,<br>
{{ config('app.name') }}
</x-mail::message>


