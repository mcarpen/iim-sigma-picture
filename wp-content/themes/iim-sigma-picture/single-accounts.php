<?php get_header('admin'); ?>

<?php if (have_posts()) : while (have_posts()) : the_post();?>

<!-- TODO afficher ici les éléments du profil : Créer la page profil du client où tous les fichiers sont listés, envoyés et reçus, (même dispo que le dashboard utilisateur) et avec la possibilité d'envoyer des nouveaux fichiers par l'admin -->

<?php endwhile; endif; ?>

<?php get_footer(); ?>